<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AlatController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',[HomeController::class, 'index'])->name('home');
Route::get('/detail/{id}',[HomeController::class, 'detail'])->name('home.detail');
Route::post('/login',[AuthController::class, 'authenticate']);
Route::get('/daftar',[RegisterController::class,'index'])->name('daftar');
Route::post('/daftar',[RegisterController::class,'store'])->name('register.store');

Route::middleware(['auth','admin'])->group(function () {
    Route::get('/admin', [AdminController::class,'index'])->name('admin.index');

    // Kategori
    Route::get('/admin/kategori',[CategoryController::class,'index'])->name('kategori.index');
    Route::post('/admin/kategori',[CategoryController::class,'store'])->name('kategori.store');
    Route::get('/admin/kategori/{id}/edit',[CategoryController::class,'edit'])->name('kategori.edit');
    Route::patch('/admin/kategori/{id}',[CategoryController::class,'update'])->name('kategori.update');
    Route::delete('/admin/kategori/{id}',[CategoryController::class,'destroy'])->name('kategori.destroy');

    // Alat
    Route::get('/admin/alat/{id?}',[AlatController::class, 'index'])->name('alat.index');
    Route::get('/admin/alat/{id}/detail',[AlatController::class,'edit'])->name('alat.edit');
    Route::patch('/admin/alat/{id}/detail',[AlatController::class,'update'])->name('alat.update');
    Route::delete('/admin/alat/{id}/detail',[AlatController::class,'destroy'])->name('alat.destroy');
    Route::post('/admin/alat',[AlatController::class, 'store'])->name('alat.store');
});

Route::get('/memberarea',[MemberController::class,'index'])->middleware('auth')->name('member.index');

// Carts
Route::post('/memberarea/store/{id}',[CartController::class,'store'])->middleware('auth')->name('cart.store');
Route::delete('/memberarea/delete/{id}',[CartController::class,'destroy'])->middleware('auth')->name('cart.destroy');

Route::get('/logout',[AuthController::class, 'logout'])->name('logout');
