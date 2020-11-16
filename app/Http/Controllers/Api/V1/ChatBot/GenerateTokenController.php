<?php

namespace App\Http\Controllers\Api\V1\ChatBot;

use App\Http\Controllers\Controller;
use App\Models\Users\ChatBotUser;
use App\Models\Users\User;
use Illuminate\Http\Request;

class GenerateTokenController extends Controller
{
    public function generate(Request $request)
    {
        if ($user = User::whereEmail($request->email)->first()) {
            return response()->json([
                "user_exist" => true,
                'login_url' => route('login', [
                    'email' => $request->email
                ])
            ]);
        }

        return response()->json([
            "user_exist" => false,
            'register_url' => route('register', [
                'email' => $request->email
            ])
        ]);
    }
}
