<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'category' => null,
]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter(([
    'category' => null,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<section class="furniture__products_scroller_wrap flow-rootX3 featured-category-section py-4 py-lg-5 my-4 my-lg-5" style="background: #f8f9fa;">
  <div class="container-xxl">
    <div class="row align-items-center gy-3 gy-lg-0">
      <div class="col-12 col-sm-6 col-lg-6">
        <h2 class="fw-normal m-0 font45 c--blackc">Featured Collections</h2>
      </div>

      <div class="col-12 col-sm-6 col-lg-6">
        <div class="filterswrap d-flex align-items-center justify-content-sm-end">
          <a href="<?php echo e(route('category.list')); ?>" class="btn learnmore_btn" style="text-decoration: none;" title="View All Categories">
            View All
          </a>
        </div>
      </div>
    </div>
  </div>

  <div class="container-xxl mt-3 mt-lg-4">
    <div class="swiperwrp">
      <div class="swiper swiper-featured">
        <div class="swiper-wrapper eq-height" id="featured-product-scroller">
          <?php
              // Fetch latest 10 active product variants to ensure newly added products show up immediately
              $featuredProducts = \App\Models\ProductVariant::where('status', 1)
                  ->with(['product', 'images' => function($q) {
                      $q->where('is_default', 1)->with('gallery');
                  }, 'inventory'])
                  ->orderBy('id', 'desc')
                  ->take(10)
                  ->get();
          ?>
          <?php if(isset($featuredProducts) && $featuredProducts->count() > 0): ?>
            <?php echo $__env->make('frontend.includes.product-card', ['variants' => $featuredProducts], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
          <?php else: ?>
            <!-- Static Fallback Data -->
            <?php for($i=1; $i<=5; $i++): ?>
            <?php
              $staticImages = [
                  'capsule-01.jpeg',
                  'medicine-01.jpeg',
                  'syrup-01.jpeg',
                  'contemporary2.jpg',
                  'contemporary3.jpg'
              ];
              $img = $staticImages[$i-1] ?? 'productmedicine.jpeg';
            ?>
            <div class="swiper-slide">
              <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100 product-card" style="transition: transform 0.3s ease;">
                <div class="position-relative main-image-wrap">
                  <img src="<?php echo e(asset('public/frontend/assets/img/home/' . $img)); ?>" class="card-img-top imageFit" alt="Product <?php echo e($i); ?>" style="height: 250px; object-fit: cover;">
                  <div class="showingbag">
                    <a href="javascript:void(0)" title="Add To Cart">
                      <span class="material-symbols-outlined">local_mall</span>
                    </a>
                  </div>
                </div>
                <div class="card-body  d-flex flex-column">
                  <h5 class="card-title fw-bold">Dermatology Product <?php echo e($i); ?></h5>
                  <p class="card-text text-muted small mb-3 flex-grow-1">An amazing product that takes care of your skin and health.</p>
                  <div class="d-flex justify-content-between align-items-center mt-auto">
                    <span class="fs-5 fw-bold text-primary">100.99</span>
                    <button class="viewbtn btn-sm rounded-pill px-3">View</button>
                  </div>
                </div>
              </div>
            </div>
            <?php endfor; ?>
          <?php endif; ?>
        </div>
        <div class="featured-slider-nav d-flex justify-content-center gap-3 mt-4">
          <div class="swiper-button-prev custom-arrow"></div>
          <div class="swiper-button-next custom-arrow"></div>
        </div>
      </div>
      <div class="featured-error-message" style="display:none;color:#dc3545;text-align:center;margin-top:1rem;"></div>
    </div>
  </div>
</section>

<?php $__env->startPush('styles'); ?>
  <style>
    .featured-category-section {
        border-radius: 20px;
    }
    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }
    .featured-slider-nav {
        position: relative;
        z-index: 10;
        padding-top: 15px;
    }
    .custom-arrow {
        position: static !important;
        margin: 0 !important;
        width: 40px !important;
        height: 40px !important;
        background: #fff;
        border: 1px solid #eaeaea;
        border-radius: 50%;
        color: #333 !important;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        transition: all 0.3s ease;
    }
    .custom-arrow:hover {
        background: #f0b334 !important;
        color: #fff !important;
    }
    .custom-arrow::after {
        font-size: 14px !important;
        font-weight: bold;
    }
  </style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    (function($) {
        $(document).ready(function() {
            new Swiper('.swiper-featured', {
              loop: false,
              slidesPerView: 4.5,
              spaceBetween: 20,
              breakpoints: {
                0: { slidesPerView: 1.25, spaceBetween: 12 },
                480: { slidesPerView: 1.6, spaceBetween: 14 },
                768: { slidesPerView: 2.5, spaceBetween: 16 },
                992: { slidesPerView: 3.2, spaceBetween: 20 },
                1200: { slidesPerView: 4.5, spaceBetween: 20 }
              },
              autoplay: false,
              navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
              }
            });
        });
    })(jQuery);
</script>
<?php $__env->stopPush(); ?>
<?php /**PATH C:\xampp\htdocs\vscode\resources\views/frontend/includes/featured-category-slider.blade.php ENDPATH**/ ?>