<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\Kelompok;
use App\Models\Produk;
use App\Models\StrukturOrganisasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
   
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

        $kegiatans = Kegiatan::select('id_kegiatan', 'foto', 'judul', 'deskripsi', 'tanggal')
            ->orderBy('tanggal', 'desc')
            ->paginate(8);

        return view('Pengunjung.index', compact(
            'totalKelompok',
            'totalAnggota',
            'totalProduk',
            'totalKelompokRentan',
            'anggotaRentan',
            'kegiatans'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * Get statistics for the dashboard.
     */
    public function getStatistik()
    {
        $totalKelompok = Kelompok::count();
        $totalAnggota = StrukturOrganisasi::count();
        $totalProduk = Produk::count();

        $totalKelompokRentan = DB::table('v_struktur_rentan')
            ->whereNotNull('nama_rentan')
            ->where('nama_rentan', '!=', '-')
            ->where('nama_rentan', '!=', '')
            ->count();

        return response()->json([
            'totalKelompok' => $totalKelompok,
            'totalAnggota' => $totalAnggota,
            'totalProduk' => $totalProduk,
            'totalKelompokRentan' => $totalKelompokRentan,
        ]);
    }
}
