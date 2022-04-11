<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\Category;
use App\Models\Carts;
use Illuminate\Http\Request;

class AlatController extends Controller
{
    public function index($id = null) {

        if($id != null) {
            $alats = Alat::where('kategori_id','=',$id)->get();
        }
        else {
            $alats = Alat::with(['category'])->get();
        }

        if(request('search')) {
            $key = request('search');
            $alats =  Alat::with(['category'])->where('nama_alat','LIKE','%'.$key.'%')->get();
        }

        return view('admin.alat.alat',[
            'alats' => $alats,
            'categories' => Category::all()
        ]);
    }

    public function edit($id) {
        $alat = Alat::with(['category'])->find($id);

        return view('admin.alat.editalat',[
            'alat' => $alat,
            'kategori' => Category::all()
        ]);
    }

    public function store(Request $request) {
        $this->validate($request,[
            'nama' => 'required',
            'kategori' => 'required',
            'harga24' => 'required|numeric',
            'harga12' => 'required|numeric',
            'harga6' => 'required|numeric',
            'gambar' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048'
        ]);

        $alat = new Alat();
        $alat->nama_alat = $request['nama'];
        $alat->kategori_id = $request['kategori'];
        $alat->harga24 = $request['harga24'];
        $alat->harga12 = $request['harga12'];
        $alat->harga6 = $request['harga6'];

        if($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $filename = time().'-'.$gambar->getClientOriginalName();
            $gambar->move(public_path('images'), $filename);
            $alat->gambar = $filename;
        }

        $alat->save();

        return redirect(route('alat.index'));
    }

    public function update(Request $request, $id) {
        $this->validate($request,[
            'nama' => 'required',
            'kategori' => 'required',
            'harga24' => 'required|numeric',
            'harga12' => 'required|numeric',
            'harga6' => 'required|numeric',
            'gambar' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048'
        ]);

        $alat = Alat::find($id);
        $alat->nama_alat = $request['nama'];
        $alat->kategori_id = $request['kategori'];
        $alat->harga24 = $request['harga24'];
        $alat->harga12 = $request['harga12'];
        $alat->harga6 = $request['harga6'];

        if($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $filename = time().'-'.$gambar->getClientOriginalName();
            $gambar->move(public_path('images'), $filename);
            $alat->gambar = $filename;
        }

        $alat->save();

        // Agar harga pada cart mengikuti saat harga alat di-update oleh Admin
        $cart = Carts::where('alat_id','=',$id)->first();

        if($cart->durasi === 24) {
            $cart->harga = $alat->harga24;
        }
        if($cart->durasi === 12) {
            $cart->harga = $alat->harga12;
        }
        if($cart->durasi === 6) {
            $cart->harga = $alat->harga6;
        }

        $cart->save();

        return redirect(route('alat.index'));
    }

    public function destroy($id) {
        $alat = Alat::find($id);

        if($alat->gambar != 'noimage.jpg') {
            $filepath = public_path('images'). '/' . $alat->gambar;
            unlink($filepath);
        }

        $alat->delete();
        return redirect(route('alat.index'));
    }
}
