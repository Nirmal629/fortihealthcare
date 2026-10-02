<?php

namespace App\Livewire\Reports;

use App\Livewire\BaseComponent;
use App\Models\OrderProduct;

class TopConversionProductsTable extends BaseComponent
{
  public $filename = '';

  public $columnsWithAliases = [
    'sl' => 'Sl.',
    'variant->category->title' => 'Category',
    'variant->name' => 'Variant Name',
    'variant->sku' => 'SKU',
    'cart_count' => 'Cart Count',
    'order_count' => 'Order Count',
    'conversion_rate' => 'Conversion %',
  ];

  public function __construct()
  {
    $this->sortColumn = 'conversion_rate';
    $this->sortDirection = 'DESC';
  }

  public function getQuery($filtered = false)
  {
    $query = OrderProduct::with('variant.product')
      ->select('variant_id')
      ->selectRaw('COUNT(*) as order_count')

      // ✅ FIXED CART COUNT
      ->selectRaw("
        (
          SELECT COUNT(*)
          FROM carts
          WHERE carts.product_variant_id = order_products.variant_id
          AND carts.status = 0
          AND carts.is_saved_for_later = 0
          AND carts.quantity > 0
          AND carts.deleted_at IS NULL
        ) as cart_count
      ")

      // ✅ FIXED CONVERSION %
      ->selectRaw("
        CASE
          WHEN (
            SELECT COUNT(*) FROM carts
            WHERE carts.product_variant_id = order_products.variant_id
            AND carts.status = 0
            AND carts.is_saved_for_later = 0
            AND carts.quantity > 0
            AND carts.deleted_at IS NULL
          ) > 0
          THEN (
            COUNT(*) / (
              SELECT COUNT(*) FROM carts
              WHERE carts.product_variant_id = order_products.variant_id
              AND carts.status = 0
              AND carts.is_saved_for_later = 0
              AND carts.quantity > 0
              AND carts.deleted_at IS NULL
            )
          ) * 100
          ELSE 0
        END as conversion_rate
      ")

      ->groupBy('variant_id')
      ->orderBy($this->sortColumn ?? 'conversion_rate', $this->sortDirection ?? 'desc');

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

    return view('livewire.reports.top-conversion-products-table', [
      'products' => $products,
      'serialNumber' => $serialNumber
    ]);
  }
}
