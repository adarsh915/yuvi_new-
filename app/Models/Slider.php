<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $fillable = [
        'image',
        'is_active',
        'order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}