<?php $__env->startSection('title', @$title ?? 'All Categories'); ?>
<?php $__env->startSection('meta_title', $meta_title ?? 'All Categories | Fortier Healthcare PVT. LTD.'); ?>
<?php $__env->startSection('meta_description', $meta_description ?? 'Explore all healthcare, medical supplies, and wellness product categories at Fortier Healthcare PVT. LTD. Find high-quality products for all your healthcare needs.'); ?>
<?php $__env->startSection('meta_keywords', $meta_keywords ?? 'categories, healthcare categories, medical products, wellness products, healthcare supplies, Fortier Healthcare'); ?>
<?php $__env->startSection('category-content'); ?>
  <?php echo $__env->make('frontend.includes.category_slider', [
      'categories' => $popularCategories,
      'categoryHeadlineBanner' => $categoryHeadlineBanner,
  ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.category', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\fortihealthcare\resources\views/frontend/pages/categories/index.blade.php ENDPATH**/ ?>