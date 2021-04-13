<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <!-- Standard Meta -->
  <meta charset="utf-8">
  <meta name="description" content="Premium HTML5 Template by Indonez">
  <meta name="keywords" content="blockit, uikit3, indonez, handlebars, scss, vanilla javascript">
  <meta name="author" content="Indonez">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="theme-color" content="#313131" />
  <!-- Site Properties -->
  <title>Nairaforex - Pro Traders</title>
  <!-- Critical preload -->
  <link rel="preload" href="{{ asset('js/vendors/uikit.min.js') }}" as="script">
  <link rel="preload" href="{{ asset('css/vendors/uikit.min.css') }}" as="style">
  <link rel="preload" href="{{ asset('css/style.css') }}" as="style">
  <!-- Icon preload -->
  <link rel="preload" href="{{ asset('fonts/fa-brands-400.woff2') }}" as="font" type="font/woff2" crossorigin>
  <link rel="preload" href="{{ asset('fonts/fa-solid-900.woff2') }}" as="font" type="font/woff2" crossorigin>
  <!-- Font preload -->
  <link rel="preload" href="{{ asset('fonts/rubik-v9-latin-500.woff2') }}" as="font" type="font/woff2" crossorigin>
  <link rel="preload" href="{{ asset('fonts/rubik-v9-latin-300.woff2') }}" as="font" type="font/woff2" crossorigin>
  <link rel="preload" href="{{ asset('fonts/rubik-v9-latin-regular.woff2') }}" as="font" type="font/woff2" crossorigin>
  <!-- Favicon and apple icon -->
  <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
  <link rel="apple-touch-icon-precomposed" href="{{ asset('apple-touch-icon.png') }}">
  <!-- Stylesheet -->
  <link rel="stylesheet" href="{{ asset('css/vendors/uikit.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('css/nairaforex.css') }}">
  @stack('styles')
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
    <div class="uk-section uk-padding-remove-vertical in-header-inner uk-background-cover uk-background-top-center"
      style="background-image: url({{ asset('img/in-wave-background-1.png') }});">
      <!-- module navigation begin -->
      @include('partials.nav')
      <!-- module navigation end -->

      <div class="uk-container">
        <div class="uk-grid">

          <!-- module breadcrumb begin -->
          <!-- <div class="uk-width-1-1 in-breadcrumb">
            <ul class="uk-breadcrumb uk-text-uppercase">
              <li><a href="index.html">Home</a></li>
            </ul>
          </div> -->
          <!-- module breadcrumb end -->
        </div>
      </div>

    </div>
    <!-- header content end -->
  </header>
  <main>
    @yield('content')
  </main>

  @include('partials.footer')
  <!-- Javascript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"
    integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg=="
    crossorigin="anonymous"></script>
  <script src="{{ asset('js/vendors/uikit.min.js') }}"></script>
  <script src="{{ asset('js/vendors/uikit-icon.min.js') }}"></script>
  <script src="{{ asset('js/vendors/indonez.min.js') }}"></script>
  <script src="{{ asset('js/config-theme.js') }}"></script>
  <!-- SweetAlert2 -->
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <script type="text/javascript">

  const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
  });

  @if($errors)
    @foreach($errors->all() as $error)
    Swal.fire(
        'Ooops!!!',
        '{{ $error }}',
        'error',
    );
    @endforeach
  @endif

  @if (Session()->has('error'))
  Toast.fire({
      icon: 'error',
      title: '{{ session('error') }}'
  })
  @elseif (Session()->has('success'))
  Swal.fire(
      '<i class="fa fa-thumbs-up"></i> Great!',
      '{{ session('success') }}',
      'success',
  );
  @elseif (Session()->has('info'))
  Swal.fire(
      'Note',
      '{{ session('info') }}',
      'info',
  );
  @elseif (Session()->has('warning'))
  Toast.fire({
      icon: 'warning',
      title: '{{ session('warning') }}'
  })
  @endif

  @if (session('status') == 'two-factor-authentication-enabled')
  Toast.fire({
      icon: 'success',
      title: 'Two factor authentication has been enabled.'
  })
  @endif

</script>

  @stack('scripts')
</body>

</html>