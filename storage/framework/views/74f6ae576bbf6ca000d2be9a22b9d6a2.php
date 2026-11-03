<?php $__env->startSection('page-styles'); ?>
  <style>
    .custom-card {
      border-radius: 16px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
      overflow: hidden;
    }

    .custom-card .card-header {
      border-bottom: 1px solid #dee2e6;
      padding: 1rem 1.5rem;
      font-weight: 600;
      font-size: 1.25rem;
    }

    .banner-thumbnail {
      max-width: 100px;
      height: 80px;
      object-fit: contain;
      border-radius: 8px;
      border: 1px solid #ddd;
      padding: 4px;
      background-color: #fff;
    }

    .fallback-banner {
      max-width: 100%;
      height: 120px;
      object-fit: contain;
      border-radius: 8px;
      border: 1px solid #ddd;
      padding: 4px;
      background-color: #fff;
    }

    .card-title {
      font-size: 1rem;
      font-weight: 500;
    }
  </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
  <?php if (isset($component)) { $__componentOriginal269900abaed345884ce342681cdc99f6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal269900abaed345884ce342681cdc99f6 = $attributes; } ?>
<?php $component = App\View\Components\Breadcrumb::resolve(['pageTitle' => $cardHeader,'skipLevels' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('breadcrumb'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Breadcrumb::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal269900abaed345884ce342681cdc99f6)): ?>
<?php $attributes = $__attributesOriginal269900abaed345884ce342681cdc99f6; ?>
<?php unset($__attributesOriginal269900abaed345884ce342681cdc99f6); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal269900abaed345884ce342681cdc99f6)): ?>
<?php $component = $__componentOriginal269900abaed345884ce342681cdc99f6; ?>
<?php unset($__componentOriginal269900abaed345884ce342681cdc99f6); ?>
<?php endif; ?>

  
  <?php if(!empty($bothBanners)): ?>
    <div class="card mb-4 custom-card">
      <div class="card-header text-dark">
        <h4 class="mb-0">Both Web & App Banners</h4>
      </div>
      <div class="card-body">
        <div class="row">
          <?php $__currentLoopData = $bothBanners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-sm-4 mb-3">
              <?php echo $__env->make('admin.banner.partial.banner-card', ['key' => $key, 'value' => $value], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
      </div>
    </div>
  <?php endif; ?>

  
  <?php if(!empty($webBanners)): ?>
    <div class="card mb-4 custom-card">
      <div class="card-header  text-dark">
        <h4 class="mb-0">Web Banners</h4>
      </div>
      <div class="card-body">
        <div class="row">
          <?php $__currentLoopData = $webBanners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-sm-4 mb-3">
              <?php echo $__env->make('admin.banner.partial.banner-card', ['key' => $key, 'value' => $value], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
      </div>
    </div>
  <?php endif; ?>

  
  <?php if(!empty($appBanners)): ?>
    <div class="card mb-4 custom-card">
      <div class="card-header  text-dark">
        <h4 class="mb-0">App Banners</h4>
      </div>
      <div class="card-body">
        <div class="row">
          <?php $__currentLoopData = $appBanners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-sm-4 mb-3">
              <?php echo $__env->make('admin.banner.partial.banner-card', ['key' => $key, 'value' => $value], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
      </div>
    </div>
  <?php endif; ?>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-scripts'); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\fortihealthcare\resources\views/backend/pages/content-manage/custom-banners/index.blade.php ENDPATH**/ ?>