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
        return view('member.reservasi',[
            'reservasi' => Payment::where('user_id', Auth::id())->orderBy('id','DESC')->get(),
        ]);
    }

    public function detail($id) {
        $detail = Order::where('payment_id', $id)->get();
        return view('member.detailreservasi',[
            'detail' => $detail,
            'total' => Payment::find($id)->total
        ]);
    }

    public function create(Request $request) {
        $cart = Carts::where('user_id', Auth::id())->get();
        $pembayaran = new Payment();

        $pembayaran->user_id = Auth::id();
        $pembayaran->total = $cart->sum('harga');
        $pembayaran->save();

        foreach($cart as $c) {
            Order::create([
                'no_invoice' => "test aja",
                'alat_id' => $c->alat_id,
                'user_id' => $c->user_id,
                'payment_id' => Payment::where('user_id',Auth::id())->orderBy('id','desc')->first()->id,
                'durasi' => $c->durasi,
                'starts' => date('Y-m-d H:i', strtotime($request['start_date'].$request['start_time'])),
                'ends' => date('Y-m-d H:i', strtotime($request['start_date'].$request['start_time']."+".$c->durasi." hours")),
                'harga' => $c->harga,
            ]);
            $c->delete();
        }

        return redirect(route('order.show'));
    }
}
