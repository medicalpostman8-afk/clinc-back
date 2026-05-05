<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
        'doctor_id',
        'invoice_number',
        'date',
        'amount',
        'type',
        'notes',
    ];

    public function doctor()
    {
        return $this->belongsTo(User::class);
    }
}
