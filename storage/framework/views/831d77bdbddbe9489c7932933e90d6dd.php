<!-- end row -->
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
        <h4 class="header-title">Orders Overview</h4>
        <?php if($filter): ?>
          <div class="d-flex align-items-center ms-1">
            <label class="nowrap me-2">Date Range:</label>

            <div class="input-group input-group-text font-14 bg-white" id="orderOverviewDatePicker" wire:ignore>
              <i class="mdi mdi-calendar-range font-14 d-flex me-2"></i>
              <span></span>
            </div>

            <!-- Refresh Button -->
            <!-- Inside your filter div -->
            <button type="button" class="btn btn-sm btn-outline-secondary ms-2 d-flex align-items-center"
              id="refreshOrderDashboard">
              <i class="mdi mdi-refresh me-1 font-16"></i> <span class="d-none d-sm-inline"></span>
            </button>

          </div>
        <?php endif; ?>
      </div>
      <div class="card-body pt-1">
        <div class="row">
          <div class="col-md-3">
            <div class="dashboardquickbox mb-3">
              <a href="<?php echo e(route('admin.orders')); ?>" title="View Details"></a>
              <div class="left">
                <div class="iconbox p-1 d-flex justify-content-center align-items-center"
                  style="background-color:#8A93A0;"><img
                    src="<?php echo e(asset('public/backend/assetss/images/dashboard/no_of_order_placed.svg')); ?>" alt="">
                </div>
                <div class="txt">
                  <p>No. of Orders Placed</p>
                  <h4 class="font-20 fw-medium" data-count="ordersCount"><?php echo e($dashboardData['ordersCount'] ?? 0); ?></h4>
                </div>
              </div>
              
            </div>
          </div>
          <div class="col-md-3">
            <div class="dashboardquickbox mb-3">
              <a href="<?php echo e(route('admin.orders')); ?>" title="View Details"></a>
              <div class="left">
                <div class="iconbox p-1 d-flex justify-content-center align-items-center"
                  style="background-color:#BB6FC2;"><img
                    src="<?php echo e(asset('public/backend/assetss/images/dashboard/cancelled_order_placed.svg')); ?>"
                    alt="">
                </div>
                <div class="txt">
                  <p>Canceled Order Placed</p>
                  <h4 class="font-20 fw-medium" data-count="ordersCancelCount">
                    <?php echo e($dashboardData['ordersCancelCount'] ?? 0); ?></h4>
                </div>
              </div>
              
            </div>
          </div>
          <div class="col-md-3">
            <div class="dashboardquickbox mb-3">
              <a href="<?php echo e(route('admin.orders')); ?>" title="View Details"></a>
              <div class="left">
                <div class="iconbox p-1 d-flex justify-content-center align-items-center"
                  style="background-color:#6CB6A1;"><img
                    src="<?php echo e(asset('public/backend/assetss/images/dashboard/inbord_in_transit.svg')); ?>" alt="">
                </div>
                <div class="txt">
                  <p>Inbound-In-Transit</p>
                  <h4 class="font-20 fw-medium" data-count="ordersConfirmCount">
                    <?php echo e($dashboardData['ordersConfirmCount'] ?? 0); ?></h4>
                </div>
              </div>
              
            </div>
          </div>
          <div class="col-md-3">
            <div class="dashboardquickbox mb-3">
              <a href="<?php echo e(route('admin.orders')); ?>" title="View Details"></a>
              <div class="left">
                <div class="iconbox p-1 d-flex justify-content-center align-items-center"
                  style="background-color:#498BC8 ;"><img
                    src="<?php echo e(asset('public/backend/assetss/images/dashboard/outboard_in_transit.svg')); ?>"
                    alt="">
                </div>
                <div class="txt">
                  <p>Outbound-In-Transit</p>
                  <h4 class="font-20 fw-medium" data-count="ordersShippingCount">
                    <?php echo e($dashboardData['ordersShippingCount'] ?? 0); ?></h4>
                </div>
              </div>
              
            </div>
          </div>
          <div class="col-md-3">
            <div class="dashboardquickbox">
              <a href="<?php echo e(route('admin.orders')); ?>" title="View Details"></a>
              <div class="left">
                <div class="iconbox p-1 d-flex justify-content-center align-items-center"
                  style="background-color:#D45693;"><img
                    src="<?php echo e(asset('public/backend/assetss/images/dashboard/no_of_orders_proceed.svg')); ?>"
                    alt="">
                </div>
                <div class="txt">
                  <p>No. of Orders Processed</p>
                  <h4 class="font-20 fw-medium" data-count="ordersProceedCount">
                    <?php echo e($dashboardData['ordersProceedCount'] ?? 0); ?></h4>
                </div>
              </div>
              
            </div>
          </div>
          <div class="col-md-3">
            <div class="dashboardquickbox">
              <a href="<?php echo e(route('admin.orders')); ?>" title="View Details"></a>
              <div class="left">
                <div class="iconbox p-1 d-flex justify-content-center align-items-center"
                  style="background-color:#CEAB20;"><img
                    src="<?php echo e(asset('public/backend/assetss/images/dashboard/orders_fulfillmentrate.svg')); ?>"
                    alt="">
                </div>
                <div class="txt">
                  <p>Orders Fulfillment Rate</p>
                  <h4 class="font-20 fw-medium" data-count="fulfillmentRate">
                    <?php echo e($dashboardData['fulfillmentRate'] ?? 0); ?>%</h4>
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
                    src="<?php echo e(asset('public/backend/assetss/images/dashboard/total_sales_revenue.svg')); ?>"
                    alt="">
                </div>
                <div class="txt">
                  <p>Total Sale Volume</p>
                  <h4 class="font-20 fw-medium nowrap" data-count="totalSaleVolume">
                    <?php echo e(displayPrice($dashboardData['totalSaleVolume']) ?? 0); ?>

                  </h4>
                </div>
              </div>
              
            </div>
          </div>
          
          <div class="col-md-3">
            <div class="dashboardquickbox">
              <a href="<?php echo e(route('admin.cart')); ?>" title="View Details"></a>
              <div class="left">
                <div class="iconbox p-1 d-flex justify-content-center align-items-center"
                  style="background-color:#EDA736;"><img
                    src="<?php echo e(asset('public/backend/assetss/images/dashboard/abandoned_cart.svg')); ?>" alt="">
                </div>
                <div class="txt">
                  <p>Abandoned Cart</p>
                  <h4 class="font-20 fw-medium" data-count="abandonedCartCount">
                    <?php echo e($dashboardData['abandonedCartCount'] ?? 0); ?></h4>
                </div>
              </div>
              
            </div>
          </div>
        </div>
      </div> <!-- end card body -->
    </div> <!-- end card -->
  </div> <!-- end col -->
</div>
<!-- end row -->
<?php /**PATH C:\xampp\htdocs\vscode\resources\views/backend/includes/orders-overview.blade.php ENDPATH**/ ?>