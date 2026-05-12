<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'service_category_id',
        'category_tag',
        'short_description',
        'accent_class',
        'listing_image',
        'hero_eyebrow',
        'hero_lead',
        'hero_pills',
        'hero_image',
        'stat1_num',
        'stat1_label',
        'stat2_num',
        'stat2_label',
        'stat3_num',
        'stat3_label',
        'approach_title',
        'approach_text',
        'protocol_title',
        'protocol_json',
        'expect_title',
        'expect_json',
        'safety_title',
        'safety_text',
        'is_active',
        'order',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ];

    protected $casts = [
        'hero_pills' => 'array',
        'protocol_json' => 'array',
        'expect_json' => 'array',
        'is_active' => 'boolean',
    ];
    public function category()
    {
        return $this->belongsTo(ServiceCategory::class, 'service_category_id');
    }
}
