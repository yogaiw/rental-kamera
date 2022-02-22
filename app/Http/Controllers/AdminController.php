<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index() {
        return view('admin.admin',[
            'loggedUsername' => Auth::user()->name,
            'total_alat' => Alat::count(),
            'total_kategori' => Category::count()
        ]);
    }
}
