<?php

use App\Models\FacilityUser;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

$user = User::where('id', Auth::user()->id)->first();

$auth = null;

if ($user->type == "Admin") {
  $auth = $user->admin;
}

$settings = $user->settings;
$layout = $settings->layout;
$theme = $settings->theme;

$path = resource_path('menu/structure.json');

if (File::exists($path)) {
  $jsonData = File::get($path);
  $menuData = json_decode($jsonData, true);
} else {
  $menuData = [];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }} | @yield('title')</title>

  <!--Styles and Scripts -->
  <link href="{{ asset('dist/css/tabler.min.css') }}?1692870487" rel="stylesheet" />
  <link href="{{ asset('dist/css/tabler-flags.min.css') }}?1692870487" rel="stylesheet" />
  <link href="{{ asset('dist/css/tabler-payments.min.css') }}?1692870487" rel="stylesheet" />
  <link href="{{ asset('dist/css/tabler-vendors.min.css') }}?1692870487" rel="stylesheet" />
  <link href="{{ asset('dist/css/demo.min.css') }}?1692870487" rel="stylesheet" />

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css" />
  <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">
  <link rel="shortcut icon" href="{{ asset('images/logo.png') }}" type="image/x-icon">

  <style>
    @import url('https://rsms.me/inter/inter.css');

    :root {
      --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
    }

    html {
      margin-right: 0 !important;
      padding-right: 0 !important;
    }

    body {
      font-feature-settings: "cv03", "cv04", "cv11";
      margin-right: 0 !important;
      padding-right: 0 !important;
    }
  </style>
</head>

<body data-bs-theme="{{ $theme ?? 'light' }}">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <!-- Libs JS -->
  <script src="{{ asset('dist/libs/apexcharts/dist/apexcharts.min.js') }}?1692870487" defer></script>
  <script src="{{ asset('dist/libs/jsvectormap/dist/js/jsvectormap.min.js') }}?1692870487" defer></script>
  <script src="{{ asset('dist/libs/jsvectormap/dist/maps/world.js') }}?1692870487" defer></script>
  <script src="{{ asset('dist/libs/jsvectormap/dist/maps/world-merc.js') }}?1692870487" defer></script>
  <!-- Tabler Core -->
  <script src="{{ asset('dist/js/tabler.min.js') }}?1692870487" defer></script>
  <script src="{{ asset('dist/js/demo.min.js') }}?1692870487" defer></script>

  <script src="{{ asset('dist/js/graphs.js') }}"></script>

  <!--Form Elements-->
  <script src="{{ asset('dist/libs/nouislider/dist/nouislider.min.js') }}?1692870487" defer></script>
  <script src="{{ asset('dist/libs/litepicker/dist/litepicker.js') }}?1692870487" defer></script>
  <script src="{{ asset('dist/libs/tom-select/dist/js/tom-select.base.min.js') }}?1692870487" defer></script>
  <div class="page">

    @if(auth()->check() )
    <!-- Navigation -->
    @include('layouts.'.$layout)

    <!-- Page Content -->
    @if($layout == "vertical")
    @include('layouts.header')
    @endif

    @yield('content')
    @endif

  </div>

  @include('layouts.footer')
  @yield('script')
</body>

</html>
