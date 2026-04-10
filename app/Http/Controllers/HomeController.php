<?php

namespace App\Http\Controllers;

use App\Models\ContentBlock;
use App\Models\Service;
use App\Models\Setting;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $blocks = ContentBlock::where('page', 'home')
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get()
            ->keyBy('section_key');

        $navbarServices = Service::where('is_active', true)
            ->where('show_in_navbar', true)
            ->where('show_on_home', true)
            ->orderBy('sort_order')
            ->get();

        $printingServices = Service::where('is_active', true)
            ->where('category', 'printing')
            ->orderBy('sort_order')
            ->get();

        $promoServices = Service::where('is_active', true)
            ->where('category', 'promo')
            ->orderBy('sort_order')
            ->get();

        $digitalServices = Service::where('is_active', true)
            ->where('category', 'digital')
            ->orderBy('sort_order')
            ->get();

        $otherServices = Service::where('is_active', true)
            ->where('category', 'other')
            ->orderBy('sort_order')
            ->get()
            ->groupBy('group_name');

        $tradeReferences = Service::where('is_active', true)
            ->where('category', 'trade_reference')
            ->orderBy('sort_order')
            ->get();

        $setting = Setting::current();

        return view('pages.home', compact(
            'blocks',
            'navbarServices',
            'printingServices',
            'promoServices',
            'digitalServices',
            'otherServices',
            'tradeReferences',
            'setting'
        ));
    }
}