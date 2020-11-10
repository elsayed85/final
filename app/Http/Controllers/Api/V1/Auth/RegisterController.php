<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Auth\RegisterRequest;
use App\Models\Users\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use MarcinOrlowski\ResponseBuilder\ResponseBuilder;

class RegisterController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $user = User::create(collect($request->only(['name', 'email', 'geneder', 'birthdate', 'phone']))->push(['password' => Hash::make($request->password)]));

        if ($request->has('avatar')) {
            $avatar = $request->file('avatar');
            $user->addMedia($avatar)->usingFileName($avatar->getClientOriginalName())->usingName($avatar->getClientOriginalName())->toMediaCollection('avatar');
        }

        return ResponseBuilder::success([
            'user' => $user,
            'token' => $user->createToken('mobile')->plainTextToken,
            'token_type' => "Bearer"
        ]);
    }
}
