<header class="navbar navbar-expand-md d-print-none">
  <div class="mx-5 w-100 d-flex justify-content-between">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu" aria-controls="sidebar-menu" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
      @if ($layout == "horizontal")
      <a href="{{ route('home') }}">
        <img src="{{ asset('images/logo.png') }}" width="110" height="32" alt="{{config('app.name')}}" class="navbar-brand-image">
      </a>
      @endif
    </h1>
    <div class="navbar-nav flex-row order-md-last">
      <div class="nav-item d-none d-md-flex me-3">
        <div class="btn-list">
        </div>
      </div>
      <div class="d-flex d-md-flex mx-2">
        @if($theme == "dark")
        <a href="{{ route('theme', ['theme' => 'light']) }}" style="font-size: 20px;" class="nav-link px-0 ">
          <i class="ti ti-sun"></i>
        </a>
        @else
        <a href="{{ route('theme', ['theme' => 'dark']) }}" style="font-size: 18px;" class="nav-link px-0 ">
          <i class="ti ti-moon"></i>
        </a>
        @endif
      </div>
      <div class="nav-item dropdown">
        <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
          <span class="avatar avatar-sm" style="background-image: url(<?php echo asset('images/user.png'); ?>)"></span>
          <div class="d-none d-xl-block ps-2">
            <div>
              {{ $auth->name }}
            </div>
            <div class="mt-1 small text-secondary">{{ $auth->status  }}</div>
          </div>
        </a>
        <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
          <a href="{{ route('reset') }}" class="dropdown-item">Reset Password</a>
          <a href="{{ route('logout') }}" class="dropdown-item">Logout</a>
        </div>
      </div>
    </div>
  </div>
</header>
