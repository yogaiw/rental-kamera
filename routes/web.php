<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
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
Route::post('/login',[AuthController::class, 'authenticate']);

Route::middleware(['auth','admin'])->group(function () {
    Route::get('/admin', [AdminController::class,'index'])->name('admin.index');
    Route::get('/admin/kategori',[CategoryController::class,'index'])->name('kategori.index');
    Route::post('/admin/kategori',[CategoryController::class,'store'])->name('kategori.store');
    Route::delete('/admin/kategori/{id}',[CategoryController::class,'destroy'])->name('kategori.destroy');
});

Route::get('/memberarea', function () {
    return view('member');
})->middleware('auth');

Route::get('/logout',[AuthController::class, 'logout'])->name('logout');
