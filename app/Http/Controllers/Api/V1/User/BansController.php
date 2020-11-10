<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use MarcinOrlowski\ResponseBuilder\ResponseBuilder;

class BansController extends Controller
{
    public function index()
    {
        return  ResponseBuilder::success(auth()->user()->bans);
    }
}
