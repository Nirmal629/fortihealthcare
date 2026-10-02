<!-- ========== Left Sidebar Start ========== -->
<div class="leftside-menu">

  <!-- Logo -->
  <a href="{{ route('admin.dashboard') }}" class="logo logo-light">
    <span class="logo-lg">
      <img src="{{ siteLogo() }}" alt="logo">
    </span>
    <span class="logo-sm">
      <img src="{{ asset('/public/backend/assetss/images/logo-dark-sm.png') }}" alt="small logo">
    </span>
  </a>

  <a href="{{ route('admin.dashboard') }}" class="logo logo-dark">
    <span class="logo-lg">
      <img src="{{ siteLogo() }}" alt="dark logo">
    </span>
    <span class="logo-sm">
      <img src="{{ asset('/public/backend/assetss/images/logo-dark-sm.png') }}" alt="small logo">
    </span>
  </a>

  <!-- Sidebar -->
  <div class="h-100" id="leftside-menu-container" data-simplebar>

    <!-- User -->
    <div class="leftbar-user">
      <a href="javascript:">
        <img src="{{ asset('/public/backend/assetss/images/users/avatar-1.jpg') }}" class="rounded-circle shadow-sm"
          height="42">
        <span class="leftbar-user-name mt-2">Dominic Keller</span>
      </a>
    </div>

    <ul class="side-nav">

      <!-- Dashboard -->
      <li class="side-nav-item">
        <a href="{{ route('admin.dashboard') }}"
          class="side-nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
          <i class="ri-dashboard-line"></i>
          <span>Dashboard</span>
        </a>
      </li>

      {{-- Dynamic Menus --}}
      @if (isset($menus) && is_array($menus))
        @foreach ($menus as $menu)
          @php
            $currentRoute = request()->route()->getName();
            $isParentActive = false;

            if (!empty($menu['submodules'])) {
                foreach ($menu['submodules'] as $submodule) {
                    if (\Illuminate\Support\Str::startsWith($currentRoute, $submodule['path'])) {
                        $isParentActive = true;
                        break;
                    }
                }
            }
          @endphp

          <li class="side-nav-item {{ $isParentActive ? 'menuitem-active' : '' }}">

            <!-- Parent Menu -->
            <a data-bs-toggle="collapse" href="#sidebar{{ $menu['id'] }}"
              class="side-nav-link {{ $isParentActive ? 'active' : '' }}"
              aria-expanded="{{ $isParentActive ? 'true' : 'false' }}">

              <i class="{{ $menu['icon'] }}"></i>
              <span>{{ $menu['name'] }}</span>

              @if (!empty($menu['submodules']))
                <span class="menu-arrow"></span>
              @endif
            </a>

            <!-- Submenus -->
            @if (!empty($menu['submodules']))
              <div class="collapse {{ $isParentActive ? 'show' : '' }}" id="sidebar{{ $menu['id'] }}">

                <ul class="side-nav-second-level">

                  @foreach ($menu['submodules'] as $submodule)
                    @php
                      $isActive = \Illuminate\Support\Str::startsWith($currentRoute, $submodule['path']);
                    @endphp

                    <li>
                      @routeExists($submodule['path'])
                        <a href="{{ route($submodule['path']) }}" class="{{ $isActive ? 'active' : '' }}">
                          {{ $submodule['name'] }}
                        </a>
                      @else
                        <a href="{{ route('coming-soon') }}">
                          {{ $submodule['name'] }}
                        </a>
                      @endrouteExists
                    </li>
                  @endforeach

                </ul>
              </div>
            @endif

          </li>
        @endforeach
      @endif

    </ul>
  </div>

  <div class="clearfix"></div>
</div>
