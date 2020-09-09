<?php

namespace App\Http\Controllers\Security;

use App\Http\Controllers\Controller;
use App\TblStudent;
use Illuminate\Http\Request;

use Sentinel;
use Reminder;
use Mail;
class ForgotPassword extends Controller
{
    public function forgot()
    {
        return view('student.forgot');
    }

    public function password(Request $request)
    {
       $user = TblStudent::whereEmail($request->email)->first();

       if($user == null)
       {
           return redirect()->back()->with(['error'=>'Email not Exists']);
       }
       $user = Sentinel::findById($user->id);
       $reminder= Reminder::exist($user) ? :Reminder::create($user);
       $this->sendEmail($user,$reminder->code);

      return redirect()->back()->with(['success'=>'Reset code sent to your email.']);
    }
    public function sendEmail($user,$code)
    {
        Mail::send(
            'email.forgot',
            ['user'=>$user,'code'=>$code],
            function($message) use ($user){
                $message->to($user->email);
                $message->subject("$user->name, reset your password");

            }
        );
    }
}
