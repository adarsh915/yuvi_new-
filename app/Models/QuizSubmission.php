<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizSubmission extends Model
{
    protected $fillable = ['name', 'phone', 'email', 'city', 'answers_json', 'is_read'];

    protected $casts = [
        'answers_json' => 'array'
    ];
}
