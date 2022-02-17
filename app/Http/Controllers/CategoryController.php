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

    public function store(Request $request) {
        $validateData = $request->validate([
            'nama' => 'required'
        ]);

        $kategori = new Category();
        $kategori->nama = $validateData['nama'];
        $kategori->save();
        return redirect(route('kategori.index'));
    }

    public function destroy($id) {
        $kategori = Category::find($id);
        $kategori->delete();
        return redirect(route('kategori.index'));
    }
}
