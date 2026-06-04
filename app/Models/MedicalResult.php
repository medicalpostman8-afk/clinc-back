<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class MedicalResult extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'result_date',
    ];

    protected $casts = [
        'result_date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
