<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Support\ActivityLogger;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class SettingController extends Controller
{
    public function edit(): View
    {
        $setting = Setting::current();

        return view('admin.settings.edit', compact('setting'));
    }

    public function update(Request $request): RedirectResponse
    {
        $setting = Setting::current();

        $validated = $request->validate([
            'site_name' => ['nullable', 'string', 'max:255'],
            'site_email' => ['nullable', 'email', 'max:255'],
            'site_phone' => ['nullable', 'string', 'max:255'],
            'whatsapp_number' => ['nullable', 'string', 'max:255'],
            'address' => ['nullable', 'string', 'max:255'],
            'facebook_url' => ['nullable', 'string', 'max:255'],
            'instagram_url' => ['nullable', 'string', 'max:255'],
            'linkedin_url' => ['nullable', 'string', 'max:255'],
            'twitter_url' => ['nullable', 'string', 'max:255'],
            'seo_title' => ['nullable', 'string', 'max:255'],
            'seo_description' => ['nullable', 'string'],
            'footer_text' => ['nullable', 'string'],
            'logo' => ['nullable', 'string', 'max:255'],
            'favicon' => ['nullable', 'string', 'max:255'],
            'logo_file' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,svg', 'max:4096'],
            'favicon_file' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,ico', 'max:2048'],
            'remove_logo' => ['nullable', 'boolean'],
            'remove_favicon' => ['nullable', 'boolean'],
        ]);

        if ($request->boolean('remove_logo')) {
            if ($setting->logo && str_starts_with($setting->logo, 'storage/')) {
                $oldPath = str_replace('storage/', '', $setting->logo);
                Storage::disk('public')->delete($oldPath);
            }

            $validated['logo'] = null;
        }

        if ($request->boolean('remove_favicon')) {
            if ($setting->favicon && str_starts_with($setting->favicon, 'storage/')) {
                $oldPath = str_replace('storage/', '', $setting->favicon);
                Storage::disk('public')->delete($oldPath);
            }

            $validated['favicon'] = null;
        }

        if ($request->hasFile('logo_file')) {
            if ($setting->logo && str_starts_with($setting->logo, 'storage/')) {
                $oldPath = str_replace('storage/', '', $setting->logo);
                Storage::disk('public')->delete($oldPath);
            }

            $path = $request->file('logo_file')->store('uploads/settings', 'public');
            $validated['logo'] = 'storage/' . $path;
        }

        if ($request->hasFile('favicon_file')) {
            if ($setting->favicon && str_starts_with($setting->favicon, 'storage/')) {
                $oldPath = str_replace('storage/', '', $setting->favicon);
                Storage::disk('public')->delete($oldPath);
            }

            $path = $request->file('favicon_file')->store('uploads/settings', 'public');
            $validated['favicon'] = 'storage/' . $path;
        }

        unset(
            $validated['logo_file'],
            $validated['favicon_file'],
            $validated['remove_logo'],
            $validated['remove_favicon']
        );

        $setting->update($validated);

        ActivityLogger::log(
            module: 'settings',
            action: 'update',
            description: 'Updated website settings.',
            subject: $setting,
            properties: [
                'site_name' => $setting->site_name,
                'site_email' => $setting->site_email,
            ],
            request: $request
        );

        return redirect()
            ->route('admin.settings.edit')
            ->with('success', 'Settings updated successfully.');
    }
}