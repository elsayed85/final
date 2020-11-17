<?php

namespace App\Http\Resources\Api\V1\ChatBot;

use Illuminate\Http\Resources\Json\JsonResource;

class CarResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            "title" => "Car #" . $this->id,
            "image_url" => "https://via.placeholder.com/150/000/000?Text=" . optional($this->brand)->name,
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
