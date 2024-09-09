<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ForgetPasswordController extends Controller
{
    public function forgetPassword()
    {
        return view('forget_password');
    }

    public function forgetPasswordPost(Request $request)
    {
        $request->validate([
            'email' => 'required|exists:users,email',
        ]);
        $token = Str::random(64);
        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
        ]);
        
        Mail::send('mail.reset_password', ['token' => $token], function ($message) use ($request){
            $message->to($request->email);
            $message->subject('Result Password');
        });

        return redirect()->to(route('reset.password', ['token' => $token]))
            ->with('success', 'We have send an email to reset password.');
    }

    function resetPassword($token)
    {
        // dd($token);
        return view('new_password', compact('token'));
    }

    function resetPasswordPost(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required'
        ]);
        $updatePassword = DB::table('password_resets')
            ->where([
                'email' => $request->email,
                'token' => $request->token,
            ])->first();
        if(!$updatePassword)
        {
            return redirect()->to(route('reset.password'))->with('error', 'Invalid');
        }
        User::where('email', $request->email)
            ->update(['password' => Hash::make($request->password)]);

        DB::table('password_resets')->where(['email' => $request->email])->delete();

        return redirect()->to(route('login'))->with('success', 'Password Reset Success');
    }
}
