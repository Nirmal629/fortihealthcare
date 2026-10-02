<?php

namespace App\Http\Controllers\Backend\Reports;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\DateRangeRequest;
use App\Services\Backend\Reports\ProfitAnalyticsService;

class ProfitAnalyticsController extends Controller
{
  public function __construct(protected ProfitAnalyticsService $service) {}

  public function index()
  {
    return view(
      'backend.pages.reports.profit-analytics.index',
      $this->service->viewData()
    );
  }

  public function getProfitTrend(DateRangeRequest $request)
  {
    return $this->service->getProfitTrendJson($request);
  }

  public function getTopProfitProducts(DateRangeRequest $request)
  {
    return $this->service->getTopProfitProductsJson($request);
  }
}
