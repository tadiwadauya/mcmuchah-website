<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Service extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'description',
        'image',
        'icon',
        'category',
        'group_name',
        'button_text',
        'button_link',
        'client_link',
        'show_on_home',
        'show_in_navbar',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'show_on_home' => 'boolean',
        'show_in_navbar' => 'boolean',
        'is_active' => 'boolean',
    ];

    protected static function booted(): void
    {
        static::saving(function (Service $service) {
            if (empty($service->slug)) {
                $service->slug = Str::slug($service->title);
            }
        });
    }

    public function getImageUrlAttribute(): ?string
    {
        if (!$this->image) {
            return null;
        }

        if (str_starts_with($this->image, 'http://') || str_starts_with($this->image, 'https://')) {
            return $this->image;
        }

        if (str_starts_with($this->image, 'storage/')) {
            return asset($this->image);
        }

        return asset($this->image);
    }
}