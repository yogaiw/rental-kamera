<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index() {
        return view('registration');
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5|max:255',
        ]);

        $validated['password'] = Hash::make($validated['password']);
        User::create($validated);
        $request->session()->flash('registrasi', 'Registrasi Berhasil, Silakan login untuk mulai menyewa');

        return redirect(route('home'));
    }
}
