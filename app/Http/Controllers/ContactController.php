<?php

namespace App\Http\Controllers;

use App\Mail\ContactInquiryNotification;
use App\Models\ContactInquiry;
use App\Models\Setting;
use App\Support\ActivityLogger;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:255'],
            'subject' => ['nullable', 'string', 'max:255'],
            'message' => ['required', 'string'],
        ]);

        $inquiry = ContactInquiry::create($validated);

        $setting = Setting::current();

        if (!empty($setting->site_email)) {
            Mail::to($setting->site_email)->send(new ContactInquiryNotification($inquiry));
        }

        ActivityLogger::log(
            module: 'contact_inquiries',
            action: 'create',
            description: 'Public contact inquiry submitted.',
            subject: $inquiry,
            properties: [
                'name' => $inquiry->name,
                'email' => $inquiry->email,
                'subject' => $inquiry->subject,
            ],
            request: $request
        );

        return back()->with('success', 'Your enquiry has been sent successfully.');
    }
}