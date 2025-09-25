<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\InformasiUserController;
use App\Http\Controllers\Admin\InovasiController;
use App\Http\Controllers\Admin\KatalogController;
use App\Http\Controllers\Admin\KegiatanController;
use App\Http\Controllers\Admin\KelompokController as AdminKelompokController;
use App\Http\Controllers\Admin\KelompokIntegritasController;
use App\Http\Controllers\Admin\KelompokRentanController;
use App\Http\Controllers\Admin\ProdukController as AdminProdukController;
use App\Http\Controllers\Admin\ProdukperTahunController;
use App\Http\Controllers\Admin\SidebarController;
use App\Http\Controllers\Admin\StrukturController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin_Kelompok\BerandaController;
use App\Http\Controllers\Admin_Kelompok\KelompokController as Admin_KelompokKelompokController;
use App\Http\Controllers\DetailProdukController;
use App\Http\Controllers\FotoController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\KelompokController;
use App\Http\Controllers\KontakController;
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

Route::get('/', [IndexController::class, 'index'])->name('beranda');
Route::get('/api/statistik', [App\Http\Controllers\IndexController::class, 'getStatistik']);


//PENGUNJUNG
Route::resource('publikasi', PublikasiController::class);
Route::resource('perusahaan_pembina', PtIpController::class);
Route::resource('produk', ProdukController::class);
Route::resource('update_kegiatan', Update_KegiatanController::class);
Route::resource('detail_produk', DetailProdukController::class);
Route::resource('kelompok', KelompokController::class);
Route::resource('kontak', KontakController::class);


//ADMIN
Route::prefix('Admin')->name('Admin.')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('sidebar', [SidebarController::class]);
    Route::resource('produk', AdminProdukController::class);
    Route::resource('kelompok_integritas', KelompokIntegritasController::class);
    Route::resource('kelompok', AdminKelompokController::class);
    Route::resource('kelompok_rentan', KelompokRentanController::class);
    Route::resource('kegiatan', KegiatanController::class);
    Route::resource('struktur', StrukturController::class);
    Route::resource('inovasi', InovasiController::class);
    Route::resource('katalog', KatalogController::class);
    Route::get('produk_pertahun/pdf', [ProdukperTahunController::class, 'exportPdf'])
        ->name('produk_pertahun.pdf');
    Route::resource('produk_pertahun', ProdukperTahunController::class);

    Route::resource('users', UserController::class);
    Route::resource('informasi_user', InformasiUserController::class);
});

// ADMIN KELOMPOK
Route::prefix('Admin_Kelompok')->name('Admin_Kelompok.')->group(function () {
    //Beranda
    Route::get('beranda', [App\Http\Controllers\Admin_Kelompok\BerandaController::class, 'index'])->name('beranda');

    //kelompok
    Route::resource('kelompok', Admin_KelompokKelompokController::class)->names([
        'index' => 'kelompok.index',
        'store' => 'kelompok.store',
        'show' => 'kelompok.show',
        'update' => 'kelompok.update',
        'destroy' => 'kelompok.destroy',
        'create' => 'kelompok.create',
        'edit' => 'kelompok.edit',
    ]);

    //struktur organisasi
    Route::post('store-struktur', [Admin_KelompokKelompokController::class, 'storeStruktur'])->name('storeStruktur');
    Route::put('update-struktur/{id}', [Admin_KelompokKelompokController::class, 'updateStruktur'])->name('updateStruktur');
    Route::delete('delete-struktur/{id}', [Admin_KelompokKelompokController::class, 'deleteStruktur'])->name('deleteStruktur');

    // Rute untuk sejarah
    Route::put('kelompok/{id}/update-sejarah', [Admin_KelompokKelompokController::class, 'updateSejarah'])->name('updateSejarah');

    //kelompok rentan
    Route::get('kelompok_rentan', [Admin_KelompokKelompokController::class, 'kelompokRentan'])->name('kelompokRentan');

    //SK Desa
    Route::post('kelompok/{id}/sk-desa', [Admin_KelompokKelompokController::class, 'storeSkDesa'])->name('storeSkDesa');
    Route::delete('kelompok/{id}/sk-desa/{index}', [Admin_KelompokKelompokController::class, 'deleteSkDesa'])->name('deleteSkDesa');

});
