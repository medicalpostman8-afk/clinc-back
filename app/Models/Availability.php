<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Availability extends Model
{
    protected $fillable = [
        'doctor_id',
        'date',
        'start_time',
        'end_time',
        'max_patients',
    ];

    public function doctor()
    {
        return $this->belongsTo(User::class);
    }
}
