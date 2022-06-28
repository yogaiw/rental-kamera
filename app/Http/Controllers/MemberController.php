<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\Carts;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MemberController extends Controller
{
    public function index() {
        $alat = Alat::with(['category'])->get();
        $carts = Carts::where('user_id','=',Auth::id());

        if(request('search')) {
            $key = request('search');
            $alat =  Alat::with(['category'])->where('nama_alat','LIKE','%'.$key.'%')->get();
        }
        if(request('kategori')) {
            $alat = Alat::with(['category'])->where('kategori_id','=',request('kategori'))->get();
        }

        return view('member.member',[
            'alat' => $alat,
            'carts' => $carts->get(),
            'total' => $carts->sum('harga'),
            'kategori' => Category::all()
        ]);
    }
}
