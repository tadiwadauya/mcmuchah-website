<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Setting;
use Illuminate\View\View;

class ServicesController extends Controller
{
    public function index(): View
    {
        $setting = Setting::current();

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

        return view('pages.services', compact(
            'setting',
            'navbarServices',
            'printingServices',
            'promoServices',
            'digitalServices',
            'otherServices'
        ));
    }
}