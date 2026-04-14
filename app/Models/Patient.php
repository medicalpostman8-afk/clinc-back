<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $fillable = [
        'name',
        'phone'
    ];

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
