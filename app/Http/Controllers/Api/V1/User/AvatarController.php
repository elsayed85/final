<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\User\AvatarRequest;
use Illuminate\Http\Request;
use MarcinOrlowski\ResponseBuilder\ResponseBuilder;

class AvatarController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(AvatarRequest $request)
    {
        $avatar = $request->file('avatar');
        auth()->user()->addMedia($avatar)->usingFileName($avatar->getClientOriginalName())->usingName($avatar->getClientOriginalName())->toMediaCollection('avatar');
        return ResponseBuilder::success([
            'avatar' =>  auth()->user()->avatar
        ]);
    }
}
