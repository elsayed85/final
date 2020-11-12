<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CarResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "brand" =>  optional($this->brand)->name,
            "current_speed" =>  $this->current_speed,
            "avaiable" =>  $this->avaiable,
            "extra" => $this->mergeWhen($this->avaiable, ['name' => "ahmed"])
        ];
    }
}
