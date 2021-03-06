<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <!-- Standard Meta -->
  <meta name="description"
    content="Nairaforex enable users to assign the
          best remote professional forex traders to their capital and earn reasonable returns within a specific period.">
  <meta name="keywords"
    content="nairaforex, forex, investment, trading, copy-trading, professional-traders, earn-from-forex, returns, cremir, cremir.org">
  <meta name="author" content="cremirdevio">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="theme-color" content="#313131" />
  <!-- Site Properties -->
  <title>Nairaforex - Pro Traders</title>
  <!-- Critical preload -->
  <link rel="preload" href="js/vendors/uikit.min.js" as="script">
  <link rel="preload" href="css/vendors/uikit.min.css" as="style">
  <link rel="preload" href="css/style.css" as="style">
  <!-- Icon preload -->
  <link rel="preload" href="fonts/fa-brands-400.woff2" as="font" type="font/woff2" crossorigin>
  <link rel="preload" href="fonts/fa-solid-900.woff2" as="font" type="font/woff2" crossorigin>
  <!-- Font preload -->
  <link rel="preload" href="fonts/rubik-v9-latin-500.woff2" as="font" type="font/woff2" crossorigin>
  <link rel="preload" href="fonts/rubik-v9-latin-300.woff2" as="font" type="font/woff2" crossorigin>
  <link rel="preload" href="fonts/rubik-v9-latin-regular.woff2" as="font" type="font/woff2" crossorigin>
  <!-- Favicon and apple icon -->
  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
  <link rel="apple-touch-icon-precomposed" href="apple-touch-icon.png">
  <!-- Stylesheet -->
  <link rel="stylesheet" type="text/css" href="{{ asset('slick/slick.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('slick/slick-theme.css') }}">

  <link rel="stylesheet" href="css/vendors/uikit.min.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/nairaforex.css">
  <script src="https://use.fontawesome.com/e23bb58ed8.js"></script>
</head>

<body>
  <!-- preloader begin -->
  <div class="in-loader">
    <div></div>
    <div></div>
    <div></div>
  </div>
  <!-- preloader end -->
  <header>
    <!-- header content begin -->
    <div class="uk-section uk-padding-remove-vertical in-header-home ">
      <!-- module navigation begin -->
      @include('partials.nav')

    </div>
    <!-- header content end -->
  </header>
  <main>
    @yield('content')
  </main>

  @include('partials.footer')
  <!-- Javascript -->
  <script src="js/vendors/uikit.min.js"></script>
  <script src="js/vendors/indonez.min.js"></script>
  <script src="js/config-theme.js"></script>
  <script src="{{ asset('js/jquery-3.5.1.min.js') }}"></script>
  <script src="{{ asset('slick/slick.js') }}"></script>
  @stack('scripts')
</body>

</html>