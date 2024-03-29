<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\Api;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [Api::class, 'login']);
Route::post('/register', [Api::class, 'register']);
Route::get('/penyedia', [Api::class, 'penyedia']);
Route::get('/user/{id}', [Api::class, 'user']);
Route::get('/paket', [Api::class, 'paket']);
Route::get('/event', [Api::class, 'event']);
Route::get('/pesanan/{id}', [Api::class, 'pesanan']);
Route::post('/postpesanan', [Api::class, 'createPesanan']);
Route::post('/updateprofile', [Api::class, 'updateProfile']);
Route::get('/pembayaran', [Api::class, 'pembayaran']);
Route::post('/rating', [Api::class, 'rating']);
Route::get('/komentar/{id}', [Api::class, 'komentar']);
Route::post('/postkomentar', [Api::class, 'postKomentar']);
Route::get('/getkota/{provinsi}', [Api::class, 'getKota']);
Route::get('/getprovinsi', [Api::class, 'getProvinsi']);
Route::get('/getprovinsiid', [Api::class, 'getProvinsiid']);
Route::get('/getkecamatan/{kota}', [Api::class, 'getKecamatan']);
Route::get('/getkelurahan/{kecamatan}', [Api::class, 'getKelurahan']);
Route::get('/listpembayaran/{id}', [Api::class, 'listPembayaran']);
Route::post('/uploadbukti', [Api::class, 'uploadBukti']);
