<?php

namespace App\Livewire\Reports;

use App\Livewire\BaseComponent;
use App\Models\OrderProduct;

class ProductPerformanceTable extends BaseComponent
{
  public $filename = '';

  public $columnsWithAliases = [
    'sl' => 'Sl.',
    'variant->category->title' => 'Category',
    'variant->name' => 'Variant Name',
    'variant->sku' => 'SKU',
    'order_count' => 'Orders',
    'total_sales' => 'Revenue',
  ];

  public function __construct()
  {
    $this->sortColumn = 'order_count';
    $this->sortDirection = 'DESC';
  }

  public function getQuery($filtered = false)
  {
    $query = OrderProduct::with('variant.product')
      ->select('variant_id')
      ->selectRaw('COUNT(*) as order_count')
      ->selectRaw('SUM(sell_price) as total_sales')
      ->groupBy('variant_id')
      ->orderBy($this->sortColumn ?? 'order_count', $this->sortDirection ?? 'desc');

    if ($filtered) {
      $query->search($this->search)
        ->when($this->startDate && $this->endDate, function ($q) {
          $q->whereBetween('created_at', [$this->startDate, $this->endDate]);
        });
    }

    return $query;
  }

  public function exportToCSV($filtered = false)
  {
    return $this->exportCSVTrait(
      $this->getQuery($filtered),
      $this->columnsWithAliases,
      $this->sortColumn,
      $this->sortDirection,
      $this->filename
    );
  }

  public function render()
  {
    $products = $this->getQuery(true)->paginate($this->perPage);

    $serialNumber = ($products->currentPage() - 1) * $products->perPage() + 1;

    return view('livewire.reports.product-performance-table', [
      'products' => $products,
      'serialNumber' => $serialNumber
    ]);
  }
}
