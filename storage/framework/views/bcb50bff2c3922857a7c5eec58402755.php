<?php $__env->startSection('title', @$title); ?>

<?php $__env->startSection('content'); ?>

  <!-- <section class="breadcrumb-wrapper py-4 border-top">
    <div class="container-xxl">
      <ul class="breadcrumbs">
        <li><a href="<?php echo e(route('home')); ?>">Home</a></li>
        <li><a href="<?php echo e(route('profile')); ?>">Account</a></li>
        <li>Profile Details</li>
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
              <div class="profile_details modern_profile_card h-100">
                <div class="heading d-flex justify-content-between align-items-center border-bottom pb-3 mb-4">
                  <div>
                    <h2 class="font22 fw-bold text-dark m-0">Profile Details</h2>
                    <p class="text-muted font13 mb-0 mt-1">Your registered personal information</p>
                  </div>
                  <a href="<?php echo e(route('user.profile.edit')); ?>" class="btn modern_edit_profile_btn d-inline-flex align-items-center gap-2"
                    title="Edit Details">
                    <span class="material-symbols-outlined font18">edit</span>
                    <span>Edit Details</span>
                  </a>
                </div>
                <div class="info">
                  <div class="modern_profile_grid">
                    <div class="profile_info_box">
                      <div class="info_label">
                        <span class="material-symbols-outlined info_icon">person</span>
                        <span>Full Name</span>
                      </div>
                      <div class="info_value"><?php echo e($user->name ?: 'N/A'); ?></div>
                    </div>

                    <div class="profile_info_box">
                      <div class="info_label">
                        <span class="material-symbols-outlined info_icon">phone_iphone</span>
                        <span>Mobile No</span>
                      </div>
                      <div class="info_value"><?php echo e($user->phone ?: 'N/A'); ?></div>
                    </div>

                    <div class="profile_info_box">
                      <div class="info_label">
                        <span class="material-symbols-outlined info_icon">mail</span>
                        <span>Email Address</span>
                      </div>
                      <div class="info_value"><?php echo e($user->email ?: 'N/A'); ?></div>
                    </div>

                    <div class="profile_info_box">
                      <div class="info_label">
                        <span class="material-symbols-outlined info_icon">wc</span>
                        <span>Gender</span>
                      </div>
                      <div class="info_value"><?php echo e($user->gender_text ?: 'N/A'); ?></div>
                    </div>

                    <div class="profile_info_box">
                      <div class="info_label">
                        <span class="material-symbols-outlined info_icon">calendar_month</span>
                        <span>Date of Birth</span>
                      </div>
                      <div class="info_value"><?php echo e($user->dob ? date('d M, Y', strtotime($user->dob)) : 'N/A'); ?></div>
                    </div>
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

<?php echo $__env->make('frontend.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\vscode\resources\views/frontend/pages/user/profile-details.blade.php ENDPATH**/ ?>