<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AlatController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\RentController;
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

    //Penyewaan
    Route::get('/admin/penyewaan',[RentController::class, 'index'])->name('penyewaan.index');
    Route::get('/admin/penyewaan/detail/{id}',[RentController::class, 'detail'])->name('penyewaan.detail');
    Route::get('/admin/riwayat-reservasi',[RentController::class,'riwayat'])->name('riwayat-reservasi');
    Route::patch('/acc/{paymentId}',[OrderController::class,'acc'])->name('acc');
    Route::patch('/admin/selesai/{id}',[OrderController::class,'alatkembali'])->name('selesai');
    Route::get('/admin/laporan/cetak',[OrderController::class,'cetak'])->name('cetak');
    Route::delete('/admin/cancel/{id}',[RentController::class,'destroy'])->name('admin.penyewaan.cancel');
    Route::patch('/accbayar/{id}',[OrderController::class,'accbayar'])->name('accbayar');

    Route::get('/admin/buat-reservasi/{userId}',[AdminController::class,'newOrderIndex'])->name('admin.buatreservasi');
    Route::post('/admin/buat-reservasi/order/{userId}',[AdminController::class,'createNewOrder'])->name('admin.createorder');

    // Penyewa atau User
    Route::get('/admin/usermanagement',[AdminController::class,'usermanagement'])->name('admin.user');
    Route::post('/admin/usermanagement/new',[AdminController::class,'newUser'])->name('user.new');
});

Route::get('/memberarea',[MemberController::class,'index'])->middleware('auth')->name('member.index');

// Carts
Route::post('/memberarea/store/{id}/{userId}',[CartController::class,'store'])->middleware('auth')->name('cart.store');
Route::delete('/memberarea/delete/{id}',[CartController::class,'destroy'])->middleware('auth')->name('cart.destroy');

// Orders
Route::post('/checkout',[OrderController::class,'create'])->middleware('auth')->name('order.create');
Route::get('/reservasi',[OrderController::class,'show'])->middleware('auth')->name('order.show');
Route::get('/reservasi/detail/{id}',[OrderController::class,'detail'])->middleware('auth')->name('order.detail');
Route::patch('/bayar/{id}',[OrderController::class,'bayar'])->middleware('auth')->name('bayar');
Route::delete('/reservasi/cancel/{id}',[OrderController::class,'destroy'])->middleware('auth')->name('cancel');

Route::get('/logout',[AuthController::class, 'logout'])->name('logout');
