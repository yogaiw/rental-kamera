<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index() {
        $alats = Alat::with(['category'])->get();
        if(request('search')) {
            $key = request('search');
            $alats =  Alat::with(['category'])->where('nama_alat','LIKE','%'.$key.'%')->get();
        }
        if(request('kategori')) {
            $alats = Alat::with(['category'])->where('kategori_id','=',request('kategori'))->get();
        }

        return view('home',[
            'alats' => $alats,
            'categories' => Category::all()
        ]);
    }

    public function detail($id) {
        $detail = Alat::with(['category'])->find($id);

        return view('detail',[
            'detail' => $detail
        ]);
    }
}
