<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class User extends Authenticatable implements HasMedia
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens,
        HasFactory,
        Notifiable,
        SoftDeletes,
        HasRoles,
        InteractsWithMedia;

    /**
     * Available account types
     *
     * @var array
     */
    const AVAILABLE_ACCOUNT_TYPES = [
        self::USER_TYPE,
        self::EMPLOYEE_TYPE
    ];

    /**
     * User account type
     *
     * @var string
     */
    const USER_TYPE = 'user';

    /**
     * Employee account type
     *
     * @var string
     */
    const EMPLOYEE_TYPE = 'employee';


    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'type',
        'email',
        'phone',
        'address',
        'latitude',
        'longitude',
        'password',
        'is_active',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('avatar')
            ->singleFile();
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('sm')
            ->performOnCollections('avatar')
            ->width(100)
            ->height(100)
            ->nonOptimized()
            ->format('webp');

        $this->addMediaConversion('lg')
            ->performOnCollections('avatar')
            ->width(500)
            ->height(500)
            ->nonOptimized()
            ->format('webp');
    }

    public function getAvatarUrl(string $conversionName = ''): string|null
    {
        return $this->getMedia('avatar')
            ->first()
            ?->getUrl($conversionName);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'doctor_id');
    }

    public function patient()
    {
        return $this->hasOne(Patient::class);
    }
}
