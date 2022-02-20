<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AlatController extends Controller
{
    public function index($id = null) {

        if($id != null) {
            $alats = Alat::all()->where('kategori_id','=',$id);
        }
        else {
            $alats = Alat::all();
        }

        if(request('search')) {
            $key = request('search');
            $alats =  Alat::where('nama_alat','LIKE','%'.$key.'%')->get();
        }

        return view('admin.alat.alat',[
            'alats' => $alats,
            'categories' => Category::all()
        ]);
    }
}
