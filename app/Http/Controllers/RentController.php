<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;

class RentController extends Controller
{
    public function index() {
        return view('admin.penyewaan.penyewaan',[
            'penyewaan' => Payment::with(['user','order'])->where('status', '!=', 4)->orderBy('id','DESC')->get(),
        ]);
    }

    public function detail($id) {
        $detail = Order::with(['user','payment','alat'])->where('payment_id', $id)->get();
        $payment = Payment::find($id);

        return view('admin.penyewaan.detail',[
            'detail' => $detail,
            'total' => $payment->total,
            'status' => $payment->status,
        ]);
    }

    public function destroy($id) {
        $payment = Payment::find($id);

        $payment->delete();

        return redirect(route('penyewaan.index'));
    }

    public function riwayat() {
        return view('admin.penyewaan.riwayat',[
            'penyewaan' => Payment::where('status', 4)->get()
        ]);
    }
}
