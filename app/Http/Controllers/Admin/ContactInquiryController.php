<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactInquiry;
use App\Support\ActivityLogger;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\View\View;

class ContactInquiryController extends Controller
{
    public function index(Request $request): View
    {
        $query = ContactInquiry::query();

        if ($request->filled('status')) {
            if ($request->string('status')->toString() === 'read') {
                $query->where('is_read', true);
            }

            if ($request->string('status')->toString() === 'unread') {
                $query->where('is_read', false);
            }
        }

        if ($request->filled('search')) {
            $search = trim($request->string('search')->toString());

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%')
                    ->orWhere('phone', 'like', '%' . $search . '%')
                    ->orWhere('subject', 'like', '%' . $search . '%')
                    ->orWhere('message', 'like', '%' . $search . '%');
            });
        }

        $inquiries = $query->latest()->paginate(15)->withQueryString();

        return view('admin.inquiries.index', compact('inquiries'));
    }

    public function show(ContactInquiry $inquiry): View
    {
        if (!$inquiry->is_read) {
            $inquiry->update([
                'is_read' => true,
                'read_at' => Carbon::now(),
            ]);

            ActivityLogger::log(
                module: 'contact_inquiries',
                action: 'mark_read',
                description: 'Opened inquiry and marked as read: ' . $inquiry->name,
                subject: $inquiry,
                request: request()
            );
        }

        return view('admin.inquiries.show', compact('inquiry'));
    }

    public function toggleRead(ContactInquiry $inquiry): RedirectResponse
    {
        $inquiry->update([
            'is_read' => !$inquiry->is_read,
            'read_at' => !$inquiry->is_read ? now() : null,
        ]);

        ActivityLogger::log(
            module: 'contact_inquiries',
            action: 'toggle_read',
            description: 'Toggled inquiry read status: ' . $inquiry->name,
            subject: $inquiry,
            properties: [
                'is_read' => $inquiry->is_read,
            ],
            request: request()
        );

        return back()->with('success', 'Inquiry status updated successfully.');
    }

    public function destroy(ContactInquiry $inquiry): RedirectResponse
    {
        ActivityLogger::log(
            module: 'contact_inquiries',
            action: 'delete',
            description: 'Deleted inquiry: ' . $inquiry->name,
            subject: $inquiry,
            request: request()
        );

        $inquiry->delete();

        return redirect()
            ->route('admin.inquiries.index')
            ->with('success', 'Inquiry deleted successfully.');
    }
}