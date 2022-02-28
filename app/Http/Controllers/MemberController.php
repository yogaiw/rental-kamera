<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index() {
        $alat = Alat::with(['category'])->get();

        return view('member.member',[
            'alat' => $alat,
        ]);
    }
}
