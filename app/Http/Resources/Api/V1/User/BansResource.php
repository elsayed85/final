<?php

namespace App\Http\Resources\Api\V1\User;

use Illuminate\Http\Resources\Json\JsonResource;

class BansResource extends JsonResource
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
            'messsage' => $this->comment,
            'expired_at_fo_humans' => $this->expired_at->diffForHumans(),
            'expired_at_fo_humans' => $this->expired_at->format("Y-m-d h:i:s")
        ];
    }
}
