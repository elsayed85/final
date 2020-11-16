<?php

namespace App\Http\Controllers\Api\V1\ChatBot;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Intervention\Image\Facades\Image;
use Intervention\Image\ImageManager;

class ProfileController extends Controller
{
    public function profile()
    {
        return auth()->user();
    }

    public function updateAvatar(Request $request)
    {
        $fileName = 'avatar_' . auth()->id() . ".png";

        $fullFilePath = \Storage::disk('public')->get($request->avatar);
        return $fullFilePath;


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
