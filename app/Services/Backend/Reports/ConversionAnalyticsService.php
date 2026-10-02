<?php

namespace App\Services\Backend\Reports;

use App\Models\Order;
use App\Models\Cart;

class ConversionAnalyticsService
{
  public function __construct() {}

  public function viewData()
  {
    return [
      'pageTitle' => 'Conversion Analytics',
      'cardHeader' => 'Conversion Analytics',
    ];
  }

  public function getConversionStatusJson($dateRange)
  {
    $start = $dateRange->start_date;
    $end = $dateRange->end_date . ' 23:59:59';

    $dailyData = Order::selectRaw("
        DATE(created_at) as date,
        COUNT(*) as order_count
    ")
      ->where('order_status', 5) // completed
      ->whereBetween('created_at', [$start, $end])
      ->groupBy('date')
      ->get();

    $categories = [];
    $conversionRates = [];

    foreach ($dailyData as $row) {

      $cartCount = Cart::where('status', 0)
        ->where('is_saved_for_later', 0)
        ->where('quantity', '>', 0)
        ->whereNull('deleted_at')
        ->whereDate('created_at', $row->date)
        ->count();

      $categories[] = $row->date;
      $conversionRates[] = $cartCount > 0
        ? round(($row->order_count / $cartCount) * 100, 2)
        : 0;
    }

    return response()->json([
      'series' => [
        [
          'name' => 'Conversion %',
          'type' => 'line',
          'data' => $conversionRates
        ]
      ],
      'chart' => [
        'height' => 350,
        'type' => 'line',
        'toolbar' => [
          'show' => true,
          'export' => [
            'csv' => [
              'filename' => 'conversion-status-' . date('Y-m-d H:i:s')
            ],
          ],
          'tools' => [
            'download' => false
          ]
        ]
      ],
      'stroke' => [
        'width' => [3]
      ],
      'dataLabels' => [
        'enabled' => true
      ],
      'xaxis' => [
        'categories' => $categories
      ],
      'yaxis' => [
        [
          'title' => ['text' => 'Conversion %']
        ]
      ],
      'colors' => ['#00E396'],
      'legend' => [
        'position' => 'top',
        'horizontalAlign' => 'left'
      ]
    ]);
  }

  public function getCartOrderComparisonJson($dateRange)
  {
    $start = \Carbon\Carbon::parse($dateRange->start_date);
    $end = \Carbon\Carbon::parse($dateRange->end_date);

    $categories = [];
    $cartCounts = [];
    $orderCounts = [];

    while ($start <= $end) {

      $date = $start->toDateString();

      $cartCount = Cart::where('status', 0)
        ->where('is_saved_for_later', 0)
        ->where('quantity', '>', 0)
        ->whereNull('deleted_at')
        ->whereDate('created_at', $date)
        ->count();

      $orderCount = Order::whereIn('order_status', [1, 5])
        ->whereDate('created_at', $date)
        ->count();

      $categories[] = $date;
      $cartCounts[] = $cartCount;
      $orderCounts[] = $orderCount;

      $start->addDay();
    }

    return response()->json([
      'series' => [
        [
          'name' => 'Cart Count',
          'type' => 'column',
          'data' => $cartCounts
        ],
        [
          'name' => 'Orders',
          'type' => 'line',
          'data' => $orderCounts
        ]
      ],
      'chart' => [
        'height' => 350,
        'type' => 'line',
        'toolbar' => [
          'show' => true,
          'export' => [
            'csv' => [
              'filename' => 'cart-vs-orders-' . date('Y-m-d H:i:s')
            ],
          ],
          'tools' => [
            'download' => false
          ]
        ]
      ],
      'stroke' => [
        'width' => [0, 4]
      ],
      'dataLabels' => [
        'enabled' => true
      ],
      'xaxis' => [
        'categories' => $categories
      ],
      'yaxis' => [
        [
          'title' => ['text' => 'Cart Count']
        ],
        [
          'opposite' => true,
          'title' => ['text' => 'Orders']
        ]
      ],
      'colors' => ['#008FFB', '#00E396'],
      'legend' => [
        'position' => 'top',
        'horizontalAlign' => 'left'
      ]
    ]);
  }
}
