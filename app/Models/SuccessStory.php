<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuccessStory extends Model
{
    protected $fillable = [
        'title',
        'video_url',
        'treatment_type',
        'treatment_type_id',
        'patient_name',
        'thumbnail',
        'order',
        'is_active',
    ];

    public function treatmentType()
    {
        return $this->belongsTo(TreatmentType::class);
    }
}
