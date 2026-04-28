<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Prescription extends Model
{
    use InteractsWithMedia;

    protected $fillable = [
        'visit_id',
        'patient_id',
        'doctor_id',
        'medicine_name',
        'dose',
        'duration',
        'frequency',
        'notes'
    ];

    public function visit()
    {
        return $this->belongsTo(Visit::class);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('prescription_files')
            ->singleFile();
    }
}
