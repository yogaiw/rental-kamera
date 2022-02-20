<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\Category;

class AlatController extends Controller
{
    public function index($id = null) {

        if($id != null) {
            $alats = Alat::where('kategori_id','=',$id)->get();
        }
        else {
            $alats = Alat::with(['category'])->get();
        }

        if(request('search')) {
            $key = request('search');
            $alats =  Alat::with(['category'])->where('nama_alat','LIKE','%'.$key.'%')->get();
        }

        return view('admin.alat.alat',[
            'alats' => $alats,
            'categories' => Category::all()
        ]);
    }
}
