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
        $emailSent = false;

        $request->validate([
            'name' => ['required', 'min:3', 'max:40'],
            'email' => ['required', 'email', 'max:60', 'unique:bio_code_users,email'],
            'phone' => ['required', 'min:10', 'max:30', 'unique:bio_code_users,phone'],
            'from_mansoura_university' => ['nullable' , 'boolean'],
        ]);

        $usersFromMansoura = User::where('from_mansoura_university' , true)->count();

        $userNotFromMansoura = User::where('from_mansoura_university' , false)->count();

        if($request->from_mansoura_university && $usersFromMansoura >= 100){
            return response()->json([
                'success' => false,
                'message' => "لقد تم إغلاق الحجز لطلاب جامعه المنصوره لإكتمال العدد"
            ]);
        }elseif(!$request->from_mansoura_university && $userNotFromMansoura >= 80){
            return response()->json([
                'success' => false,
                'message' => "لقد تم إغلاق الحجز لمن هم خارج جامعه المنصوره لإكتمال العدد"
            ]);
        }

        $user = User::create([
            'name' => $request->name,
            'email' =>  $request->email,
            'phone' => $request->phone,
            'from_mansoura_university' => $request->from_mansoura_university ?? false,
        ]);

        try {
            Mail::to($request->email)->send(new BioCodeUserMail($user));
            $emailSent = true;
        } catch (Exception $e) {
            //
        }


        if($emailSent){
            return response()->json([
                'success' => true,
                'message' => "لقد تم إرسال رسالة على بريدك الالكتروني  تحتوي على معلومات التسجيل ورقم التذكره ",
                'ticket' => [
                    'id' => $user->id,
                    'paid' => !$user->from_mansoura_university,
                    'price' => $user->ticket_price
                ]
            ]);
        }else{
            return response()->json([
                'success' => true,
                'message' => "تم التسجيل بنجاح و يرجاء الاحتفاظ برقم التذكره",
                'ticket' => [
                    'id' => $user->id,
                    'paid' => !$user->from_mansoura_university,
                    'price' => $user->ticket_price
                ]
            ]);
        }
    }

    public function getAllMessages()
    {
        return response()->json([
            'messages' => Message::latest()->paginate(10)
        ]);
    }
}
