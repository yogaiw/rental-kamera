<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function promote($id) {
        $user = User::find($id);
        $user->update([
            'isAdmin' => true,
        ]);

        return back();
    }

    public function demote($id) {
        $user = User::find($id);
        $user->update([
            'isAdmin' => false,
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
}
