<?php

namespace App\Http\Resources\Api\V1\ChatBot;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CarCollection extends ResourceCollection
{
    public $collects = CarResource::class;
    
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection;
    }
}
