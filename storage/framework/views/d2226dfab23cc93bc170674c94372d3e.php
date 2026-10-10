<div class="furniture__menuwrap">
  <div class="container-xxl p-0">
    <div class="row m-0">
      <div class="col-lg-12 p-0">
        <nav class="navbar navbar-expand navbar-light p-0">
          <div class="container-fluid p-0">

            <div class="navbar-categories-wrap w-100 d-flex align-items-center" id="main_nav">

              
              <ul class="navbar-nav left-items d-flex align-items-center">

                <?php $__currentLoopData = $navMenus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $navMenu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <?php
                    $hasChildren = $navMenu->children->isNotEmpty();
                    $hasGrandChildren = false;

                    if ($hasChildren) {
                        foreach ($navMenu->children as $child) {
                            if ($child->children->isNotEmpty()) {
                                $hasGrandChildren = true;
                                break;
                            }
                        }
                    }

                    $currentCategorySlug = request()->route('slug');
                    $currentChildSlug = request()->route('child_slug');

                    if (!empty($currentChildSlug)) {
                        $isCategoryActive = request()->routeIs('category.slug') && ($currentCategorySlug === $navMenu->slug);
                    } else {
                        $isCategoryActive = (request()->routeIs('category.slug') && $currentCategorySlug === $navMenu->slug)
                            || ($navMenu->children->isNotEmpty() && $navMenu->children->pluck('slug')->contains($currentCategorySlug));
                    }
                  ?>

                  
                  
                  
                  <?php if($hasGrandChildren): ?>
                    <li class="nav-item dropdown has-megamenu <?php echo e($isCategoryActive ? 'active' : ''); ?>">
                      <a class="nav-link dropdown-toggle category-dropdown-btn <?php echo e($isCategoryActive ? 'active' : ''); ?>" href="javascript:void(0);" role="button" aria-expanded="false" data-category-title="<?php echo e($navMenu->title); ?>">
                        <span class="category-title-text"><?php echo e($navMenu->title); ?></span>
                        <span class="material-symbols-outlined dropdown-indicator-icon">expand_more</span>
                      </a>

                      <div class="dropdown-menu megamenu">
                        <div class="row g-3">

                          
                          <div class="col-lg-8 col-12">
                            <div class="col-megamenu_wrap">

                              <?php $__currentLoopData = $navMenu->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subnavMenu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                  if (!empty($currentChildSlug)) {
                                      $isSubActive = request()->routeIs('category.slug')
                                          && $currentCategorySlug === $navMenu->slug
                                          && ($currentChildSlug === $subnavMenu->slug || $subnavMenu->children->pluck('slug')->contains($currentChildSlug));
                                  } else {
                                      $isSubActive = request()->routeIs('category.slug')
                                          && ($navMenu->slug === $currentCategorySlug || empty($currentCategorySlug))
                                          && ($currentCategorySlug === $subnavMenu->slug || $subnavMenu->children->pluck('slug')->contains($currentCategorySlug));
                                  }
                                ?>
                                <div class="col-megamenu">
                                  <h6 class="text-uppercase font15 fw-bold mb-2 subcategory-heading">
                                    <a href="<?php echo e(filter_var($subnavMenu->slug, FILTER_VALIDATE_URL)
                                        ? $subnavMenu->slug
                                        : ($subnavMenu->slug == '#' || empty($subnavMenu->slug)
                                            ? '#'
                                            : route('category.slug', [$navMenu->slug, $subnavMenu->slug]))); ?>"
                                       class="subnav-heading-link <?php echo e($isSubActive ? 'active' : ''); ?>"
                                       style="<?php echo e($isSubActive ? 'color: #f0b334 !important; font-weight: 700;' : ''); ?>">
                                      <?php echo e($subnavMenu->title); ?>

                                    </a>
                                  </h6>

                                  <?php if($subnavMenu->children->isNotEmpty()): ?>
                                    <ul class="list-unstyled subcategory-item-list">
                                      <?php $__currentLoopData = $subnavMenu->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $level3): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php
                                          if (!empty($currentChildSlug)) {
                                              $isLevel3Active = request()->routeIs('category.slug')
                                                  && $currentCategorySlug === $navMenu->slug
                                                  && $currentChildSlug === $level3->slug;
                                          } else {
                                              $isLevel3Active = request()->routeIs('category.slug')
                                                  && $currentCategorySlug === $level3->slug;
                                          }
                                        ?>
                                        <li>
                                          <a
                                            href="<?php echo e(filter_var($level3->slug, FILTER_VALIDATE_URL)
                                                ? $level3->slug
                                                : ($level3->slug == '#' || empty($level3->slug)
                                                    ? '#'
                                                    : route('category.slug', [$navMenu->slug, $level3->slug]))); ?>"
                                            class="level3-subnav-link <?php echo e($isLevel3Active ? 'active' : ''); ?>"
                                            style="<?php echo e($isLevel3Active ? 'color: #f0b334 !important; font-weight: 600; padding-left: 4px;' : ''); ?>">
                                            <?php echo e($level3->title); ?>

                                          </a>
                                        </li>
                                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                  <?php endif; ?>
                                </div>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </div>
                          </div>

                          
                          <div class="col-lg-4 col-12 d-none d-lg-block">
                            <div class="menu-banner">
                              <figure class="m-0">
                                <a href="<?php echo e(route('category.slug', $navMenu->slug)); ?>" class="mega-banner-link">
                                  <img
                                    src="<?php echo e(!empty($navMenu->category_image)
                                        ? asset('/public/uploads/categories/' . $navMenu->category_image)
                                        : asset('public/frontend/assets/img/home/megamenu-banner.jpg')); ?>"
                                    alt="<?php echo e($navMenu->title); ?>" title="<?php echo e($navMenu->title); ?>"
                                    class="imageFit img-with-radius" />
                                </a>
                              </figure>
                            </div>
                          </div>

                        </div>
                      </div>
                    </li>

                    
                    
                    
                  <?php elseif($hasChildren): ?>
                    <li class="nav-item dropdown has-singleListing <?php echo e($isCategoryActive ? 'active' : ''); ?>">
                      <a class="nav-link dropdown-toggle category-dropdown-btn <?php echo e($isCategoryActive ? 'active' : ''); ?>" href="javascript:void(0);" role="button" aria-expanded="false" data-category-title="<?php echo e($navMenu->title); ?>">
                        <span class="category-title-text"><?php echo e($navMenu->title); ?></span>
                        <!-- <span class="material-symbols-outlined dropdown-indicator-icon">expand_more</span> -->
                      </a>

                      <div class="dropdown-menu singleListing-menu">
                        <div class="dropdown-content">
                          <div class="singleListing-header px-3 py-2 border-bottom mb-2 d-flex align-items-center justify-content-between">
                            <span class="fw-bold text-dark font14"><?php echo e($navMenu->title); ?></span>
                            <!-- <a href="<?php echo e(route('category.slug', $navMenu->slug)); ?>" class="text-primary font12 fw-semibold text-decoration-none view-all-link">View All &rarr;</a> -->
                          </div>

                          <div class="subcategory-links-list">
                            <?php $__currentLoopData = $navMenu->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subnavMenu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <?php
                                if (!empty($currentChildSlug)) {
                                    $isSubActive = request()->routeIs('category.slug')
                                        && $currentCategorySlug === $navMenu->slug
                                        && $currentChildSlug === $subnavMenu->slug;
                                } else {
                                    $isSubActive = request()->routeIs('category.slug')
                                        && $currentCategorySlug === $subnavMenu->slug;
                                }
                              ?>
                              <a href="<?php echo e(filter_var($subnavMenu->slug, FILTER_VALIDATE_URL)
                                  ? $subnavMenu->slug
                                  : ($subnavMenu->slug == '#' || empty($subnavMenu->slug)
                                      ? '#'
                                      : route('category.slug', [$navMenu->slug, $subnavMenu->slug]))); ?>"
                                class="dropdown-item subcategory-dropdown-link <?php echo e($isSubActive ? 'active' : ''); ?> d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center gap-2">
                                  <span class="subcat-dot"></span>
                                  <span class="subcat-text"><?php echo e($subnavMenu->title); ?></span>
                                </div>
                                <span class="material-symbols-outlined font16 arrow-subcat-icon">chevron_right</span>
                              </a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          </div>

                        </div>
                      </div>
                    </li>

                    
                    
                    
                  <?php else: ?>
                    <li class="nav-item <?php echo e($isCategoryActive ? 'active' : ''); ?>">
                      <a class="nav-link category-direct-link <?php echo e($isCategoryActive ? 'active' : ''); ?>"
                        href="<?php echo e(filter_var($navMenu->slug, FILTER_VALIDATE_URL) ? $navMenu->slug : route('category.slug', $navMenu->slug)); ?>">
                        <span><?php echo e($navMenu->title); ?></span>
                      </a>
                    </li>
                  <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

              </ul>

              
              <!-- <ul class="navbar-nav ms-auto right-items gap-4">
                <li class="nav-item">
                  <a class="nav-link <?php echo e(request()->is('contact-us*') || request()->is('contact*') ? 'active' : ''); ?>" href="<?php echo e(route('cms.page', 'contact-us')); ?>">
                    Help
                  </a>
                </li>
              </ul> -->

            </div>
          </div>
        </nav>
      </div>
    </div>
  </div>
</div>

<script>
  (function() {
    function initCategoryDropdowns() {
      var toggles = document.querySelectorAll('.furniture__menuwrap .category-dropdown-btn');

      toggles.forEach(function(toggle) {
        toggle.onclick = function(e) {
          e.preventDefault();
          e.stopPropagation();

          var parentLi = toggle.closest('.dropdown');
          var targetMenu = parentLi ? parentLi.querySelector('.dropdown-menu') : null;
          var isAlreadyOpen = parentLi && parentLi.classList.contains('show');

          // Close all other open category dropdowns
          document.querySelectorAll('.furniture__menuwrap .dropdown.show').forEach(function(el) {
            if (el !== parentLi) {
              el.classList.remove('show');
              var m = el.querySelector('.dropdown-menu');
              if (m) m.classList.remove('show');
              var t = el.querySelector('.dropdown-toggle');
              if (t) {
                t.classList.remove('show');
                t.setAttribute('aria-expanded', 'false');
              }
            }
          });

          // Toggle clicked dropdown
          if (isAlreadyOpen) {
            if (parentLi) parentLi.classList.remove('show');
            if (targetMenu) targetMenu.classList.remove('show');
            toggle.classList.remove('show');
            toggle.setAttribute('aria-expanded', 'false');
          } else if (parentLi && targetMenu) {
            parentLi.classList.add('show');
            targetMenu.classList.add('show');
            toggle.classList.add('show');
            toggle.setAttribute('aria-expanded', 'true');
          }
        };
      });

      // Close when clicking outside
      document.addEventListener('click', function(e) {
        if (!e.target.closest('.furniture__menuwrap .dropdown')) {
          document.querySelectorAll('.furniture__menuwrap .dropdown.show').forEach(function(el) {
            el.classList.remove('show');
            var m = el.querySelector('.dropdown-menu');
            if (m) m.classList.remove('show');
            var t = el.querySelector('.dropdown-toggle');
            if (t) {
              t.classList.remove('show');
              t.setAttribute('aria-expanded', 'false');
            }
          });
        }
      });

      // Close on Escape key
      document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
          document.querySelectorAll('.furniture__menuwrap .dropdown.show').forEach(function(el) {
            el.classList.remove('show');
            var m = el.querySelector('.dropdown-menu');
            if (m) m.classList.remove('show');
            var t = el.querySelector('.dropdown-toggle');
            if (t) {
              t.classList.remove('show');
              t.setAttribute('aria-expanded', 'false');
            }
          });
        }
      });
    }

    if (document.readyState === 'loading') {
      document.addEventListener('DOMContentLoaded', initCategoryDropdowns);
    } else {
      initCategoryDropdowns();
    }
  })();
</script>
<?php /**PATH C:\xampp\htdocs\vscode\resources\views/frontend/layouts/includes/navbar.blade.php ENDPATH**/ ?>