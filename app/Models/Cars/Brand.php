<?php

namespace App\Models\Cars;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'car_brands';

    public function cars()
    {
        return $this->hasMany(Car::class);
    }
}
