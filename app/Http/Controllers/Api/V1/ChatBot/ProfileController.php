<?php

namespace App\Http\Controllers\Api\V1\ChatBot;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    public function profile()
    {
        return auth()->user();
    }

    public function updateAvatar(Request $request)
    {
        $img = Image::make($request->avatar);
        header('Content-Type: image/png');
        return $img->response();

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
