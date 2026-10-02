<?php

namespace App\Http\Controllers\Backend\Reports;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\DateRangeRequest;
use App\Services\Backend\Reports\ProductPerformanceService;

class ProductPerformanceController extends Controller
{
  public function __construct(protected ProductPerformanceService $productPerformanceService) {}

  public function index()
  {
    return view(
      'backend.pages.reports.product-performance.index',
      $this->productPerformanceService->viewData()
    );
  }

  public function getTopProducts(DateRangeRequest $request)
  {
    return $this->productPerformanceService->getTopProductsJson($request);
  }

  public function getProductRevenue(DateRangeRequest $request)
  {
    return $this->productPerformanceService->getProductRevenueJson($request);
  }
}
