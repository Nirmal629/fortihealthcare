<?php $__env->startSection('title', @$title); ?>
<?php $__env->startSection('category-content'); ?>
  <?php echo $__env->make('frontend.includes.category_slider', [
      'categories' => $popularCategories,
      'categoryHeadlineBanner' => $categoryHeadlineBanner,
  ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.category', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\vscode\resources\views/frontend/pages/categories/index.blade.php ENDPATH**/ ?>