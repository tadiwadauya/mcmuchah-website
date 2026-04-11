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
           BASE HEADER / LOGO
        ---------------------------- */
        .header .logo {
            position: relative;
            display: inline-flex;
            align-items: center;
            line-height: 1;
            z-index: 20;
        }

        .header .logo img {
            display: block;
            width: auto;
            object-fit: contain;
        }

        .header .logo .show-sticky {
            display: none;
        }

        .header .logo .always-logo {
            display: inline-block;
        }

        .header .header-wrapper {
            display: flex;
            align-items: center;
        }

        .header .header-inner-wrapper {
            display: flex;
            align-items: center;
        }

        /* ---------------------------
           HOME NAVBAR
        ---------------------------- */
        .home-navbar .header-wrapper {
            min-height: 90px;
            display: flex;
            align-items: center;
        }

        .home-navbar .logo {
            height: 90px;
            display: flex;
            align-items: center;
        }

        .home-navbar .logo img {
            max-height: 58px;
        }

        .home-navbar .header-inner-wrapper {
            min-height: 90px;
            display: flex;
            align-items: center;
        }

        .home-navbar .navigation-menu.desktop > .menu-item > a,
        .home-navbar .navigation-menu.desktop > .menu-item > a:visited {
            color: #111827;
            text-decoration: none;
        }

        .home-navbar.is-fixed .header-wrapper,
        .home-navbar.active .header-wrapper,
        .home-navbar.sticky .header-wrapper {
            min-height: 90px;
            display: flex;
            align-items: center;
            padding-top: 0 !important;
            padding-bottom: 0 !important;
        }

        .home-navbar.is-fixed .logo,
        .home-navbar.active .logo,
        .home-navbar.sticky .logo {
            height: 90px;
            display: flex;
            align-items: center;
            margin-top: 0 !important;
            margin-bottom: 0 !important;
            top: 0 !important;
            transform: none !important;
        }

        .home-navbar.is-fixed .logo img,
        .home-navbar.active .logo img,
        .home-navbar.sticky .logo img {
            margin-top: 0 !important;
            margin-bottom: 0 !important;
            top: 0 !important;
            transform: none !important;
            max-height: 58px;
        }

        .home-navbar.is-fixed .header-inner-wrapper,
        .home-navbar.active .header-inner-wrapper,
        .home-navbar.sticky .header-inner-wrapper {
            min-height: 90px;
            display: flex;
            align-items: center;
        }

        .home-navbar.is-fixed .logo .hide-sticky,
        .home-navbar.active .logo .hide-sticky,
        .home-navbar.sticky .logo .hide-sticky {
            display: none;
        }

        .home-navbar.is-fixed .logo .show-sticky,
        .home-navbar.active .logo .show-sticky,
        .home-navbar.sticky .logo .show-sticky {
            display: inline-block;
        }

        .home-navbar.is-fixed .navigation-menu.desktop > .menu-item > a,
        .home-navbar.active .navigation-menu.desktop > .menu-item > a,
        .home-navbar.sticky .navigation-menu.desktop > .menu-item > a {
            color: #ffffff !important;
        }

        /* ---------------------------
           INNER NAVBAR
        ---------------------------- */
        .inner-navbar .header-wrapper {
            min-height: 90px;
            display: flex;
            align-items: center;
        }

        .inner-navbar .logo {
            height: 90px;
            display: flex;
            align-items: center;
        }

        .inner-navbar .logo img {
            max-height: 58px;
        }

        .inner-navbar .header-inner-wrapper {
            min-height: 90px;
            display: flex;
            align-items: center;
        }

        .inner-navbar .navigation-menu.desktop > .menu-item > a,
        .inner-navbar .navigation-menu.desktop > .menu-item > a:visited {
            color: #ffffff !important;
            text-decoration: none;
        }

        .inner-navbar .services-dropdown > a .icon svg,
        .home-navbar .services-dropdown > a .icon svg {
            width: 12px;
            height: 12px;
            fill: currentColor;
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
           PAGE / CARD / FORM STYLES
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
            transition: all 0.2s ease;
        }

        .btn-success {
            background: #0f766e;
            color: #ffffff;
        }

        .btn-success:hover {
            background: #0b5f59;
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
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
            background: #ffffff;
        }

        .form-control:focus {
            outline: none;
            border-color: #0f766e;
            box-shadow: 0 0 0 3px rgba(15, 118, 110, 0.12);
        }

        textarea.form-control {
            min-height: 130px;
            resize: vertical;
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

        /* ---------------------------
           MOBILE
        ---------------------------- */
        @media (max-width: 991px) {
            .header .navigation-menu.desktop .menu-item-has-children > .sub-menu {
                display: none !important;
            }

            .home-navbar .header-wrapper,
            .inner-navbar .header-wrapper {
                min-height: 78px;
            }

            .home-navbar .logo,
            .inner-navbar .logo {
                height: 78px;
            }

            .home-navbar .header-inner-wrapper,
            .inner-navbar .header-inner-wrapper {
                min-height: 78px;
            }

            .home-navbar .logo img,
            .inner-navbar .logo img {
                max-height: 50px;
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

        document.addEventListener('DOMContentLoaded', function () {
            const header = document.querySelector('.home-navbar');

            if (!header) {
                return;
            }

            const toggleHeaderState = function () {
                if (window.scrollY > 40) {
                    header.classList.add('is-fixed');
                } else {
                    header.classList.remove('is-fixed');
                }
            };

            toggleHeaderState();
            window.addEventListener('scroll', toggleHeaderState);
        });
    </script>

    @stack('scripts')
</body>
</html>