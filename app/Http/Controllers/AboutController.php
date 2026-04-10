<?php

namespace App\Http\Controllers;

use App\Models\ContentBlock;
use App\Models\Service;
use App\Models\Setting;
use Illuminate\View\View;

class AboutController extends Controller
{
    public function index(): View
    {
        $blocks = ContentBlock::where('page', 'about')
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get()
            ->keyBy('section_key');

        $navbarServices = Service::where('is_active', true)
            ->where('show_in_navbar', true)
            ->where('show_on_home', true)
            ->orderBy('sort_order')
            ->get();

        $setting = Setting::current();

        return view('pages.about', compact(
            'blocks',
            'navbarServices',
            'setting'
        ));
    }
}