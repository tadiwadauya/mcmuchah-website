@extends('layouts.website')

@section('content')
    @php
        $title = 'Services | ' . ($setting->site_name ?: 'Website');
        $metaDescription = $setting->seo_description ?: 'Explore our branding, printing, digital marketing, and business support services.';
    @endphp

    <section class="page-header-section">
        <div class="container">
            <div class="page-header-wrapper">
                <div class="page-header-content">
                    <div class="page-title">
                        <h1>Services</h1>
                    </div>

                    <div class="breadcrumbs">
                        <ul>
                            <li>
                                <a href="{{ route('home') }}">Home</a>
                            </li>
                            <li>Services</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="fields-section work-v1-section" style="padding-top: 80px;">
        <div class="container">
            <h2 class="primary--heading">Branding & Large Format Printing</h2>

            <div class="work-cards-wrapper row-masonry" data-masonry-options='{ "percentPosition": true, "horizontalOrder": true, "transitionDuration": 0, "gutter": 30 }'>
                @foreach($printingServices as $service)
                    <div class="image-box" id="service-{{ $service->slug }}">
                        <div class="image-box-image">
                            <img src="{{ $service->image_url ?? asset('inc/assets/images/service-img-01.jpg') }}" alt="{{ $service->title }}">
                        </div>

                        <div class="image-box-content">
                            <div class="image-box-content-inner">
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
                <h2 class="primary--heading">Promotional Materials & Printing</h2>

                <div class="facts-cards-wrapper">
                    @foreach($promoServices as $service)
                        <div class="facts-card" id="service-{{ $service->slug }}">
                            <div class="img-block">
                                <img src="{{ $service->image_url ?? asset('inc/assets/images/fact-img-1.jpg') }}" class="fact-img" alt="{{ $service->title }}">
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

    <section class="contact-v2-section" style="padding-top: 80px;">
        <div class="container">
            <div class="contact-v2-wrapper">
                <div class="image-block">
                    <img src="{{ asset('inc/assets/images/contact-img-2.jpg') }}" alt="Digital Marketing" class="contact-img">
                </div>

                <div class="content-block" style="color:#fff;">
                    <h2 class="primary--heading" style="color:#fff;">Digital Marketing</h2>
                    <p style="margin-bottom:22px; color:#ddd; font-size:16px;">
                        We provide professional digital marketing services designed to grow your brand and increase your online presence.
                    </p>

                    <div class="services-list" style="display:grid; gap:16px;">
                        @foreach($digitalServices as $service)
                            <div id="service-{{ $service->slug }}" style="display:flex; align-items:center; gap:14px;">
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

    <div class="work-v3-section" style="padding-top: 80px;">
        <section class="toggle-card-section-2">
            <div class="container">
                <h2 class="primary--heading">Other Services</h2>

                <div class="toggle-card-wrapper">
                    <div class="rodio-tabs tab-landscape">
                        <div class="rodio-tabs-inner">
                            <div class="tabs-wrapper">
                                <ul class="nav nav-tabs mobile-hidden" id="services-tab-container">
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
                                                    <h2 class="primary--heading">{{ $groupName }}</h2>

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
                                                                <svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                                                    <path d="M438.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.8 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l306.7 0L233.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z"/>
                                                                </svg>
                                                            </div>
                                                        </a>
                                                    @endif
                                                </div>

                                                <div class="about-img-block">
                                                    <div data-extend class="r-image overlap">
                                                        <div class="r-image-inner">
                                                            <img src="{{ $firstItem?->image_url ?? asset('inc/assets/images/tab-img-01.jpg') }}" alt="{{ $groupName }}">
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

    <section style="padding: 80px 0;">
        <div class="container">
            <div class="card">
                <h2 style="margin-top: 0;">Need a custom quotation?</h2>
                <p>
                    We offer flexible and competitive pricing based on your exact requirements. Get in touch with us and we will prepare a solution tailored to your business.
                </p>
                <a href="{{ route('contact') }}" class="btn btn-success">Contact Us</a>
            </div>
        </div>
    </section>
@endsection