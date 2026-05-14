<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SeoSetting extends Model
{
    protected $fillable = [
        'page_identifier',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'og_image',
    ];
}
