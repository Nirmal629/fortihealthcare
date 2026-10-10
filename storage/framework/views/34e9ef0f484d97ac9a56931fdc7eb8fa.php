<div class="navbar-custom">
  <div class="topbar container-fluid">
    <div class="d-flex align-items-center gap-lg-2 gap-1">

      <!-- Topbar Brand Logo -->
      <div class="logo-topbar">
        <!-- Logo light -->
        <a href="javascript:" class="logo-light">
          <span class="logo-lg">
            <img src=<?php echo e(asset('/public/backend/assetss/images/logo.svg')); ?> alt="logo">
          </span>
          <span class="logo-sm">
            <img src=<?php echo e(asset('/public/backend/assetss/images/logo-sm.svg')); ?> alt="small logo">
          </span>
        </a>

        <!-- Logo Dark -->
        <a href="javascript:" class="logo-dark">
          <span class="logo-lg">
            <img src=<?php echo e(asset('/public/backend/assetss/images/logo-dark.svg')); ?> alt="dark logo">
          </span>
          <span class="logo-sm">
            <img src=<?php echo e(asset('/public/backend/assetss/images/logo-dark-sm.png')); ?> alt="small logo">
          </span>
        </a>
      </div>

      <!-- Sidebar Menu Toggle Button -->
      <button class="button-toggle-menu">
        <img src=<?php echo e(asset('/public/backend/assetss/images//svg/ham.svg')); ?> alt="hammenu">
      </button>

      <!-- Horizontal Menu Toggle Button -->
      <button class="navbar-toggle" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
        <div class="lines">
          <span></span>
          <span></span>
          <span></span>
        </div>
      </button>

      <!-- Topbar Search Form -->
      <div class="app-search dropdown d-none d-lg-block">
        

        
      </div>
    </div>

    <ul class="topbar-menu d-flex align-items-center gap-3">
      <li class="dropdown d-lg-none">
        <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="#" role="button"
          aria-haspopup="false" aria-expanded="false">
          <i class="ri-search-line font-22"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-animated dropdown-lg p-0">
          <form class="p-3">
            <input type="search" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
          </form>
        </div>
      </li>

      

      


      <li class="dropdown">
        <a class="nav-link dropdown-toggle arrow-none nav-user px-2" data-bs-toggle="dropdown" href="#"
          role="button" aria-haspopup="false" aria-expanded="false">
          <span class="account-user-avatar">
            <img src=<?php echo e(userImageById('admin', user('admin')->id)['thumbnail']); ?> alt="user-image" id="admin-avatar"
              width="32" class="rounded-circle">
          </span>
          <span class="d-lg-flex flex-column gap-1 d-none">
            <h5 class="my-0" id="topbar-adminName"><?php echo e($user->first_name); ?> <?php echo e($user->middle_name); ?>

              <?php echo e($user->last_name); ?></h5>
            <h6 class="my-0 fw-normal" id="topbar-adminRole">
              <?php echo e(count($user->roles) > 0 ? $user->roles[0]->name : 'Unknown'); ?> </h6>
          </span>
        </a>
        <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated profile-dropdown">

          <div class=" dropdown-header noti-title">
            <h6 class="text-overflow m-0">Welcome !</h6>
          </div>

          <a href="<?php echo e(route('admin.profile')); ?>" class="dropdown-item">
            <i class="mdi mdi-account-circle me-1"></i>
            <span>My Profile</span>
          </a>

          <a href="<?php echo e(route('admin.profile')); ?>#changepassword" id="changePasswordMenu" class="dropdown-item">
            <i class="mdi mdi-account-edit me-1"></i>
            <span>Change Password</span>
          </a>
          <!-- item-->
          <a href=<?php echo e(route('admin.logout')); ?> class="dropdown-item">
            <i class="mdi mdi-logout me-1"></i>
            <span>Logout</span>
          </a>
        </div>
      </li>

    </ul>
  </div>
</div>

<?php $__env->startPush('component-scripts'); ?>
  <script>
    document.addEventListener("DOMContentLoaded",(function(){if(window.location.hash){let t=window.location.hash.substring(1),n=document.getElementById("v-pills-"+t+"-tab");if(n){new bootstrap.Tab(n).show()}}}));

  </script>
<?php $__env->stopPush(); ?>
<?php /**PATH C:\xampp\htdocs\vscode\resources\views/backend/includes/topbar.blade.php ENDPATH**/ ?>