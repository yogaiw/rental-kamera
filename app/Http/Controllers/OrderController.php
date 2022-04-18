<?php

namespace App\Http\Controllers;

use App\Models\Carts;
use App\Models\Order;
use App\Models\Payment;
use Carbon\Carbon;
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
        $payment = Payment::find($id);
        return view('member.detailreservasi',[
            'detail' => $detail,
            'total' => $payment->total,
            'paymentId' => $payment->id,
            'paymentStatus' => $detail->first()->payment->status,
            'bukti' => $payment->bukti
        ]);
    }

    public function create(Request $request) {
        $cart = Carts::where('user_id', Auth::id())->get();
        $pembayaran = new Payment();

        $pembayaran->no_invoice = Auth::id()."/".Carbon::now()->timestamp;
        $pembayaran->user_id = Auth::id();
        $pembayaran->total = $cart->sum('harga');
        $pembayaran->save();

        foreach($cart as $c) {
            Order::create([
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

    public function acc(Request $request, $paymentId) {
        $orders = $request->order;
        $payment = new Payment();

        foreach($orders as $o) {
            Order::where('id', $o)->update(['status' => 2]);
        }
        $payment->find($paymentId)->update(['status' => 2]);
        Order::where('payment_id', $paymentId)->where('status', 1)->update(['status' => 3]);
        $payment->where('id', $paymentId)->update(['total' => Order::where('payment_id', $paymentId)->where('status', 2)->sum('harga')]);

        return back();
    }

    public function bayar(Request $request, $id) {
        $this->validate($request, [
            'bukti' => "image|mimes:png,jpg,svg,jpeg,gif|max:5000"
        ]);

        $payment = Payment::find($id);
        if($request->hasFile('bukti')) {
            $gambar = $request->file('bukti');
            $filename = time().'-'.$gambar->getClientOriginalName();
            $gambar->move(public_path('images/evidence'), $filename);
        }
        $payment->update([
            'bukti' => $filename
        ]);

        return back();
    }
}
