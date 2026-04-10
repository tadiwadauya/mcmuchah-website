<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class WebsiteSettingSeeder extends Seeder
{
    public function run(): void
    {
        Setting::updateOrCreate(
            ['id' => 1],
            [
                'site_name' => 'McMupah Marketing',
                'site_email' => 'admin@mcmupahmarketing.co.zw',
                'site_phone' => '+263772610975',
                'whatsapp_number' => '+263772610975',
                'address' => 'Harare, Zimbabwe',
                'facebook_url' => '',
                'instagram_url' => '',
                'linkedin_url' => '',
                'twitter_url' => '',
                'logo' => 'inc/assets/images/logo-white.png',
                'favicon' => 'inc/assets/images/favicon-1.png',
                'seo_title' => 'McMupah Marketing',
                'seo_description' => 'Branding, printing, marketing, and digital growth solutions.',
                'footer_text' => 'Give us a call today on our number to experience the best services.',
            ]
        );
    }
}