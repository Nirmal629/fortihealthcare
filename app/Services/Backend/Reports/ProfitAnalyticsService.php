<?php

namespace App\Services\Backend\Reports;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProfitAnalyticsService
{
  public function viewData()
  {
    return [
      'pageTitle' => 'Profit Analytics',
      'cardHeader' => 'Profit Analytics',
    ];
  }

  /**
   * 🔹 Chart 1: Profit Trend
   */
  public function getProfitTrendJson($dateRange)
  {
    $data = DB::table('order_products')
      ->selectRaw('DATE(created_at) as date')
      ->selectRaw('SUM((sell_price - regular_price) * quantity) as profit')
      ->whereBetween('created_at', [
        $dateRange->start_date,
        $dateRange->end_date . ' 23:59:59'
      ])
      ->groupBy('date')
      ->orderBy('date')
      ->get();

    $categories = [];
    $profits = [];

    foreach ($data as $row) {
      $categories[] = $row->date;
      $profits[] = round($row->profit, 2);
    }

    return response()->json([
      'series' => [[
        'name' => 'Margin',
        'data' => $profits
      ]],
      'chart' => [
        'type' => 'line',
        'height' => 350
      ],
      'xaxis' => ['categories' => $categories],
      'colors' => ['#28a745']
    ]);
  }

  /**
   * 🔹 Chart 2: Top Profit Products
   */
  public function getTopProfitProductsJson($dateRange)
  {
    $data = DB::table('order_products')
      ->select(
        'variant_id',
        DB::raw('SUM((sell_price - regular_price) * quantity) as profit')
      )
      ->whereBetween('created_at', [
        $dateRange->start_date,
        $dateRange->end_date . ' 23:59:59'
      ])
      ->groupBy('variant_id')
      ->orderByDesc('profit')
      ->limit(10)
      ->get();

    $categories = [];
    $profits = [];

    foreach ($data as $item) {
      $variant = \App\Models\ProductVariant::find($item->variant_id);
      $categories[] = Str::limit($variant->name ?? 'N/A', 40);
      $profits[] = (float) $item->profit;
    }

    return response()->json([
      'series' => [[
        'name' => 'Margin',
        'data' => $profits
      ]],
      'chart' => [
        'type' => 'bar',
        'height' => 400,
        'toolbar' => ['show' => false],
      ],
      'xaxis' => ['categories' => $categories],
      'plotOptions' => [
        'bar' => [
          'horizontal' => true,
          'barHeight' => '70%',
          'distributed' => true
        ]
      ],
      'dataLabels' => ['enabled' => true],
      'colors' => ['#28a745'],
      'legend' => ['show' => false]
    ]);
  }
}
