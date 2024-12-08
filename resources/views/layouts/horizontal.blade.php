@include('layouts.header')

<header class="navbar-expand-md">
  <div class="collapse navbar-collapse" id="navbar-menu">
    <div class="navbar">
      <div class="mx-5 w-100 d-flex justify-content-between">
        @include('layouts.navbar')
        <div class="mx-2">
          @yield('search')
        </div>
      </div>
    </div>
  </div>
</header>
