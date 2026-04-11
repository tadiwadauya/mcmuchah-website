<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Setting;
use Illuminate\Http\Response;
use Illuminate\View\View;

class ServicesController extends Controller
{
    protected array $servicePages = [
        'branding-large-format-printing' => [
            'title' => 'Branding / Large Format Printing',
            'category' => 'printing',
            'group_name' => null,
            'description' => 'Professional branding and large format printing solutions for strong visual impact.',
        ],
        'promotional-materials' => [
            'title' => 'Promotional Materials',
            'category' => 'promo',
            'group_name' => null,
            'description' => 'Promotional printing solutions to support campaigns, awareness, and product visibility.',
        ],
        'corporate-gifts' => [
            'title' => 'Corporate Gifts',
            'category' => null,
            'group_name' => 'Corporate Gifts',
            'description' => 'Branded corporate gift solutions including promotional items and giveaways.',
        ],
        'digital-marketing' => [
            'title' => 'Digital Marketing',
            'category' => 'digital',
            'group_name' => null,
            'description' => 'Digital marketing solutions that increase reach, visibility, and customer engagement.',
        ],
        'graphic-designing' => [
            'title' => 'Graphic Designing',
            'category' => 'other',
            'group_name' => 'Graphic Design',
            'description' => 'Creative design services for logos, flyers, brochures, profiles, and business visuals.',
        ],
        'social-media-management' => [
            'title' => 'Social Media Management',
            'category' => 'other',
            'group_name' => 'Social Media Management',
            'description' => 'Content creation, page management, advertising, and growth support for social platforms.',
        ],
        'business-services' => [
            'title' => 'Business Services',
            'category' => 'other',
            'group_name' => 'Business Services',
            'description' => 'Business support services including consultancy, registration, development, and PR.',
        ],
    ];

    public function index(): View
    {
        $setting = Setting::current();

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

        $servicePages = $this->servicePages;

        return view('pages.services', compact(
            'setting',
            'printingServices',
            'promoServices',
            'digitalServices',
            'otherServices',
            'servicePages'
        ));
    }

    public function show(string $slug): View
    {
        abort_unless(array_key_exists($slug, $this->servicePages), Response::HTTP_NOT_FOUND);

        $setting = Setting::current();
        $servicePages = $this->servicePages;
        $page = $this->servicePages[$slug];

        $query = Service::query()->where('is_active', true);

        if (!empty($page['category'])) {
            $query->where('category', $page['category']);
        }

        if (!empty($page['group_name'])) {
            $query->where('group_name', $page['group_name']);
        }

        if ($slug === 'corporate-gifts') {
            $query->where(function ($q) {
                $q->where('title', 'like', '%corporate gift%')
                    ->orWhere('excerpt', 'like', '%corporate gift%')
                    ->orWhere('description', 'like', '%corporate gift%')
                    ->orWhere('group_name', 'Corporate Gifts');
            });
        }

        $services = $query->orderBy('sort_order')->get();

        return view('pages.service-category', compact(
            'setting',
            'servicePages',
            'page',
            'services',
            'slug'
        ));
    }
}