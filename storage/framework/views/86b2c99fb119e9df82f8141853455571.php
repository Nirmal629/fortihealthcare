<?php $__env->startSection('title', @$title); ?>

<?php $__env->startSection('content'); ?>

  <?php if(!empty($page) && $page->slug == 'terms-of-use'): ?>
    <?php echo $__env->make('frontend.pages.cms.terms', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

  <?php elseif(!empty($page) && $page->slug == 'privacy-policy'): ?>
    <?php echo $__env->make('frontend.pages.cms.privacy-policy', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

  <?php elseif(!empty($page) && $page->slug == 'about-us'): ?>
    <?php echo $__env->make('frontend.pages.cms.about-us', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

  <?php elseif(!empty($page) && $page->slug == 'return-policy'): ?>
    <?php echo $__env->make('frontend.pages.cms.return-policy', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

  <?php elseif(!empty($page) && $page->slug == 'faqs'): ?>
    <?php echo $__env->make('frontend.pages.cms.faqs', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

  <?php elseif(!empty($page) && $page->slug == 'contact-us'): ?>
    <?php echo $__env->make('frontend.pages.cms.contact-us', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

  <?php endif; ?>

  
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
  <script>
    $(document).ready(function() {
      $('.marquee').marquee({
        direction: 'left',
        duration: 30000,
        gap: 0,
        delayBeforeStart: 0,
        duplicated: true,
        pauseOnHover: true
      });
    });
  </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('frontend.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\fortihealthcare\resources\views/frontend/pages/cms.blade.php ENDPATH**/ ?>