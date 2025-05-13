<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MitraController;
use Illuminate\Support\Facades\Route;



// Route::get('/', function () {
//     return view('welcome');
// }); 

Route::get('/', [HomeController::class, 'index']);

Route::get('login', [AuthController::class, 'login']);
Route::get('register', [AuthController::class, 'register']);
Route::post('registerproses', [AuthController::class, 'registerproses']);
Route::post('loginproses', [AuthController::class, 'loginproses']);
Route::get('logout', [AuthController::class, 'logout']);

Route::middleware(['auth'])->controller(HomeController::class)->group(function () {
    // artikel
    Route::get('artikeldetail/{id}', 'artikeldetail');
    Route::post('komentarsimpan', 'komentarsimpan');

    // produk
    Route::get('produkdetail/{id}', 'produkdetail');
    Route::get('cartsimpan', 'cartsimpan');
    Route::get('keranjang', 'keranjang');
    // Hapus item dari keranjang
    Route::get('keranjang/hapus/{id}', 'keranjanghapus');
    Route::post('keranjang/update', 'keranjangupdate');

    // Hitung total harga keranjang
    Route::get('keranjang/total', 'keranjangtotal');

    Route::get('checkout', 'checkout');
});

Route::middleware(['auth'])->controller(AdminController::class)->group(function () {
    // dashboard
    Route::get('admin', 'dashboard');

    // artikel
    Route::get('admin/artikel', 'artikel');
    Route::post('admin/artikelsimpan', 'artikelsimpan');
    Route::get('admin/artikeledit/{id}', 'artikeledit');
    Route::put('admin/artikelupdate/{id}', 'artikelupdate');
    Route::delete('admin/artikelhapus/{id}', 'artikelhapus');

    // komentar
    Route::get('admin/komentar', 'komentar');
    Route::post('admin/komentarsimpan', 'komentarsimpan');
    Route::get('admin/komentaredit/{id}', 'komentaredit');
    Route::put('admin/komentarupdate/{id}', 'komentarupdate');
    Route::delete('admin/komentarhapus/{id}', 'komentarhapus');
    Route::post('admin/komentarbalas', 'komentarbalas');
});

Route::middleware(['auth'])->controller(MitraController::class)->group(function () {
    // dashboard
    Route::get('mitra', 'dashboard');

    // produk
    Route::get('mitra/produk', 'produk');
    Route::post('mitra/produksimpan', 'produksimpan');
    Route::get('mitra/produkedit/{id}', 'produkedit');
    Route::put('mitra/produkupdate/{id}', 'produkupdate');
    Route::delete('mitra/produkhapus/{id}', 'produkhapus');
});
