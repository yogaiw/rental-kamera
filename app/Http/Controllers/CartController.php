<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\Carts;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function store(Request $request, $id, $userId) {
        $cart = new Carts();
        $alat = Alat::find($id);

        if($request['btn'] == '24') {
            $harga = $alat->harga24;
        }
        if($request['btn'] == '12') {
            $harga = $alat->harga12;
        }
        if($request['btn'] == '6') {
            $harga = $alat->harga6;
        }

        $cart->user_id = $userId;
        $cart->alat_id = $alat->id;
        $cart->harga = $harga;
        $cart->durasi = $request['btn'];

        $cart->save();

        return back()->with('success', 'Berhasil ditambahkan ke keranjang');
    }

    public function destroy($id) {
        $alat = Carts::find($id);
        $alat->delete();

        return back();
    }
}
