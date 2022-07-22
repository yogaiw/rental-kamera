<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

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

        return back()->with('message', 'Email telah dikirim untuk melakukan reset password');
    }
}
