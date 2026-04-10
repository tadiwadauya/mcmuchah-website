@extends('layouts.website')

@section('content')
    @php
        $title = 'Contact | ' . ($setting->site_name ?: 'Website');
        $metaDescription = $setting->seo_description ?: 'Contact us for branding, printing, marketing, and digital solutions.';
    @endphp

    @if(session('success'))
        <div class="container" style="margin-top: 20px;">
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        </div>
    @endif

    <section class="page-header-section">
        <div class="container">
            <div class="page-header-wrapper">
                <div class="page-header-content">
                    <div class="page-title">
                        <h1>Contact</h1>
                    </div>

                    <div class="breadcrumbs">
                        <ul>
                            <li>
                                <a href="{{ route('home') }}">Home</a>
                            </li>
                            <li>Contact</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section style="padding: 80px 0;">
        <div class="container">
            <div class="grid-2" style="display:grid; grid-template-columns: 1fr 1fr; gap: 30px;">
                <div class="card">
                    <h2 style="margin-top: 0;">Get in touch</h2>

                    <form action="{{ route('contact.store') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                        </div>

                        <div class="form-group">
                            <label class="form-label">Phone</label>
                            <input type="text" name="phone" class="form-control" value="{{ old('phone') }}">
                        </div>

                        <div class="form-group">
                            <label class="form-label">Subject</label>
                            <input type="text" name="subject" class="form-control" value="{{ old('subject') }}">
                        </div>

                        <div class="form-group">
                            <label class="form-label">Message</label>
                            <textarea name="message" class="form-control" rows="6" required>{{ old('message') }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-success">Send Enquiry</button>
                    </form>
                </div>

                <div class="card">
                    <h2 style="margin-top: 0;">Contact Details</h2>

                    @if($setting->site_phone)
                        <p><strong>Phone:</strong> {{ $setting->site_phone }}</p>
                    @endif

                    @if($setting->site_email)
                        <p><strong>Email:</strong> {{ $setting->site_email }}</p>
                    @endif

                    @if($setting->whatsapp_number)
                        <p><strong>WhatsApp:</strong> {{ $setting->whatsapp_number }}</p>
                    @endif

                    @if($setting->address)
                        <p><strong>Address:</strong> {{ $setting->address }}</p>
                    @endif

                    <div style="margin-top: 24px;">
                        <h4>Follow Us</h4>
                        <div class="social-links-block">
                            <ul class="social-links">
                                @if($setting->facebook_url)
                                    <li>
                                        <a href="{{ $setting->facebook_url }}" target="_blank">
                                            <span>
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                                                    <path d="M80 299.3V512H196V299.3h86.5l18-97.8H196V166.9c0-51.7 20.3-71.5 72.7-71.5c16.3 0 29.4 .4 37 1.2V7.9C291.4 4 256.4 0 236.2 0C129.3 0 80 50.5 80 159.4v42.1H14v97.8H80z"/>
                                                </svg>
                                            </span>
                                        </a>
                                    </li>
                                @endif

                                @if($setting->twitter_url)
                                    <li>
                                        <a href="{{ $setting->twitter_url }}" target="_blank">
                                            <span>
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                    <path d="M389.2 48h70.6L305.6 224.2 487 464H345L233.7 318.6 106.5 464H35.8L200.7 275.5 26.8 48H172.4L272.9 180.9 389.2 48zM364.4 421.8h39.1L151.1 88h-42L364.4 421.8z"></path>
                                                </svg>
                                            </span>
                                        </a>
                                    </li>
                                @endif

                                @if($setting->linkedin_url)
                                    <li>
                                        <a href="{{ $setting->linkedin_url }}" target="_blank">
                                            <span>
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                                    <path d="M100.3 448H7.4V148.9h92.9zM53.8 108.1C24.1 108.1 0 83.5 0 53.8a53.8 53.8 0 0 1 107.6 0c0 29.7-24.1 54.3-53.8 54.3zM447.9 448h-92.7V302.4c0-34.7-.7-79.2-48.3-79.2-48.3 0-55.7 37.7-55.7 76.7V448h-92.8V148.9h89.1v40.8h1.3c12.4-23.5 42.7-48.3 87.9-48.3 94 0 111.3 61.9 111.3 142.3V448z"/>
                                                </svg>
                                            </span>
                                        </a>
                                    </li>
                                @endif

                                @if($setting->instagram_url)
                                    <li>
                                        <a href="{{ $setting->instagram_url }}" target="_blank">
                                            <span>
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                                    <path d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.3 0-74.8-33.5-74.8-74.8S182.8 181 224.1 181s74.8 33.5 74.8 74.8-33.5 74.8-74.8 74.8zm146.4-194.3c0 14.9-12 26.9-26.9 26.9-14.9 0-26.9-12-26.9-26.9 0-14.9 12-26.9 26.9-26.9 14.9 0 26.9 12 26.9 26.9zM398.8 80c-1.7-35.3-9.8-66.6-35.7-92.5C337.2-38.3 305.9-46.4 270.6-48.1 234.1-50 213.9-50 177.4-48.1 142.1-46.4 110.8-38.3 84.9-12.5 59.1 13.4 51 44.7 49.3 80c-1.9 36.5-1.9 56.7 0 93.2 1.7 35.3 9.8 66.6 35.6 92.5 25.9 25.8 57.2 33.9 92.5 35.6 36.5 1.9 56.7 1.9 93.2 0 35.3-1.7 66.6-9.8 92.5-35.6 25.8-25.9 33.9-57.2 35.7-92.5 1.9-36.5 1.9-56.7 0-93.2zM351 281.9c-7.7 19.3-22.7 34.3-42 42-29 11.5-97.8 8.8-130.9 8.8s-101.9 2.6-130.9-8.8c-19.3-7.7-34.3-22.7-42-42-11.5-29-8.8-97.8-8.8-130.9s-2.6-101.9 8.8-130.9c7.7-19.3 22.7-34.3 42-42 29-11.5 97.8-8.8 130.9-8.8s101.9-2.6 130.9 8.8c19.3 7.7 34.3 22.7 42 42 11.5 29 8.8 97.8 8.8 130.9s2.7 101.9-8.8 130.9z"/>
                                                </svg>
                                            </span>
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>

                    <div style="margin-top: 30px;">
                        <h4>Business Hours</h4>
                        <p>Monday to Friday: 8:00 AM – 5:00 PM</p>
                        <p>Saturday: By arrangement</p>
                        <p>Sunday: Closed</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection