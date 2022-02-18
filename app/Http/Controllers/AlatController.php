<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AlatController extends Controller
{
    public function index() {

        $alats = DB::table('alats')->leftJoin('categories','alats.kategori_id','=','categories.id')->get();

        return view('admin.alat.alat',[
            'alats' => $alats
        ]);
    }
}
