@extends('layouts.website')

@section('content')
    @if(session('success'))
        <div class="container" style="margin-top: 20px;">
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        </div>
    @endif

    <section class="hero-4-section">
        <div class="img-block">
            <img
                src="{{ $blocks['home_hero_image']->image_url ?? asset('inc/assets/images/hero-image-4.png') }}"
                alt="Hero"
                class="hero-4-img"
            />
        </div>

        <div class="hero-text-block">
            <div class="container">
                <div class="headings">
                    <h5 class="sub-heading">
                        {{ $blocks['home_hero_subheading']->title ?? 'Welcome to McMupah Marketing.' }}
                    </h5>

                    <h3 class="hero--heading">
                        {{ $blocks['home_hero_heading']->title ?? 'Excellence Delivered.' }}
                    </h3>

                    <div class="hero-btns">
                        <a class="button" href="{{ route('about') }}">
                            <div class="button-inner">
                                <span>About Us</span>
                                <svg
                                    class="icon"
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 448 512"
                                >
                                    <path
                                        d="M438.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.8 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l306.7 0L233.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z"
                                    />
                                </svg>
                            </div>
                        </a>

                        <a class="button blue--btn" href="{{ route('contact') }}">
                            <div class="button-inner">
                                <span>Contact Us</span>
                                <svg
                                    class="icon"
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 448 512"
                                >
                                    <path
                                        d="M438.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.8 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l306.7 0L233.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z"
                                    />
                                </svg>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="section-wrapper">
        <section class="about-us-v1-section r-left-align">
            <div class="container elementor-container">
                <div
                    class="about-us-v1 wow animate__animated custom-fadeInUp"
                    data-wow-duration="2s"
                >
                    <div class="about-us-content-block">
                        <h1 class="primary--heading">
                            {{ $blocks['home_about_heading']->title ?? 'Bold Branding That Gets You Seen.' }}
                        </h1>

                        <div>
                            {!! $blocks['home_about_body']->body ?? '<p>We help businesses stand out through powerful branding, large format printing, and smart marketing solutions.</p>' !!}
                        </div>

                        <div class="about-cards-block">
                            <div class="about-card">
                                <div style="display:flex; align-items:center; gap:12px; margin-bottom:10px;">
                                    <span style="display:inline-flex; align-items:center; justify-content:center; width:42px; height:42px; border-radius:50%; background:#0f766e; color:#fff;">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" style="width:18px; height:18px; fill:currentColor;">
                                            <path d="M287.9 17.8L354 150.2l145.9 21.2c26.2 3.8 36.7 36 17.7 54.6L412.1 329.9l24.9 145.3c4.5 26.1-23 46-46.4 33.7L288 439.6 185.4 508.9c-23.4 12.3-50.9-7.6-46.4-33.7l24.9-145.3L58.4 226c-19-18.6-8.5-50.8 17.7-54.6L222 150.2 288.1 17.8c11.7-23.6 45.5-23.9 57.2 0z"/>
                                        </svg>
                                    </span>
                                    <h2 class="about-card__title" style="margin:0;">Vision</h2>
                                </div>
                                <div>
                                    {!! $blocks['home_vision']->body ?? '<p>Defining brands, creating value, and inspiring lives.</p>' !!}
                                </div>
                            </div>

                            <div class="about-card">
                                <div style="display:flex; align-items:center; gap:12px; margin-bottom:10px;">
                                    <span style="display:inline-flex; align-items:center; justify-content:center; width:42px; height:42px; border-radius:50%; background:#1d4ed8; color:#fff;">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" style="width:18px; height:18px; fill:currentColor;">
                                            <path d="M256 0C167.6 0 96 71.6 96 160c0 35.3 11.4 67.9 30.8 94.3L246.5 472c4.5 8.2 14.1 13.3 23.5 13.3s19-5.1 23.5-13.3l119.7-217.7C404.6 227.9 416 195.3 416 160 416 71.6 344.4 0 256 0zm0 224c-35.3 0-64-28.7-64-64s28.7-64 64-64 64 28.7 64 64-28.7 64-64 64z"/>
                                        </svg>
                                    </span>
                                    <h2 class="about-card__title" style="margin:0;">Mission</h2>
                                </div>
                                <div>
                                    {!! $blocks['home_mission']->body ?? '<p>To provide effective branding solutions and quality products and services affordably in a fast-paced business environment.</p>' !!}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="about-img-block">
                        <img
                            src="{{ $blocks['home_about_main_image']->image_url ?? asset('inc/assets/images/about-us-img1.jpg') }}"
                            alt="McMupah Marketing"
                            class="about-img"
                        />

                        <img
                            src="{{ asset('inc/assets/images/image-frame-2.png') }}"
                            alt=""
                            class="frame-img"
                        />

                        <div class="single-icon-box">
                            <div class="content">
                                <span>
                                    {{ $blocks['home_about_badge']->title ?? 'Branding. Printing. Marketing. Growth.' }}
                                </span>
                            </div>

                            <div class="icon-inner">
                                <svg
                                    class="icon-svg"
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24"
                                    fill="currentColor"
                                    aria-hidden="true"
                                >
                                    <path d="M3 10v4a1 1 0 0 0 1 1h2.59l3.7 3.71A1 1 0 0 0 12 18v-12a1 1 0 0 0-1.71-.71L6.59 9H4a1 1 0 0 0-1 1Zm11.5-1.5a1 1 0 0 1 1.41 0A6 6 0 0 1 18 13a6 6 0 0 1-2.09 4.5 1 1 0 1 1-1.32-1.5A4 4 0 0 0 16 13a4 4 0 0 0-1.41-3 1 1 0 0 1-.09-1.5Zm2.83-2.83a1 1 0 0 1 1.41 0A10 10 0 0 1 22 13a10 10 0 0 1-3.26 7.33 1 1 0 0 1-1.35-1.48A8 8 0 0 0 20 13a8 8 0 0 0-2.61-5.85 1 1 0 0 1-.06-1.48Z"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <section class="fields-section work-v1-section">
        <div
            class="container wow animate__animated custom-fadeInUp"
            data-wow-duration="2s"
        >
            <h2 class="primary--heading">
                {{ $blocks['printing_heading']->title ?? 'Branding & Large Format Printing' }}
            </h2>

            <div>
                {!! $blocks['printing_intro']->body ?? '<p style="font-size: 16px; line-height: 1.7; font-weight: 400; max-width: 760px; margin: 0 auto 30px auto;">McMupah Marketing offers a wide range of printing and branding solutions. We provide screen printing, sublimation, embroidery printing, and other professional services using modern technology — all under one roof.</p>' !!}
            </div>

            <div
                class="work-cards-wrapper row-masonry"
                data-masonry-options='{ "percentPosition": true, "horizontalOrder": true, "transitionDuration": 0, "gutter": 30 }'
            >
                @foreach($printingServices as $service)
                    <div class="image-box" id="service-{{ $service->slug }}">
                        <div class="image-box-image">
                            <img
                                src="{{ $service->image_url ?? asset('inc/assets/images/service-img-01.jpg') }}"
                                alt="{{ $service->title }}"
                            />
                        </div>

                        <div class="image-box-content">
                            <div class="image-box-content-inner">
                                @if($service->icon)
                                    <span>{!! $service->icon !!}</span>
                                @endif

                                <h4>{{ $service->title }}</h4>

                                <div class="content">
                                    <p>{{ $service->excerpt }}</p>
                                </div>

                                <div class="reveal"></div>
                            </div>
                        </div>

                        <div class="image-box-bg"></div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <div class="facts-dark-section">
        <section class="facts-section">
            <div class="container">
                <div class="icon-box">
                    <svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 2L2 7v7c0 5 3.8 9.7 10 11 6.2-1.3 10-6 10-11V7l-10-5z"/>
                    </svg>
                </div>

                <h2
                    class="primary--heading wow animate__animated custom-fadeInUp"
                    data-wow-duration="2s"
                >
                    {{ $blocks['promo_heading']->title ?? 'Promotional Materials & Printing' }}
                </h2>

                <div
                    class="facts-cards-wrapper wow animate__animated custom-fadeInUp"
                    data-wow-duration="2s"
                >
                    @foreach($promoServices as $service)
                        <div class="facts-card">
                            <div class="img-block">
                                <img
                                    src="{{ $service->image_url ?? asset('inc/assets/images/fact-img-1.jpg') }}"
                                    class="fact-img"
                                    alt="{{ $service->title }}"
                                />
                            </div>

                            <div class="number-title-wrapper">
                                <div class="title">{{ $service->title }}</div>
                                <p class="small">{{ $service->excerpt }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    </div>

    <section class="clients-section">
        <div class="contact-section">
            <section
                class="contact-v2-section wow animate__animated custom-fadeInUp"
                data-wow-duration="2s"
            >
                <div class="container">
                    <div class="contact-v2-wrapper">
                        <div class="image-block">
                            <img
                                src="{{ $blocks['digital_marketing_image']->image_url ?? asset('inc/assets/images/contact-img-2.jpg') }}"
                                alt="Digital Marketing"
                                class="contact-img"
                            />
                        </div>

                        <div class="content-block" style="color:#fff;">
                            <h2 class="primary--heading" style="color:#fff;">
                                {{ $blocks['digital_marketing_heading']->title ?? 'Digital Marketing' }}
                            </h2>

                            <div style="margin-bottom:22px; color:#ddd; font-size:16px;">
                                {!! $blocks['digital_marketing_intro']->body ?? '<p>We provide professional digital marketing services designed to grow your brand and increase your online presence.</p>' !!}
                            </div>

                            <div class="services-list" style="display:grid; gap:16px;">
                                @foreach($digitalServices as $service)
                                    <div
                                        style="display:flex; align-items:center; gap:14px;"
                                        id="service-{{ $service->slug }}"
                                    >
                                        <span style="display:inline-flex; align-items:center; justify-content:center; width:38px; height:38px; border-radius:50%; background:rgba(255,255,255,0.14); color:#fff; flex-shrink:0;">
                                            @if($service->icon)
                                                {!! $service->icon !!}
                                            @else
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" style="width:16px; height:16px; fill:currentColor;">
                                                    <path d="M502.3 190.8l-192-160c-14.8-12.3-36.3-10.4-48.7 4.3L215.4 91.6l-59.9-50c-14.8-12.3-36.4-10.3-48.7 4.3L9.7 165c-12.3 14.8-10.3 36.4 4.4 48.7l59.9 50L9.7 341c-12.3 14.8-10.3 36.4 4.4 48.7l97.1 80.9c14.8 12.3 36.4 10.3 48.7-4.4l64.3-77.2 59.9 50c14.8 12.3 36.4 10.3 48.7-4.4l97.1-116.4c12.3-14.8 10.3-36.4-4.4-48.7l-59.9-50 64.3-77.2c12.3-14.8 10.3-36.4-4.4-48.7z"/>
                                                </svg>
                                            @endif
                                        </span>

                                        <div style="font-size:17px; font-weight:600;">
                                            {{ $service->title }}
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <div class="work-v3-section">
                <section
                    class="toggle-card-section-2 wow animate__animated custom-fadeInUp"
                    data-wow-duration="2s"
                >
                    <div class="container">
                        <h2 class="primary--heading">
                            {{ $blocks['other_services_heading']->title ?? 'Other Services' }}
                        </h2>

                        <div class="toggle-card-wrapper">
                            <div class="rodio-tabs tab-landscape">
                                <div class="rodio-tabs-inner">
                                    <div class="tabs-wrapper">
                                        <ul class="nav nav-tabs mobile-hidden" id="tab-container-custom">
                                            @php $tabIndex = 0; @endphp
                                            @foreach($otherServices as $groupName => $groupItems)
                                                <li class="nav-item" role="presentation">
                                                    <button
                                                        class="nav-link {{ $tabIndex === 0 ? 'active' : '' }}"
                                                        id="tab-{{ \Illuminate\Support\Str::slug($groupName) }}"
                                                        data-bs-toggle="tab"
                                                        data-bs-target="#target-{{ \Illuminate\Support\Str::slug($groupName) }}"
                                                        type="button"
                                                        role="tab"
                                                    >
                                                        <span class="button-list-text">{{ $groupName }}</span>
                                                    </button>
                                                </li>
                                                @php $tabIndex++; @endphp
                                            @endforeach
                                        </ul>
                                    </div>

                                    <div class="tab-content">
                                        @php $paneIndex = 0; @endphp
                                        @foreach($otherServices as $groupName => $groupItems)
                                            @php
                                                $firstItem = $groupItems->first();
                                            @endphp

                                            <div
                                                class="tab-pane {{ $paneIndex === 0 ? 'active first-render' : '' }} tab-template"
                                                id="target-{{ \Illuminate\Support\Str::slug($groupName) }}"
                                                role="tabpanel"
                                            >
                                                <div class="tab-pane-inner">
                                                    <div class="tab-panel-wrapper">
                                                        <div class="pane-content-block">
                                                            <div style="display:flex; align-items:center; gap:14px; margin-bottom:12px;">
                                                                <span style="display:inline-flex; align-items:center; justify-content:center; width:44px; height:44px; border-radius:50%; background:#0f766e; color:#fff; flex-shrink:0;">
                                                                    @if($firstItem && $firstItem->icon)
                                                                        {!! $firstItem->icon !!}
                                                                    @else
                                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" style="width:18px; height:18px; fill:currentColor;">
                                                                            <path d="M184 48H328c4.4 0 8 3.6 8 8V96H176V56c0-4.4 3.6-8 8-8zM96 128H416c17.7 0 32 14.3 32 32v48H64V160c0-17.7 14.3-32 32-32zm352 112v176c0 26.5-21.5 48-48 48H112c-26.5 0-48-21.5-48-48V240h384z"/>
                                                                        </svg>
                                                                    @endif
                                                                </span>
                                                                <h2 class="primary--heading" style="margin:0;">{{ $groupName }}</h2>
                                                            </div>

                                                            @if($firstItem && $firstItem->description)
                                                                <div style="margin-bottom: 16px;">
                                                                    {!! $firstItem->description !!}
                                                                </div>
                                                            @else
                                                                @foreach($groupItems as $service)
                                                                    <p id="service-{{ $service->slug }}">
                                                                        <strong>{{ $service->title }}</strong>{{ $service->excerpt ? ' – ' . $service->excerpt : '' }}
                                                                    </p>
                                                                @endforeach
                                                            @endif

                                                            @if($firstItem && $firstItem->button_link)
                                                                <a class="button" href="{{ $firstItem->button_link }}">
                                                                    <div class="button-inner">
                                                                        <span>{{ $firstItem->button_text ?? 'LEARN MORE' }}</span>
                                                                        <svg
                                                                            class="icon"
                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                            viewBox="0 0 448 512"
                                                                        >
                                                                            <path
                                                                                d="M438.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.8 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l306.7 0L233.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z"
                                                                            />
                                                                        </svg>
                                                                    </div>
                                                                </a>
                                                            @endif
                                                        </div>

                                                        <div class="about-img-block">
                                                            <div data-extend class="r-image overlap">
                                                                <div class="r-image-inner">
                                                                    <img
                                                                        src="{{ $firstItem?->image_url ?? asset('inc/assets/images/tab-img-01.jpg') }}"
                                                                        alt="{{ $groupName }}"
                                                                    />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            @php $paneIndex++; @endphp
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <div
                class="container wow animate__animated custom-fadeInUp"
                data-wow-duration="2s"
            >
                <div class="slider-header">
                    <h2 class="primary--heading">
                        {{ $blocks['trade_references_heading']->title ?? 'Trade References' }}
                    </h2>

                    <div>
                        {!! $blocks['trade_references_intro']->body ?? '<p>Imagine entrusting McMupah Marketing with all your branding and marketing needs while you simply monitor the progress and results.</p>' !!}
                    </div>

                    <div class="client-slider-btns">
                        <div class="client-button-prev slider-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512">
                                <path d="M203.9 405.3c5.877 6.594 5.361 16.69-1.188 22.62c-6.562 5.906-16.69 5.375-22.59-1.188L36.1 266.7c-5.469-6.125-5.469-15.31 0-21.44l144-159.1c5.906-6.562 16.03-7.094 22.59-1.188c6.918 6.271 6.783 16.39 1.188 22.62L69.53 256L203.9 405.3z"></path>
                            </svg>
                        </div>

                        <div class="client-button-next slider-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512">
                                <path d="M219.9 266.7L75.89 426.7c-5.906 6.562-16.03 7.094-22.59 1.188c-6.918-6.271-6.783-16.39-1.188-22.62L186.5 256L52.11 106.7C46.23 100.1 46.75 90.04 53.29 84.1C59.86 78.2 69.98 78.73 75.89 85.29l144 159.1C225.4 251.4 225.4 260.6 219.9 266.7z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="swiper clients-swiper">
                    <div class="swiper-wrapper">
                        @foreach($tradeReferences as $reference)
                            <div class="swiper-slide">
                                <a href="{{ $reference->client_link ?? '#' }}" class="client-block">
                                    <img
                                        src="{{ $reference->image_url ?? asset('inc/assets/images/client-logo.png') }}"
                                        alt="{{ $reference->title }}"
                                        class="swiper-img"
                                    />
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="contact" style="padding: 60px 0;">
        <div class="container">
            <div class="card">
                <h2 style="margin-top: 0;">Contact Us</h2>

                <form action="{{ route('contact.store') }}" method="POST">
                    @csrf

                    <div class="grid-2">
                        <div class="form-group">
                            <label class="form-label">Name</label>
                            <input
                                type="text"
                                name="name"
                                class="form-control"
                                value="{{ old('name') }}"
                                required
                            >
                        </div>

                        <div class="form-group">
                            <label class="form-label">Email</label>
                            <input
                                type="email"
                                name="email"
                                class="form-control"
                                value="{{ old('email') }}"
                            >
                        </div>
                    </div>

                    <div class="grid-2">
                        <div class="form-group">
                            <label class="form-label">Phone</label>
                            <input
                                type="text"
                                name="phone"
                                class="form-control"
                                value="{{ old('phone') }}"
                            >
                        </div>

                        <div class="form-group">
                            <label class="form-label">Subject</label>
                            <input
                                type="text"
                                name="subject"
                                class="form-control"
                                value="{{ old('subject') }}"
                            >
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Message</label>
                        <textarea
                            name="message"
                            class="form-control"
                            rows="6"
                            required
                        >{{ old('message') }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-success">Send Enquiry</button>
                </form>
            </div>
        </div>
    </section>
@endsection