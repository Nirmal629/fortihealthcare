<?php

namespace App\Services\Backend\Reports;

use App\Models\OrderProduct;
use Illuminate\Support\Str;

class ProductPerformanceService
{
  public function __construct() {}

  public function viewData()
  {
    return [
      'pageTitle' => 'Product Performance Analytics',
      'cardHeader' => 'Product Performance Analytics',
    ];
  }

  /**
   * 🔹 Chart 1: Top Products (Order Count)
   */
  public function getTopProductsJson($dateRange)
  {
    $data = OrderProduct::with('variant.product')
      ->select('variant_id')
      ->selectRaw('COUNT(*) as order_count')
      ->when($dateRange->start_date && $dateRange->end_date, function ($q) use ($dateRange) {
        $q->whereBetween('created_at', [
          $dateRange->start_date,
          $dateRange->end_date . ' 23:59:59'
        ]);
      })
      ->groupBy('variant_id')
      ->orderByDesc('order_count')
      ->limit(10)
      ->get();

    $categories = [];
    $orderCounts = [];

    foreach ($data as $item) {
      $variantName = $item->variant->name ?? 'Unnamed Product';
      $categories[] = Str::limit($variantName, 40);
      $orderCounts[] = (int) $item->order_count;
    }

    return response()->json([
      'series' => [
        [
          'name' => 'Order Count',
          'data' => $orderCounts
        ]
      ],
      'chart' => [
        'type' => 'bar',
        'height' => 400,
        'toolbar' => [
          'show' => false,
          'export' => [
            'csv' => [
              'filename' => 'top-products-' . date('Y-m-d H:i:s')
            ],
          ],
        ],
      ],
      'xaxis' => [
        'categories' => $categories
      ],
      'plotOptions' => [
        'bar' => [
          'horizontal' => true,
          'barHeight' => '70%',
          'distributed' => true
        ]
      ],
      'dataLabels' => [
        'enabled' => true
      ],
      'colors' => ['#0062d0'],
      'legend' => [
        'show' => false
      ]
    ]);
  }

  /**
   * 🔹 Chart 2: Product Revenue
   */
  public function getProductRevenueJson($dateRange)
  {
    $data = OrderProduct::with('variant.product')
      ->select('variant_id')
      ->selectRaw('SUM(sell_price) as total_revenue')
      ->when($dateRange->start_date && $dateRange->end_date, function ($q) use ($dateRange) {
        $q->whereBetween('created_at', [
          $dateRange->start_date,
          $dateRange->end_date . ' 23:59:59'
        ]);
      })
      ->groupBy('variant_id')
      ->orderByDesc('total_revenue')
      ->limit(10)
      ->get();

    $categories = [];
    $revenues = [];

    foreach ($data as $item) {
      $variantName = $item->variant->name ?? 'Unnamed Product';
      $categories[] = Str::limit($variantName, 40);
      $revenues[] = (float) $item->total_revenue;
    }

    return response()->json([
      'series' => [
        [
          'name' => 'Revenue',
          'data' => $revenues
        ]
      ],
      'chart' => [
        'type' => 'bar',
        'height' => 400,
        'toolbar' => [
          'show' => false,
          'export' => [
            'csv' => [
              'filename' => 'product-revenue-' . date('Y-m-d H:i:s')
            ],
          ],
        ],
      ],
      'xaxis' => [
        'categories' => $categories
      ],
      'plotOptions' => [
        'bar' => [
          'horizontal' => true,
          'barHeight' => '70%',
          'distributed' => true
        ]
      ],
      'dataLabels' => [
        'enabled' => true
      ],
      'colors' => ['#00E396'],
      'legend' => [
        'show' => false
      ]
    ]);
  }
}
