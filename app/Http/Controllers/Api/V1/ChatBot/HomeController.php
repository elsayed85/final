<?php

namespace App\Http\Controllers\Api\V1\ChatBot;

use App\Http\Controllers\Controller;
use App\Models\Users\ChatBotUser;
use App\Models\Users\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function CheckIfUserExist(Request $request)
    {
        if ($user = User::whereEmail($request->email)->first()) {
            return response()->json([
                "set_attributes" => [
                    "user_exist" => true,
                    'personal_token' => "Bearer " . $user->createToken('chatbot')->plainTextToken
                ]
            ]);
        }

        return response()->json([
            "set_attributes" => [
                "user_exist" => false,
            ]
        ]);
    }

    public function generateNewToekn(Request $request)
    {
        $request->validate([
            'bot_key' => ['required'],
            'bot_secret' => ['required'],
            'email' => ['required', 'email', 'exists:users,email']
        ]);

        $user = User::whereEmail($request->email)->first();

        return $user;
    }
}
