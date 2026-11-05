<section class="innerstaticBanner">
  <figure><img
      src="<?php echo e(!empty($page->feature_image) ? asset('public/uploads/cms_pages/' . $page->feature_image) : asset('public/frontend/assets/img/terms-use/banner.jpg')); ?>"
      alt="<?php echo e($page->title ?? ''); ?>" title="<?php echo e($page->title ?? ''); ?>" class="imageFit" /></figure>
  <div class="container">
    <h1 class="fw-normal c--whitec title font64"><?php echo e($page->title ?? ''); ?></h1>
  </div>
</section>

<section class="privacy_Policy">
  <div class="container flow-rootX2">
    <?php echo $page->body ?? ''; ?>

  </div>
</section>
<?php echo $__env->make('frontend.includes.banners.keep-flowing', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php /**PATH C:\xampp\htdocs\fortihealthcare\resources\views/frontend/pages/cms/terms.blade.php ENDPATH**/ ?>