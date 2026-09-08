<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Project extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'category',
        'year',
        'description',
        'thumbnail',
        'technologies',
        'github_url',
        'live_url',
        'featured',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'technologies' => 'array',
            'featured' => 'boolean',
        ];
    }
}