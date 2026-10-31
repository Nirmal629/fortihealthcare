<?php $__env->startSection('title', @$title); ?>

<?php $__env->startSection('content'); ?>

  <?php echo $__env->make('frontend.includes.banners.offer-slider', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
  <main>
    <?php echo $__env->make('frontend.includes.banners.main-slider', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
     <?php if($showDisclaimer ?? true): ?>
    <?php echo $__env->make('frontend.includes.disclaimer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
  <?php endif; ?>
   
     
     
    
    
    

   

    


     


     

    <?php echo $__env->make('frontend.includes.featured-category-slider', ['category' => $featuredCategory ?? null], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <?php echo $__env->make('frontend.includes.get-in-touch', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <?php echo $__env->make('frontend.includes.banners.subscribe', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    
  </main>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
<style>
  /* Global Home Page Button Styles */
  main .btn,
  .living__home-hero--media .txt-wrp .btn-light,
  .living__home-hero--media .txt-wrp .custom-submit-btn {
    background-color: #f0b334 !important;
    color: #ffffff !important;
    position: relative;
    border: 1px solid transparent !important;
    transition: all 0.5s !important;
    z-index: 1;
    overflow: hidden;
    padding: 10px 50px 10px 20px !important;
  }

  main .btn::before,
  .living__home-hero--media .txt-wrp .btn-light::before,
  .living__home-hero--media .txt-wrp .custom-submit-btn::before {
    content: "";
    background-color: #ffffff;
    position: absolute;
    z-index: -1;
    left: -20%;
    right: -20%;
    top: 0;
    bottom: 0;
    transform: skewX(-45deg) scale(0, 1);
    transition: all 0.5s;
  }

  main .btn:hover::before,
  .living__home-hero--media .txt-wrp .btn-light:hover::before,
  .living__home-hero--media .txt-wrp .custom-submit-btn:hover::before {
    transform: skewX(-45deg) scale(1, 1);
  }

  main .btn:hover,
  .living__home-hero--media .txt-wrp .btn-light:hover,
  .living__home-hero--media .txt-wrp .custom-submit-btn:hover {
    color: #f0b334 !important;
    border-color: #f0b334 !important;
  }

  /* Custom Subscribe Button: Same to same design with equal left & right padding */
  .custom-subscribe-btn,
  main .custom-subscribe-btn {
    padding: 10px 25px !important;
    border-radius: 50rem !important;
    display: inline-flex;
    align-items: center;
    justify-content: center;
  }

  .custom-subscribe-btn::after,
  main .custom-subscribe-btn::after {
    display: none !important;
  }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
  <script>
    $(document).ready(function() {
      const speed = $('.marquee').data('speed') || 30000; // fallback to 30 seconds

      $('.marquee').marquee({
        direction: 'left',
        duration: speed,
        gap: 0,
        delayBeforeStart: 0,
        duplicated: true,
        pauseOnHover: true
      });
    });
  </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('frontend.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\vscode\resources\views/frontend/pages/home/index.blade.php ENDPATH**/ ?>