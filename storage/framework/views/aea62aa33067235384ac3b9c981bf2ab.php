<?php $__env->startSection('title', @$title); ?>

<?php $__env->startSection('content'); ?>

  <!-- <section class="breadcrumb-wrapper py-4 border-top">
    <div class="container-xxl">
      <ul class="breadcrumbs">
        <li><a href="<?php echo e(route('home')); ?>">Home</a></li>
        <li>Account</li>
      </ul>
    </div>
  </section> -->
  <section class="furniture_myaccount_wrap pt-2 pb-5">
    <div class="container">
      <div class="row mb-4">
        <div class="col-lg-12">
          <div class="account-page-header">
            <h1 class="fw-bold m-0 font32 text-dark">My Account</h1>
            <p class="text-muted m-0 font14 mt-1">Manage your account information, orders, and addresses</p>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-12">
          <div class="my_account_wrap">
            <?php echo $__env->make('frontend.pages.user.includes.profile-sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            <div class="right_content">
              <div class="overview modern_overview_grid">
                <div class="overview-card">
                  <a href="<?php echo e(route('orders')); ?>" title="Orders" class="card-link"></a>
                  <div class="card-icon-wrap">
                    <span class="material-symbols-outlined">receipt_long</span>
                  </div>
                  <h3 class="card-title">Orders</h3>
                  <p class="card-subtitle">Check and track your order history</p>
                  <div class="card-arrow-action">
                    <span class="material-symbols-outlined">arrow_forward</span>
                  </div>
                </div>

                <div class="overview-card">
                  <a href="<?php echo e(route('address')); ?>" title="Address" class="card-link"></a>
                  <div class="card-icon-wrap">
                    <span class="material-symbols-outlined">location_on</span>
                  </div>
                  <h3 class="card-title">Address</h3>
                  <p class="card-subtitle">Manage your delivery and billing addresses</p>
                  <div class="card-arrow-action">
                    <span class="material-symbols-outlined">arrow_forward</span>
                  </div>
                </div>

                <div class="overview-card">
                  <a href="<?php echo e(route('profile-details')); ?>" title="Profile Details" class="card-link"></a>
                  <div class="card-icon-wrap">
                    <span class="material-symbols-outlined">person</span>
                  </div>
                  <h3 class="card-title">Profile Details</h3>
                  <p class="card-subtitle">View and update your personal information</p>
                  <div class="card-arrow-action">
                    <span class="material-symbols-outlined">arrow_forward</span>
                  </div>
                </div>

                <div class="overview-card">
                  <a href="<?php echo e(route('reward')); ?>" title="Rewards" class="card-link"></a>
                  <div class="card-icon-wrap">
                    <span class="material-symbols-outlined">military_tech</span>
                  </div>
                  <h3 class="card-title">Rewards</h3>
                  <p class="card-subtitle">View your earned rewards and points</p>
                  <div class="card-arrow-action">
                    <span class="material-symbols-outlined">arrow_forward</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('frontend.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\fortihealthcare\resources\views/frontend/pages/user/profile.blade.php ENDPATH**/ ?>