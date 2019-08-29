<!DOCTYPE html>
<html lang="en">
  <head>
    <base href="./admin">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="CoreUI - Laravel">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>EGSI Control</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Includes para datatables -->
    @yield('scoped_css_imports')


  </head>
  <body class="app header-fixed sidebar-fixed aside-menu-fixed sidebar-lg-show">

    @include('admin.partials.header')
    <div class="app-body">
        @include('admin.partials.sidebar')
        <main class="main">
            @include('admin.partials.breadcrumb')
            <div class="container-fluid">
                <div class="animated fadeIn">
                    @yield('content')
                </div>
            </div>
        </main>
        @include('admin.partials.aside-menu')
    </div>
    @include('admin.partials.footer')

     <!-- Scripts -->

    <script src="{{ asset('js/manifest.js') }}"></script>
    <script src="{{ asset('js/vendor.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>

     <!-- Includes propios de las páginas -->
     @yield('scoped_js_imports')

    <!-- Include the script only on homepage -->
    @if(Request::path() === 'admin')
        <script src="js/main.js"></script>
    @endif

    @yield('custom_scripts')
  </body>
</html>
