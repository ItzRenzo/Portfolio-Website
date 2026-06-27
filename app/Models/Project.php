<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'category',
        'image_url',
        'external_url',
        'tags',
        'featured',
        'display_order',
        'emoji',
    ];

    protected $casts = [
        'tags' => 'array',
        'featured' => 'boolean',
    ];

    public function scopeFeatured($query)
    {
        return $query->where('featured', true)->orderBy('display_order');
    }
}
