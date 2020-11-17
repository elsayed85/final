<?php

namespace App\Http\Controllers\Api\V1\ChatBot;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\ChatBot\CarResource;
use App\Models\Cars\Car;
use Illuminate\Http\Request;

class CarsController extends Controller
{
    public function index()
    {
        return response()->json([
            "messages" =>  [
                [
                    "attachment" =>  [
                        "type" => "template",
                        "payload" => [
                            "template_type" =>  "generic",
                            "image_aspect_ratio" => "square",
                            "elements" => CarResource::collection(Car::Avaiable()->latest()->take(5)),
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
