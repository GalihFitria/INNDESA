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
use App\Http\Controllers\Admin_Kelompok\ProfilKelompokController;
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\DetailProdukController;
use App\Http\Controllers\FotoController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\KelompokController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\LupaPasswordController;
use App\Http\Controllers\PublikasiController;
use App\Http\Controllers\PtIpController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\Update_KegiatanController;
use App\Http\Controllers\TambahPerusahaanController;
use App\Http\Controllers\Admin_Kelompok\EditLogoBackgroundController;
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

// LOGIN REGISTER
Route::resource('register', RegisterController::class);
Route::get('/admin_login', [AdminLoginController::class, 'index'])->name('admin_login.index');
Route::post('/admin_login', [AdminLoginController::class, 'store'])->name('admin_login.store');
Route::post('/logout', [AdminLoginController::class, 'destroy'])->name('logout');

// LUPA PASSWORD
Route::post('/reset-password', [ResetPasswordController::class, 'reset'])
    ->name('password.update');
Route::get('/reset-password/{token}', function ($token) {
    return view('Pengunjung.reset_password', ['token' => $token]);
})->name('password.reset');
Route::get('/lupa_password', [LupaPasswordController::class, 'showLinkRequestForm'])->name('lupa_password_form');
Route::post('/lupa_password', [LupaPasswordController::class, 'sendResetLinkEmail'])->name('lupa_password_email');

//PENGUNJUNG
Route::resource('publikasi', PublikasiController::class);
Route::resource('perusahaan_pembina', PtIpController::class);
Route::resource('produk', ProdukController::class);
Route::resource('update_kegiatan', Update_KegiatanController::class);
Route::resource('detail_produk', DetailProdukController::class);
Route::resource('kelompok', KelompokController::class);
Route::resource('kontak', KontakController::class);


//SUPER ADMIN
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
    Route::get('beranda', [BerandaController::class, 'index'])->name('beranda');
    Route::resource('kelompok', Admin_KelompokKelompokController::class)->except(['update']);

    //CRUD STRUKTUR
    Route::post('kelompok/{id}/struktur', [Admin_KelompokKelompokController::class, 'storeStruktur'])
        ->name('struktur.store');
    Route::put('/update-struktur/{id}', [Admin_KelompokKelompokController::class, 'updateStruktur'])->name('updateStruktur');
    Route::delete('/delete-struktur/{id}', [Admin_KelompokKelompokController::class, 'deleteStruktur'])->name('deleteStruktur');

    //crud sejarah
    Route::put('/kelompok/{id}/update-sejarah', [Admin_KelompokKelompokController::class, 'updateSejarah'])
        ->name('updateSejarah');

    //crud kelompok rentan
    Route::get(
        '/Admin_Kelompok/kelompok_rentan',
        [App\Http\Controllers\Admin_Kelompok\KelompokController::class, 'kelompokRentan']
    )->name('kelompokRentan');

    //crud produk
    Route::post('kelompok/{id}/storeProduk', [Admin_KelompokKelompokController::class, 'storeProduk'])->name('storeProduk');
    Route::put(
        'kelompok/updateProduk/{id}',
        [Admin_KelompokKelompokController::class, 'updateProduk']
    )->name('updateProduk');
    Route::delete(
        'kelompok/deleteProduk/{id}',
        [Admin_KelompokKelompokController::class, 'deleteProduk']
    )->name('deleteProduk');

    // CRUD Inovasi
    Route::post('inovasi/{id}', [Admin_KelompokKelompokController::class, 'storeInovasi'])
        ->name('storeInovasi');
    Route::put('inovasi/{id}', [Admin_KelompokKelompokController::class, 'updateInovasi'])->name('updateInovasi');
    Route::delete('inovasi/{id}', [Admin_KelompokKelompokController::class, 'deleteInovasi'])->name('deleteInovasi');

    //CRUD STOK PRODUK
    Route::put('produk/{id}', [Admin_KelompokKelompokController::class, 'updateStok'])->name('updateStok');

    // CRUD SK Desa
    Route::post('kelompok/{id}/sk-desa', [Admin_KelompokKelompokController::class, 'storeSkDesa'])
        ->name('storeSkDesa');
    Route::delete('kelompok/{id}/sk-desa', [Admin_KelompokKelompokController::class, 'deleteSkDesa'])
        ->name('deleteSkDesa');
    Route::put('kelompok/{id}/sk-desa', [Admin_KelompokKelompokController::class, 'updateSkDesa'])
        ->name('updateSkDesa'); 

    //CRUD KEGIATAN
    Route::post('/kegiatan/{id}', [Admin_KelompokKelompokController::class, 'storeKegiatan'])
        ->name('storeKegiatan');

    Route::put('/kegiatan/{id_kegiatan}', [Admin_KelompokKelompokController::class, 'updateKegiatan'])
        ->name('updateKegiatan');

    Route::delete('/kegiatan/{id_kegiatan}', [Admin_KelompokKelompokController::class, 'deleteKegiatan'])
        ->name('deleteKegiatan');

    //CRUD PRODUK PERTAHUN
    Route::post('/store-produk-tahun', [Admin_KelompokKelompokController::class, 'storeProdukPertahun'])->name('storeProdukTahun');
    Route::put('/update-produk-tahun/{id}', [Admin_KelompokKelompokController::class, 'updateProdukPertahun'])->name('updateProdukTahun');
    Route::delete('/delete-produk-tahun/{id}', [Admin_KelompokKelompokController::class, 'deleteProdukPertahun'])->name('deleteProdukTahun');

    // CRUD KATALOG
    Route::post('store-katalog', [Admin_KelompokKelompokController::class, 'storeKatalog'])->name('storeKatalog');
    Route::put('update-katalog/{id}', [Admin_KelompokKelompokController::class, 'updateKatalog'])->name('updateKatalog');
    Route::delete('delete-katalog/{id}', [Admin_KelompokKelompokController::class, 'deleteKatalog'])->name('deleteKatalog');



    Route::resource('kelompok', Admin_KelompokKelompokController::class)->except(['update']);
    Route::resource('profil', ProfilKelompokController::class);
    Route::patch('/profil/update-password/{id}', [ProfilKelompokController::class, 'updatePassword'])
    ->name('profil.updatePassword');
    Route::get('/kelompok/{id}', [Admin_KelompokKelompokController::class, 'show'])->name('kelompok.show');

    //LOGO BACKGROUND
    // EDIT LOGO & BACKGROUND
    Route::put('/kelompok/{id}/update-logo-background', [Admin_KelompokKelompokController::class, 'updateLogoBackground'])
        ->name('kelompok.updateLogoBackground');
    // Hapus logo atau background kelompok
    Route::delete('/kelompok/{id}/delete-file', [Admin_KelompokKelompokController::class, 'deleteFile'])
        ->name('kelompok.deleteFile');
});



