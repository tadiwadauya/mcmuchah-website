@extends('layouts.website')

@section('content')
    @php
        $title = 'About | ' . ($setting->site_name ?: 'Website');
        $metaDescription = $setting->seo_description ?: 'Learn more about our mission, vision, values, and business approach.';
    @endphp

    <section class="page-header-section">
        <div class="container">
            <div class="page-header-wrapper">
                <div class="page-header-content">
                    <div class="page-title">
                        <h1>{{ $blocks['about_page_heading']->title ?? 'About' }}</h1>
                    </div>

                    <div class="breadcrumbs">
                        <ul>
                            <li>
                                <a href="{{ route('home') }}">Home</a>
                            </li>
                            <li>About</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section
        class="about-us-v2-section wow animate__animated custom-fadeInUp"
        data-wow-delay="0.25s"
        data-wow-duration="2s"
    >
        <div class="container">
            <div class="about-us-v2">
                <div class="about-us-content-block">
                    <h2 class="primary--heading">
                        {{ $blocks['about_main_heading']->title ?? 'Let your business gain it’s full potential.' }}
                    </h2>

                    <div style="margin-bottom: 24px;">
                        {!! $blocks['about_intro']->body ?? '<p>Full company about text goes here.</p>' !!}
                    </div>

                    <div class="about-list">
                        <div class="list-item" style="display: flex; align-items: flex-start; gap: 16px; margin-bottom: 22px;">
                            <svg
                                class="list-icon"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 576 512"
                                style="width: 26px; min-width: 26px; margin-top: 6px;"
                            >
                                <path d="M368.8 119.8l-41.86-6.125l-18.72-38.09c-7.607-15.48-32.69-15.45-40.23 0L249.2 113.7L207.3 119.8C198.7 121.1 191.8 126.9 189.1 135.2C186.5 143.4 188.6 152.3 194.8 158.2l30.34 29.52L217.9 229.7C216.5 238.2 219.1 246.7 226.9 251.7c6.982 4.961 15.97 5.715 23.57 1.664l37.48-19.75l37.45 19.75C328.7 255.1 332.3 256 335.9 256c4.633 0 9.236-1.445 13.18-4.336c6.951-5.086 10.36-13.53 8.924-22.01l-7.201-41.89l30.34-29.52c6.199-6.027 8.391-14.86 5.729-23.11C384.2 126.9 377.3 121 368.8 119.8z"></path>
                            </svg>
                            <div>
                                <h3 style="margin: 0 0 8px 0;">Vision</h3>
                                <div>{!! $blocks['about_vision']->body ?? '' !!}</div>
                            </div>
                        </div>

                        <div class="list-item" style="display: flex; align-items: flex-start; gap: 16px; margin-bottom: 22px;">
                            <svg
                                class="list-icon"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 512 512"
                                style="width: 26px; min-width: 26px; margin-top: 6px;"
                            >
                                <path d="M364.2 267.2l-104.8-15.28L212.6 156.7C208.7 148.8 200.7 143.9 191.9 143.9C183.2 143.8 175.1 148.8 171.4 156.7L124.5 251.1L19.71 267.2C.9566 269.9-6.618 293.1 7.007 306.5l75.87 74l-17.1 104.6c-1.25 6.75 .5878 13.51 4.963 18.63C74.22 509 80.64 512 87.52 512c3.625 0 7.436-.9554 10.69-2.705l93.79-49.38l93.74 49.38c3.25 1.625 6.991 2.675 10.62 2.675c6.75 0 13.23-2.97 17.61-8.22c4.25-5.125 6.273-11.98 5.148-18.61L301.2 380.5l75.92-74C390.6 293 383.1 269.1 364.2 267.2z"></path>
                            </svg>
                            <div>
                                <h3 style="margin: 0 0 8px 0;">Mission</h3>
                                <div>{!! $blocks['about_mission']->body ?? '' !!}</div>
                            </div>
                        </div>

                        <div class="list-item" style="display: flex; align-items: flex-start; gap: 16px; margin-bottom: 22px;">
                            <svg
                                class="list-icon"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 512 512"
                                style="width: 26px; min-width: 26px; margin-top: 6px;"
                            >
                                <path d="M255.9 120.9l9.1-15.7c5.6-9.8 18.1-13.1 27.9-7.5 9.8 5.6 13.1 18.1 7.5 27.9l-87.5 151.5h63.3c20.5 0 32 24.1 23.1 40.8H113.8c-11.3 0-20.4-9.1-20.4-20.4 0-11.3 9.1-20.4 20.4-20.4h52l66.6-115.4-20.8-36.1c-5.6-9.8-2.3-22.2 7.5-27.9 9.8-5.6 22.2-2.3 27.9 7.5l8.9 15.7z"></path>
                            </svg>
                            <div>
                                <h3 style="margin: 0 0 8px 0;">Core Values</h3>
                                <div>{!! $blocks['about_core_values']->body ?? '' !!}</div>
                            </div>
                        </div>

                        @if(!empty($blocks['about_values']) && !empty($blocks['about_values']->body))
                            <div class="list-item" style="display: flex; align-items: flex-start; gap: 16px; margin-bottom: 22px;">
                                <svg
                                    class="list-icon"
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 512 512"
                                    style="width: 26px; min-width: 26px; margin-top: 6px;"
                                >
                                    <path d="M480.1 159c-9.375-9.375-24.56-9.375-33.94 0L192 414.1L64.97 287c-9.375-9.375-24.56-9.375-33.94 0s-9.375 24.56 0 33.94l144 144C179.7 469.7 185.8 472 192 472s12.28-2.344 16.97-7.031l272-272C490.3 183.6 490.3 168.4 480.1 159z"></path>
                                </svg>
                                <div>
                                    <h3 style="margin: 0 0 8px 0;">Values</h3>
                                    <div>{!! $blocks['about_values']->body !!}</div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div style="margin-top: 26px;">
                        <a class="button" href="{{ route('services') }}">
                            <div class="button-inner">
                                <span>{{ $blocks['about_button_text']->title ?? 'LEARN MORE' }}</span>
                                <svg
                                    class="icon"
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 448 512"
                                >
                                    <path d="M438.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.8 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l306.7 0L233.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z"></path>
                                </svg>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="about-img-block">
                    <img
                        src="{{ $blocks['about_main_image']->image_url ?? asset('inc/assets/images/about-us-img2.jpg') }}"
                        alt="About image"
                        class="back-img"
                    >

                    <div class="upper-block">
                        <img
                            src="{{ $blocks['about_secondary_image']->image_url ?? asset('inc/assets/images/about-us-img3.jpg') }}"
                            alt="About image detail"
                            class="front-img"
                        >

                        <div class="single-icon-box">
                            <div class="content">
                                <span>{{ $blocks['about_image_badge']->title ?? 'Branding. Printing. Marketing. Growth.' }}</span>
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
        </div>

        <style>
            .about-us-v2 .about-list .list-item h3 {
                font-size: 24px;
                font-weight: 700;
            }

            .about-us-v2 .about-list .list-item div p:last-child {
                margin-bottom: 0;
            }
        </style>
    </section>

    <section style="padding: 80px 0;">
        <div class="container">
            <div class="card">
                <h2 style="margin-top: 0;">Ready to work with us?</h2>
                <p>
                    We are committed to delivering branding, printing, marketing, and business support solutions that create real value for your organisation.
                </p>
                <a href="{{ route('contact') }}" class="btn btn-success">Contact Us</a>
            </div>
        </div>
    </section>
@endsection