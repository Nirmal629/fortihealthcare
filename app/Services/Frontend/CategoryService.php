<?php

namespace App\Services\Frontend;

use App\Http\Requests\Frontend\FilterRequest;
use App\Models\MenuItem;
use App\Models\ProductCategory;
use App\Services\Frontend\ProductService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;

class CategoryService
{

  public function __construct(protected ProductService $productService) {}

  /**
   * Get Product Categories that have products.
   *
   * @param int $limit
   * @param string|null $orderBy ('latest' or 'oldest' or null)
   * @return \Illuminate\Support\Collection
   */
  public function getCategoriesWithProducts(int $limit = 16, ?string $orderBy = null): Collection
  {
    // $slugs = [
    //   'red-apples',
    //   'hass-avocados',
    //   'chicken',
    //   'white-bread',
    //   'ground-goat',
    // ];

    $query = ProductCategory::whereHas('products')
      // ->whereIn('slug', $slugs)
      // ->orderByRaw("FIELD(slug, '" . implode("','", $slugs) . "')") // preserve the given sequence
      ->when($orderBy, fn($q) => $q->orderBy('created_at', $orderBy === 'latest' ? 'desc' : 'asc'));

    return $limit > 0 ? $query->take($limit)->get() : $query->get();
  }

  /**
   * Retrieve a category by slug or the newest for 'new-collections'.
   */
  public function getCategory(string $slug, ?string $parentSlug = null): ?ProductCategory
  {
    $query = ProductCategory::with('products', 'children');
    
    if ($slug === 'new-collections') {
      $category = $query->orderBy('created_at', 'desc')->first();
    } else {
      $query->where('slug', $slug);
      
      if ($parentSlug) {
          $query->whereHas('parent', function ($q) use ($parentSlug) {
              $q->where('slug', $parentSlug);
          });
      }
      
      $category = $query->first();
    }

    if ($category && $slug === 'new-collections') {
      $category->title = 'New Collections';
    }
    return $category;
  }

  /**
   * Get direct child categories with minimal fields.
   */
  public function getChildCategories(ProductCategory $category): Collection
  {
    return ProductCategory::where('parent_id', $category->id)
      ->orderBy('sequence')
      ->get(['id', 'title', 'slug', 'category_image']);
  }

  /**
   * Recursively find products in a category or its descendants.
   */
  public function findProducts(ProductCategory $category): Collection
  {
    $products = $category->products()->with(['variants.images.gallery', 'variants.inventory', 'variants.variantAttributes'])->get();

    $childCategories = $this->getChildCategories($category);
    if ($childCategories->isNotEmpty()) {
      foreach ($childCategories as $subCategory) {
        $products = $products->concat($this->findProducts($subCategory));
      }
    }

    return $products;
  }

  /**
   * Get products to display.
   */
  public function getDisplayProducts(ProductCategory $category): Collection
  {
    $products = $category->products()->with(['variants.images.gallery', 'variants.inventory', 'variants.variantAttributes'])->get();

    if ($products->isNotEmpty()) {
      return $products;
    }

    return $this->findProducts($category);
  }

  /**
   * Prepare data for the category view.
   */
  public function prepareViewData(ProductCategory $category, Collection $products, FilterRequest $request, string $slug): array
  {
    $params = $request->all();
    $perPage = (int) ($params['per_page'] ?? 10);
    $page = (int) ($params['page'] ?? 1);

    $productIds = $products->pluck('id')->toArray();

    $variantQuery = \App\Models\ProductVariant::whereIn('product_id', $productIds)
      ->where('status', 1)
      ->withCommonRelations();

    // Keywords search
    $keywords = $this->productService->getKeywords($params);
    if (!empty($keywords)) {
      $variantQuery->where(function ($q) use ($keywords) {
        foreach ($keywords as $kw) {
          $q->orWhere('name', 'like', "%{$kw}%")->orWhere('sku', 'like', "%{$kw}%");
        }
      });
    }

    // Price filter
    if (isset($params['min_price'], $params['max_price']) && $params['min_price'] !== '' && $params['max_price'] !== '') {
      $variantQuery->whereBetween(\Illuminate\Support\Facades\DB::raw('COALESCE(sale_price, regular_price)'), [$params['min_price'], $params['max_price']]);
    }

    // Sorting
    $sortKey = $params['sort'] ?? 'relevance';
    if ($sortKey === 'lowest-price') {
      $variantQuery->orderByRaw('COALESCE(sale_price, regular_price) ASC');
    } elseif ($sortKey === 'highest-price') {
      $variantQuery->orderByRaw('COALESCE(sale_price, regular_price) DESC');
    } elseif ($sortKey === 'most-recent') {
      $variantQuery->orderBy('created_at', 'desc');
    } else {
      $variantQuery->orderBy('id', 'asc');
    }

    $allVariants = $variantQuery->get();

    // 10 items per page pagination
    $variants = new \Illuminate\Pagination\LengthAwarePaginator(
      $allVariants->forPage($page, $perPage),
      $allVariants->count(),
      $perPage,
      $page,
      ['path' => $request->url(), 'query' => $request->query()]
    );

    $product = $products->first();
    if ($product) {
      $product->searchSlug = Str::slug($product->name);
    }

    $priceRange = $product ? $this->productService->getPriceRange($product, $params) : [
      'minPrice' => 0, 'maxPrice' => 0, 'actualMinPrice' => 0, 'actualMaxPrice' => 0
    ];

    $totalVariants = $allVariants->count();
    $selectedFilters = $params['attributes'] ?? [];
    $attributes = $product ? $this->productService->getFilterAttributes($product) : collect();

    return [
      'category' => $category,
      'title' => $category->title ?? '',
      'selectedCategory' => $this->getChildCategories($category)->first(),
      'product' => $product,
      'products' => $products,
      'relatedProducts' => $products,
      'totalVariants' => $totalVariants,
      'variants' => $variants,
      'selectedFilters' => $selectedFilters,
      'priceRange' => $priceRange,
      'attributes' => $attributes,
    ];
  }

  // public function getNestedCategories($id = 0)
  // {
  //   return ProductCategory::with(['children'])
  //     ->where('parent_id', $id)
  //     ->orderBy('sequence', 'asc')
  //     ->take(7)
  //     ->get(['title', 'id']);
  // }

  // public function getNestedCategories($id = 0)
  // {
  //   return ProductCategory::with(['children.children'])
  //     ->where('parent_id', 0)
  //     ->take(7)
  //     ->get();
  // }

  public function getNestedCategories(int $parentId = 0, int $limit = 7)
  {
    return ProductCategory::with([
      'children' => function ($q) {
        $q->select('id', 'title', 'slug', 'parent_id', 'sequence', 'category_image')
          ->orderBy('sequence')
          ->with([
            'children' => function ($q2) {
              $q2->select('id', 'title', 'slug', 'parent_id', 'sequence', 'category_image')
                ->orderBy('sequence');
            }
          ]);
      }
    ])
      ->select('id', 'title', 'slug', 'parent_id', 'sequence', 'category_image')
      ->where('parent_id', $parentId)   // root categories
      ->orderBy('sequence')
      ->take($limit)
      ->get();
  }

  //$menus =
}
