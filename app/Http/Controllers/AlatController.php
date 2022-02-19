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

        return view('admin.alat.alat',[
            'alats' => $alats,
            'categories' => Category::all()
        ]);
    }
}
