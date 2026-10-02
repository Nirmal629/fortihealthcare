<?php

namespace App\Livewire;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductVariant;
use App\Models\SearchQuery;
use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Str;

class FrontendSearch extends Component
{
  public string $search_products = '';
  public bool $showResults = false;
  public array $searchHistory = [];

  public function mount()
  {
    $this->loadSearchHistory();
  }

  public function loadSearchHistory()
  {
    $sessionHistory = session('search_medicine_history', []);
    $list = [];

    if (is_array($sessionHistory)) {
      foreach ($sessionHistory as $item) {
        if (is_array($item) && !empty($item['name'])) {
          $list[] = [
            'name' => $item['name'],
            'category' => $item['category'] ?? 'General Medicine',
            'sku' => $item['sku'] ?? '',
            'url' => $item['url'] ?? (!empty($item['sku']) ? route('product.show', ['variant' => $item['sku']]) : '#'),
          ];
        }
      }
    }

    $this->searchHistory = array_slice($list, 0, 8);
    session(['search_medicine_history' => $this->searchHistory]);
  }

  public function updatedSearchProducts()
  {
    $query = trim($this->search_products);

    if (!empty($query)) {
      $this->showResults = true;
      $this->logQuery($query);
    } else {
      $this->showResults = false;
    }
  }

  public function logQuery(string $query)
  {
    $normalized = trim(strtolower($query));
    if (mb_strlen($normalized) < 3) {
      return;
    }

    if (session('last_logged_search_query') !== $normalized) {
      SearchQuery::log(
        query: $normalized,
        userId: user() ? user()->id : null,
        ip: request()->ip()
      );
      session(['last_logged_search_query' => $normalized]);
    }
  }

  public function recordMedicineClick(string $sku, string $name, string $category = '', string $url = '')
  {
    $item = [
      'sku' => $sku,
      'name' => $name,
      'category' => $category ?: 'General Medicine',
      'url' => $url ?: route('product.show', ['variant' => $sku]),
    ];

    $history = session('search_medicine_history', []);
    if (!is_array($history)) {
      $history = [];
    }

    $history = array_values(array_filter($history, function ($h) use ($sku, $name) {
      $existingSku = is_array($h) ? ($h['sku'] ?? '') : '';
      $existingName = is_array($h) ? ($h['name'] ?? '') : '';
      return strtolower($existingSku) !== strtolower($sku) && strtolower($existingName) !== strtolower($name);
    }));

    array_unshift($history, $item);
    $this->searchHistory = array_slice($history, 0, 8);
    session(['search_medicine_history' => $this->searchHistory]);

    $this->dispatch('save-local-medicine-history', item: $item);

    SearchQuery::log(
      query: $name,
      userId: user() ? user()->id : null,
      ip: request()->ip()
    );
  }

  public function removeSearchHistory(string $identifier)
  {
    $identifier = strtolower(trim($identifier));
    $history = array_values(array_filter($this->searchHistory, function ($item) use ($identifier) {
      $sku = strtolower(trim($item['sku'] ?? ''));
      $name = strtolower(trim($item['name'] ?? ''));
      return $sku !== $identifier && $name !== $identifier;
    }));

    $this->searchHistory = $history;
    session(['search_medicine_history' => $history]);

    $this->dispatch('remove-local-medicine-history', identifier: $identifier);
  }

  public function clearSearchHistory()
  {
    $this->searchHistory = [];
    session()->forget('search_medicine_history');
    session()->forget('search_history');

    $this->dispatch('clear-local-medicine-history');
  }

  #[On('sync-local-medicine-history')]
  public function syncLocalMedicineHistory(array $localHistory = [])
  {
    if (!empty($localHistory)) {
      $current = $this->searchHistory;
      $merged = [];
      $seen = [];

      foreach (array_merge($current, $localHistory) as $item) {
        if (is_array($item) && !empty($item['name'])) {
          $key = strtolower($item['sku'] ?: $item['name']);
          if (!isset($seen[$key])) {
            $seen[$key] = true;
            $merged[] = [
              'name' => $item['name'],
              'category' => $item['category'] ?? 'General Medicine',
              'sku' => $item['sku'] ?? '',
              'url' => $item['url'] ?? (!empty($item['sku']) ? route('product.show', ['variant' => $item['sku']]) : '#'),
            ];
          }
        }
      }

      $this->searchHistory = array_slice($merged, 0, 8);
      session(['search_medicine_history' => $this->searchHistory]);
    }
  }

  public function getVariants()
  {
    $query = trim($this->search_products);
    if (empty($query)) {
      return collect();
    }

    $queryLower = strtolower($query);

    // 1. Check for specific exact variant/medicine name or SKU match
    $exactSpecific = ProductVariant::with(['product.category', 'images.gallery'])
      ->where('status', 1)
      ->whereHas('product', fn($pq) => $pq->where('status', 1))
      ->where(function ($q) use ($queryLower) {
        $q->whereRaw('LOWER(name) = ?', [$queryLower])
          ->orWhereRaw('LOWER(sku) = ?', [$queryLower]);
      })
      ->get()
      ->map(function ($variant) {
        $variant->product_name = $variant->product?->name ?? $variant->name;
        $variant->category_name = $variant->product?->category?->title ?? 'General Medicine';
        $variant->image_url = get_default_variant_image($variant);
        $variant->url = route('product.show', ['variant' => $variant->sku]);
        return $variant;
      });

    if ($exactSpecific->isNotEmpty()) {
      return $exactSpecific;
    }

    // 2. Otherwise, find all medicines of the same type/category/name
    $searchTerms = array_filter(explode(' ', $query));

    $matchingVariants = ProductVariant::with(['product.category', 'images.gallery'])
      ->where('status', 1)
      ->whereHas('product', fn($pq) => $pq->where('status', 1))
      ->where(function ($q) use ($query, $searchTerms) {
        $q->where('name', 'like', '%' . $query . '%')
          ->orWhere('sku', 'like', '%' . $query . '%')
          ->orWhereHas('product', function ($pq) use ($query) {
            $pq->where('name', 'like', '%' . $query . '%')
              ->orWhere('sku', 'like', '%' . $query . '%')
              ->orWhereHas('category', function ($cq) use ($query) {
                $cq->where('title', 'like', '%' . $query . '%');
              });
          });

        foreach ($searchTerms as $term) {
          if (mb_strlen($term) >= 1) {
            $q->orWhere('name', 'like', '%' . $term . '%')
              ->orWhere('sku', 'like', '%' . $term . '%')
              ->orWhereHas('product', function ($pq) use ($term) {
                $pq->where('name', 'like', '%' . $term . '%')
                  ->orWhere('sku', 'like', '%' . $term . '%')
                  ->orWhereHas('category', function ($cq) use ($term) {
                    $cq->where('title', 'like', '%' . $term . '%');
                  });
              });
          }
        }
      })
      ->get()
      ->map(function ($variant) {
        $variant->product_name = $variant->product?->name ?? $variant->name;
        $variant->category_name = $variant->product?->category?->title ?? 'General Medicine';
        $variant->image_url = get_default_variant_image($variant);
        $variant->url = route('product.show', ['variant' => $variant->sku]);
        return $variant;
      });

    if ($matchingVariants->isNotEmpty()) {
      return $matchingVariants->take(15);
    }

    // 3. Fallback to fuzzy search for typo tolerance
    $allVariants = ProductVariant::with(['product.category', 'images.gallery'])
      ->where('status', 1)
      ->whereHas('product', fn($pq) => $pq->where('status', 1))
      ->get()
      ->map(function ($variant) {
        $variant->product_name = $variant->product?->name ?? $variant->name;
        $variant->category_name = $variant->product?->category?->title ?? 'General Medicine';
        $variant->image_url = get_default_variant_image($variant);
        $variant->url = route('product.show', ['variant' => $variant->sku]);
        return $variant;
      });

    $fuzzyVariants = $allVariants->map(function ($variant) use ($queryLower) {
      $name = strtolower($variant->name ?? '');
      $pname = strtolower($variant->product_name ?? '');
      $sku = strtolower($variant->sku ?? '');
      $cat = strtolower($variant->category_name ?? '');

      similar_text($queryLower, $name, $scoreName);
      similar_text($queryLower, $pname, $scorePname);
      similar_text($queryLower, $sku, $scoreSku);
      similar_text($queryLower, $cat, $scoreCat);

      $variant->match_score = max($scoreName, $scorePname, $scoreSku, $scoreCat);
      return $variant;
    })->filter(function ($variant) {
      return $variant->match_score > 30;
    })->sortByDesc('match_score')->take(12);

    return $fuzzyVariants;
  }

  public function generateSearchUrl($variant)
  {
    return route('product.show', ['variant' => $variant->sku]);
  }

  #[On('clearSearch')]
  public function clearSearch()
  {
    $this->reset(['search_products', 'showResults']);
    $this->loadSearchHistory();
  }

  public function render()
  {
    $query = trim($this->search_products);
    $queryLength = mb_strlen($query);
    $variants = ($this->showResults && !empty($query))
      ? $this->getVariants()
      : collect();

    return view('livewire.frontend-search', [
      'variants' => $variants,
      'queryLength' => $queryLength,
      'searchHistory' => $this->searchHistory,
    ]);
  }
}
