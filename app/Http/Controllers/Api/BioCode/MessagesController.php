<?php

namespace App\Http\Controllers\Api\BioCode;

use App\Http\Controllers\Controller;
use App\Mail\BioCodeMessageMail;
use App\Models\BioCode\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MessagesController extends Controller
{
    public function send(Request $request)
    {
        $request->validate([
            'name' => ['required', 'min:3', 'max:40'],
            'email' => ['required', 'email', 'max:60' , 'unique:bio_code_messages,email'],
            'phone' => ['nullable', 'min:10', 'max:30' , 'unique:bio_code_messages,phone'],
            'message' => ['nullable', 'min:3', 'max:500'],
            'sessions' => ['required', 'array', 'min:1']
        ]);

        $message = Message::create([
            'name' => $request->name,
            'email' =>  $request->email,
            'phone' => $request->phone,
            'message' =>  $request->message,
            'sessions' => json_encode($request->sessions)
        ]);

        return $message;

        Mail::to($request->email)->send(new BioCodeMessageMail($message));

        return response()->json([
            'message' => "thanks for contact us!",
            'message_id' => $message->id
        ]);
    }

    public function getAllMessages()
    {
        return response()->json([
            'messages' => Message::latest()->paginate(10)
        ]);
    }
}
