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
                "set_attributes" => [
                    "user_exist" => true
                ],
                "redirect_to_blocks" => "login"
            ]);
        }

        return response()->json([
            "set_attributes" => [
                "user_exist" => false
            ],
            "redirect_to_blocks" => "register"
        ]);
    }
}
