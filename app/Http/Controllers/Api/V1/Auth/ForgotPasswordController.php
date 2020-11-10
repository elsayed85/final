<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Auth\ForgetPasswordRequest;
use App\Jobs\Api\V1\Auth\ForgetPasswordJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use MarcinOrlowski\ResponseBuilder\ResponseBuilder;

class ForgotPasswordController extends Controller
{
    public function reset(ForgetPasswordRequest $request)
    {
        dispatch(new ForgetPasswordJob($request->validated()));
        return ResponseBuilder::success(null, 200);
    }
}
