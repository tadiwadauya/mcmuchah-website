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

    <section class="about-us-v2-section wow animate__animated custom-fadeInUp" data-wow-delay="0.25s" data-wow-duration="2s">
        <div class="container">
            <div class="about-us-v2">
                <div class="about-us-content-block">
                    <h2 class="primary--heading">
                        {{ $blocks['about_main_heading']->title ?? 'Let your business gain its full potential.' }}
                    </h2>

                    <div>
                        {!! $blocks['about_intro']->body ?? '<p>Full company about text goes here.</p>' !!}
                    </div>

                    <h3>Vision</h3>
                    <div>{!! $blocks['about_vision']->body ?? '' !!}</div>

                    <h3>Mission</h3>
                    <div>{!! $blocks['about_mission']->body ?? '' !!}</div>

                    <h3>Core Values</h3>
                    <div>{!! $blocks['about_core_values']->body ?? '' !!}</div>

                    <h3>Values</h3>
                    <div>{!! $blocks['about_values']->body ?? '' !!}</div>
                </div>

                <div class="about-img-block">
                    <img
                        src="{{ $blocks['about_main_image']->image_url ?? asset('inc/assets/images/about-us-img2.jpg') }}"
                        alt="About image"
                        class="back-img"
                    >
                </div>
            </div>
        </div>
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