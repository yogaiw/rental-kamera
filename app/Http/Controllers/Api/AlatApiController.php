<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Alat;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AlatApiController extends Controller
{
    public function showAllAlat() {
        if(request('category')) {
            $query = request('category');
            $filtered = DB::table('alats')
                ->join('categories', 'categories.id','alats.kategori_id')
                ->where('kategori_id', $query)
                ->get(['alats.id','kategori_id','nama_alat','harga24','harga12','harga6','nama_kategori']);

            if($filtered->isNotEmpty()) {
                return response()->json([
                    'message' => 'success',
                    'data' => $filtered
                ], 200, ['Content-Type' => 'application/json']);
            } else {
                return response()->json([
                    'message' => 'NOT FOUND',
                    'data' => []
                ], 404, ['Content-Type' => 'application/json']);
            }
        } else {
            $alat = DB::table('alats')
                ->join('categories', 'categories.id','alats.kategori_id')
                ->get(['alats.id','kategori_id','nama_alat','harga24','harga12','harga6','nama_kategori']);

            return response()->json([
                'message' => 'success',
                'data' => $alat
            ],200, ['Content-Type' => 'application/json']);
        }
    }

    public function showAllCategory() {
        return response()->json([
            'message' => 'success',
            'data' => Category::all(['id','nama_kategori'])
        ]);
    }

    public function detail($id) {
        $alat = Alat::find($id, ['id', 'kategori_id', 'nama_alat', 'harga24', 'harga12', 'harga6']);

        $booked = DB::table('orders')
            ->join('alats', 'alats.id','=','orders.alat_id')
            ->join('payments','payments.id','=','orders.payment_id')
            ->where('alats.id', $id)
            ->where('orders.status', 2)
            ->where('payments.status', 3)
            ->get(['starts AS start','ends AS end','durasi']);


        return response()->json([
            "message" => "success",
            "data" => $alat,
            "booked" => $booked
        ], 200);
    }
}
