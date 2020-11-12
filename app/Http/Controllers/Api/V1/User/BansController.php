<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\User\BansResource;
use Illuminate\Http\Request;
use MarcinOrlowski\ResponseBuilder\ResponseBuilder;

class BansController extends Controller
{
    public function index()
    {
        return  ResponseBuilder::success(BansResource::collection(auth()->user()->bans));
    }
}
