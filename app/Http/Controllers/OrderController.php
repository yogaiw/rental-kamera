<?php

namespace App\Http\Controllers;

use App\Models\Carts;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    public function show() {
        $sesi = Payment::where('user_id', Auth::id())->get();
        return view('member.reservasi',[
            'reservasi' => Order::where('user_id', Auth::id())->get(),
            'sesi' => $sesi,
        ]);
    }

    public function create(Request $request) {
        $cart = Carts::where('user_id', Auth::id())->get();
        $sesi = new Payment();

        foreach($cart as $c) {
            Order::create([
                'no_invoice' => "test aja",
                'alat_id' => $c->alat_id,
                'user_id' => $c->user_id,
                'durasi' => $c->durasi,
                'start_date' => $request['start_date'],
                'start_time' => $request['start_time'],
                'end_date' => date('Y-m-d', strtotime($request['start_date'] . "+".$c->durasi." hours")),
                'end_time' => date('H:i', strtotime($request['start_time'] . "+".$c->durasi." hours")),
                'harga' => $c->harga,
            ]);
            $c->delete();
        }

        // untuk mencatat sesi tiap checkout
        $sesi->user_id = Auth::id();
        $sesi->sesi = Order::where('user_id', Auth::id())->orderBy('id','desc')->first()->created_at;
        $sesi->total = Order::where('user_id', Auth::id())->where('created_at', $sesi->sesi)->sum('harga');
        $sesi->save();

        return redirect(route('order.show'));
    }
}
