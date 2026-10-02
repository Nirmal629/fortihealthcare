<div class="furniture__menuwrap">
  <div class="container-xxl p-0">
    <div class="row m-0">
      <div class="col-lg-12 p-0">
        <nav class="navbar navbar-expand navbar-light p-0">
          <div class="container-fluid p-0">

            <div class="navbar-categories-wrap w-100 d-flex align-items-center" id="main_nav">

              {{-- LEFT MENU --}}
              <ul class="navbar-nav left-items d-flex align-items-center">

                @foreach ($navMenus as $navMenu)
                  @php
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
                  @endphp

                  {{-- ========================= --}}
                  {{-- TYPE 1: MEGA MENU --}}
                  {{-- ========================= --}}
                  @if ($hasGrandChildren)
                    <li class="nav-item dropdown has-megamenu {{ $isCategoryActive ? 'active' : '' }}">
                      <a class="nav-link dropdown-toggle category-dropdown-btn {{ $isCategoryActive ? 'active' : '' }}" href="javascript:void(0);" role="button" aria-expanded="false" data-category-title="{{ $navMenu->title }}">
                        <span class="category-title-text">{{ $navMenu->title }}</span>
                        <span class="material-symbols-outlined dropdown-indicator-icon">expand_more</span>
                      </a>

                      <div class="dropdown-menu megamenu">
                        <div class="row g-3">

                          {{-- LEFT SIDE --}}
                          <div class="col-lg-8 col-12">
                            <div class="col-megamenu_wrap">

                              @foreach ($navMenu->children as $subnavMenu)
                                @php
                                  if (!empty($currentChildSlug)) {
                                      $isSubActive = request()->routeIs('category.slug')
                                          && $currentCategorySlug === $navMenu->slug
                                          && ($currentChildSlug === $subnavMenu->slug || $subnavMenu->children->pluck('slug')->contains($currentChildSlug));
                                  } else {
                                      $isSubActive = request()->routeIs('category.slug')
                                          && ($navMenu->slug === $currentCategorySlug || empty($currentCategorySlug))
                                          && ($currentCategorySlug === $subnavMenu->slug || $subnavMenu->children->pluck('slug')->contains($currentCategorySlug));
                                  }
                                @endphp
                                <div class="col-megamenu">
                                  <h6 class="text-uppercase font15 fw-bold mb-2 subcategory-heading">
                                    <a href="{{ filter_var($subnavMenu->slug, FILTER_VALIDATE_URL)
                                        ? $subnavMenu->slug
                                        : ($subnavMenu->slug == '#' || empty($subnavMenu->slug)
                                            ? '#'
                                            : route('category.slug', [$navMenu->slug, $subnavMenu->slug])) }}"
                                       class="subnav-heading-link {{ $isSubActive ? 'active' : '' }}"
                                       style="{{ $isSubActive ? 'color: #f0b334 !important; font-weight: 700;' : '' }}">
                                      {{ $subnavMenu->title }}
                                    </a>
                                  </h6>

                                  @if ($subnavMenu->children->isNotEmpty())
                                    <ul class="list-unstyled subcategory-item-list">
                                      @foreach ($subnavMenu->children as $level3)
                                        @php
                                          if (!empty($currentChildSlug)) {
                                              $isLevel3Active = request()->routeIs('category.slug')
                                                  && $currentCategorySlug === $navMenu->slug
                                                  && $currentChildSlug === $level3->slug;
                                          } else {
                                              $isLevel3Active = request()->routeIs('category.slug')
                                                  && $currentCategorySlug === $level3->slug;
                                          }
                                        @endphp
                                        <li>
                                          <a
                                            href="{{ filter_var($level3->slug, FILTER_VALIDATE_URL)
                                                ? $level3->slug
                                                : ($level3->slug == '#' || empty($level3->slug)
                                                    ? '#'
                                                    : route('category.slug', [$navMenu->slug, $level3->slug])) }}"
                                            class="level3-subnav-link {{ $isLevel3Active ? 'active' : '' }}"
                                            style="{{ $isLevel3Active ? 'color: #f0b334 !important; font-weight: 600; padding-left: 4px;' : '' }}">
                                            {{ $level3->title }}
                                          </a>
                                        </li>
                                      @endforeach
                                    </ul>
                                  @endif
                                </div>
                              @endforeach

                            </div>
                          </div>

                          {{-- RIGHT SIDE (CATEGORY IMAGE) --}}
                          <div class="col-lg-4 col-12 d-none d-lg-block">
                            <div class="menu-banner">
                              <figure class="m-0">
                                <a href="{{ route('category.slug', $navMenu->slug) }}" class="mega-banner-link">
                                  <img
                                    src="{{ !empty($navMenu->category_image)
                                        ? asset('/public/uploads/categories/' . $navMenu->category_image)
                                        : asset('public/frontend/assets/img/home/megamenu-banner.jpg') }}"
                                    alt="{{ $navMenu->title }}" title="{{ $navMenu->title }}"
                                    class="imageFit img-with-radius" />
                                </a>
                              </figure>
                            </div>
                          </div>

                        </div>
                      </div>
                    </li>

                    {{-- ========================= --}}
                    {{-- TYPE 2: SIMPLE DROPDOWN (SINGLE LISTING) --}}
                    {{-- ========================= --}}
                  @elseif ($hasChildren)
                    <li class="nav-item dropdown has-singleListing {{ $isCategoryActive ? 'active' : '' }}">
                      <a class="nav-link dropdown-toggle category-dropdown-btn {{ $isCategoryActive ? 'active' : '' }}" href="javascript:void(0);" role="button" aria-expanded="false" data-category-title="{{ $navMenu->title }}">
                        <span class="category-title-text">{{ $navMenu->title }}</span>
                        <!-- <span class="material-symbols-outlined dropdown-indicator-icon">expand_more</span> -->
                      </a>

                      <div class="dropdown-menu singleListing-menu">
                        <div class="dropdown-content">
                          <div class="singleListing-header px-3 py-2 border-bottom mb-2 d-flex align-items-center justify-content-between">
                            <span class="fw-bold text-dark font14">{{ $navMenu->title }}</span>
                            <!-- <a href="{{ route('category.slug', $navMenu->slug) }}" class="text-primary font12 fw-semibold text-decoration-none view-all-link">View All &rarr;</a> -->
                          </div>

                          <div class="subcategory-links-list">
                            @foreach ($navMenu->children as $subnavMenu)
                              @php
                                if (!empty($currentChildSlug)) {
                                    $isSubActive = request()->routeIs('category.slug')
                                        && $currentCategorySlug === $navMenu->slug
                                        && $currentChildSlug === $subnavMenu->slug;
                                } else {
                                    $isSubActive = request()->routeIs('category.slug')
                                        && $currentCategorySlug === $subnavMenu->slug;
                                }
                              @endphp
                              <a href="{{ filter_var($subnavMenu->slug, FILTER_VALIDATE_URL)
                                  ? $subnavMenu->slug
                                  : ($subnavMenu->slug == '#' || empty($subnavMenu->slug)
                                      ? '#'
                                      : route('category.slug', [$navMenu->slug, $subnavMenu->slug])) }}"
                                class="dropdown-item subcategory-dropdown-link {{ $isSubActive ? 'active' : '' }} d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center gap-2">
                                  <span class="subcat-dot"></span>
                                  <span class="subcat-text">{{ $subnavMenu->title }}</span>
                                </div>
                                <span class="material-symbols-outlined font16 arrow-subcat-icon">chevron_right</span>
                              </a>
                            @endforeach
                          </div>

                        </div>
                      </div>
                    </li>

                    {{-- ========================= --}}
                    {{-- TYPE 3: SIMPLE LINK --}}
                    {{-- ========================= --}}
                  @else
                    <li class="nav-item {{ $isCategoryActive ? 'active' : '' }}">
                      <a class="nav-link category-direct-link {{ $isCategoryActive ? 'active' : '' }}"
                        href="{{ filter_var($navMenu->slug, FILTER_VALIDATE_URL) ? $navMenu->slug : route('category.slug', $navMenu->slug) }}">
                        <span>{{ $navMenu->title }}</span>
                      </a>
                    </li>
                  @endif
                @endforeach

              </ul>

              {{-- RIGHT SIDE --}}
              <!-- <ul class="navbar-nav ms-auto right-items gap-4">
                <li class="nav-item">
                  <a class="nav-link {{ request()->is('contact-us*') || request()->is('contact*') ? 'active' : '' }}" href="{{ route('cms.page', 'contact-us') }}">
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
