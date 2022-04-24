<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\Category;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index() {
        return view('admin.admin',[
            'loggedUsername' => Auth::user()->name,
            'total_user' => User::where('isAdmin',0)->count(),
            'total_alat' => Alat::count(),
            'total_kategori' => Category::count(),
            'total_penyewaan' => Payment::count(),
        ]);
    }

    public function usermanagement() {

        $user = User::with(['payment'])->get();

        return view('admin.user.user',[
            'penyewa' => $user->where('isAdmin', false),
            'admin' => $user->where('isAdmin', true)
        ]);
    }

    public function newUser(Request $request) {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5|max:255',
            'telepon' => 'required|max:15'
        ]);

        $validated['password'] = Hash::make($validated['password']);
        User::create($validated);
        $request->session()->flash('registrasi', 'Registrasi Berhasil, Silakan login untuk mulai menyewa');

        return redirect(route('admin.user'));
    }

    public function newOrderIndex($userId) {
        $user = User::find($userId);

        return view('admin.penyewaan.reservasibaru',[
            'user' => $user
        ]);
    }
}
