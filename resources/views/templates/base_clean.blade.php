<!doctype html>
<html lang="en" dir="ltr">
    <head>

        <!-- META DATA -->
        <meta charset="UTF-8">
        <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="description" content="Trappy">
        <meta name="author" content="Joey Roeters, Niels de Vries, Jurrie Piek, Hessel Doesburg">
        <meta name="keywords" content="trappy">

        <!-- FAVICON -->
{{--        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/images/logo_only.png') }}" />--}}

        <!-- TITLE -->
{{--        <title>Trappy - @yield('title')</title>--}}

        <!-- JQUERY JS -->
        <script src="{{ asset('assets/js/jquery.min.js') }}"></script>

        <!-- BOOTSTRAP CSS -->
        <link id="style" href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" />

        <!-- STYLE CSS -->
        <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" />
        <link href="{{ asset('assets/css/dark-style.css') }}" rel="stylesheet" />
        <link href="{{ asset('assets/css/transparent-style.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/css/skin-modes.css') }}" rel="stylesheet" />

        <!--- FONT-ICONS CSS -->
        <link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet" />

        <!-- COLOR SKIN CSS -->
        <link id="theme" rel="stylesheet" type="text/css" media="all" href="{{ asset('assets/colors/color1.css') }}" />

    </head>

    <body class="app sidebar-mini ltr sidenav-toggled"">
        <!-- GLOABAL LOADER -->
        <div id="global-loader">
            <img src="{{ asset('assets/images/loader.svg') }}" class="loader-img" alt="Loader">
        </div>

        <div class="page">
            <div class="page-main">
                @yield('body')
            </div>
        </div>


        <!-- BOOTSTRAP JS -->
        <script src="{{ asset('assets/plugins/bootstrap/js/popper.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>

        <!-- SHOW PASSWORD JS -->
        <script src="{{ asset('assets/js/show-password.min.js') }}"></script>

        <!-- SPARKLINE JS-->
        <script src="{{ asset('assets/js/jquery.sparkline.min.js') }}"></script>

        <!-- CHART-CIRCLE JS-->
        <script src="{{ asset('assets/js/circle-progress.min.js') }}"></script>

        <!-- C3 CHART JS -->
        <script src="{{ asset('assets/plugins/charts-c3/d3.v5.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/charts-c3/c3-chart.js') }}"></script>

        <!-- INPUT MASK JS-->
        <script src="{{ asset('assets/plugins/input-mask/jquery.mask.min.js') }}"></script>

        <!-- SIDEBAR JS -->
        <script src="{{ asset('assets/plugins/sidebar/sidebar.js') }}"></script>

        <!-- SIDE-MENU JS -->
        <script src="{{ asset('assets/plugins/sidemenu/sidemenu.js') }}"></script>

        <!-- Perfect SCROLLBAR JS-->
        <script src="{{ asset('assets/plugins/p-scroll/perfect-scrollbar.js') }}"></script>
        <script src="{{ asset('assets/plugins/p-scroll/pscroll.js') }}"></script>
        <script src="{{ asset('assets/plugins/p-scroll/pscroll-1.js') }}"></script>

        <!-- Color Theme js -->
        <script src="{{ asset('assets/js/themeColors.js') }}"></script>

        <!-- Sticky js -->
        <script src="{{ asset('assets/js/sticky.js') }}"></script>

        <!-- CUSTOM JS -->
        <script src="{{ asset('assets/js/custom.js') }}"></script>

    </body>
</html>
