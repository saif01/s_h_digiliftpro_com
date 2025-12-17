<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $guarded = [];

    public function services()
    {
        return $this->belongsToMany(Service::class, 'tag_service')->withTimestamps();
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'tag_product')->withTimestamps();
    }

    public function posts()
    {
        return $this->belongsToMany(BlogPost::class, 'tag_post')->withTimestamps();
    }

    public function portfolio()
    {
        return $this->belongsToMany(Portfolio::class, 'tag_portfolio')->withTimestamps();
    }
}


