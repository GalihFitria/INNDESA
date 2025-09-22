<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kelompok;
use App\Models\Produk;
use App\Models\StrukturOrganisasi;
use App\Models\PageView; // Tambahkan ini
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $totalKelompok = Kelompok::count();
        $totalAnggota = StrukturOrganisasi::count();
        $totalProduk = Produk::count();

        $totalKelompokRentan = DB::table('v_struktur_rentan')
            ->whereNotNull('nama_rentan')
            ->where('nama_rentan', '!=', '-')
            ->where('nama_rentan', '!=', '')
            ->count();

        $anggotaRentan = DB::table('v_struktur_rentan')
            ->select('nama_anggota', 'nama_rentan')
            ->whereNotNull('nama_rentan')
            ->where('nama_rentan', '!=', '-')
            ->where('nama_rentan', '!=', '')
            ->get();

        // Ambil total views dari database
        $totalViews = PageView::getViewCount('home');

        return view('Admin.dashboard', compact(
            'totalKelompok',
            'totalAnggota',
            'totalProduk',
            'totalKelompokRentan',
            'anggotaRentan',
            'totalViews' // Tambahkan ini
        ));
    }
}
