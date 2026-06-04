<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'user_id',
        'gender',
        'birth_date',
        'weight',
        'height',
        'chronic_diseases',
    ];

    protected $casts = [
        'birth_date' => 'date',
    ];

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function visits()
    {
        return $this->hasMany(Visit::class);
    }

    public function prescriptions()
    {
        return $this->hasMany(Prescription::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
