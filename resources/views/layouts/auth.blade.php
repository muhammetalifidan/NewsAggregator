<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/png" href="{{ asset('assets/images/favicon.png') }}">
    <title>News Aggregator | Sign In</title>

    <!-- Global stylesheets -->
    <link href="{{ asset('assets/fonts/inter/inter.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/icons/phosphor/styles.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/ltr/all.min.css') }}" id="stylesheet" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->

    @stack('css')

    <!-- Core JS files -->
    <script src="{{ asset('assets/demo/demo_configurator.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <!-- /core JS files -->

    <!-- Theme JS files -->
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <!-- /theme JS files -->

    @stack('js')

</head>

<body>
    <!-- Main navbar -->
    <div class="navbar navbar-dark navbar-static py-2">
        <div class="container-fluid">
            <div class="navbar-brand">
                <a href="{{ Auth::guard('admin')->check() ? route('admin.dashboard.index') : route('admin.login') }}"
                    class="d-inline-flex align-items-center">
                    <img src="{{ asset('assets/images/text-logo-white.png') }}" alt=""
                        style="width: 100px; height: auto;">
                </a>
            </div>
        </div>
    </div>
    <!-- /main navbar -->

    <!-- Page content -->
    <div class="page-content">
        <div class="content-wrapper">

            <!-- Inner content -->
            <div class="content-inner">
                <!-- Main content -->
                @yield('content')
                <!-- /main content -->

            </div>
            <!-- /page content -->

            <!-- Footer -->
            <div class="navbar navbar-sm navbar-footer border-top">
                <div class="container-fluid">
                    <span>&copy; 2024 <a href="https://www.muhammetalifidan.com.tr">Muhammet Ali Fidan</a></span>
                </div>
            </div>
            <!-- /footer -->

        </div>
        <!-- /inner content -->
    </div>
</body>

</html>
