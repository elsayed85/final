<?php

namespace App\Http\Controllers\Api\V1\Cars;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\Cars\CarsCollection;
use App\Http\Resources\CarCollection;
use App\Http\Resources\CarResource;
use App\Http\Resources\User;
use App\Http\Resources\UserCollection;
use App\Models\Cars\Car;
use App\Models\Users\User as UsersUser;
use Illuminate\Http\Request;
use MarcinOrlowski\ResponseBuilder\ResponseBuilder;
use Psy\Exception\TypeErrorException;
use TypeError;

class CarsController extends Controller
{
    public function index()
    {
        return ResponseBuilder::asSuccess()
            ->withData(CarResource::collection(Car::Avaiable()->latest()->paginate(2)))
            ->build();
    }
}
