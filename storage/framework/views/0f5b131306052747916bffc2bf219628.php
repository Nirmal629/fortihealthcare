<div class="left_content_wrap modern_profile_sidebar">
  <div class="left_content_inside">
    <div class="afterlogin_profile modern_profile_usercard d-flex align-items-center gap-3">
      <figure class="m-0 user_avatar_figure">
        <img
          src="<?php echo e(userImageById('web', auth()->guard('web')->user()->id) ? userImageById('web', auth()->guard('web')->user()->id)['image'] : asset('public/frontend/assets/img/home/top_user_thumb.jpg')); ?>"
          alt="<?php echo e(auth()->guard('web')->user()->name); ?>"
          title="<?php echo e(auth()->guard('web')->user()->name); ?>"
          class="imageFit user_avatar_img" />
      </figure>
      <div class="user_details overflow-hidden">
        <h4 class="font16 fw-bold m-0 text-truncate text-dark mb-1"><?php echo e(auth()->guard('web')->user()->name); ?></h4>
        <p class="font13 m-0 text-muted text-truncate mb-2"><?php echo e(auth()->guard('web')->user()->email); ?></p>
        <span class="user-member-badge">Member</span>
      </div>
    </div>

    <div class="sidebar_nav_group">
      <ul class="profile_nav_list">
        <li>
          <a href="<?php echo e(route('profile')); ?>" title="Overview"
            class="profile_nav_link <?php echo e(request()->segment(1) == 'profile' ? 'active' : ''); ?>">
            <span class="material-symbols-outlined nav_icon">grid_view</span>
            <span>Overview</span>
          </a>
        </li>

        <!-- <li class="nav_section_header">Orders</li> -->
        <li>
          <a href="<?php echo e(route('orders')); ?>" title="Orders"
            class="profile_nav_link <?php echo e(request()->segment(1) == 'orders' ? 'active' : ''); ?>">
            <span class="material-symbols-outlined nav_icon">receipt_long</span>
            <span>Orders History</span>
          </a>
        </li>

        <!-- <li class="nav_section_header">Account</li> -->
        <li>
          <a href="<?php echo e(route('profile-details')); ?>" title="Profile"
            class="profile_nav_link <?php echo e(request()->segment(1) == 'profile-details' || request()->is('*profile/edit*') ? 'active' : ''); ?>">
            <span class="material-symbols-outlined nav_icon">person</span>
            <span>Profile Details</span>
          </a>
        </li>
        <li>
          <a href="<?php echo e(route('address')); ?>" title="Addresses"
            class="profile_nav_link <?php echo e(request()->segment(1) == 'address' ? 'active' : ''); ?>">
            <span class="material-symbols-outlined nav_icon">location_on</span>
            <span>Addresses</span>
          </a>
        </li>

        <!-- <li class="nav_section_header">Legal</li> -->
        <li>
          <a href="<?php echo e(route('cms.page', 'terms-of-use')); ?>" title="Terms of Use"
            class="profile_nav_link <?php echo e(request()->is('terms-of-use*') ? 'active' : ''); ?>">
            <span class="material-symbols-outlined nav_icon">gavel</span>
            <span>Terms of Use</span>
          </a>
        </li>
        <li>
          <a href="<?php echo e(route('cms.page', 'privacy-policy')); ?>" title="Privacy Policy"
            class="profile_nav_link <?php echo e(request()->is('privacy-policy*') ? 'active' : ''); ?>">
            <span class="material-symbols-outlined nav_icon">privacy_tip</span>
            <span>Privacy Policy</span>
          </a>
        </li>
      </ul>
    </div>
  </div>
</div>
<?php /**PATH C:\xampp\htdocs\vscode\resources\views/frontend/pages/user/includes/profile-sidebar.blade.php ENDPATH**/ ?>