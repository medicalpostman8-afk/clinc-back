<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingInfo extends Model
{
    protected $fillable = [
        'booking_type',
        'service_price',
    ];
}
