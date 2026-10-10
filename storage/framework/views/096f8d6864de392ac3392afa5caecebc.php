 <!-- end page title -->
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
         <h4 class="header-title">Customer Overview</h4>
         <?php if($filter): ?>
           <div class="d-flex align-items-center ms-1">
             <label class="nowrap me-2">Date Range:</label>

             <div class="input-group input-group-text font-14 bg-white" id="customerOverviewDatePicker" wire:ignore>
               <i class="mdi mdi-calendar-range font-14 d-flex me-2"></i>
               <span></span>
             </div>

             <!-- Refresh Button -->
             <!-- Inside your filter div -->
             <button type="button" class="btn btn-sm btn-outline-secondary ms-2 d-flex align-items-center"
               id="refreshDashboard">
               <i class="mdi mdi-refresh me-1 font-16"></i> <span class="d-none d-sm-inline"></span>
             </button>

           </div>
         <?php endif; ?>
       </div>
       <div class="card-body pt-1">
         <div class="row">
           <div class="col-md-3">
             <div class="dashboardquickbox">
               <a href="<?php echo e(route('admin.customers')); ?>" title="View Details"></a>
               <div class="left">
                 <div class="iconbox p-1 d-flex justify-content-center align-items-center"
                   style="background-color:#7AA5EB;"><img
                     src="<?php echo e(asset('public/backend/assetss/images/dashboard/total_customers.svg')); ?>" alt="">
                 </div>
                 <div class="txt">
                   <p>Total Customers</p>
                   <h4 class="font-20 fw-medium" data-count="customers"><?php echo e($dashboardData['customersCount'] ?? 0); ?></h4>
                 </div>
               </div>
               
             </div>
           </div>
           <div class="col-md-3">
             <div class="dashboardquickbox">
               <a href="<?php echo e(route('admin.customers')); ?>" title="View Details"></a>
               <div class="left">
                 <div class="iconbox p-1 d-flex justify-content-center align-items-center"
                   style="background-color:#DE7F88;"><img
                     src="<?php echo e(asset('public/backend/assetss/images/dashboard/new_customer.svg')); ?>" alt="">
                 </div>
                 <div class="txt">
                   <p>New Customers</p>
                   <h4 class="font-20 fw-medium" data-count="new"><?php echo e($dashboardData['customersCount'] ?? 0); ?></h4>
                 </div>
               </div>
               
             </div>
           </div>
           <div class="col-md-3">
             <div class="dashboardquickbox">
               <a href="<?php echo e(route('admin.customers')); ?>" title="View Details"></a>
               <div class="left">
                 <div class="iconbox p-1 d-flex justify-content-center align-items-center"
                   style="background-color:#7AD6EB;"><img
                     src="<?php echo e(asset('public/backend/assetss/images/dashboard/active_customer.svg')); ?>" alt="">
                 </div>
                 <div class="txt">
                   <p>Active Customers</p>
                   <h4 class="font-20 fw-medium" data-count="active"><?php echo e($dashboardData['activecustomersCount'] ?? 0); ?>

                   </h4>

                 </div>
               </div>
               
             </div>
           </div>
           <div class="col-md-3">
             <div class="dashboardquickbox">
               <a href="<?php echo e(route('admin.customers')); ?>" title="View Details"></a>
               <div class="left">
                 <div class="iconbox p-1 d-flex justify-content-center align-items-center"
                   style="background-color:#8BC988;"><img
                     src="<?php echo e(asset('public/backend/assetss/images/dashboard/inactive_customer.svg')); ?>" alt="">
                 </div>
                 <div class="txt">
                   <p>Inactive Customers</p>
                   <h4 class="font-20 fw-medium" data-count="inactive">
                     <?php echo e($dashboardData['inactivecustomersCount'] ?? 0); ?></h4>

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
<?php /**PATH C:\xampp\htdocs\vscode\resources\views/backend/includes/customer-overview.blade.php ENDPATH**/ ?>