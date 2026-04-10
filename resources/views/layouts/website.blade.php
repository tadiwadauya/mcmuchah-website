<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? ($setting->seo_title ?: $setting->site_name ?: 'Website') }}</title>
    <meta name="description" content="{{ $metaDescription ?? ($setting->seo_description ?: 'Professional branding, printing, and marketing solutions.') }}">

    <link
        rel="icon"
        href="{{ $setting->favicon_url ?? asset('inc/assets/images/favicon-1.png') }}"
        sizes="32x32"
    >

    <link rel="stylesheet" href="{{ asset('inc/assets/dist/style.css') }}">
    <link rel="stylesheet" href="{{ asset('inc/assets/dist/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
    <script src="{{ asset('inc/assets/dist/app.js') }}" defer></script>

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

    <script>
        new WOW().init();
    </script>

    @stack('scripts')
</body>
</html>