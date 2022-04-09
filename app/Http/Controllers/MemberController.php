<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\Carts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MemberController extends Controller
{
    public function index() {
        $alat = Alat::with(['category'])->get();
        $carts = Carts::all();

        return view('member.member',[
            'alat' => $alat,
            'carts' => $carts
        ]);
    }
}
