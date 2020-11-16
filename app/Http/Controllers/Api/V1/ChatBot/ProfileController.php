<?php

namespace App\Http\Controllers\Api\V1\ChatBot;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function profile()
    {
        return auth()->user();
    }

    public function updateAvatar(Request $request)
    {
        $file = Storage::disk('local')->put('avatar_' . auth()->id(), $request->avatar);
        return $file;

        auth()->user()->addMediaFromRequest($request->avatar)->usingFileName("fb_avatar.png")->usingName("fb_avatar.png")->toMediaCollection('avatar');
        return response()->json([
            "messages" =>  [
                [
                    "attachment" =>  [
                        "type" => "image",
                        "payload" => [
                            "url" => auth()->user()->avatar
                        ]
                    ]
                ]
            ]
        ]);
    }
}
