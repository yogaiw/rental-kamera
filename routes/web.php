<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AlatController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ForgetPasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\RentController;
use App\Http\Controllers\UserController;
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

Route::get('/forget-password',[ForgetPasswordController::class,'index'])->name('forgetpassword.index');
Route::post('/forget-password',[ForgetPasswordController::class,'sendResetLink'])->name('forgetpassword.sendlink');

Route::get('/reset/{token}',[ForgetPasswordController::class,'resetPasswordIndex']);
Route::post('/reset',[ForgetPasswordController::class,'resetPassword'])->name('resetpassword');

Route::middleware(['auth','superuser'])->group(function () {
    Route::get('/admin/admin-management',[AdminController::class, 'adminmanagement'])->name('superuser.admin');

    // Alat
    Route::get('/admin/alat/{id?}',[AlatController::class, 'index'])->name('alat.index');
    Route::get('/admin/alat/{id}/detail',[AlatController::class,'edit'])->name('alat.edit');
    Route::patch('/admin/alat/{id}/detail',[AlatController::class,'update'])->name('alat.update');
    Route::delete('/admin/alat/{id}/detail',[AlatController::class,'destroy'])->name('alat.destroy');
    Route::post('/admin/alat',[AlatController::class, 'store'])->name('alat.store');

    // Kategori
    Route::get('/admin/kategori',[CategoryController::class,'index'])->name('kategori.index');
    Route::post('/admin/kategori',[CategoryController::class,'store'])->name('kategori.store');
    Route::get('/admin/kategori/{id}/edit',[CategoryController::class,'edit'])->name('kategori.edit');
    Route::patch('/admin/kategori/{id}',[CategoryController::class,'update'])->name('kategori.update');
    Route::delete('/admin/kategori/{id}',[CategoryController::class,'destroy'])->name('kategori.destroy');
});

Route::middleware(['auth','admin'])->group(function () {
    Route::get('/admin', [AdminController::class,'index'])->name('admin.index');

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
    Route::patch('admin/user/promote/{id}',[UserController::class,'promote'])->name('user.promote');
    Route::patch('admin/user/demote/{id}',[UserController::class,'demote'])->name('user.demote');
});

Route::middleware('auth')->group(function() {
    Route::get('/memberarea',[MemberController::class,'index'])->name('member.index');
    Route::get('/memberarea/kalender', function() {
        return view('member.kalender');
    })->name('member.kalender');

    // Carts
    Route::post('/memberarea/store/{id}/{userId}',[CartController::class,'store'])->name('cart.store');
    Route::delete('/memberarea/delete/{id}',[CartController::class,'destroy'])->name('cart.destroy');

    // Orders
    Route::post('/checkout',[OrderController::class,'create'])->name('order.create');
    Route::get('/reservasi',[OrderController::class,'show'])->name('order.show');
    Route::get('/reservasi/detail/{id}',[OrderController::class,'detail'])->name('order.detail');
    Route::patch('/bayar/{id}',[OrderController::class,'bayar'])->name('bayar');
    Route::delete('/reservasi/cancel/{id}',[OrderController::class,'destroy'])->name('cancel');

    Route::get('/akun/pengaturan',[UserController::class,'edit'])->name('akun.pengaturan');
    Route::patch('/akun/pengaturan',[UserController::class,'update'])->name('akun.update');
    Route::patch('/changepass',[UserController::class,'changePassword'])->name('changepassword');
});

Route::get('/logout',[AuthController::class, 'logout'])->name('logout');
