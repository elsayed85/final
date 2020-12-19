<?php

namespace App\Http\Controllers\Api\BioCode;

use App\Http\Controllers\Controller;
use App\Jobs\SendBioCodeUserEmailJob;
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

        if(!$request->has("from_mansoura_university"))
        {
            $request->request->add(['from_mansoura_university' => false]);
        }else{
            $request->request->add(['from_mansoura_university' => true]);
        }

        $usersFromMansoura = User::where('from_mansoura_university' , true)->count();
        $userNotFromMansoura = User::where('from_mansoura_university' , false)->count();

        /* if($request->from_mansoura_university && $usersFromMansoura >= 100){
            return response()->json([
                'success' => false,
                'message' => "لقد تم إغلاق الحجز لطلاب جامعه المنصوره لإكتمال العدد"
            ]);
        }elseif(!$request->from_mansoura_university && $userNotFromMansoura >= 80){
            return response()->json([
                'success' => false,
                'message' => "لقد تم إغلاق الحجز لمن هم خارج جامعه المنصوره لإكتمال العدد"
            ]);
        } */

        $user = User::create([
            'name' => $request->name,
            'email' =>  $request->email,
            'phone' => $request->phone,
            'from_mansoura_university' => $request->from_mansoura_university,
        ]);

        try {
            dispatch(new SendBioCodeUserEmailJob($user));
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
                'message' => "تم التسجيل بنجاح وبرجاء الاحتفاظ برقم التذكره",
                'ticket' => [
                    'id' => $user->id,
                    'paid' => !$user->from_mansoura_university,
                    'price' => $user->ticket_price
                ]
            ]);
        }
    }

    public function getAllMessages(Request $request)
    {
        $data = User::latest();
        if($request->has('id')){
            $data->where('id' , $request->id);
        }
        if($request->has('name')){
            $data->where('name' , 'like' , "%" . $request->name . "%");
        }
        if($request->has('phone')){
            $data->where('phone' , 'like' , "%" . $request->phone . "%");
        }
        if($request->has('email')){
            $data->where('email' , 'like' , "%" . $request->email . "%");
        }
        if($request->has('from_mansoura_university')){
            $data->where('from_mansoura_university' , $request->from_mansoura_university);
        }

        return response()->json([
            'users' => $request->has("all") ? $data->get() : $data->paginate(25)
        ]);
        
    }
}
