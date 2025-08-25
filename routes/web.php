<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\KegiatanController;
use App\Http\Controllers\Admin\KelompokController as AdminKelompokController;
use App\Http\Controllers\Admin\KelompokIntegritasController;
use App\Http\Controllers\Admin\ProdukController as AdminProdukController;
use App\Http\Controllers\Admin\SidebarController;
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


//PENGUNJUNG
Route::resource('publikasi', PublikasiController::class);
Route::resource('pt', PtIpController::class);
Route::resource('produk', ProdukController::class);
Route::resource('update_kegiatan', Update_KegiatanController::class);
Route::resource('detail_produk', DetailProdukController::class);
Route::resource('kelompok', KelompokController::class);

//ADMIN
Route::prefix('Admin')->name('Admin.')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('sidebar', [SidebarController::class]);
    Route::resource('produk', AdminProdukController::class);
    Route::resource('kelompok_integritas', KelompokIntegritasController::class);
    Route::resource('kelompok', AdminKelompokController::class);
    Route::resource('kegiatan', KegiatanController::class);
});
