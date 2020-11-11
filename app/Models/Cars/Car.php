<?php

namespace App\Models\Cars;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'avaiable' => 'boolean',
    ];

    public function scopeAvaiable($query)
    {
        return $query->where('avaiable', true);
    }

    public function scopeNotAvaiable($query)
    {
        return $query->where('avaiable', false);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function location()
    {
        return $this->hasOne(Location::class);
    }
}
