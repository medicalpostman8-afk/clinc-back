<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Visit extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'patient_id',
        'doctor_id',
        'type',
        'diagnosis'
    ];

    public function prescriptions()
    {
        return $this->hasMany(Prescription::class);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('analysis');
        $this->addMediaCollection('xray');
    }
}
