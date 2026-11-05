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
    <div class="mt-5 d-flex justify-content-center category-featured-pagination-wrap">
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
        border-radius: 0 !important;
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

    /* =========================================================
       THEME-BASED FEATURED COLLECTION PAGINATION DESIGN
       ========================================================= */
    .category-featured-pagination-wrap {
      width: 100% !important;
      margin-top: 3rem !important;
    }

    .category-featured-pagination-wrap nav {
      width: 100% !important;
      background: #ffffff !important;
      border: 1px solid #e2e8f0 !important;
      border-radius: 0 !important;
      padding: 18px 24px !important;
      box-shadow: 0 4px 18px rgba(0, 0, 0, 0.03) !important;
      display: flex !important;
      align-items: center !important;
      justify-content: space-between !important;
      flex-wrap: wrap !important;
      gap: 16px !important;
    }

    .category-featured-pagination-wrap nav > div {
      display: flex !important;
      align-items: center !important;
    }

    .category-featured-pagination-wrap .text-muted,
    .category-featured-pagination-wrap p.small {
      color: #64748b !important;
      font-size: 14px !important;
      margin: 0 !important;
      font-weight: 500 !important;
      letter-spacing: 0.01em !important;
    }

    .category-featured-pagination-wrap .text-muted .fw-semibold,
    .category-featured-pagination-wrap p.small .fw-semibold {
      color: #0f172a !important;
      font-weight: 700 !important;
    }

    .category-featured-pagination-wrap .pagination {
      display: flex !important;
      align-items: center !important;
      gap: 8px !important;
      margin: 0 !important;
      padding: 0 !important;
      list-style: none !important;
    }

    .category-featured-pagination-wrap .pagination .page-item {
      margin: 0 !important;
    }

    .category-featured-pagination-wrap .pagination .page-link {
      min-width: 42px !important;
      height: 42px !important;
      padding: 0 14px !important;
      display: inline-flex !important;
      align-items: center !important;
      justify-content: center !important;
      font-size: 14.5px !important;
      font-weight: 600 !important;
      color: #334155 !important;
      background-color: #ffffff !important;
      border: 1.5px solid #e2e8f0 !important;
      border-radius: 0 !important;
      transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1) !important;
      text-decoration: none !important;
      box-shadow: 0 1px 2px rgba(0, 0, 0, 0.03) !important;
      cursor: pointer !important;
    }

    .category-featured-pagination-wrap .pagination .page-item:not(.active):not(.disabled) .page-link:hover {
      color: #f0b334 !important;
      border-color: #f0b334 !important;
      background-color: #fffdf5 !important;
      transform: translateY(-2px) !important;
      box-shadow: 0 4px 12px rgba(240, 179, 52, 0.25) !important;
    }

    .category-featured-pagination-wrap .pagination .page-item.active .page-link {
      background-color: #f0b334 !important;
      border-color: #f0b334 !important;
      color: #ffffff !important;
      font-weight: 700 !important;
      box-shadow: 0 4px 14px rgba(240, 179, 52, 0.4) !important;
      cursor: default !important;
      transform: none !important;
    }

    .category-featured-pagination-wrap .pagination .page-item.disabled .page-link {
      color: #cbd5e1 !important;
      background-color: #f8fafc !important;
      border-color: #e2e8f0 !important;
      cursor: not-allowed !important;
      opacity: 0.7 !important;
      box-shadow: none !important;
      transform: none !important;
    }

    .category-featured-pagination-wrap .pagination .page-item.disabled span.page-link:not([aria-label]):not([aria-hidden]) {
      background: transparent !important;
      border-color: transparent !important;
      color: #94a3b8 !important;
      min-width: 24px !important;
      box-shadow: none !important;
    }

    @media (max-width: 768px) {
      .category-featured-pagination-wrap nav {
        flex-direction: column !important;
        justify-content: center !important;
        text-align: center !important;
        padding: 16px !important;
        gap: 14px !important;
      }
      .category-featured-pagination-wrap nav > div {
        justify-content: center !important;
        width: 100% !important;
      }
      .category-featured-pagination-wrap .pagination {
        gap: 6px !important;
        flex-wrap: wrap !important;
        justify-content: center !important;
      }
      .category-featured-pagination-wrap .pagination .page-link {
        min-width: 38px !important;
        height: 38px !important;
        padding: 0 10px !important;
        font-size: 13.5px !important;
      }
    }
  </style>
<?php $__env->stopPush(); ?>
<?php /**PATH C:\xampp\htdocs\fortihealthcare\resources\views/frontend/includes/category_slider.blade.php ENDPATH**/ ?>