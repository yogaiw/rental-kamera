<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ForgetPasswordController extends Controller
{
    public function index() {
        return view('forgetpassword');
    }

    public function sendResetLink(Request $request) {
        $this->validate($request, [
            'email' => 'required|email|exists:users'
        ]);

        $token = Str::random(64);

        DB::table('password_resets')->insert([
            'email' => $request['email'],
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        Mail::send('emails.forgetpassword',['token' => $token], function($message) use($request) {
            $message->to($request['email']);
            $message->subject('Kancil Rental Online: Permintaan Reset Password');
        });

        return back()->with('message', 'Silakan cek email anda');
    }

    public function resetPasswordIndex($token) {
        return view('resetpassword',['token' => $token]);
    }

    public function resetPassword(Request $request) {
        $this->validate($request,[
            'email' => 'required|email|exists:users',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required',
        ]);

        $updatePassword = DB::table('password_resets')->where(['email' => $request->email, 'token' => $request->token])->first();

        if(!$updatePassword) {
            return back()->withInput()->with('error', 'Invalid token!');
        }

        User::where('email', $request->email)->update(['password' => Hash::make($request->password)]);
        DB::table('password_resets')->where(['email'=> $request->email])->delete();

        return redirect(route('home'))->with('success_reset_password', 'Reset Password Berhasil!');
    }
}
