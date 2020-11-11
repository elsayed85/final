<?php

namespace App\Http\Resources\Api\V1\Cars;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CarsCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
