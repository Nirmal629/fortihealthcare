<!-- ========== Left Sidebar Start ========== -->
<div class="leftside-menu">

  <!-- Logo -->
  <a href="<?php echo e(route('admin.dashboard')); ?>" class="logo logo-light">
    <span class="logo-lg">
      <img src="<?php echo e(siteLogo()); ?>" alt="logo">
    </span>
    <span class="logo-sm">
      <img src="<?php echo e(asset('/public/backend/assetss/images/logo-dark-sm.png')); ?>" alt="small logo">
    </span>
  </a>

  <a href="<?php echo e(route('admin.dashboard')); ?>" class="logo logo-dark">
    <span class="logo-lg">
      <img src="<?php echo e(siteLogo()); ?>" alt="dark logo">
    </span>
    <span class="logo-sm">
      <img src="<?php echo e(asset('/public/backend/assetss/images/logo-dark-sm.png')); ?>" alt="small logo">
    </span>
  </a>

  <!-- Sidebar -->
  <div class="h-100" id="leftside-menu-container" data-simplebar>

    <!-- User -->
    <div class="leftbar-user">
      <a href="javascript:">
        <img src="<?php echo e(asset('/public/backend/assetss/images/users/avatar-1.jpg')); ?>" class="rounded-circle shadow-sm"
          height="42">
        <span class="leftbar-user-name mt-2">Dominic Keller</span>
      </a>
    </div>

    <ul class="side-nav">

      <!-- Dashboard -->
      <li class="side-nav-item">
        <a href="<?php echo e(route('admin.dashboard')); ?>"
          class="side-nav-link <?php echo e(request()->routeIs('admin.dashboard') ? 'active' : ''); ?>">
          <i class="ri-dashboard-line"></i>
          <span>Dashboard</span>
        </a>
      </li>

      
      <?php if(isset($menus) && is_array($menus)): ?>
        <?php $__currentLoopData = $menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <?php
            $currentRoute = request()->route()->getName();
            $isParentActive = false;

            if (!empty($menu['submodules'])) {
                foreach ($menu['submodules'] as $submodule) {
                    if (\Illuminate\Support\Str::startsWith($currentRoute, $submodule['path'])) {
                        $isParentActive = true;
                        break;
                    }
                }
            }
          ?>

          <li class="side-nav-item <?php echo e($isParentActive ? 'menuitem-active' : ''); ?>">

            <!-- Parent Menu -->
            <a data-bs-toggle="collapse" href="#sidebar<?php echo e($menu['id']); ?>"
              class="side-nav-link <?php echo e($isParentActive ? 'active' : ''); ?>"
              aria-expanded="<?php echo e($isParentActive ? 'true' : 'false'); ?>">

              <i class="<?php echo e($menu['icon']); ?>"></i>
              <span><?php echo e($menu['name']); ?></span>

              <?php if(!empty($menu['submodules'])): ?>
                <span class="menu-arrow"></span>
              <?php endif; ?>
            </a>

            <!-- Submenus -->
            <?php if(!empty($menu['submodules'])): ?>
              <div class="collapse <?php echo e($isParentActive ? 'show' : ''); ?>" id="sidebar<?php echo e($menu['id']); ?>">

                <ul class="side-nav-second-level">

                  <?php $__currentLoopData = $menu['submodules']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $submodule): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                      $isActive = \Illuminate\Support\Str::startsWith($currentRoute, $submodule['path']);
                    ?>

                    <li>
                      <?php if (\Illuminate\Support\Facades\Blade::check('routeExists', $submodule['path'])): ?>
                        <a href="<?php echo e(route($submodule['path'])); ?>" class="<?php echo e($isActive ? 'active' : ''); ?>">
                          <?php echo e($submodule['name']); ?>

                        </a>
                      <?php else: ?>
                        <a href="<?php echo e(route('coming-soon')); ?>">
                          <?php echo e($submodule['name']); ?>

                        </a>
                      <?php endif; ?>
                    </li>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </ul>
              </div>
            <?php endif; ?>

          </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      <?php endif; ?>

    </ul>
  </div>

  <div class="clearfix"></div>
</div>
<?php /**PATH C:\xampp\htdocs\vscode\resources\views/backend/includes/sidebar.blade.php ENDPATH**/ ?>