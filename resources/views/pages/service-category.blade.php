@extends('layouts.website')

@section('content')
    @php
        $title = $page['title'] . ' | ' . ($setting->site_name ?: 'Website');
        $metaDescription = $page['description'] ?? ($setting->seo_description ?: 'Our services');
    @endphp

    <section class="page-header-section">
        <div class="container">
            <div class="page-header-wrapper">
                <div class="page-header-content">
                    <div class="page-title">
                        <h1>{{ $page['title'] }}</h1>
                    </div>

                    <div class="breadcrumbs">
                        <ul>
                            <li><a href="{{ route('home') }}">Home</a></li>
                            <li><a href="{{ route('services') }}">Services</a></li>
                            <li>{{ $page['title'] }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section style="padding: 80px 0;">
        <div class="container">
            <div class="card" style="margin-bottom: 30px;">
                <h2 style="margin-top:0;">{{ $page['title'] }}</h2>
                <p>{{ $page['description'] }}</p>
            </div>

            @if($services->count())
                <div class="grid-2" style="display:grid; grid-template-columns:1fr 1fr; gap:30px;">
                    @foreach($services as $service)
                        <div class="card" id="service-{{ $service->slug }}">
                            @if($service->image_url)
                                <div style="margin-bottom:16px;">
                                    <img
                                        src="{{ $service->image_url }}"
                                        alt="{{ $service->title }}"
                                        style="width:100%; max-height:260px; object-fit:cover; border-radius:12px;"
                                    >
                                </div>
                            @endif

                            <h3 style="margin-top:0;">{{ $service->title }}</h3>

                            @if($service->excerpt)
                                <p>{{ $service->excerpt }}</p>
                            @endif

                            @if($service->description)
                                <div>{!! $service->description !!}</div>
                            @endif
                        </div>
                    @endforeach
                </div>
            @else
                <div class="card">
                    <p>No services have been added for this page yet.</p>
                </div>
            @endif

            <div class="card" style="margin-top: 30px;">
                <h3 style="margin-top:0;">Need help with {{ strtolower($page['title']) }}?</h3>
                <p>Contact us for a quotation or a solution tailored to your needs.</p>
                <a href="{{ route('contact') }}" class="btn btn-success">Contact Us</a>
            </div>
        </div>
    </section>
@endsection