<?php

namespace App\Models\Cars;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'car_locations';

    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    public function coordinates()
    {
        return collect(["lat" =>  $this->lat, 'lang' =>  $this->lang]);
    }
}
