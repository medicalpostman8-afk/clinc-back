<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'invoice_number' => 'INV-' . str_pad($this->id, 6, '0', STR_PAD_LEFT),

            'date' => $this->date,
            'time' => $this->time,

            'patient' => [
                'id' => $this->patient?->id,
                'name' => $this->patient?->name,
                'phone' => $this->patient?->phone,
            ],

            'doctor' => [
                'id' => $this->doctor?->id,
                'name' => $this->doctor?->name,
            ],

            'type' => $this->type,
            'notes' => $this->notes,
            'descriptions' => $this->descriptions,

            'amount' => (float) $this->price,

            'reservation_status' => [
                'value' => $this->status,
                'label' => match ($this->status) {
                    'pending' => 'في الانتظار',
                    'completed' => 'المنتهية',
                    'cancelled' => 'ملغية',
                    default => $this->status,
                },
            ],

            'payment_status' => [
                'value' => $this->status === 'completed' ? 'paid' : 'unpaid',
                'label' => $this->status === 'completed' ? 'مدفوع' : 'غير مدفوع',
            ],

            'created_at' => $this->created_at?->format('Y-m-d H:i'),
        ];
    }
}
