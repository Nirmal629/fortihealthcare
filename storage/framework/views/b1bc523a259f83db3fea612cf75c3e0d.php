<?php $__env->startSection('title', @$title); ?>

<?php $__env->startSection('content'); ?>

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
              <div class="profile_details modern_profile_card h-100">
                <div class="heading d-flex justify-content-between align-items-center border-bottom pb-3 mb-4 flex-wrap gap-2">
                  <div>
                    <h2 class="font22 fw-bold text-dark m-0">Saved Addresses</h2>
                    <p class="text-muted font13 mb-0 mt-1">Manage your delivery and billing addresses</p>
                  </div>
                  <a href="javascript:void(0);"
                    class="btn modern_edit_profile_btn d-inline-flex align-items-center gap-2 create-or-edit-address"
                    title="Add New Address">
                    <span class="material-symbols-outlined font18">add</span>
                    <span>Add New Address</span>
                  </a>
                </div>
                <div class="info" id="address_block_profile">
                  <?php echo $__env->make('frontend.includes.list-of-profile-address', ['addresses' => $addresses], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <?php if (isset($component)) { $__componentOriginal22271b6c7d71fd7378303e04c6c5d3c3 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal22271b6c7d71fd7378303e04c6c5d3c3 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.create-or-edit-address-modal','data' => ['states' => $states]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('create-or-edit-address-modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['states' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($states)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal22271b6c7d71fd7378303e04c6c5d3c3)): ?>
<?php $attributes = $__attributesOriginal22271b6c7d71fd7378303e04c6c5d3c3; ?>
<?php unset($__attributesOriginal22271b6c7d71fd7378303e04c6c5d3c3); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal22271b6c7d71fd7378303e04c6c5d3c3)): ?>
<?php $component = $__componentOriginal22271b6c7d71fd7378303e04c6c5d3c3; ?>
<?php unset($__componentOriginal22271b6c7d71fd7378303e04c6c5d3c3); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('frontend.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\vscode\resources\views/frontend/pages/user/address/index.blade.php ENDPATH**/ ?>