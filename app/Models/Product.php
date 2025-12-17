<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'images' => 'array',
        'specifications' => 'array',
        'downloads' => 'array',
        'features' => 'array',
        'published' => 'boolean',
        'featured' => 'boolean',
        'show_price' => 'boolean',
        'price' => 'decimal:2',
        'discount_percent' => 'decimal:2',
        'discounted_price' => 'decimal:2',
        'rating' => 'decimal:2',
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_product')->withTimestamps();
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'tag_product')->withTimestamps();
    }

    public function reviews()
    {
        return $this->hasMany(ProductReview::class);
    }

    public function approvedReviews()
    {
        return $this->reviews()->where('status', 'approved');
    }

    public function updateRatingFromReviews(): void
    {
        $avg = (float) ($this->approvedReviews()->avg('rating') ?? 0);
        $count = (int) $this->approvedReviews()->count();

        $this->forceFill([
            'rating' => $avg,
            'rating_count' => $count,
        ])->save();
    }
}


