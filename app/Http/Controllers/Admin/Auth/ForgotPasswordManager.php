<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ForgotPasswordManager extends Controller
{
    function forgetPassword() {
        return view('admin.auth.forget-password');
    }

    function forgetPasswordPost(Request $request){
        $request->validate([
           'email' => 'required|email|exists:users',
        ]);

        $token = Str::random(64);

        DB::table('password_reset_tokens')->upsert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ], ['email'], ['token', 'created_at']);


        Mail::send('emails.forget-password', ['token' => $token], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Reset Password');
        });

        return redirect()->to(route('forget.password'))
            ->with('success', 'We have send an email to reset password.');


    }

    function resetPassword($token){
        return view('admin.auth.new-password', compact('token'));
    }

    function resetPasswordPost(Request $request){
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required'
        ]);

        $updatePassword = DB::table('password_reset_tokens')
            ->where([
               'email' => $request->email,
                'token' => $request->token
            ])->first();

        if (!$updatePassword) {
            return redirect()->to(route('reset.password'))->with('error', 'Invalid');
        }

        User::where('email', $request->email)
            ->update(['password' => Hash::make($request->password)]);

        DB::table('password_reset_tokens')->where(['email' => $request->email])->delete();

        return redirect()->to(route('admin.login'))->with('success','Password reset success.');



    }

}
