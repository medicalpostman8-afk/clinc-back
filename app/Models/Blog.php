<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Blog extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'doctor_id',
        'title',
        'description',
        'url',
        'status',
    ];

    protected $casts = [
        'title' => 'array',
        'description' => 'array',
    ];

    public function doctor()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
}
