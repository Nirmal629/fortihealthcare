@php
  $currentSlug = request()->route('slug') ?? (isset($page) && is_object($page) ? $page->slug : '');

  $isHomeActive = request()->routeIs('home') || request()->is('/') || request()->path() === '/' || request()->path() === '';
  $isAboutActive = $currentSlug === 'about-us' || request()->is('*about-us*');
  $isServicesActive = in_array($currentSlug, ['return-policy', 'privacy-policy', 'terms-of-use']) || request()->is('*return-policy*') || request()->is('*privacy-policy*') || request()->is('*terms-of-use*');
  $isReturnPolicyActive = $currentSlug === 'return-policy' || request()->is('*return-policy*');
  $isPrivacyPolicyActive = $currentSlug === 'privacy-policy' || request()->is('*privacy-policy*');
  $isTermsOfUseActive = $currentSlug === 'terms-of-use' || request()->is('*terms-of-use*');
  $isProductsActive = request()->routeIs('category.list') || request()->routeIs('category.slug') || request()->routeIs('product.show') || request()->routeIs('search.product') || request()->routeIs('base.search') || request()->is('*categories*') || request()->is('*category*') || request()->is('*product*') || request()->is('*products*') || request()->is('*search*');
  $isContactActive = $currentSlug === 'contact-us' || request()->is('*contact-us*') || request()->is('*contact*');
@endphp

<header class="furniture__header custom-old-header">
  <div class="furniture__logowrap top-header-area">
    <div class="container-xxl">
      <div class="row">
        <div class="col-lg-12">
          <div class="furniture_logowrap d-flex justify-content-between align-items-center">

            <!-- <div class="location__link" style="">
              <div class="inside">
                @if (!auth()->check())
                  <a href="javascript:void();" class="d-flex justify-content-start align-items-center locationModal"><span
                      class="material-symbols-outlined me-1">location_on</span> Delivering to:
                    <strong class="default-pin ms-2">
                      {{ isset(session('user_pincode')['Name']) ? truncateNoWordBreak(session('user_pincode')['Name'], 20) : config('defaults.default_location') }}
                      {{ session('user_pincode')['Pincode'] ?? config('defaults.default_pincode') }}
                    </strong></a>
                @else
                  <a href="javascript:void();"
                    class="d-flex justify-content-start align-items-center list-address"
                    ><span
                      class="material-symbols-outlined me-1">location_on</span> Delivering to:
                    <strong class="default-pin ms-2">
                      {{ isset(session('user_pincode')['Name']) ? truncateNoWordBreak(session('user_pincode')['Name'], 20) : config('defaults.default_location') }}
                      {{ session('user_pincode')['Pincode'] ?? config('defaults.default_pincode') }}
                    </strong></a>
                @endif
              </div>
            </div> -->

            <div class="furniture__headerlogo d-flex align-items-center" style="gap: 15px;">
                <a href="{{ route('home') }}" title="{{ $siteSettings['sitename'] ?? 'Sundew Ecomm' }}" class="flex-shrink-0">
                  <img src="{{ siteLogo() }}" alt="{{ $siteSettings['sitename'] ?? 'Sundew Ecomm' }}" title="{{ $siteSettings['sitename'] ?? 'Sundew Ecomm' }}" style="max-height: 60px; object-fit: contain; border-radius: 4px;" />
                </a>
                <a href="{{ route('home') }}" class="text-decoration-none">
                  <div class="brand-text d-flex flex-column text-start">
                      <span class="fw-bold text-dark" style="font-family: 'Poppins', sans-serif; font-size: 22px; letter-spacing: -0.5px; line-height: 1.1;">Fortier Healthcare</span>
                      <span class="fw-semibold" style="color: #f0b334; font-size: 11px; letter-spacing: 1.5px; text-transform: uppercase; margin-top: 2px;">Pvt. Ltd.</span>
                  </div>
                </a>
            </div>

            <div class="menubar_box">
                <ul class="navber_wrap d-flex m-0 align-items-center" style="gap: 15px; list-style: none;">
                    <li class="{{ $isHomeActive ? 'current-menu-item' : '' }}"><a href="{{ route('home') }}" class="nav_link btn">Home</a></li>
                    <li class="{{ $isAboutActive ? 'current-menu-item' : '' }}"><a href="{{ route('cms.page', 'about-us') }}" class="nav_link btn">About Us</a></li>
                    <li class="dropdown {{ $isServicesActive ? 'current-menu-item' : '' }}">
                        <a href="javascript:void(0)" class="nav_link btn dropdown-toggle d-inline-flex align-items-center {{ $isServicesActive ? 'active' : '' }}" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false" style="gap: 4px;">
                            <span>Services</span>
                            <span class="material-symbols-outlined services-caret-icon" style="font-size: 16px; line-height: 1; transition: transform 0.25s ease;">expand_more</span>
                        </a>
                        <ul class="sub-menu dropdown-menu">
                            <li class="{{ $isReturnPolicyActive ? 'active' : '' }}"><a class="dropdown-item {{ $isReturnPolicyActive ? 'active' : '' }}" href="{{ route('cms.page', 'return-policy') }}">Return Policy</a></li>
                            <li class="{{ $isPrivacyPolicyActive ? 'active' : '' }}"><a class="dropdown-item {{ $isPrivacyPolicyActive ? 'active' : '' }}" href="{{ route('cms.page', 'privacy-policy') }}">Privacy Policy</a></li>
                            <li class="{{ $isTermsOfUseActive ? 'active' : '' }}"><a class="dropdown-item {{ $isTermsOfUseActive ? 'active' : '' }}" href="{{ route('cms.page', 'terms-of-use') }}">Terms of Use</a></li>
                        </ul>
                    </li>
                    <li class="{{ $isProductsActive ? 'current-menu-item' : '' }}"><a href="{{ route('category.list') }}" class="nav_link btn">Our Products</a></li>
                    <li class="{{ $isContactActive ? 'current-menu-item' : '' }}"><a href="{{ route('cms.page', 'contact-us') }}" class="nav_link btn">Contact Us</a></li>
                </ul>
            </div>

            <!-- Sidebar Toggle Icon Button (Visible on <= 991px) -->
            <button type="button" class="header-sidebar-toggle-btn" id="headerSidebarOpenBtn" onclick="openCustomMobileSidebar()" aria-label="Open navigation sidebar">
                <span class="material-symbols-outlined">menu</span>
            </button>

          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="custom-subheader-area">
    <div class="container-xxl">
      <div class="d-flex justify-content-between align-items-center custom-subheader-flex">

         <div class="left-categories flex-grow-1">
            @include('frontend.layouts.includes.navbar')
         </div>

         <div class="right-actions actionwrap d-flex align-items-center">
            <div class="itemswrp d-flex align-items-center gap-2">

              <!-- <div class="top-nav-item  d-flex align-items-center">
                <a class="nav-link custom-help-text" href="{{ route('cms.page', 'contact-us') }}" style="color: #000; font-weight: 500;">
                  Help
                </a>
              </div> -->

              <div class="top-nav-item search-icon d-flex align-items-center">
                <a href="javascript:void();" title="Search" data-bs-toggle="modal" data-bs-target="#searchModal"><span
                    class="material-symbols-outlined custom-text-white">search</span></a>
              </div>

              {{--@if (auth()->check())
                <div class="top-nav-item cart-icon wish-icon d-flex align-items-center">
                  <a href="{{ route('wishlist') }}" title="Wishlist">
                    <span class="material-symbols-outlined custom-text-white">favorite</span>
                    <div class="cart-number wishlist-number {{ savedForLaterCount() > 0 ? '' : 'd-none' }}">
                      {{ savedForLaterCount() }}</div>
                  </a>
                </div>
              @endif--}}

              <div class="top-nav-item cart-icon d-flex align-items-center">
                <a href="{{ route('cart.index') }}" title="Shopping Cart">
                  <span class="material-symbols-outlined custom-text-white">local_mall</span>
                  <div class="cart-number {{ cartCount() > 0 ? '' : 'd-none' }}">{{ cartCount() }}</div>
                </a>
              </div>
            </div>

            <div class="top_accounts_wrap ms-2 d-flex align-items-center">
              <div class="buttons-inline align-items-center d-flex">
                @if (auth()->guard('web')->check())
                  @php
                    $headerUser = auth()->guard('web')->user();
                    $headerUserImg = userImageById('web', $headerUser->id);
                    $headerAvatar = $headerUserImg ? $headerUserImg['image'] : asset('public/frontend/assets/img/home/top_user_thumb.jpg');
                    $headerUserName = trim($headerUser->first_name . ' ' . $headerUser->last_name) ?: 'My Account';
                  @endphp
                  <div class="dropdown user-header-dropdown">
                    <button class="btn user-profile-circle-btn d-flex align-items-center justify-content-center p-0 border-0 bg-transparent rounded-circle" type="button" id="headerUserProfileDropdown" aria-expanded="false" title="{{ $headerUserName }}">
                      <figure class="m-0 d-flex align-items-center justify-content-center rounded-circle user-circle-figure">
                        <img src="{{ $headerAvatar }}"
                             alt="{{ $headerUserName }}"
                             title="{{ $headerUserName }}"
                             class="imageFit rounded-circle header-profile-avatar" />
                      </figure>
                    </button>

                    <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 header-profile-menu py-0 mt-2" aria-labelledby="headerUserProfileDropdown">
                      <li class="user-menu-info border-bottom">
                        <div class="d-flex align-items-center justify-content-between mb-1">
                          <div class="fw-bold text-dark font14 text-truncate" style="max-width: 145px;">{{ $headerUserName }}</div>
                          <span class="user-member-badge">Member</span>
                        </div>
                        <div class="text-muted font12 text-truncate">{{ $headerUser->email }}</div>
                      </li>

                      <li class="pt-2 pb-1">
                        <a class="dropdown-item d-flex align-items-center gap-2 px-3 py-2 font14" href="{{ route('profile') }}">
                          <span class="material-symbols-outlined profile-item-icon">person</span>
                          <span>My Profile</span>
                        </a>
                      </li>
                      <li class="pb-1">
                        <a class="dropdown-item d-flex align-items-center gap-2 px-3 py-2 font14" href="{{ route('orders') }}">
                          <span class="material-symbols-outlined profile-item-icon">receipt_long</span>
                          <span>My Orders</span>
                        </a>
                      </li>

                      <li><hr class="dropdown-divider my-1"></li>

                      <li class="pb-2">
                        <button type="button" class="dropdown-item d-flex align-items-center gap-2 px-3 py-2 text-danger font14 bg-transparent border-0 w-100 text-start btn-trigger-logout" style="cursor: pointer;" onclick="promptLogoutConfirmation(event)">
                          <span class="material-symbols-outlined font20 text-danger">logout</span>
                          <span>Log Out</span>
                        </button>
                      </li>
                    </ul>
                  </div>

                  <form id="header-logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                  </form>
                @else
                  <a class="btn modern-header-login-btn d-inline-flex align-items-center gap-1" href="{{ route('signuplogin') }}" title="Login / Register">
                    <span class="material-symbols-outlined" style="font-size: 18px;">person</span>
                    <span>Login</span>
                  </a>
                @endif
              </div>
            </div>
         </div>

      </div>
    </div>
  </div>
</header>

<!-- Mobile Navigation Sidebar Overlay & Drawer -->
<div class="custom-mobile-sidebar-backdrop" id="customSidebarBackdrop" onclick="closeCustomMobileSidebar()"></div>
<aside class="custom-mobile-sidebar-drawer" id="customMobileSidebar" aria-label="Mobile navigation sidebar">
  <!-- Drawer Header -->
  <div class="sidebar-drawer-header d-flex justify-content-between align-items-center">
    <div class="sidebar-brand d-flex align-items-center" style="gap: 10px;">
      <a href="{{ route('home') }}" class="d-flex align-items-center text-decoration-none" style="gap: 10px;">
        <img src="{{ siteLogo() }}" alt="{{ $siteSettings['sitename'] ?? 'Fortier Healthcare' }}" style="max-height: 40px; object-fit: contain; border-radius: 4px;" />
        <div class="brand-text d-flex flex-column text-start">
          <span class="fw-bold text-dark" style="font-family: 'Poppins', sans-serif; font-size: 16px; letter-spacing: -0.5px; line-height: 1.1;">Fortier Healthcare</span>
          <span class="fw-semibold" style="color: #f0b334; font-size: 10px; letter-spacing: 1.2px; text-transform: uppercase;">Pvt. Ltd.</span>
        </div>
      </a>
    </div>
    <button type="button" class="sidebar-close-btn" id="customSidebarCloseBtn" onclick="closeCustomMobileSidebar()" aria-label="Close sidebar">
      <span class="material-symbols-outlined">close</span>
    </button>
  </div>

  <!-- Drawer Body Navigation -->
  <div class="sidebar-drawer-body">
    <ul class="sidebar-menu-list">
      <li class="sidebar-menu-item {{ $isHomeActive ? 'active' : '' }}">
        <a href="{{ route('home') }}" class="sidebar-menu-link">
          <div class="d-flex align-items-center gap-3">
            <span class="material-symbols-outlined menu-icon">home</span>
            <span>Home</span>
          </div>
        </a>
      </li>

      <li class="sidebar-menu-item {{ $isAboutActive ? 'active' : '' }}">
        <a href="{{ route('cms.page', 'about-us') }}" class="sidebar-menu-link">
          <div class="d-flex align-items-center gap-3">
            <span class="material-symbols-outlined menu-icon">info</span>
            <span>About Us</span>
          </div>
        </a>
      </li>

      <!-- Services Dropdown in Sidebar -->
      <li class="sidebar-menu-item sidebar-dropdown-item {{ $isServicesActive ? 'active' : '' }}">
        <a href="javascript:void(0);" class="sidebar-menu-link sidebar-dropdown-toggle {{ $isServicesActive ? 'expanded' : '' }}" id="sidebarServicesToggle" onclick="toggleSidebarServices(event)">
          <div class="d-flex align-items-center gap-3">
            <span class="material-symbols-outlined menu-icon">design_services</span>
            <span>Services</span>
          </div>
          <span class="material-symbols-outlined dropdown-arrow">expand_more</span>
        </a>
        <ul class="sidebar-submenu {{ $isServicesActive ? 'open' : '' }}" id="sidebarServicesSubmenu">
          <li>
            <a href="{{ route('cms.page', 'return-policy') }}" class="sidebar-submenu-link {{ $isReturnPolicyActive ? 'active' : '' }}">
              <span class="submenu-dot"></span>
              <span>Return Policy</span>
            </a>
          </li>
          <li>
            <a href="{{ route('cms.page', 'privacy-policy') }}" class="sidebar-submenu-link {{ $isPrivacyPolicyActive ? 'active' : '' }}">
              <span class="submenu-dot"></span>
              <span>Privacy Policy</span>
            </a>
          </li>
          <li>
            <a href="{{ route('cms.page', 'terms-of-use') }}" class="sidebar-submenu-link {{ $isTermsOfUseActive ? 'active' : '' }}">
              <span class="submenu-dot"></span>
              <span>Terms of Use</span>
            </a>
          </li>
        </ul>
      </li>

      <li class="sidebar-menu-item {{ $isProductsActive ? 'active' : '' }}">
        <a href="{{ route('category.list') }}" class="sidebar-menu-link">
          <div class="d-flex align-items-center gap-3">
            <span class="material-symbols-outlined menu-icon">category</span>
            <span>Our Products</span>
          </div>
        </a>
      </li>

      <li class="sidebar-menu-item {{ $isContactActive ? 'active' : '' }}">
        <a href="{{ route('cms.page', 'contact-us') }}" class="sidebar-menu-link">
          <div class="d-flex align-items-center gap-3">
            <span class="material-symbols-outlined menu-icon">support_agent</span>
            <span>Contact Us</span>
          </div>
        </a>
      </li>
    </ul>

    <!-- Quick Links & Accounts in Sidebar Footer -->
    <div class="sidebar-drawer-footer mt-auto pt-3 border-top">
      <div class="sidebar-footer-links d-flex flex-column gap-1">
        <a href="{{ route('cms.page', 'contact-us') }}" class="sidebar-footer-item">
          <span class="material-symbols-outlined">help_outline</span>
          <span>Help & Support</span>
        </a>
        <a href="{{ route('cart.index') }}" class="sidebar-footer-item">
          <span class="material-symbols-outlined">local_mall</span>
          <span>Shopping Cart</span>
        </a>
        @if (auth()->guard('web')->check())
          <a href="{{ route('profile') }}" class="sidebar-footer-item">
            <span class="material-symbols-outlined">person</span>
            <span>My Profile</span>
          </a>
          <button type="button" class="sidebar-footer-item text-danger border-0 bg-transparent w-100 text-start p-2 d-flex align-items-center gap-2" style="font-size: 0.92rem; cursor: pointer;" onclick="promptLogoutConfirmation(event)">
            <span class="material-symbols-outlined">logout</span>
            <span>Log Out</span>
          </button>
        @else
          <a href="{{ route('signuplogin') }}" class="sidebar-footer-item">
            <span class="material-symbols-outlined">login</span>
            <span>Login / Register</span>
          </a>
        @endif
      </div>
    </div>
  </div>
</aside>

<!-- Embedded Styles to Guarantee Instant Reflection on All Browsers -->
<style>
/* Toggle Button in Header */
.header-sidebar-toggle-btn {
  display: none;
  background-color: #ffffff !important;
  border: 1.5px solid #d1d5db !important;
  border-radius: 8px !important;
  padding: 6px 10px !important;
  color: #111827 !important;
  cursor: pointer !important;
  align-items: center !important;
  justify-content: center !important;
  transition: all 0.2s ease !important;
  outline: none !important;
  line-height: 1 !important;
  box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08) !important;
  z-index: 10 !important;
}

.header-sidebar-toggle-btn:hover,
.header-sidebar-toggle-btn:focus {
  background-color: #f3f4f6 !important;
  color: #f0b334 !important;
  border-color: #f0b334 !important;
}

.header-sidebar-toggle-btn .material-symbols-outlined {
  font-size: 28px !important;
  line-height: 1 !important;
  display: block !important;
}

/* Backdrop */
.custom-mobile-sidebar-backdrop {
  position: fixed !important;
  top: 0 !important;
  left: 0 !important;
  width: 100vw !important;
  height: 100vh !important;
  background: rgba(15, 23, 42, 0.65) !important;
  backdrop-filter: blur(4px) !important;
  -webkit-backdrop-filter: blur(4px) !important;
  z-index: 999998 !important;
  opacity: 0 !important;
  visibility: hidden !important;
  pointer-events: none !important;
  transition: opacity 0.35s ease, visibility 0.35s ease !important;
}

.custom-mobile-sidebar-backdrop.active {
  opacity: 1 !important;
  visibility: visible !important;
  pointer-events: auto !important;
}

/* Sidebar Drawer */
.custom-mobile-sidebar-drawer {
  position: fixed !important;
  top: 0 !important;
  right: 0 !important;
  width: 330px !important;
  max-width: 86vw !important;
  height: 100vh !important;
  height: 100dvh !important;
  background: #ffffff !important;
  z-index: 999999 !important;
  box-shadow: -10px 0 35px rgba(0, 0, 0, 0.2) !important;
  transform: translateX(100%) !important;
  transition: transform 0.38s cubic-bezier(0.16, 1, 0.3, 1) !important;
  display: flex !important;
  flex-direction: column !important;
  overflow-y: auto !important;
  overflow-x: hidden !important;
}

.custom-mobile-sidebar-drawer.active {
  transform: translateX(0) !important;
}

body.sidebar-open {
  overflow: hidden !important;
}

/* Sidebar Header */
.sidebar-drawer-header {
  padding: 1.2rem 1.25rem !important;
  border-bottom: 1px solid #f1f5f9 !important;
  background: #ffffff !important;
  position: sticky !important;
  top: 0 !important;
  z-index: 2 !important;
}

.sidebar-close-btn {
  background: #f8fafc !important;
  border: 1px solid #e2e8f0 !important;
  border-radius: 50% !important;
  width: 38px !important;
  height: 38px !important;
  display: flex !important;
  align-items: center !important;
  justify-content: center !important;
  color: #64748b !important;
  cursor: pointer !important;
  transition: all 0.25s ease !important;
  outline: none !important;
}

.sidebar-close-btn:hover {
  background: #fee2e2 !important;
  color: #ef4444 !important;
  border-color: #fca5a5 !important;
  transform: rotate(90deg) !important;
}

.sidebar-close-btn .material-symbols-outlined {
  font-size: 20px !important;
}

/* Sidebar Body */
.sidebar-drawer-body {
  padding: 1.25rem !important;
  flex: 1 !important;
  display: flex !important;
  flex-direction: column !important;
}

.sidebar-menu-list {
  list-style: none !important;
  padding: 0 !important;
  margin: 0 !important;
  display: flex !important;
  flex-direction: column !important;
  gap: 6px !important;
}

.sidebar-menu-item {
  border-radius: 12px !important;
  overflow: hidden !important;
}

.sidebar-menu-link {
  display: flex !important;
  align-items: center !important;
  justify-content: space-between !important;
  padding: 12px 14px !important;
  color: #334155 !important;
  text-decoration: none !important;
  font-weight: 500 !important;
  font-size: 1rem !important;
  border-radius: 12px !important;
  transition: all 0.2s ease !important;
}

.sidebar-menu-link:hover,
.sidebar-menu-item.active > .sidebar-menu-link {
  background: #f0b334 !important;
  color: #ffffff !important;
  font-weight: 600 !important;
}

.sidebar-menu-link .menu-icon {
  font-size: 22px !important;
  color: #94a3b8 !important;
  transition: color 0.2s ease !important;
}

.sidebar-menu-link:hover .menu-icon,
.sidebar-menu-item.active > .sidebar-menu-link .menu-icon {
  color: #ffffff !important;
}

/* Submenu */
.sidebar-dropdown-toggle .dropdown-arrow {
  font-size: 20px !important;
  color: #94a3b8 !important;
  transition: transform 0.3s ease !important;
}

.sidebar-dropdown-toggle.expanded .dropdown-arrow {
  transform: rotate(180deg) !important;
  color: #f0b334 !important;
}

.sidebar-submenu {
  list-style: none !important;
  padding: 0 0 0 2.5rem !important;
  margin: 0 !important;
  max-height: 0 !important;
  overflow: hidden !important;
  opacity: 0 !important;
  transition: max-height 0.35s ease, opacity 0.25s ease !important;
}

.sidebar-submenu.open {
  max-height: 200px !important;
  opacity: 1 !important;
  padding-top: 4px !important;
  padding-bottom: 6px !important;
}

.sidebar-submenu-link {
  display: flex !important;
  align-items: center !important;
  gap: 10px !important;
  padding: 8px 12px !important;
  color: #64748b !important;
  text-decoration: none !important;
  font-size: 0.95rem !important;
  font-weight: 500 !important;
  border-radius: 8px !important;
  transition: all 0.2s ease !important;
}

.sidebar-submenu-link:hover {
  color: #f0b334 !important;
  background: #f8fafc !important;
}

.sidebar-submenu-link .submenu-dot {
  width: 6px !important;
  height: 6px !important;
  border-radius: 50% !important;
  background: #cbd5e1 !important;
  transition: background 0.2s ease !important;
}

.sidebar-submenu-link:hover .submenu-dot {
  background: #f0b334 !important;
}

/* Footer Links */
.sidebar-drawer-footer {
  margin-top: auto !important;
}

.sidebar-footer-item {
  display: flex !important;
  align-items: center !important;
  gap: 10px !important;
  padding: 10px 12px !important;
  color: #64748b !important;
  text-decoration: none !important;
  font-size: 0.92rem !important;
  font-weight: 500 !important;
  border-radius: 8px !important;
  transition: all 0.2s ease !important;
}

.sidebar-footer-item:hover {
  color: #f0b334 !important;
  background: #f1f5f9 !important;
}

.sidebar-footer-item .material-symbols-outlined {
  font-size: 20px !important;
}

/* Subheader Always Visible Left Categories & Dropdown Menus */
.custom-subheader-area {
  position: relative !important;
  /* z-index: 1050 !important; */
  overflow: visible !important;
  background: #ffffff !important;
}

.custom-subheader-area .left-categories,
.custom-subheader-area .left-categories .furniture__menuwrap,
.custom-subheader-area .left-categories .navbar,
.custom-subheader-area .left-categories .navbar-categories-wrap {
  position: static !important;
  overflow: visible !important;
  display: block !important;
  flex-grow: 1 !important;
  min-width: 0 !important;
  width: 100% !important;
}

.custom-subheader-area .left-categories .navbar-nav.left-items {
  display: flex !important;
  flex-direction: row !important;
  align-items: center !important;
  flex-wrap: wrap !important;
  overflow: visible !important;
  margin: 0 !important;
  padding: 6px 0 !important;
  gap: 8px !important;
  position: static !important;
}

.custom-subheader-area .left-categories .navbar-nav.left-items .nav-item {
  flex-shrink: 0 !important;
  position: relative !important;
  list-style: none !important;
}

.custom-subheader-area .left-categories .navbar-nav.left-items .nav-item.has-megamenu {
  position: static !important;
}

/* Category Button Links */
.custom-subheader-area .left-categories .navbar-nav.left-items .nav-link {
  white-space: nowrap !important;
  cursor: pointer !important;
  display: inline-flex !important;
  align-items: center !important;
  gap: 4px !important;
  padding: 6px 14px !important;
  font-size: 0.95rem !important;
  font-weight: 500 !important;
  color: #1e293b !important;
  border-radius: 20px !important;
  background: #f8fafc !important;
  border: 1px solid #e2e8f0 !important;
  transition: all 0.2s ease !important;
  text-decoration: none !important;
  user-select: none !important;
}

.custom-subheader-area .left-categories .navbar-nav.left-items .nav-link:hover,
.custom-subheader-area .left-categories .navbar-nav.left-items .nav-item.show > .nav-link,
.custom-subheader-area .left-categories .navbar-nav.left-items .nav-link.show,
.custom-subheader-area .left-categories .navbar-nav.left-items .nav-item.active > .nav-link,
.custom-subheader-area .left-categories .navbar-nav.left-items .nav-link.active {
  background: #f0b334 !important;
  color: #ffffff !important;
  border-color: #f0b334 !important;
  font-weight: 600 !important;
}

.custom-subheader-area .left-categories .navbar-nav.left-items .nav-item.active .dropdown-indicator-icon,
.custom-subheader-area .left-categories .navbar-nav.left-items .nav-link.active .dropdown-indicator-icon {
  color: #ffffff !important;
}

/* Menubar Active Link Enhancements */
.navber_wrap li > a.nav_link,
.navber_wrap li > a {
  position: relative !important;
  color: #58595b !important;
  font-weight: 600 !important;
  text-transform: capitalize !important;
  text-decoration: none !important;
  padding: 5px 10px !important;
  transition: all 0.3s ease !important;
  display: inline-block !important;
}

.navber_wrap li.dropdown {
  position: relative !important;
}

.navber_wrap li.dropdown > a.dropdown-toggle {
  display: inline-flex !important;
  align-items: center !important;
}

.navber_wrap li.dropdown > a.dropdown-toggle::after {
  display: none !important;
}

.navber_wrap .services-caret-icon {
  font-size: 16px !important;
  line-height: 1 !important;
  color: inherit !important;
  transition: transform 0.25s ease, color 0.25s ease !important;
}

.navber_wrap li:hover > a.nav_link,
.navber_wrap li:hover > a {
  color: #f0b334 !important;
}

.navber_wrap li.dropdown:hover .services-caret-icon,
.navber_wrap li.dropdown.show .services-caret-icon,
.navber_wrap li.dropdown > a.show .services-caret-icon {
  transform: rotate(180deg) !important;
  color: #f0b334 !important;
}

/* Exact same active style design for all navmenu items (Home, About Us, Services, Our Products, Contact Us) */
.navber_wrap li.current-menu-item > a,
.navber_wrap li.current-menu-item > a.nav_link {
  color: #f0b334 !important;
  text-decoration: none !important;
  text-shadow: 0px -1px #b5b5b5 !important;
  font-weight: 600 !important;
  position: relative !important;
  transition: 0.4s !important;
}

.navber_wrap li.current-menu-item > a::after,
.navber_wrap li.current-menu-item > a.nav_link::after {
  content: "" !important;
  position: absolute !important;
  bottom: -2px !important;
  left: 50% !important;
  transform: translateX(-50%) !important;
  background-color: #f0b334 !important;
  width: 80% !important;
  height: 2px !important;
  border-radius: 6px !important;
  transition: 0.4s !important;
  display: block !important;
}

/* Submenu inside Services */
.navber_wrap .sub-menu {
  position: absolute !important;
  top: calc(100% + 5px) !important;
  left: 0 !important;
  margin: 0 !important;
  min-width: 14rem !important;
  background-color: #ffffff !important;
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.12) !important;
  border: 1px solid #e2e8f0 !important;
  border-radius: 8px !important;
  padding: 6px 0 !important;
  z-index: 1050 !important;
  display: none;
}

/* Invisible bridge so mouse hover is smooth across 5px gap */
.navber_wrap .sub-menu::before {
  content: "" !important;
  position: absolute !important;
  top: -6px !important;
  left: 0 !important;
  right: 0 !important;
  height: 6px !important;
  background: transparent !important;
}

/* Open submenu on hover */
.navber_wrap li.dropdown:hover > .sub-menu {
  display: block !important;
  animation: dropdownFadeIn 0.2s ease forwards !important;
}

/* Open submenu on click / show */
.navber_wrap li.dropdown > .sub-menu.show,
.navber_wrap li.dropdown.show > .sub-menu {
  display: block !important;
  animation: dropdownFadeIn 0.2s ease forwards !important;
}

.navber_wrap .sub-menu li {
  border-bottom: 1px solid #f1f5f9 !important;
}

.navber_wrap .sub-menu li:last-child {
  border-bottom: none !important;
}

.navber_wrap .sub-menu li a {
  width: 100% !important;
  display: block !important;
  padding: 8px 16px !important;
  font-size: 0.9rem !important;
  font-weight: 500 !important;
  color: #475569 !important;
  text-shadow: none !important;
  text-transform: capitalize !important;
  transition: all 0.2s ease !important;
}

.navber_wrap .sub-menu li a::after {
  display: none !important;
}

.navber_wrap .sub-menu li a:hover,
.navber_wrap .sub-menu li.active > a,
.navber_wrap .sub-menu li a.active {
  background-color: #fff8eb !important;
  color: #f0b334 !important;
  font-weight: 600 !important;
  padding-left: 20px !important;
}

/* Category Indicator Arrow */
.dropdown-indicator-icon {
  font-size: 18px !important;
  line-height: 1 !important;
  color: #64748b !important;
  transition: transform 0.25s ease, color 0.2s ease !important;
}

.custom-subheader-area .left-items .nav-item.show .dropdown-indicator-icon,
.custom-subheader-area .left-items .dropdown-toggle.show .dropdown-indicator-icon {
  transform: rotate(180deg) !important;
  color: #ffffff !important;
}

@keyframes dropdownFadeIn {
  from {
    opacity: 0;
    transform: translateY(6px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

/* Megamenu (Type 1) */
.custom-subheader-area .has-megamenu .dropdown-menu.megamenu {
  display: none !important;
  position: absolute !important;
  top: 100% !important;
  left: 0 !important;
  right: 0 !important;
  width: 100% !important;
  background: #ffffff !important;
  border: 1px solid #e2e8f0 !important;
  border-top: 3px solid #f0b334 !important;
  border-radius: 0 0 16px 16px !important;
  box-shadow: 0 20px 45px rgba(0, 0, 0, 0.16) !important;
  z-index: 9999999 !important;
  padding: 1.75rem 2rem !important;
  margin: 0 !important;
  max-height: 75vh !important;
  overflow-y: auto !important;
}

.custom-subheader-area .has-megamenu .dropdown-menu.megamenu.show,
.custom-subheader-area .has-megamenu.show > .dropdown-menu.megamenu {
  display: block !important;
  opacity: 1 !important;
  visibility: visible !important;
  pointer-events: auto !important;
  animation: dropdownFadeIn 0.22s cubic-bezier(0.16, 1, 0.3, 1) forwards !important;
}

.custom-subheader-area .col-megamenu_wrap {
  display: grid !important;
  grid-template-columns: repeat(auto-fill, minmax(180px, 1fr)) !important;
  gap: 1.5rem !important;
  width: 100% !important;
}

.subnav-heading-link {
  color: #0f172a !important;
  text-decoration: none !important;
  transition: color 0.2s ease !important;
  display: inline-block !important;
}

.subnav-heading-link:hover {
  color: #f0b334 !important;
}

.subcategory-item-list {
  padding: 0 !important;
  margin: 0 !important;
  list-style: none !important;
}

.subcategory-item-list li {
  margin-bottom: 4px !important;
}

.level3-subnav-link {
  display: block !important;
  color: #64748b !important;
  text-decoration: none !important;
  font-size: 0.92rem !important;
  padding: 3px 0 !important;
  transition: all 0.2s ease !important;
}

.level3-subnav-link:hover {
  color: #f0b334 !important;
  padding-left: 4px !important;
}

/* Single Listing Menu (Type 2) */
.custom-subheader-area .has-singleListing .dropdown-menu.singleListing-menu {
  display: none !important;
  position: absolute !important;
  top: 100% !important;
  left: 0 !important;
  min-width: 260px !important;
  background: #ffffff !important;
  border: 1px solid #e2e8f0 !important;
  border-top: 3px solid #f0b334  !important;
  border-radius: 12px !important;
  box-shadow: 0 16px 36px rgba(0, 0, 0, 0.16) !important;
  z-index: 9999999 !important;
  padding: 6px 0 !important;
  margin-top: 4px !important;
  max-height: 70vh !important;
  overflow-y: auto !important;
}

.custom-subheader-area .has-singleListing .dropdown-menu.singleListing-menu.show,
.custom-subheader-area .has-singleListing.show > .dropdown-menu.singleListing-menu {
  display: block !important;
  opacity: 1 !important;
  visibility: visible !important;
  pointer-events: auto !important;
  animation: dropdownFadeIn 0.22s cubic-bezier(0.16, 1, 0.3, 1) forwards !important;
}

.singleListing-header {
  padding: 8px 16px !important;
  border-bottom: 1px solid #f1f5f9 !important;
}

.singleListing-header .view-all-link {
  color: #f0b334 !important;
  font-size: 0.8rem !important;
  transition: color 0.2s ease !important;
}

.singleListing-header .view-all-link:hover {
  color: #003db3 !important;
  text-decoration: underline !important;
}

.subcategory-links-list {
  padding: 4px 6px !important;
}

.custom-subheader-area .has-singleListing .dropdown-menu.singleListing-menu a.dropdown-item,
.subcategory-dropdown-link {
  display: flex !important;
  align-items: center !important;
  justify-content: space-between !important;
  padding: 9px 12px !important;
  color: #334155 !important;
  font-size: 0.92rem !important;
  font-weight: 500 !important;
  border-radius: 8px !important;
  text-decoration: none !important;
  transition: all 0.2s ease !important;
  margin-bottom: 2px !important;
}

.subcategory-dropdown-link .subcat-dot {
  width: 6px !important;
  height: 6px !important;
  border-radius: 50% !important;
  background: #cbd5e1 !important;
  transition: background 0.2s ease, transform 0.2s ease !important;
  display: inline-block !important;
  flex-shrink: 0 !important;
}

.subcategory-dropdown-link .arrow-subcat-icon {
  font-size: 16px !important;
  color: #94a3b8 !important;
  transition: transform 0.2s ease, color 0.2s ease !important;
}

.custom-subheader-area .has-singleListing .dropdown-menu.singleListing-menu a.dropdown-item:hover,
.subcategory-dropdown-link:hover {
  background: #f0b334 !important;
  color: #ffffff !important;
  padding-left: 16px !important;
}

.subcategory-dropdown-link:hover .subcat-dot {
  background: #ffffff !important;
  transform: scale(1.3) !important;
}

.subcategory-dropdown-link:hover .arrow-subcat-icon {
  color: #ffffff !important;
  transform: translateX(3px) !important;
}

@media (max-width: 767px) {
  .custom-subheader-area .has-megamenu .dropdown-menu.megamenu {
    padding: 1.25rem 1rem !important;
  }
  .custom-subheader-area .col-megamenu_wrap {
    grid-template-columns: 1fr !important;
    gap: 1.25rem !important;
  }
  .custom-subheader-area .has-megamenu .dropdown-menu.megamenu .col-lg-8,
  .custom-subheader-area .has-megamenu .dropdown-menu.megamenu .col-12 {
    width: 100% !important;
    flex: 0 0 100% !important;
    max-width: 100% !important;
  }
  .custom-subheader-area .has-singleListing .dropdown-menu.singleListing-menu {
    position: absolute !important;
    left: 0 !important;
    right: 0 !important;
    width: 100% !important;
    min-width: 220px !important;
    max-width: 100% !important;
  }
}

/* Responsive Media Queries (<= 991px) */
/* Responsive Media Queries (<= 991px) */
@media (max-width: 991.98px) {
  .menubar_box {
    display: none !important;
  }
  .header-sidebar-toggle-btn {
    display: inline-flex !important;
  }
  .right-actions,
  .right-actions.actionwrap {
    display: none !important;
  }
  section, .section, .py-5, .py-lg-5, .modern-about-section, .welcomeText, .yearsexprience, .businessExcellence {
    padding-top: 2.25rem !important;
    padding-bottom: 2.25rem !important;
  }
  .living__home-hero, .living__home-hero--media, .about_hero_banner, .about_hero_banner .living__home-hero--media {
    height: 360px !important;
    max-height: 360px !important;
  }
  .about-image-wrapper img {
    height: 320px !important;
  }
}

/* App-Like Mobile Design (<= 575.98px / 576px) */
@media (max-width: 575.98px) {
  .container, .container-fluid, .container-xxl {
    padding-left: 14px !important;
    padding-right: 14px !important;
  }
  section, .section, .py-5, .py-lg-5, .modern-about-section, .welcomeText, .yearsexprience, .businessExcellence {
    padding-top: 1.6rem !important;
    padding-bottom: 1.6rem !important;
  }
  .furniture__headerlogo img {
    max-height: 40px !important;
  }
  .furniture__headerlogo .brand-text span.fw-bold {
    font-size: 16px !important;
  }
  .furniture__headerlogo .brand-text span.fw-semibold {
    font-size: 9px !important;
    letter-spacing: 1px !important;
  }
  .custom-subheader-area {
    padding: 8px 0 !important;
  }
  .custom-subheader-area .left-categories .navbar-nav.left-items .nav-link {
    font-size: 0.82rem !important;
    padding: 5px 12px !important;
    background: #f1f5f9 !important;
    border-radius: 20px !important;
    color: #334155 !important;
  }
  .living__home-hero, .living__home-hero--media, .about_hero_banner, .about_hero_banner .living__home-hero--media {
    height: 240px !important;
    max-height: 240px !important;
  }
  .about-image-wrapper img {
    height: 220px !important;
  }
}

@media (min-width: 992px) {
  .header-sidebar-toggle-btn {
    display: none !important;
  }
  .custom-mobile-sidebar-drawer,
  .custom-mobile-sidebar-backdrop {
    display: none !important;
  }
  .right-actions,
  .right-actions.actionwrap {
    display: flex !important;
  }
}

/* Subheader User Profile Circle and Dropdown */
.user-header-dropdown,
.custom-subheader-area .user-header-dropdown,
.custom-subheader-area .top_accounts_wrap .user-header-dropdown,
.custom-subheader-area .top_accounts_wrap .buttons-inline .user-header-dropdown {
  position: relative !important;
  display: inline-flex !important;
  align-items: center !important;
  justify-content: center !important;
  width: 38px !important;
  height: 38px !important;
  min-width: 38px !important;
  max-width: 38px !important;
  min-height: 38px !important;
  max-height: 38px !important;
  flex-shrink: 0 !important;
  box-sizing: border-box !important;
}

.user-header-dropdown .dropdown-toggle::after,
.custom-subheader-area .user-header-dropdown .dropdown-toggle::after {
  display: none !important;
}

.user-profile-circle-btn,
.custom-subheader-area .user-profile-circle-btn,
.custom-subheader-area .top_accounts_wrap .user-profile-circle-btn,
.custom-subheader-area .top_accounts_wrap .buttons-inline .user-profile-circle-btn,
.custom-subheader-area .top_accounts_wrap .buttons-inline button.user-profile-circle-btn {
  width: 38px !important;
  height: 38px !important;
  min-width: 38px !important;
  max-width: 38px !important;
  min-height: 38px !important;
  max-height: 38px !important;
  border-radius: 50% !important;
  padding: 0 !important;
  margin: 0 !important;
  display: flex !important;
  align-items: center !important;
  justify-content: center !important;
  border: 2px solid #f0b334 !important;
  background: #ffffff !important;
  cursor: pointer !important;
  box-shadow: 0 2px 8px rgba(240, 179, 52, 0.35) !important;
  transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1) !important;
  overflow: hidden !important;
  outline: none !important;
  flex-shrink: 0 !important;
  box-sizing: border-box !important;
  line-height: 1 !important;
  aspect-ratio: 1 / 1 !important;
}

.user-profile-circle-btn:hover,
.user-profile-circle-btn:focus,
.user-profile-circle-btn[aria-expanded="true"],
.user-profile-circle-btn.show,
.user-header-dropdown.show .user-profile-circle-btn {
  border-color: #df9f1b !important;
  box-shadow: 0 5px 15px rgba(240, 179, 52, 0.5) !important;
  transform: translateY(-2px) scale(1.05) !important;
}

.user-profile-circle-btn:active {
  transform: translateY(0) scale(0.96) !important;
}

.user-circle-figure,
.custom-subheader-area .user-circle-figure,
.custom-subheader-area .top_accounts_wrap figure.user-circle-figure,
.custom-subheader-area .top_accounts_wrap .buttons-inline figure.user-circle-figure {
  width: 100% !important;
  height: 100% !important;
  min-width: 100% !important;
  max-width: 100% !important;
  min-height: 100% !important;
  max-height: 100% !important;
  margin: 0 !important;
  padding: 0 !important;
  border-radius: 50% !important;
  overflow: hidden !important;
  display: flex !important;
  align-items: center !important;
  justify-content: center !important;
  flex-shrink: 0 !important;
  box-sizing: border-box !important;
  aspect-ratio: 1 / 1 !important;
}

.header-profile-avatar,
.custom-subheader-area .header-profile-avatar,
.custom-subheader-area .top_accounts_wrap img.header-profile-avatar,
.custom-subheader-area .top_accounts_wrap .buttons-inline img.header-profile-avatar {
  width: 100% !important;
  height: 100% !important;
  min-width: 100% !important;
  max-width: 100% !important;
  min-height: 100% !important;
  max-height: 100% !important;
  object-fit: cover !important;
  border-radius: 50% !important;
  display: block !important;
  margin: 0 !important;
  padding: 0 !important;
  flex-shrink: 0 !important;
  box-sizing: border-box !important;
  aspect-ratio: 1 / 1 !important;
}

.header-profile-menu {
  position: absolute !important;
  top: calc(100% + 8px) !important;
  right: 0 !important;
  left: auto !important;
  min-width: 245px !important;
  background-color: #ffffff !important;
  border: 1.5px solid #e2e8f0 !important;
  border-top: 3.5px solid #f0b334 !important;
  border-radius: 16px !important;
  box-shadow: 0 18px 42px -6px rgba(0, 0, 0, 0.16), 0 6px 16px rgba(0, 0, 0, 0.06) !important;
  margin: 0 !important;
  padding: 0 !important;
  overflow: hidden !important;
  z-index: 1100 !important;
  transform-origin: top right !important;
  display: none !important;
}

.user-header-dropdown:hover > .header-profile-menu:not(.show),
.user-header-dropdown.hover-open > .header-profile-menu:not(.show) {
  display: none !important;
  opacity: 0 !important;
  visibility: hidden !important;
  pointer-events: none !important;
}

.header-profile-menu.show,
.user-header-dropdown.show > .header-profile-menu {
  display: block !important;
  opacity: 1 !important;
  visibility: visible !important;
  transform: translateY(0) scale(1) !important;
  pointer-events: auto !important;
  animation: profileMenuFadeIn 0.2s cubic-bezier(0.16, 1, 0.3, 1) !important;
}

.header-profile-menu .user-menu-info {
  background: linear-gradient(135deg, #f8fafc 0%, #fffbf2 100%) !important;
  border-bottom: 1px solid #f1f5f9 !important;
  padding: 12px 16px !important;
}

.user-member-badge {
  font-size: 10.5px !important;
  font-weight: 700 !important;
  color: #b47b00 !important;
  background-color: rgba(240, 179, 52, 0.16) !important;
  border: 1px solid rgba(240, 179, 52, 0.35) !important;
  padding: 2px 8px !important;
  border-radius: 12px !important;
  text-transform: uppercase !important;
  letter-spacing: 0.5px !important;
}

@keyframes profileMenuFadeIn {
  from {
    opacity: 0;
    transform: translateY(8px) scale(0.97);
  }
  to {
    opacity: 1;
    transform: translateY(0) scale(1);
  }
}

.header-profile-menu .dropdown-item {
  transition: all 0.2s ease !important;
  border-radius: 8px !important;
  margin: 3px 8px !important;
  width: calc(100% - 16px) !important;
  padding: 8px 12px !important;
  font-size: 13.5px !important;
  font-weight: 500 !important;
  color: #334155 !important;
}

.header-profile-menu .dropdown-item:hover {
  background-color: #fff8eb !important;
  color: #f0b334 !important;
  font-weight: 600 !important;
  padding-left: 16px !important;
  transform: translateX(2px) !important;
}

.header-profile-menu .dropdown-item .profile-item-icon {
  font-size: 20px !important;
  color: #64748b !important;
  transition: all 0.2s ease !important;
}

.header-profile-menu .dropdown-item:hover .profile-item-icon {
  color: #f0b334 !important;
}

.header-profile-menu .dropdown-item.text-danger {
  color: #475569 !important;
}

.header-profile-menu .dropdown-item.text-danger:hover {
  background-color: #fef2f2 !important;
  color: #dc2626 !important;
  font-weight: 600 !important;
}

.header-profile-menu .dropdown-item.text-danger:hover .material-symbols-outlined {
  color: #dc2626 !important;
}

.modern-header-login-btn {
  background-color: #f0b334 !important;
  color: #ffffff !important;
  font-size: 13.5px !important;
  font-weight: 600 !important;
  padding: 7px 18px !important;
  border-radius: 20px !important;
  border: none !important;
  box-shadow: 0 2px 8px rgba(240, 179, 52, 0.35) !important;
  transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1) !important;
  text-decoration: none !important;
  line-height: 1.4 !important;
}

.modern-header-login-btn:hover {
  background-color: #df9f1b !important;
  color: #ffffff !important;
  transform: translateY(-2px) scale(1.03) !important;
  box-shadow: 0 5px 15px rgba(240, 179, 52, 0.45) !important;
}

/* =========================================================
   SEARCH & CART ACTION BUTTONS (THEME YELLOW + WHITE ICON)
   ========================================================= */
.top-nav-item.search-icon,
.top-nav-item.cart-icon,
.top-nav-item.wish-icon {
  position: relative !important;
  display: inline-flex !important;
  align-items: center !important;
  justify-content: center !important;
}

.top-nav-item.search-icon a,
.top-nav-item.cart-icon a,
.top-nav-item.wish-icon a {
  display: inline-flex !important;
  align-items: center !important;
  justify-content: center !important;
  width: 38px !important;
  height: 38px !important;
  min-width: 38px !important;
  min-height: 38px !important;
  max-width: 38px !important;
  max-height: 38px !important;
  border-radius: 50% !important;
  background-color: #f0b334 !important;
  color: #ffffff !important;
  text-decoration: none !important;
  position: relative !important;
  box-shadow: 0 2px 8px rgba(240, 179, 52, 0.35) !important;
  transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1) !important;
  border: none !important;
  padding: 0 !important;
  margin: 0 !important;
  cursor: pointer !important;
  aspect-ratio: 1 / 1 !important;
  box-sizing: border-box !important;
  outline: none !important;
}

.top-nav-item.search-icon a:hover,
.top-nav-item.cart-icon a:hover,
.top-nav-item.wish-icon a:hover,
.top-nav-item.search-icon a:focus,
.top-nav-item.cart-icon a:focus,
.top-nav-item.wish-icon a:focus {
  background-color: #df9f1b !important;
  color: #ffffff !important;
  transform: translateY(-2px) scale(1.05) !important;
  box-shadow: 0 5px 15px rgba(240, 179, 52, 0.5) !important;
}

.top-nav-item.search-icon a:active,
.top-nav-item.cart-icon a:active,
.top-nav-item.wish-icon a:active {
  transform: translateY(0) scale(0.96) !important;
  box-shadow: 0 2px 6px rgba(240, 179, 52, 0.3) !important;
}

.top-nav-item.search-icon a .material-symbols-outlined,
.top-nav-item.cart-icon a .material-symbols-outlined,
.top-nav-item.wish-icon a .material-symbols-outlined,
.top-nav-item .custom-text-white {
  font-size: 20px !important;
  color: #ffffff !important;
  line-height: 1 !important;
  display: block !important;
  transition: transform 0.2s ease !important;
}

.top-nav-item.search-icon a:hover .material-symbols-outlined,
.top-nav-item.cart-icon a:hover .material-symbols-outlined,
.top-nav-item.wish-icon a:hover .material-symbols-outlined {
  transform: scale(1.08);
}

/* Cart & Wishlist Number Badge UI/UX */
.top-nav-item.cart-icon .cart-number,
.top-nav-item.wish-icon .wishlist-number {
  position: absolute !important;
  top: -4px !important;
  right: -5px !important;
  background-color: #0f172a !important;
  color: #ffffff !important;
  font-size: 11px !important;
  font-weight: 700 !important;
  font-family: 'Poppins', system-ui, -apple-system, sans-serif !important;
  min-width: 20px !important;
  height: 20px !important;
  line-height: 16px !important;
  border-radius: 10px !important;
  padding: 0 5px !important;
  display: flex !important;
  align-items: center !important;
  justify-content: center !important;
  border: 2px solid #ffffff !important;
  box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3) !important;
  pointer-events: none !important;
  user-select: none !important;
  z-index: 5 !important;
  animation: cartBadgePop 0.35s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards !important;
}

@keyframes cartBadgePop {
  0% {
    transform: scale(0.4);
    opacity: 0;
  }
  70% {
    transform: scale(1.22);
    opacity: 1;
  }
  100% {
    transform: scale(1);
    opacity: 1;
  }
}

@keyframes cartIconBump {
  0% {
    transform: scale(1);
  }
  25% {
    transform: scale(1.2) translateY(-3px);
  }
  50% {
    transform: scale(0.92) translateY(1px);
  }
  75% {
    transform: scale(1.08) translateY(-1px);
  }
  100% {
    transform: scale(1) translateY(0);
  }
}

.top-nav-item.cart-icon.cart-bump a {
  animation: cartIconBump 0.55s cubic-bezier(0.34, 1.56, 0.64, 1) !important;
}
</style>

<!-- Reliable Global Script Handlers -->
<script>
  function openCustomMobileSidebar() {
    var sidebar = document.getElementById('customMobileSidebar');
    var backdrop = document.getElementById('customSidebarBackdrop');
    if (sidebar) sidebar.classList.add('active');
    if (backdrop) backdrop.classList.add('active');
    document.body.classList.add('sidebar-open');
  }

  function closeCustomMobileSidebar() {
    var sidebar = document.getElementById('customMobileSidebar');
    var backdrop = document.getElementById('customSidebarBackdrop');
    if (sidebar) sidebar.classList.remove('active');
    if (backdrop) backdrop.classList.remove('active');
    document.body.classList.remove('sidebar-open');
  }

  function toggleSidebarServices(e) {
    if (e) {
      e.preventDefault();
      e.stopPropagation();
    }
    var toggle = document.getElementById('sidebarServicesToggle');
    var submenu = document.getElementById('sidebarServicesSubmenu');
    if (toggle && submenu) {
      toggle.classList.toggle('expanded');
      submenu.classList.toggle('open');
    }
  }

  window.openCustomMobileSidebar = openCustomMobileSidebar;
  window.closeCustomMobileSidebar = closeCustomMobileSidebar;
  window.toggleSidebarServices = toggleSidebarServices;

  // Additional keyboard & link event listeners
  document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
      closeCustomMobileSidebar();
    }
  });

  document.addEventListener('click', function(e) {
    var target = e.target.closest('.custom-mobile-sidebar-drawer a:not(.sidebar-dropdown-toggle)');
    if (target) {
      closeCustomMobileSidebar();
    }
  });

  function promptLogoutConfirmation(e) {
    if (e) {
      e.preventDefault();
      e.stopPropagation();
    }
    var modalEl = document.getElementById('logoutConfirmModal');
    if (modalEl && typeof bootstrap !== 'undefined' && bootstrap.Modal) {
      var logoutModal = bootstrap.Modal.getInstance(modalEl) || new bootstrap.Modal(modalEl);
      logoutModal.show();
    } else if (typeof swalConfirm === 'function') {
      swalConfirm('Log Out', 'Are you sure you want to log out?').then(function(result) {
        if (result && (result.isConfirmed || result.value)) {
          submitHeaderLogout();
        }
      });
    } else {
      if (confirm('Are you sure you want to log out?')) {
        submitHeaderLogout();
      }
    }
  }

  function submitHeaderLogout() {
    var form = document.getElementById('header-logout-form');
    if (form) {
      form.submit();
    }
  }

  function initHeaderProfileDropdown() {
    if (typeof initUserProfileDropdown === 'function') {
      initUserProfileDropdown();
    }
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initHeaderProfileDropdown);
  } else {
    initHeaderProfileDropdown();
  }

  window.initHeaderProfileDropdown = initHeaderProfileDropdown;
  window.promptLogoutConfirmation = promptLogoutConfirmation;
  window.submitHeaderLogout = submitHeaderLogout;
</script>

@if (auth()->guard('web')->check())
<!-- Logout Confirmation Modal -->
<div class="modal fade" id="logoutConfirmModal" tabindex="-1" aria-labelledby="logoutConfirmModalLabel" aria-hidden="true" style="z-index: 1065;">
  <div class="modal-dialog modal-dialog-centered" style="max-width: 380px;">
    <div class="modal-content border-0 shadow-lg" style="border-radius: 16px; overflow: hidden; background: #ffffff;">
      <div class="modal-body text-center p-4">
        <div class="mb-3 d-inline-flex align-items-center justify-content-center rounded-circle" style="width: 60px; height: 60px; background-color: #fee2e2; color: #dc2626;">
          <span class="material-symbols-outlined" style="font-size: 32px;">logout</span>
        </div>
        <h5 class="fw-bold text-dark mb-2 font18" id="logoutConfirmModalLabel">Log Out</h5>
        <p class="text-muted mb-4 font14">Are you sure you want to log out?</p>
        <div class="d-flex justify-content-center gap-2">
          <button type="button" class="btn btn-light px-4 py-2 fw-semibold text-secondary" data-bs-dismiss="modal" style="border-radius: 8px; font-size: 14px; min-width: 105px; border: 1px solid #e2e8f0;">Cancel</button>
          <button type="button" class="btn btn-danger px-4 py-2 fw-semibold" id="confirmLogoutModalBtn" onclick="submitHeaderLogout()" style="border-radius: 8px; font-size: 14px; min-width: 105px; background-color: #dc2626; border-color: #dc2626;">Yes</button>
        </div>
      </div>
    </div>
  </div>
</div>
@endif

@livewire('frontend-search')
