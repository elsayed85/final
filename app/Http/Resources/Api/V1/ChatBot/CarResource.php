<?php

namespace App\Http\Resources\Api\V1\ChatBot;

use Illuminate\Http\Resources\Json\JsonResource;

class CarResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            "title" => optional($this->brand)->name  . " Car #" . $this->id,
            "image_url" => "https://ukvehicledata.co.uk/images/redcar.png",
            "subtitle" => "brand: " . optional($this->brand)->name,
            "buttons" => [
                [
                    "type" => "web_url",
                    "url" => route('cars.index', ['car' =>  $this->id]),
                    "title" => "Take it"
                ]
            ]
        ];
    }
}
