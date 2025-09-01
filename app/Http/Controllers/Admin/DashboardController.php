<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kelompok;
use App\Models\Produk;
use App\Models\StrukturOrganisasi;
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

        return view('Admin.dashboard', compact(
            'totalKelompok',
            'totalAnggota',
            'totalProduk',
            'totalKelompokRentan',
            'anggotaRentan'
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
     * Display the specified resource.
     */
    public function show(string $id)
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
}
