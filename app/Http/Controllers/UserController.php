<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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
}
