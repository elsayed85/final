<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use MarcinOrlowski\ResponseBuilder\ResponseBuilder;

class StatusController extends Controller
{
    public function all()
    {
        $user = auth()->user();
        return ResponseBuilder::success([
            'email_verified' => $user->hasVerifiedEmail(),
            'baned' =>  $user->isBanned(),
            'phone_verified' => $user->phoneIsVerified(),
        ]);
    }

    public function email()
    {
        return ResponseBuilder::success([
            'email_verified' => auth()->user()->hasVerifiedEmail(),
        ]);
    }

    public function phone()
    {
        return ResponseBuilder::success([
            'phone_verified' => auth()->user()->hasVerifiedEmail(),
        ]);
    }

    public function ban()
    {
        return ResponseBuilder::success([
            'baned' =>  auth()->user()->isBanned(),
        ]);
    }
}
