<section class="living__home-hero">
  <div class="living__home-hero--media">
    <div class="swiper swiper__1">
      <div class="swiper-wrapper eq-height">

        <?php if($mainSliders->isNotEmpty()): ?>
          <?php $__currentLoopData = $mainSliders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
              $settings = json_decode($slider->settings, true);
            ?>

            <div class="swiper-slide">
              <figure>
                <img
                  src="<?php echo e(!empty($settings['image'])
                      ? asset(config('defaults.banner_image_path') . $settings['image'])
                      : asset('frontend/assets/img/home/homeslider1.jpg')); ?>"
                  alt="<?php echo e($settings['alt_text'] ?? ''); ?>" title="<?php echo e($slider->alt_text ?? ''); ?>" class="imageFit" />
              </figure>

              <div class="txt-wrp">
                <div class="container">
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="inside"></div>

                      

                      <div class="txt">
                        <h4 class="font45 fw-normal mb-0 c--whitec">
                          
                        </h4>
                        <a href="<?php echo e($settings['hyper_link'] ?? '#'); ?>" class="btn custom-submit-btn learnmore_btn">
                          <?php echo e($settings['btn_text'] ?? 'Explore Products'); ?>

                        </a>
                      </div>

                    </div>
                  </div>
                </div>
              </div>

            </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
          <!-- Static fallback slide if no slider data found -->
          <div class="swiper-slide">
            <figure>
              <img src="<?php echo e(asset('public/frontend/assets/img/home/homeslider1.jpg')); ?>" alt="Default Banner"
                class="imageFit" />
            </figure>

            <div class="txt-wrp">
              <div class="container">
                <div class="row">
                  <div class="col-lg-12">
                    <div class="inside"></div>

                    

                    <div class="txt">
                      <h4 class="font45 fw-normal mb-0 c--whitec">
                        
                      </h4>
                      <a href="#" class="btn custom-submit-btn learnmore_btn">
                        Explore Products
                      </a>
                    </div>

                  </div>
                </div>
              </div>
            </div>

          </div>

          <div class="swiper-slide">
            <figure>
              <img src="<?php echo e(asset('public/frontend/assets/img/home/homeslider1.jpg')); ?>" alt="Default Banner"
                class="imageFit" />
            </figure>

            <div class="txt-wrp">
              <div class="container">
                <div class="row">
                  <div class="col-lg-12">
                    <div class="inside"></div>

                    

                    <div class="txt">
                      <h4 class="font45 fw-normal mb-0 c--whitec">
                        
                      </h4>
                      <a href="#" class="btn custom-submit-btn learnmore_btn">
                        Explore Products
                      </a>
                    </div>

                  </div>
                </div>
              </div>
            </div>

          </div>
        <?php endif; ?>

      </div>

      <!-- Navigation Buttons -->
      <div class="arrow-wrap">
        <div class="container">
          <div class="col-lg-12">
            <div class="inside">
              <div class="swiper-pagination-progressbar">
                <div class="swiper-pagination-progressbar-fill"></div>
              </div>
              <div class="others">
                <div class="swipper_button swiper__1--prev d-flex">
                  <span class="material-symbols-outlined font35 c--whitec">arrow_back_ios_new</span>
                </div>
                <div class="swiper-pagination"></div>
                <div class="swipper_button swiper__1--next d-flex">
                  <span class="material-symbols-outlined font35 c--whitec">arrow_forward_ios</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Navigation Buttons -->

    </div>
  </div>
</section>
<?php /**PATH C:\xampp\htdocs\vscode\resources\views/frontend/includes/banners/main-slider.blade.php ENDPATH**/ ?>