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
        $fileName = 'avatar_' . auth()->id() . ".png";
        
        Storage::disk('public')->put($fileName, $request->avatar);

        auth()->user()->addMediaFromDisk($fileName, 'public')->usingFileName("fb_avatar.png")->usingName("fb_avatar.png")->toMediaCollection('avatar');

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
