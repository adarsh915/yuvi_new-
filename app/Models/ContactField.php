<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactField extends Model
{
    protected $fillable = ['label', 'name', 'type', 'category', 'options', 'is_required', 'is_active', 'order', 'placeholder'];
    
    protected $casts = [
        'is_required' => 'boolean',
        'is_active' => 'boolean',
    ];
}
