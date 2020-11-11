<?php

namespace App\Http\Controllers\Api\V1\Cars;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\Cars\CarsCollection;
use App\Models\Cars\Car;
use Illuminate\Http\Request;
use MarcinOrlowski\ResponseBuilder\ResponseBuilder;

class CarsController extends Controller
{
    public function index()
    {
        return ResponseBuilder::success(CarsCollection::collection(Car::Avaiable()->get()));
    }
}
