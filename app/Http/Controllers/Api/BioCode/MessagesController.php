<?php

namespace App\Http\Controllers\Api\BioCode;

use App\Http\Controllers\Controller;
use App\Models\BioCode\Message;
use Illuminate\Http\Request;

class MessagesController extends Controller
{
    public function send(Request $request)
    {
        $request->validate([
            'name' => ['required', 'min:3', 'max:40'],
            'email' => ['required', 'email', 'max:60'],
            'phone' => ['nullable', 'min:10', 'max:30'],
            'message' => ['nullable', 'min:3', 'max:500'],
            'sessions' => ['required', 'array', 'min:1']
        ]);

        return response()->json($request->all());
    }

    public function getAllMessages()
    {
        return response()->json([
            'messages' => Message::latest()->paginate(10)
        ]);
    }
}
