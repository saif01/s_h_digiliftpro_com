<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'event_date' => 'date',
        'event_time' => 'datetime:H:i:s',
        'end_date_time' => 'datetime',
        'speakers' => 'array',
        'allow_registration' => 'boolean',
        'published' => 'boolean',
    ];
}


