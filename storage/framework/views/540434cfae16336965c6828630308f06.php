


<?php if(!empty($homePageOfferBanners) && count($homePageOfferBanners) > 0): ?>
  <?php
    $offerSpeed = 30000; // Default speed

    if (!empty($homePageOfferSpeed['settings'])) {
        $speedSettings = json_decode($homePageOfferSpeed['settings'], true);
        $offerSpeed = isset($speedSettings['speed']) ? $speedSettings['speed'] : 30000;
    }
  ?>

  <div class="furniture__top_scroller py-2">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
          <div class="marquee" data-speed="<?php echo e($offerSpeed); ?>">
            <?php $__currentLoopData = $homePageOfferBanners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php
                $settings = json_decode($banner['settings'] ?? '{}', true);
                $hyper_link = $settings['hyper_link'] ?? '#';
                $content = $banner['title'] ?? '';
              ?>
              <a href="<?php echo e($hyper_link); ?>"><?php echo strip_tags($content, '<a><img><strong><span><em><ul><li><ol>'); ?></a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\vscode\resources\views/frontend/includes/banners/offer-slider.blade.php ENDPATH**/ ?>