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
        return response()->json([
            "messages" =>  [
                ["text" => "this is a test image for u"],
                [
                    "attachment" =>  [
                        "type" => "image",
                        "payload" => [
                            "url" => "https://ewscripps.brightspotcdn.com/dims4/default/5194996/2147483647/strip/true/crop/1000x563+0+0/resize/1280x720!/quality/90/?url=https%3A%2F%2Fewscripps.brightspotcdn.com%2Fe9%2F93%2Fa52c003f42ea9ebb36550ca123eb%2Fmike-kelly.png"
                        ]
                    ]
                ],
                [
                    "attachment" =>  [
                        "type" => "template",
                        "payload" => [
                            "template_type" =>  "button",
                            "buttons" =>  [
                                [
                                    "type" =>  "web_url",
                                    "url" =>  "https://erada-soft.com/sdc/public/profile",
                                    "webview_height_ratio" =>  "compact",
                                    "title" =>  "Change Avatar"
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ]);
    }
}
