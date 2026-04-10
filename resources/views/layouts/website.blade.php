<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? ($setting->seo_title ?: $setting->site_name ?: 'McMupah') }}</title>
    <meta name="description" content="{{ $metaDescription ?? ($setting->seo_description ?: 'Professional branding, printing, and marketing solutions.') }}">

    <link rel="apple-touch-icon" href="{{ $setting->favicon_url ?? asset('inc/assets/images/favicon-1.png') }}">
    <link rel="icon" href="{{ $setting->favicon_url ?? asset('inc/assets/images/favicon-1.png') }}" sizes="192x192">
    <link rel="icon" href="{{ $setting->favicon_url ?? asset('inc/assets/images/favicon-1.png') }}" sizes="32x32">

    <link rel="stylesheet" href="{{ asset('inc/assets/dist/style.css') }}">
    <link rel="stylesheet" href="{{ asset('inc/assets/dist/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
    <script src="{{ asset('inc/assets/dist/app.js') }}" defer></script>

    <style>
        body {
            overflow-x: hidden;
        }

        /* ---------------------------
           LOGO SWITCH
        ---------------------------- */
        .header .logo {
            position: relative;
            display: inline-flex;
            align-items: center;
        }

        .header .logo img {
            max-height: 60px;
            width: auto;
        }

        .header .logo .show-sticky {
            display: none;
        }

        .header.home-4-header .logo .hide-sticky {
            display: inline-block;
        }

        .header.home-4-header.is-fixed .logo .hide-sticky,
        .header.home-4-header.active .logo .hide-sticky,
        .header.home-4-header.sticky .logo .hide-sticky {
            display: none;
        }

        .header.home-4-header.is-fixed .logo .show-sticky,
        .header.home-4-header.active .logo .show-sticky,
        .header.home-4-header.sticky .logo .show-sticky {
            display: inline-block;
        }

        /* ---------------------------
           DESKTOP NAV
        ---------------------------- */
        .header .navigation-menu.desktop > .menu-item {
            position: relative;
            list-style: none;
        }

        .header .navigation-menu.desktop > .menu-item > a {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .header .navigation-menu.desktop > .menu-item > a,
        .header .navigation-menu.desktop > .menu-item > a:visited {
            color: #111827;
            text-decoration: none;
        }

        .header.home-4-header.is-fixed .navigation-menu.desktop > .menu-item > a,
        .header.home-4-header.active .navigation-menu.desktop > .menu-item > a,
        .header.home-4-header.sticky .navigation-menu.desktop > .menu-item > a {
            color: #ffffff;
        }

        .header .navigation-menu.desktop .services-dropdown > a .icon svg {
            width: 12px;
            height: 12px;
            fill: currentColor;
        }

        /* ---------------------------
           DROPDOWN
        ---------------------------- */
        .header .navigation-menu.desktop .menu-item-has-children > .sub-menu {
            position: absolute;
            top: calc(100% + 10px);
            left: 0;
            min-width: 300px;
            background: #ffffff;
            box-shadow: 0 18px 45px rgba(0, 0, 0, 0.14);
            border-radius: 14px;
            padding: 10px 0;
            margin: 0;
            list-style: none;
            opacity: 0;
            visibility: hidden;
            transform: translateY(10px);
            transition: all 0.25s ease;
            z-index: 9999;
            display: block;
        }

        .header .navigation-menu.desktop .menu-item-has-children:hover > .sub-menu {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .header .navigation-menu.desktop .sub-menu .menu-item {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .header .navigation-menu.desktop .sub-menu .menu-item a,
        .header .navigation-menu.desktop .sub-menu .menu-item a:visited {
            display: block;
            width: 100%;
            padding: 12px 20px;
            color: #111827 !important;
            background: transparent;
            text-decoration: none;
            font-size: 15px;
            font-weight: 500;
            line-height: 1.45;
            transition: all 0.2s ease;
        }

        .header .navigation-menu.desktop .sub-menu .menu-item a:hover {
            background: #f4f7fb;
            color: #0f766e !important;
        }

        /* ---------------------------
           BASIC FORM STYLES
        ---------------------------- */
        .card {
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 6px 24px rgba(0, 0, 0, 0.08);
            padding: 28px;
        }

        .btn {
            display: inline-block;
            padding: 12px 18px;
            border: none;
            border-radius: 10px;
            text-decoration: none;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
        }

        .btn-success {
            background: #0f766e;
            color: #ffffff;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-label {
            display: block;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .form-control {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid #d1d5db;
            border-radius: 10px;
            font-size: 14px;
            box-sizing: border-box;
        }

        textarea.form-control {
            min-height: 130px;
        }

        .grid-2 {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 18px;
        }

        .alert {
            padding: 14px 16px;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .alert-success {
            background: #dcfce7;
            color: #166534;
        }

        @media (max-width: 991px) {
            .header .navigation-menu.desktop .menu-item-has-children > .sub-menu {
                display: none !important;
            }

            .grid-2 {
                grid-template-columns: 1fr;
            }
        }
    </style>

    @stack('styles')
</head>
<body>
    <div class="preloader">
        <div class="preloader-icon">
            <div class="preloader-icon-container">
                <span class="animated-preloader"></span>
            </div>
        </div>
    </div>

    @include('partials.website-header')

    @yield('content')

    @include('partials.website-footer')

    <div class="back-to-top">
        <div class="back-to-top-inner">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
                <path d="M363.9 330.7c-6.271 6.918-16.39 6.783-22.62 1.188L192 197.5l-149.3 134.4c-6.594 5.877-16.69 5.361-22.62-1.188C14.2 324.1 14.73 314 21.29 308.1l159.1-144c6.125-5.469 15.31-5.469 21.44 0l159.1 144C369.3 314 369.8 324.1 363.9 330.7z"></path>
            </svg>
        </div>
    </div>

    <script>
        new WOW().init();
    </script>

    @stack('scripts')
</body>
</html>