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

        foreach($cart as $c) {
            Order::create([
                'no_invoice' => "test aja",
                'alat_id' => $c->alat_id,
                'user_id' => $c->user_id,
                'start_date' => $request['start_date'],
                'start_time' => $request['start_time'],
                'end_date' => date('Y-m-d', strtotime($request['start_date'] . "+".$c->durasi." hours")),
                'end_time' => date('H:i', strtotime($request['start_date'] . "+".$c->durasi." hours")),
                'harga' => $c->harga,
            ]);
            $c->delete();
        }

        return redirect(route('member.index'));
    }
}
