<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function promote($id) {
        $user = User::find($id);
        $user->update([
            'role' => 1,
        ]);

        return back();
    }

    public function demote($id) {
        $user = User::find($id);
        $user->update([
            'role' => 0,
        ]);

        return back();
    }

    public function edit() {
        return view('account',[
            'user' => User::find(Auth::id())
        ]);
    }

    public function update(Request $request) {
        $user = User::find(Auth::id());

        $this->validate($request,[
            'name' => 'required|max:255',
            'email' => 'required|email',
            'telepon' => 'required|max:15'
        ]);

        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->telepon = $request['telepon'];
        $user->save();

        return back()->with('updated', 'Berhasil melakukan perubahan');
    }

    public function changePassword(Request $request) {
        $user = User::find(Auth::id());

        $this->validate($request,[
            'oldPassword' => 'required',
            'newPassword' => 'required',
        ]);

        if(Hash::check($request['oldPassword'], $user->password)) {
            $user->update([
                'password' => Hash::make($request['newPassword'])
            ]);
            return back()->with('updated','Password berhasil diubah');
        } else {
            return back()->with('message','Password saat ini salah');
        }

    }
}
