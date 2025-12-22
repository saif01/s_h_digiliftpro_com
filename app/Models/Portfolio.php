<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Portfolio extends Model
{
    use SoftDeletes;

    protected $table = 'portfolio';

    protected $guarded = [];

    protected $casts = [
        'project_date' => 'date',
        'published' => 'boolean',
        'featured' => 'boolean',
        'images' => 'array',
        'videos' => 'array',
        'technology_stack' => 'array',
        'security' => 'array',
        'integrations' => 'array',
        'modules' => 'array',
        'key_features' => 'array',
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_portfolio')->withTimestamps();
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'tag_portfolio')->withTimestamps();
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


