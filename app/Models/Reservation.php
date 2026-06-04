<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{

    const PENDING_STATUS = 'pending';
    const COMPLETED_STATUS = 'completed';
    const CANCELLED_STATUS = 'cancelled';

    const PAID_STATUS = 'paid';
    const UNPAID_STATUS = 'unpaid';

    const CARD_PAYMENT = 'card';
    const APP_PAYMENT = 'app';
    const CASH_PAYMENT = 'cash';
    protected $fillable = [
        'patient_id',
        'doctor_id',
        'date',
        'time',
        'status',
        'descriptions',
        'notes',
        'type',
        'price',
        'payment_status',
        'payment_method',
        'transaction_id',
        'paid_at',
    ];

    protected $casts = [
        'paid_at' => 'datetime',
        'date' => 'date',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }

    public function getIsPaidAttribute(): bool
    {
        return $this->payment_status === self::PAID_STATUS;
    }
}
