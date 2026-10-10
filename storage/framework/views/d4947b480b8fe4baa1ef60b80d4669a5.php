<section class="furniture__products_scroller_wrap flow-rootX3 featured-category-section" style="background: #f8f9fa; padding: 60px 0; margin-top: 40px;">
  <div class="container-xxl">
    <div class="row align-items-center">
      <div class="col-lg-6">
        <h2 class="fw-normal m-0 font45 c--blackc">Featured Collections</h2>
      </div>
      <div class="col-lg-6 text-end">
        <div class="position-relative d-inline-block">
          <button class="filter-btn-custom rounded-pill d-inline-flex align-items-center gap-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#filterOffcanvas" aria-controls="filterOffcanvas">
            <span class="material-symbols-outlined" style="font-size: 20px;">filter_alt</span> Filter
          </button>
          <?php if(request()->has('category_id')): ?>
            <a href="<?php echo e(url()->current()); ?>" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger d-flex align-items-center justify-content-center p-1 text-decoration-none shadow" style="width: 24px; height: 24px; z-index: 10; border: 2px solid #fff;" title="Clear Filter">
              <span class="material-symbols-outlined" style="font-size: 14px; font-weight: bold;">close</span>
            </a>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>

  <div class="container-xxl mt-4">
    <div class="product-grid">
      <?php
          $requestedCategoryId = request()->query('category_id');

          // Fetch latest active product variants with pagination (10 per page)
          $latestProductsQuery = \App\Models\ProductVariant::where('status', 1)
              ->with(['product', 'images' => function($q) {
                  $q->where('is_default', 1)->with('gallery');
              }, 'inventory'])
              ->orderBy('id', 'desc');

          if ($requestedCategoryId) {
              $latestProductsQuery->whereHas('product', function($q) use ($requestedCategoryId) {
                  $q->where('category_id', $requestedCategoryId);
              });
          }

          $latestProducts = $latestProductsQuery->paginate(10)->appends(request()->query());

          // Fetch parent categories with children for the filter modal
          $filterCategories = \App\Models\ProductCategory::where('status', 1)
              ->where('parent_id', 0)
              ->with(['children' => function($q) {
                  $q->where('status', 1);
              }])
              ->get();
      ?>
      <?php if(isset($latestProducts) && $latestProducts->count() > 0): ?>
        <?php echo $__env->make('frontend.includes.product-card', ['variants' => $latestProducts], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
      <?php else: ?>
        <div class="col-12 py-5 text-center">
          <h4 class="text-muted">No products found for this category.</h4>
          <a href="<?php echo e(route('category.list')); ?>" class="btn btn-primary mt-3 rounded-pill px-4">Clear Filter</a>
        </div>
      <?php endif; ?>
    </div>

    <?php if(isset($latestProducts) && $latestProducts->hasPages()): ?>
    <div class="mt-5 d-flex justify-content-center">
      <?php echo e($latestProducts->links('pagination::bootstrap-5')); ?>

    </div>
    <?php endif; ?>
  </div>
</section>

<!-- Filter Offcanvas Modal -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="filterOffcanvas" aria-labelledby="filterOffcanvasLabel">
  <div class="offcanvas-header border-bottom">
    <h5 class="offcanvas-title fw-bold" id="filterOffcanvasLabel">Filter Products</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body p-0">
    <div class="accordion accordion-flush" id="categoryAccordion">
      <?php $__currentLoopData = $filterCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $parent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <?php
        $isParentActive = $requestedCategoryId && $parent->children->pluck('id')->contains($requestedCategoryId);
      ?>
      <div class="accordion-item border-bottom">
        <h2 class="accordion-header" id="heading-<?php echo e($parent->id); ?>">
          <button class="accordion-button <?php echo e($isParentActive ? '' : 'collapsed'); ?> px-4 py-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-<?php echo e($parent->id); ?>" aria-expanded="<?php echo e($isParentActive ? 'true' : 'false'); ?>" aria-controls="collapse-<?php echo e($parent->id); ?>">
            <div class="form-check m-0 pointer-event-none">
              <input class="form-check-input shadow-none pointer-event-none" type="checkbox" id="check-<?php echo e($parent->id); ?>" <?php echo e($isParentActive ? 'checked' : ''); ?> style="pointer-events: none;">
              <label class="form-check-label fw-bold pointer-event-none" for="check-<?php echo e($parent->id); ?>" style="pointer-events: none;">
                <?php echo e($parent->title); ?>

              </label>
            </div>
          </button>
        </h2>
        <div id="collapse-<?php echo e($parent->id); ?>" class="accordion-collapse collapse <?php echo e($isParentActive ? 'show' : ''); ?>" aria-labelledby="heading-<?php echo e($parent->id); ?>" data-bs-parent="#categoryAccordion">
          <div class="accordion-body px-4 py-2 bg-light">
            <?php if($parent->children->count() > 0): ?>
              <ul class="list-unstyled mb-0 ms-4 border-start border-2 border-primary ps-3 py-1">
                <?php $__currentLoopData = $parent->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="mb-1">
                  <a href="<?php echo e(request()->fullUrlWithQuery(['category_id' => $child->id])); ?>" class="text-decoration-none d-block p-2 rounded custom-hover-link <?php echo e($requestedCategoryId == $child->id ? 'active fw-bold text-primary bg-white shadow-sm' : 'text-secondary'); ?>">
                    <?php echo e($child->title); ?>

                  </a>
                </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </ul>
            <?php else: ?>
              <p class="text-muted small mb-0 ms-2">No subcategories available.</p>
            <?php endif; ?>
          </div>
        </div>
      </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
  </div>
</div>

<?php $__env->startPush('styles'); ?>
  <style>
    .featured-category-section {
        border-radius: 20px;
    }
    .product-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 1.5rem;
    }
    .product-grid .swiper-slide {
        width: auto !important; /* Override Swiper's forced width */
        height: auto !important;
    }
    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }
    .pointer-event-none {
        pointer-events: none;
    }
    .custom-hover-link {
        transition: all 0.2s;
    }
    .custom-hover-link:hover {
        background-color: #fff;
        color: #0d6efd !important;
        box-shadow: 0 .125rem .25rem rgba(0,0,0,.075);
    }
    .filter-btn-custom {
        background-color: #f0b334;
        color: #ffffff;
        position: relative;
        border: 1px solid transparent;
        transition: all 0.5s;
        z-index: 1;
        overflow: hidden;
        padding: 0.5rem 1.5rem;
    }
    .filter-btn-custom::before {
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
    .filter-btn-custom:hover::before {
        transform: skewX(-45deg) scale(1, 1);
    }
    .filter-btn-custom:hover {
        color: #f0b334 !important;
        border-color: #f0b334 !important;
    }
  </style>
<?php $__env->stopPush(); ?>
<?php /**PATH C:\xampp\htdocs\vscode\resources\views/frontend/includes/category_slider.blade.php ENDPATH**/ ?>