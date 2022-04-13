<?php

namespace App\Http\Controllers;

use App\Models\Carts;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function create(Request $request) {
        $cart = Carts::where('user_id', Auth::id())->get();
        $orders = new Order();

        foreach($cart as $c) {
            $orders->no_invoice = "test aja";
            $orders->alat_id = $c->alat_id;
            $orders->user_id = $c->user_id;
            $orders->start_date = $request['start_date'];
            $orders->start_time = $request['start_time'];
            $orders->end_date = date('Y-m-d', strtotime($request['start_date'] . "+".$c->durasi." hours"));
            $orders->end_time = date('H:i', strtotime($request['start_date'] . "+".$c->durasi." hours"));
            $orders->harga = $c->harga;

            $orders->save();
        }
        return redirect(route('member.index'));
    }
}
