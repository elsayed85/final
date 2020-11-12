<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use MarcinOrlowski\ResponseBuilder\ResponseBuilder;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        if (auth()->attempt($this->credentials())) {
            return ResponseBuilder::success([
                'token' => auth()->user()->createToken('mobile')->plainTextToken,
                'token_type' => "Bearer"
            ]);
        }
        throw ValidationException::withMessages(['email' => "email or password is wrong"]);
    }

    protected function credentials()
    {
        if (is_numeric(request('email'))) {
            return ['phone' => request('email'), 'password' => request('password')];
        } elseif (filter_var(request('email'), FILTER_VALIDATE_EMAIL)) {
            return ['email' => request('email'), 'password' => request('password')];
        }
    }
}
