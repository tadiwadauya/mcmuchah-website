<?php

namespace Database\Seeders;

use App\Models\ContentBlock;
use Illuminate\Database\Seeder;

class WebsiteContentSeeder extends Seeder
{
    public function run(): void
    {
        $blocks = [
            ['page' => 'home', 'section_key' => 'home_hero_subheading', 'label' => 'Home Hero Subheading', 'title' => 'Welcome to McMupah Marketing.', 'body' => null, 'sort_order' => 1],
            ['page' => 'home', 'section_key' => 'home_hero_heading', 'label' => 'Home Hero Heading', 'title' => 'Excellence Delivered.', 'body' => null, 'sort_order' => 2],
            ['page' => 'home', 'section_key' => 'home_about_heading', 'label' => 'Home About Heading', 'title' => 'Bold Branding That Gets You Seen.', 'body' => null, 'sort_order' => 3],
            ['page' => 'home', 'section_key' => 'home_about_body', 'label' => 'Home About Body', 'title' => null, 'body' => '<p>We help businesses stand out through powerful branding, large format printing, and smart marketing solutions.</p>', 'sort_order' => 4],
            ['page' => 'home', 'section_key' => 'home_vision', 'label' => 'Home Vision', 'title' => null, 'body' => '<p>Defining brands, creating value, and inspiring lives.</p>', 'sort_order' => 5],
            ['page' => 'home', 'section_key' => 'home_mission', 'label' => 'Home Mission', 'title' => null, 'body' => '<p>To provide effective branding solutions and quality products and services affordably in a fast-paced business environment.</p>', 'sort_order' => 6],
            ['page' => 'about', 'section_key' => 'about_page_heading', 'label' => 'About Page Heading', 'title' => 'About', 'body' => null, 'sort_order' => 1],
            ['page' => 'about', 'section_key' => 'about_main_heading', 'label' => 'About Main Heading', 'title' => 'Let your business gain its full potential.', 'body' => null, 'sort_order' => 2],
            ['page' => 'about', 'section_key' => 'about_intro', 'label' => 'About Intro', 'title' => null, 'body' => '<p>Full company about text goes here.</p>', 'sort_order' => 3],
            ['page' => 'about', 'section_key' => 'about_vision', 'label' => 'About Vision', 'title' => null, 'body' => '<p>Your vision here.</p>', 'sort_order' => 4],
            ['page' => 'about', 'section_key' => 'about_mission', 'label' => 'About Mission', 'title' => null, 'body' => '<p>Your mission here.</p>', 'sort_order' => 5],
            ['page' => 'about', 'section_key' => 'about_core_values', 'label' => 'About Core Values', 'title' => null, 'body' => '<ul><li>Integrity</li><li>Excellence</li><li>Innovation</li></ul>', 'sort_order' => 6],
            ['page' => 'about', 'section_key' => 'about_values', 'label' => 'About Values', 'title' => null, 'body' => '<p>Your values here.</p>', 'sort_order' => 7],
        ];

        foreach ($blocks as $block) {
            ContentBlock::updateOrCreate(
                ['section_key' => $block['section_key']],
                array_merge($block, ['is_active' => true])
            );
        }
    }
}