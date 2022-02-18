<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AlatController extends Controller
{
    public function index() {

        return view('admin.alat.alat',[
            'alats' => Alat::all()
        ]);
    }
}
