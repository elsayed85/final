<?php

namespace App\Http\Controllers\Api\V1\Brodcasting;

use App\Events\NewTestMessage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function send()
    {
        broadcast(new NewTestMessage("sayed is here " .  rand(1111, 9999)))->toOthers();

        return response()->json(["success" =>  true], 200);
    }
}
