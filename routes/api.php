<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/kalender-alat', function() {
    $order = DB::table('orders')
    ->leftJoin('alats', 'alats.id','=','orders.alat_id')
    ->get(['nama_alat AS title','starts AS start','ends AS end']);
    return json_encode($order);
});
