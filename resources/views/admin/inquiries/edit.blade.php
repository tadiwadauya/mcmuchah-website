@extends('layouts.admin')

@section('content')
    @php
        $pageTitle = 'Settings';
    @endphp

    <div class="card">
        <h3 style="margin-top: 0;">Website Settings</h3>

        <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="grid-2">
                <div class="form-group">
                    <label class="form-label">Site Name</label>
                    <input type="text" name="site_name" class="form-control" value="{{ old('site_name', $setting->site_name) }}">
                </div>

                <div class="form-group">
                    <label class="form-label">Site Email</label>
                    <input type="email" name="site_email" class="form-control" value="{{ old('site_email', $setting->site_email) }}">
                </div>
            </div>

            <div class="grid-2">
                <div class="form-group">
                    <label class="form-label">Site Phone</label>
                    <input type="text" name="site_phone" class="form-control" value="{{ old('site_phone', $setting->site_phone) }}">
                </div>

                <div class="form-group">
                    <label class="form-label">WhatsApp Number</label>
                    <input type="text" name="whatsapp_number" class="form-control" value="{{ old('whatsapp_number', $setting->whatsapp_number) }}">
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Address</label>
                <input type="text" name="address" class="form-control" value="{{ old('address', $setting->address) }}">
            </div>

            <div class="grid-2">
                <div class="form-group">
                    <label class="form-label">Facebook URL</label>
                    <input type="text" name="facebook_url" class="form-control" value="{{ old('facebook_url', $setting->facebook_url) }}">
                </div>

                <div class="form-group">
                    <label class="form-label">Instagram URL</label>
                    <input type="text" name="instagram_url" class="form-control" value="{{ old('instagram_url', $setting->instagram_url) }}">
                </div>
            </div>

            <div class="grid-2">
                <div class="form-group">
                    <label class="form-label">LinkedIn URL</label>
                    <input type="text" name="linkedin_url" class="form-control" value="{{ old('linkedin_url', $setting->linkedin_url) }}">
                </div>

                <div class="form-group">
                    <label class="form-label">Twitter/X URL</label>
                    <input type="text" name="twitter_url" class="form-control" value="{{ old('twitter_url', $setting->twitter_url) }}">
                </div>
            </div>

            <div class="grid-2">
                <div class="form-group">
                    <label class="form-label">SEO Title</label>
                    <input type="text" name="seo_title" class="form-control" value="{{ old('seo_title', $setting->seo_title) }}">
                </div>

                <div class="form-group">
                    <label class="form-label">SEO Description</label>
                    <textarea name="seo_description" class="form-control" rows="4">{{ old('seo_description', $setting->seo_description) }}</textarea>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Footer Text</label>
                <textarea name="footer_text" class="form-control" rows="4">{{ old('footer_text', $setting->footer_text) }}</textarea>
            </div>

            <div class="grid-2">
                <div class="form-group">
                    <label class="form-label">Manual Logo Path</label>
                    <input type="text" name="logo" class="form-control" value="{{ old('logo', $setting->logo) }}">
                </div>

                <div class="form-group">
                    <label class="form-label">Upload Logo</label>
                    <input type="file" name="logo_file" class="form-control" accept=".jpg,.jpeg,.png,.webp,.svg">
                </div>
            </div>

            @if($setting->logo_url)
                <div class="form-group">
                    <label class="form-label">Current Logo</label>
                    <div style="margin-bottom: 10px;">
                        <img src="{{ $setting->logo_url }}" alt="Logo" style="max-width: 220px; border: 1px solid #ddd; border-radius: 10px;">
                    </div>
                    <label class="checkbox-wrap">
                        <input type="checkbox" name="remove_logo" value="1">
                        <span>Remove logo</span>
                    </label>
                </div>
            @endif

            <div class="grid-2">
                <div class="form-group">
                    <label class="form-label">Manual Favicon Path</label>
                    <input type="text" name="favicon" class="form-control" value="{{ old('favicon', $setting->favicon) }}">
                </div>

                <div class="form-group">
                    <label class="form-label">Upload Favicon</label>
                    <input type="file" name="favicon_file" class="form-control" accept=".jpg,.jpeg,.png,.webp,.ico">
                </div>
            </div>

            @if($setting->favicon_url)
                <div class="form-group">
                    <label class="form-label">Current Favicon</label>
                    <div style="margin-bottom: 10px;">
                        <img src="{{ $setting->favicon_url }}" alt="Favicon" style="max-width: 64px; border: 1px solid #ddd; border-radius: 10px;">
                    </div>
                    <label class="checkbox-wrap">
                        <input type="checkbox" name="remove_favicon" value="1">
                        <span>Remove favicon</span>
                    </label>
                </div>
            @endif

            <div style="display: flex; gap: 10px; flex-wrap: wrap;">
                <button type="submit" class="btn btn-success">Save Settings</button>
            </div>
        </form>
    </div>
@endsection