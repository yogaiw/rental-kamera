<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index() {
        return view('admin.kategori',[
           'categories' => Category::all()
        ]);
    }

    public function edit($id) {
        $kategori = Category::findOrFail($id);
        return view('admin.editkategori',[
            'kategori' => $kategori
        ]);
    }

    public function store(Request $request) {
        $this->validate($request, [
            'nama' => 'required'
        ]);

        $kategori = new Category();
        $kategori->nama = $request['nama'];
        $kategori->save();
        return redirect(route('kategori.index'));
    }

    public function update(Request $request, $id) {
        $this->validate($request,[
            'nama' => 'required'
        ]);
        $kategori = Category::find($id);
        $kategori->nama = $request['nama'];
        $kategori->save();
        return redirect(route('kategori.index'));
    }

    public function destroy($id) {
        $kategori = Category::find($id);
        $kategori->delete();
        return redirect(route('kategori.index'));
    }
}
