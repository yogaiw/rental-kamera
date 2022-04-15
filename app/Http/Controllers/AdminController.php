<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\Category;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index() {
        return view('admin.admin',[
            'loggedUsername' => Auth::user()->name,
            'total_user' => User::where('isAdmin',0)->count(),
            'total_alat' => Alat::count(),
            'total_kategori' => Category::count(),
            'total_penyewaan' => Payment::count(),
        ]);
    }
}
