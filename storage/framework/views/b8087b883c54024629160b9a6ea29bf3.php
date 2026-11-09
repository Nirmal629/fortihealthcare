<?php $__env->startPush('styles'); ?>

<link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('title', @$title); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('frontend.includes.breadcrumb', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<section class="product-details-page-section py-4">
  <div class="container-xxl">
    <div class="product-details-grid-wrapper">
      <div class="product-details-gallery-col">
        <?php echo $__env->make('frontend.includes.image-slide', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
      </div>
      <div class="product-details-info-col">
        <?php echo $__env->make('frontend.includes.product-buy', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
      </div>
    </div>
  </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('component-scripts'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>

<script>
$(document).ready(function() {
  $(document).on('click', '.po-items', function() {
    window.location.href = $(this).data('url');
  });

  $('.buy-now-btn').on('click', function() {
    const id = $(this).data('id');
    let serial = $(this).data('serial');
    $('#buy-now-form-' + serial).submit();
  });
});
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('frontend.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\fortihealthcare\resources\views/frontend/pages/products-manage/show.blade.php ENDPATH**/ ?>