<?php

namespace App\Http\Controllers\Api\BioCode;

use App\Http\Controllers\Controller;
use App\Mail\BioCodeUserMail;
use App\Models\BioCode\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MessagesController extends Controller
{
    public function send(Request $request)
    {
        $request->validate([
            'name' => ['required', 'min:3', 'max:40'],
            'email' => ['required', 'email', 'max:60', 'unique:bio_code_users,email'],
            'phone' => ['required', 'min:10', 'max:30', 'unique:bio_code_users,phone'],
            'from_mansoura_university' => ['nullable' , 'boolean'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' =>  $request->email,
            'phone' => $request->phone,
            'from_mansoura_university' => $request->from_mansoura_university ?? false,
        ]);

        try {
            Mail::to($request->email)->send(new BioCodeUserMail($user));
        } catch (Exception $e) {
            //
        }


        return response()->json([
            'user_id' => $user->id,
            'success' =>  true
        ]);
    }

    public function getAllMessages()
    {
        return response()->json([
            'messages' => Message::latest()->paginate(10)
        ]);
    }
}
