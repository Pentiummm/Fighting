<!doctype html>
<html lang="{{ config('app.locale') }}" class="no-focus">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

        <title>Codebase - Bootstrap 4 Admin Template &amp; UI Framework</title>

        <meta name="description" content="Codebase - Bootstrap 4 Admin Template &amp; UI Framework created by pixelcave and published on Themeforest">
        <meta name="author" content="pixelcave">
        <meta name="robots" content="noindex, nofollow">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Icons -->
        <link rel="shortcut icon" href="{{ asset('media/favicons/favicon.png') }}">
        <link rel="icon" sizes="192x192" type="image/png" href="{{ asset('media/favicons/favicon-192x192.png') }}">
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('media/favicons/apple-touch-icon-180x180.png') }}">

        <!-- Fonts and Styles -->
        @yield('css_before')
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:300,400,400i,600,700">
        <link rel="stylesheet" id="css-main" href="{{ mix('/css/codebase.css') }}">

        <!-- You can include a specific file from public/css/themes/ folder to alter the default color theme of the template. eg: -->
        <!-- <link rel="stylesheet" id="css-theme" href="{{ mix('/css/themes/corporate.css') }}"> -->
        @yield('css_after')

        <!-- Scripts -->
        <script>window.Laravel = {!! json_encode(['csrfToken' => csrf_token(),]) !!};</script>
    </head>
    <body>
        <!-- Page Container -->
        <div id="page-container" class="sidebar-o enable-page-overlay side-scroll page-header-modern main-content-boxed">
            <!-- Side Overlay-->
            <aside id="side-overlay">
                <!-- Side Header -->
                <div class="content-header content-header-fullrow">
                    <div class="content-header-section align-parent">
                        <!-- Close Side Overlay -->
                        <button type="button" class="btn btn-circle btn-dual-secondary align-v-r" data-toggle="layout" data-action="side_overlay_close">
                            <i class="fa fa-times text-danger"></i>
                        </button>
                        <!-- END Close Side Overlay -->

                        <!-- User Info -->
                        <div class="content-header-item">
                            <a class="img-link mr-5" href="javascript:void(0)">
                                <img class="img-avatar img-avatar32" src="{{ asset('media/avatars/avatar15.jpg') }}" alt="">
                            </a>
                            <a class="align-middle link-effect text-primary-dark font-w600" href="javascript:void(0)">John Smith</a>
                        </div>
                        <!-- END User Info -->
                    </div>
                </div>
                <!-- END Side Header -->

                <!-- Side Content -->
                <div class="content-side">
                    <p>
                        Content..
                    </p>
                </div>
                <!-- END Side Content -->
            </aside>
            <!-- END Side Overlay -->

            <!-- Sidebar -->
            @include('layouts.adminLayout.admin_sidebar')
            <!-- END Sidebar -->

            <!-- Header -->
            @include('layouts.adminLayout.admin_header')
            <!-- END Header -->

            <!-- Main Container -->
            <main id="main-container">
                @yield('content')
            </main>
            <!-- END Main Container -->

            @include('layouts.adminLayout.admin_footer')

        </div>
        <!-- END Page Container -->

        <!-- Codebase Core JS -->
        <script src="{{ mix('js/codebase.app.js') }}"></script>

        <!-- Laravel Scaffolding JS -->
        <script src="{{ mix('js/laravel.app.js') }}"></script>

        <!-- Page JS Plugins -->
        <script src="{{ asset('js/plugins/jquery-validation/jquery.validate.js') }}"></script>

        <script src="{{ asset('js/pages/forms_validation.min.js') }}"></script>
        
        <script src="{{ asset('js/main.js') }}"></script>

        @yield('js_after')
    </body>
</html>
