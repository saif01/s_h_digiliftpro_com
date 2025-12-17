<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];

    protected $casts = [
        'published' => 'boolean',
    ];

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function services()
    {
        return $this->belongsToMany(Service::class, 'category_service')->withTimestamps();
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'category_product')->withTimestamps();
    }

    public function posts()
    {
        return $this->belongsToMany(BlogPost::class, 'category_post')->withTimestamps();
    }

    public function portfolio()
    {
        return $this->belongsToMany(Portfolio::class, 'category_portfolio')->withTimestamps();
    }
}


