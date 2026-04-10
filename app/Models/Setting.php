<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'site_name',
        'site_email',
        'site_phone',
        'whatsapp_number',
        'address',
        'facebook_url',
        'instagram_url',
        'linkedin_url',
        'twitter_url',
        'logo',
        'favicon',
        'seo_title',
        'seo_description',
        'footer_text',
    ];

    public function getLogoUrlAttribute(): ?string
    {
        if (!$this->logo) {
            return null;
        }

        if (str_starts_with($this->logo, 'http://') || str_starts_with($this->logo, 'https://')) {
            return $this->logo;
        }

        return asset($this->logo);
    }

    public function getFaviconUrlAttribute(): ?string
    {
        if (!$this->favicon) {
            return null;
        }

        if (str_starts_with($this->favicon, 'http://') || str_starts_with($this->favicon, 'https://')) {
            return $this->favicon;
        }

        return asset($this->favicon);
    }

    public static function current(): self
    {
        return static::first() ?? static::create([]);
    }
}