<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;

class RentController extends Controller
{
    public function index() {
        return view('admin.penyewaan.penyewaan',[
            'penyewaan' => Payment::orderBy('id','DESC')->get(),
        ]);
    }

    public function detail($id) {
        $detail = Order::where('payment_id', $id)->get();

        return view('admin.penyewaan.detail',[
            'detail' => $detail,
            'total' => Payment::find($id)->total,
        ]);
    }
}
