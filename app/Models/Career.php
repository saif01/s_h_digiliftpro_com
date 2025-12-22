<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Career extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'deadline' => 'date',
        'published' => 'boolean',
    ];

    public function applications()
    {
        return $this->hasMany(JobApplication::class, 'career_id');
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


