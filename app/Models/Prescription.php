<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    protected $fillable = [
        'visit_id',
        'medicine_name',
        'dose',
        'duration',
        'frequency',
        'notes'
    ];
}
