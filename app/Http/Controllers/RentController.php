<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class RentController extends Controller
{
    public function index() {
        return view('admin.penyewaan',[
            'penyewaan' => Payment::orderBy('id','DESC')->get(),
        ]);
    }
}
