<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactField extends Model
{
    protected $fillable = ['label', 'name', 'type', 'category', 'options', 'is_required', 'order', 'placeholder'];
}
