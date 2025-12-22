<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'features' => 'array',
        'benefits' => 'array',
        'published' => 'boolean',
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_service')->withTimestamps();
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'tag_service')->withTimestamps();
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}


