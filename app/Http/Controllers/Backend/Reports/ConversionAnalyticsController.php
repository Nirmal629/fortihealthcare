<?php

namespace App\Http\Controllers\Backend\Reports;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\DateRangeRequest;
use App\Services\Backend\Reports\ConversionAnalyticsService;

class ConversionAnalyticsController extends Controller
{
  public function __construct(protected ConversionAnalyticsService $conversionAnalyticsService) {}

  public function index()
  {
    return view(
      'backend.pages.reports.conversion-analytics.index',
      $this->conversionAnalyticsService->viewData()
    );
  }

  public function getConversionStatus(DateRangeRequest $request)
  {
    return $this->conversionAnalyticsService->getConversionStatusJson($request);
  }

  public function getCartOrderComparison(DateRangeRequest $request)
  {
    return $this->conversionAnalyticsService->getCartOrderComparisonJson($request);
  }
}
