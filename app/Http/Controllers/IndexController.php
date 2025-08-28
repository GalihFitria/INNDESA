<?php

namespace App\Http\Controllers;

use App\Models\Kelompok;
use App\Models\Produk;
use App\Models\StrukturOrganisasi;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        // return view ('Pengunjung.index');

        $totalKelompok = Kelompok::count();
        $totalAnggota = StrukturOrganisasi::count();
        $totalProduk = Produk::count();
        $totalKelompokRentan = StrukturOrganisasi::whereNotNull('rentan')
            ->where('rentan', '!=', '-')
            ->where('rentan', '!=', '')
            ->count();

        return view('Pengunjung.index', compact(
            'totalKelompok',
            'totalAnggota',
            'totalProduk',
            'totalKelompokRentan'
        ));
    }

    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }


    public function destroy(string $id)
    {
        //
    }

    public function getStatistik()
    {
        $totalKelompok = Kelompok::count();
        $totalAnggota = StrukturOrganisasi::count();
        $totalProduk = Produk::count();
        $totalKelompokRentan = StrukturOrganisasi::whereNotNull('rentan')
            ->where('rentan', '!=', '-')
            ->where('rentan', '!=', '')
            ->count();

        return response()->json([
            'totalKelompok' => $totalKelompok,
            'totalAnggota' => $totalAnggota,
            'totalProduk' => $totalProduk,
            'totalKelompokRentan' => $totalKelompokRentan,
        ]);
    }
}
