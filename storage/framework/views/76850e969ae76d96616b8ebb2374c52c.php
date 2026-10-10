<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['filter' => true]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['filter' => true]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>
<div class="row">
  <div class="col-xl-12 col-lg-12">
    <div class="card border-0 dashboard-quicklinks">
      <div class="d-flex card-header justify-content-between align-items-center border-0 pb-0">
        <h4 class="header-title">Marketing & Sales</h4>
        <?php if($filter): ?>
          <div class="d-flex align-items-center ms-1">
            <label class="nowrap me-2">Date Range:</label>

            <div class="input-group input-group-text font-14 bg-white" id="marketingOverviewDatePicker" wire:ignore>
              <i class="mdi mdi-calendar-range font-14 d-flex me-2"></i>
              <span></span>
            </div>

            <!-- Refresh Button -->
            <!-- Inside your filter div -->
            <button type="button" class="btn btn-sm btn-outline-secondary ms-2 d-flex align-items-center"
              id="refreshMarketingDashboard">
              <i class="mdi mdi-refresh me-1 font-16"></i> <span class="d-none d-sm-inline"></span>
            </button>

          </div>
        <?php endif; ?>
      </div>
      <div class="card-body pt-1">
        <div class="row">
          <div class="col-md-3">
            <div class="dashboardquickbox">
              <a href="<?php echo e(route('admin.product-variations')); ?>" title="View Details"></a>
              <div class="left">
                <div class="iconbox p-1 d-flex justify-content-center align-items-center"
                  style="background-color:#BDD07E;"><img
                    src="<?php echo e(asset('public/backend/assetss/images/dashboard/no_of_products.svg')); ?>" alt="">
                </div>
                <div class="txt">
                  <p>No. of Products</p>
                  <h4 class="font-20 fw-medium" data-count="productCount"><?php echo e($dashboardData['productCount'] ?? 0); ?></h4>
                </div>
              </div>
              
            </div>
          </div>
          <div class="col-md-3">
            <div class="dashboardquickbox">
              <a href="<?php echo e(route('admin.promotion')); ?>" title="View Details"></a>
              <div class="left">
                <div class="iconbox p-1 d-flex justify-content-center align-items-center"
                  style="background-color:#B57FDE;"><img
                    src="<?php echo e(asset('public/backend/assetss/images/dashboard/active_promotions.svg')); ?>" alt="">
                </div>
                <div class="txt">
                  <p>Active Promotions</p>
                  <h4 class="font-20 fw-medium" data-count="activePromotionCount">
                    <?php echo e($dashboardData['activePromotionCount'] ?? 0); ?></h4>
                </div>
              </div>
              
            </div>
          </div>
          <div class="col-md-3">
            <div class="dashboardquickbox">
              <a href="<?php echo e(route('admin.orders')); ?>" title="View Details"></a>
              <div class="left">
                <div class="iconbox p-1 d-flex justify-content-center align-items-center"
                  style="background-color:#E9BA63;"><img
                    src="<?php echo e(asset('public/backend/assetss/images/dashboard/total_sales_revenue.svg')); ?>" alt="">
                </div>
                <div class="txt">
                  <p>Total Sales Revenue</p>
                  <h4 class="font-20 fw-medium nowrap" data-count="totalSalesRevenue">
                    <?php echo e(displayPrice($dashboardData['totalSalesRevenue']) ?? 0); ?>

                  </h4>
                </div>
              </div>
              
            </div>
          </div>
          <div class="col-md-3">
            <div class="dashboardquickbox">
              <a href="#" title="View Details"></a>
              <div class="left">
                <div class="iconbox p-1 d-flex justify-content-center align-items-center"
                  style="background-color:#DA8BC2;"><img
                    src="<?php echo e(asset('public/backend/assetss/images/dashboard/campaign_spent.svg')); ?>" alt="">
                </div>
                <div class="txt">
                  <p>Campaign Spent</p>
                  
                  <h4 class="font-20 fw-medium nowrap">N/A</h4>
                </div>
              </div>
              
            </div>
          </div>
        </div>
      </div> <!-- end card body -->
    </div> <!-- end card -->
  </div> <!-- end col -->
</div>
<?php /**PATH C:\xampp\htdocs\vscode\resources\views/backend/includes/marketing-sales.blade.php ENDPATH**/ ?>