<?php

namespace App\Models\Users;

use App\Models\Users\Traits\PhoneVerificationTrait;
use Cog\Contracts\Ban\Bannable as BannableContract;
use Cog\Laravel\Ban\Traits\Bannable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements HasMedia, BannableContract, MustVerifyEmail
{
    use Notifiable, HasApiTokens, HasMediaTrait, Bannable, PhoneVerificationTrait, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'geneder', 'birthdate', 'phone'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'phone_verified_at' => 'datetime',
        'birthdate' => "date"
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'updated_at', 'birthdate', 'banned_at', 'phone_verified_at', 'email_verified_at'];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['avatar'];


    // Media Libraray
    public function registerMediaCollections()
    {
        $this->addMediaCollection('avatar')
            ->singleFile()
            ->useFallbackUrl('https://ui-avatars.com/api/?rounded=true&size=200&name=' . $this->name)
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/jpg']);
    }


    public function getAvatarAttribute()
    {
        return optional($this->getFirstMedia("avatar"))->getFullUrl();
    }

    public function scopeMale($query)
    {
        return $query->where('gender', 'm');
    }

    public function scopeFemale($query)
    {
        return $query->where('gender', 'f');
    }

    public function locations()
    {
        return $this->hasMany(Location::class);
    }

    public function lastLocation()
    {
        return $this->locations()->latest()->last();
    }
}
