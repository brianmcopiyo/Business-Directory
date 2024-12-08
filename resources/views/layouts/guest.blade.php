<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }} | @yield('title')</title>

  <!-- Styles and Scripts -->
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

    body {
      font-feature-settings: "cv03", "cv04", "cv11";
    }
  </style>

</head>

<body class=" d-flex flex-column">
  <div class="page page-center">
    <div class="container container-tight py-4">
      <div class="text-center mb-4">
        <a href="." class="navbar-brand navbar-brand-autodark">
          <img src="{{ asset('images/logo.png') }}" width="110" height="32" alt="Tabler" class="navbar-brand-image">
        </a>
      </div>
      @yield('content')
    </div>
  </div>
  <script src="./dist/js/tabler.min.js?1692870487" defer></script>
  <script src="./dist/js/demo.min.js?1692870487" defer></script>
</body>

</html>
