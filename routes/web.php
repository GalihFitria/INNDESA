<?php

use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\DetailProdukController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\KelompokController;
use App\Http\Controllers\PublikasiController;
use App\Http\Controllers\PtIpController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\Update_KegiatanController;
use App\Http\Controllers\TambahPerusahaanController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('Pengunjung.index');
})->name('beranda');



Route::resource('publikasi', PublikasiController::class);
Route::resource('pt', PtIpController::class);
Route::resource('produk', ProdukController::class);
Route::resource('update_kegiatan', Update_KegiatanController::class);
Route::resource('detail_produk', DetailProdukController::class);
Route::resource('kelompok', KelompokController::class);
Route::resource('dashboard_admin',DashboardAdminController::class);

