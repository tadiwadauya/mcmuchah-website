<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Setting;
use Illuminate\View\View;

class ContactPageController extends Controller
{
    public function index(): View
    {
        $setting = Setting::current();

        $navbarServices = Service::where('is_active', true)
            ->where('show_in_navbar', true)
            ->where('show_on_home', true)
            ->orderBy('sort_order')
            ->get();

        return view('pages.contact', compact('setting', 'navbarServices'));
    }
}