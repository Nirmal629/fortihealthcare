<?php $__env->startSection('title', @$title); ?>
<?php $__env->startSection('content'); ?>
  <?php if(!auth()->guard('web')->check()): ?>
    <?php echo $__env->make('frontend.includes.banners.category-banner', [
        'categoryBanner' => $categoryBanner,
    ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
  <?php endif; ?>
  <?php echo $__env->yieldContent('category-content'); ?>

  

  

  
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\vscode\resources\views/frontend/layouts/category.blade.php ENDPATH**/ ?>