<?php

namespace App\Http\Controllers;

use App\Mail\OrderAccepted;
use App\Mail\OrderPaid;
use App\Models\Carts;
use App\Models\Order;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{

    public function show() {
        $payment = Payment::with(['user','order'])->where('user_id', Auth::id());
        return view('member.reservasi',[
            'reservasi' => $payment->where('status','!=', 4)->orderBy('id','DESC')->get(),
            'riwayat' => Payment::with(['user','order'])->where('user_id', Auth::id())->where('status', 4)->orderBy('id','DESC')->get()
        ]);
    }

    public function detail($id) {
        $detail = Order::where('payment_id', $id)->get();
        $payment = Payment::find($id);

        if($payment->user_id == Auth::id()) {
            return view('member.detailreservasi',[
                'detail' => $detail,
                'total' => $payment->total,
                'paymentId' => $payment->id,
                'paymentStatus' => $detail->first()->payment->status,
                'bukti' => $payment->bukti
            ]);
        } else {
            return abort(403, "Forbidden");
        }
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

    public function destroy($id) {
        $payment = Payment::find($id);

        $payment->delete();

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

        Mail::to($payment->find($paymentId)->user->email)->send(new OrderAccepted($payment->find($paymentId)));

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

    public function accbayar($id) {
        $payment = Payment::find($id);

        $payment->update([
            'status' => 3
        ]);

        Mail::to($payment->user->email)->send(new OrderPaid($payment));
        return back();
    }

    public function alatkembali($id) {
        Payment::find($id)->update([
            'status' => 4
        ]);

        return back();
    }

    public function cetak() {
        $dari = request('dari');
        $sampai = request('sampai');
        $laporan = DB::table('orders')
            ->join('payments','payments.id','orders.payment_id')
            ->join('alats','alats.id','orders.alat_id')
            ->join('users','users.id','orders.user_id')
            ->whereBetween('orders.created_at',[$dari, $sampai])
            ->where('orders.status',2)
            ->where('payments.status','>',2)
            ->get(['*','orders.created_at AS tanggal']);

        return view('admin.laporan',[
            'laporan' => $laporan,
            'total' => $laporan->sum('harga')
        ]);
    }
}
