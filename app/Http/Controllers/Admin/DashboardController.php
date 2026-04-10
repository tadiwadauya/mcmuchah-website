<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactInquiry;
use App\Models\ContentBlock;
use App\Models\Service;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $contentBlocksCount = ContentBlock::count();
        $servicesCount = Service::count();
        $inquiriesCount = ContactInquiry::count();
        $unreadInquiriesCount = ContactInquiry::where('is_read', false)->count();

        $latestInquiries = ContactInquiry::latest()->take(5)->get();
        $latestContentBlocks = ContentBlock::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'contentBlocksCount',
            'servicesCount',
            'inquiriesCount',
            'unreadInquiriesCount',
            'latestInquiries',
            'latestContentBlocks'
        ));
    }
}