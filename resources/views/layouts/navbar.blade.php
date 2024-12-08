<ul class="navbar-nav {{ $layout ? 'vertical' : 'pt-lg-3' }}">
  @foreach ($menuData as $menu)

  @if(in_array(auth()->user()->type, $menu['type']))

  @if(isset($menu['submenu']))
  @php

  $isActive = false;

  if (isset($menu['submenu'])) {
  foreach ($menu['submenu'] as $item) {
  if (Route::currentRouteName() === $item['route']) {
  $isActive = true;
  break;
  }
  }
  }
  @endphp

  <li class="nav-item {{ $isActive ? 'active' : '' }} dropdown">
    <a class="nav-link dropdown-toggle" href="#navbar-layout" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false">
      <span class="nav-link-icon d-md-none d-lg-inline-block">
        <i class="{{ $menu['icon'] }}" style="font-size: 20px; opacity: 0.8;"></i>
      </span>
      <span class="nav-link-title">
        {{ $menu['name'] }}
      </span>
    </a>
    <div class="dropdown-menu">
      @foreach ($menu['submenu'] as $sub)
      <div class="dropdown-menu-columns">
        <a class="dropdown-item {{ Route::currentRouteName() === $sub['route'] ? 'active' : '' }}" href="{{ route( $sub['route'] ) }}">
          {{ $sub['name'] }}
        </a>
      </div>
      @endforeach
    </div>
  </li>
  @else
  <li class="nav-item {{ Route::currentRouteName() === $menu['route'] ? 'active' : '' }}">
    <a class="nav-link" href="{{ route($menu['route']) }}">
      <span class="nav-link-icon d-md-none d-lg-inline-block">
        <i class="{{ $menu['icon'] }}" style="font-size: 20px; opacity: 0.8;"></i>
      </span>
      <span class="nav-link-title">
        {{ $menu['name'] }}
      </span>
    </a>
  </li>
  @endif

  @endif

  @endforeach
</ul>
