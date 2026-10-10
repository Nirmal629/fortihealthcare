<?php if(!auth()->guard('web')->check()): ?>
   <?php
     $settings = [];
     if (!empty($categoryBanner) && isset($categoryBanner->settings)) {
         $settings = json_decode($categoryBanner->settings, true);
     }
   ?>
   <!-- <section class="furniture__home_content_blockwrp category_hero bg--blackc fullBG c--whitec bg-- mt-0">
     <div class="container-xxl">
       <div class="row">
         <div class="col-lg-12">
           <div class="inside text-center">
             <h1 class="font140 text-center fw-normal c--whitec" data-parallax-strength-vertical="-2.5"
               data-parallax-height="-2.5"><span data-parallax-target><?php echo e($categoryBanner->title ?? ''); ?></span></h1>
             <figure data-parallax-strength-vertical="2.5" data-parallax-height="2.5"><img
                 src="<?php echo e(!empty($settings['image']) ? asset(config('defaults.banner_image_path') . $settings['image']) : asset('public/frontend/assets/img/category/category_hero.png')); ?>"
                 alt="<?php echo e($settings['alt_text'] ?? ''); ?>" title="<?php echo e($categoryBanner->title ?? ''); ?>"
                 data-parallax-target />
             </figure>
             
             <?php echo $settings['content'] ?? ''; ?>

           </div>
         </div>
       </div>
     </div>
   </section> -->
   <section class="furniture__home_content_blockwrp category_hero  fullBG c--whitec bg-- mt-0">
     <figure class="mb-0"><img class="img-fluid" style="width: 100%; height: 400px; object-fit: cover; display: block;"
         src="<?php echo e(!empty($settings['image']) ? asset(config('defaults.banner_image_path') . $settings['image']) : asset('public/frontend/assets/img/category/category_hero.png')); ?>"
         alt="<?php echo e($settings['alt_text'] ?? ''); ?>" title="<?php echo e($categoryBanner->title ?? ''); ?>" />
     </figure>

   </section>
 <?php endif; ?>
<?php /**PATH C:\xampp\htdocs\vscode\resources\views/frontend/includes/banners/category-banner.blade.php ENDPATH**/ ?>