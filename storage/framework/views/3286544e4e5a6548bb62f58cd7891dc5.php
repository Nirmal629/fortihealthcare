<!-- Footer Start -->
<?php
  //dd($siteSettings);
?>
<section class="furniture_footer footer_sec fullBG mt-0">
  <div class="container cust_container">
    <div class="row">
      <div class="col-lg-4 col-md-6 col-12">
        <div class="footermenu_box footer-logo-wrap">
         <a href="<?php echo e(route('home')); ?>" title="<?php echo e($siteSettings['sitename'] ?? 'Sundew Ecomm'); ?>">
                  <img src="<?php echo e(siteLogo()); ?>" alt="<?php echo e($siteSettings['sitename'] ?? 'Sundew Ecomm'); ?>" title="<?php echo e($siteSettings['sitename'] ?? 'Sundew Ecomm'); ?>" style="max-height: 80px;" />
                </a>
          <p class="cdc_text" style="font-size: 14.5px; font-weight: 500; line-height: 1.6; color: #4a5568; letter-spacing: 0.2px; margin-top: 14px; margin-bottom: 0;">Every product. Every promise. Every time — held to the highest standard.</p>

          <div class="follow d-flex align-items-center justify-content-start gap-2 mt-4">
            <!-- <p class="text mb-0" >Follow Us On:</p> -->
            <ul class="fsicons_all">
              <!-- <li><a href="<?php echo e($siteSettings['facebook_link'] ?? 'javascript:void(0)'); ?>" target="_blank"><i class="fa-brands fa-facebook-f"></i></a></li>
              <li><a href="<?php echo e($siteSettings['linkedin_link'] ?? 'javascript:void(0)'); ?>" target="_blank"><i class="fa-brands fa-linkedin-in"></i></a></li>
              <li><a href="<?php echo e($siteSettings['instagram_link'] ?? 'javascript:void(0)'); ?>" target="_blank"><i class="fa-brands fa-instagram"></i></a></li>
              <li><a href="<?php echo e($siteSettings['x_link'] ?? 'javascript:void(0)'); ?>" target="_blank"><i class="fa-brands fa-x-twitter"></i></a></li> -->
              <!-- <li><a href="<?php echo e($siteSettings['x_link'] ?? 'javascript:void();'); ?>" title="Twitter"
                  class="twitter"><img src="<?php echo e(asset('public/frontend/assets/img/footer/twitter.svg')); ?>"
                    alt="Twitter" title="Twitter" /></a></li>
              <li><a href="<?php echo e($siteSettings['youtube_link'] ?? 'javascript:void();'); ?>" title="YouTube"
                  class="youtube"><img src="<?php echo e(asset('public/frontend/assets/img/footer/youtube.svg')); ?>"
                    alt="YouTube" title="YouTube" /></a></li>
              <li><a href="<?php echo e($siteSettings['instagram_link'] ?? 'javascript:void();'); ?>" title="Instagram"
                  class="instagram"><img src="<?php echo e(asset('public/frontend/assets/img/footer/instagram.svg')); ?>"
                    alt="Instagram" title="Instagram" /></a></li>
              <li><a href="<?php echo e($siteSettings['facebook_link'] ?? 'javascript:void();'); ?>" title="Facebook"
                  class="facebook"><img src="<?php echo e(asset('public/frontend/assets/img/footer/facebook.svg')); ?>"
                    alt="Facebook" title="Facebook" /></a></li> -->
            </ul>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 col-12">
        <div class="footermenu_box">
          <h2 class="head">Menu Link</h2>
          <ul class="menu footer-menu">
            <li><a href="<?php echo e(route('home')); ?>" class="btn">Home</a></li>
            <?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slug => $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <li><a href="<?php echo e(url($slug)); ?>" class="btn" title="<?php echo e($page->title); ?>"><?php echo e($page->title); ?></a></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </ul>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 col-12">
        <div class="footermenu_box">
          <h2 class="head">Contact Us</h2>
          <ul class="fcontact_details footer_details">
            <li class="d-flex align-items-start gap-2 mb-2">
              <span class="icon"><span class="material-symbols-outlined" style="color: #f0b334; font-size: 20px; margin-top: 2px;">call</span></span>
              <span class="text"><?php echo e($siteSettings['site_primary_phone'] ?? $siteSettings['phone'] ?? '+91 91 730 69721'); ?></span>
            </li>
            <li class="d-flex align-items-start gap-2 mb-2">
              <span class="icon"><span class="material-symbols-outlined" style="color: #f0b334; font-size: 20px; margin-top: 2px;">mail</span></span>
              <span class="text"><?php echo e($siteSettings['site_email'] ?? $siteSettings['email'] ?? 'fortiercustomersupport@gmail.com'); ?></span>
            </li>
            <li class="d-flex align-items-start gap-2 mb-2">
              <span class="icon"><span class="material-symbols-outlined" style="color: #f0b334; font-size: 20px; margin-top: 2px;">location_on</span></span>
              <span class="text">
                <?php echo e(!empty($siteSettings['address1']) ? $siteSettings['address1'] : ($siteSettings['address'] ?? 'Rajkot, Gujarat, India')); ?><br>
                <?php echo e(!empty($siteSettings['address2']) ? $siteSettings['address2'] : ($siteSettings['sector'] ?? 'Sector: Pharmaceutical · Ethical Marketing')); ?>

              </span>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Bottom Footer -->
<section class="bottom_footer">
  <div class="container cust_container">
    <div class="wrap w-100 ">
      <p class="text mb-0 text-center">Copyright &copy; <?php echo e(date('Y')); ?> All Rights Reserve by <?php echo e($siteSettings['sitename'] ?? 'Fortier Healthcare Pvt. Ltd.'); ?></p>
      <!-- <span class="font16 copyrightwrp-items text">
        <?php if(!empty($terms_and_conditions_page)): ?>
          <a href="<?php echo e(route('cms.page', $terms_and_conditions_page->slug)); ?>" style="color: #fff;">
            <?php echo e($terms_and_conditions_page->title); ?>

          </a>
        <?php endif; ?>
        <?php if(!empty($privacy_policy_page)): ?>
          | <a href="<?php echo e(route('cms.page', $privacy_policy_page->slug)); ?>" style="color: #fff;">
            <?php echo e($privacy_policy_page->title); ?>

          </a>
        <?php endif; ?>
      </span> -->
    </div>
  </div>
  <a href="javascript:void(0)" class="back-to-top" id="backtotop" title="Back to top">
    <span class="material-symbols-outlined">north</span>
  </a>
</section>
<!-- Footer End -->
<?php /**PATH C:\xampp\htdocs\vscode\resources\views/frontend/layouts/includes/footer.blade.php ENDPATH**/ ?>