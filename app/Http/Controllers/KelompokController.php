<?php

namespace App\Http\Controllers;

use App\Models\Kelompok;
use App\Models\StrukturOrganisasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KelompokController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        // daftar semua kelompok
        $kelompok = Kelompok::all();

        // struktur umum (nama + jabatan saja)
        $struktur = StrukturOrganisasi::select('nama', 'jabatan')->get();

        return view('Pengunjung.kelompok', compact('kelompok', 'struktur'));
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

        // return view('Pengunjung.kelompok');
        $kelompok = Kelompok::where('id_kelompok', $id)->firstOrFail();

        $struktur = DB::table('struktur_organisasi')
            ->join('kelompok', 'struktur_organisasi.id_kelompok', '=', 'kelompok.id_kelompok')
            ->select(
                'kelompok.nama as nama_kelompok',
                'struktur_organisasi.nama',
                'struktur_organisasi.jabatan'
            )
            ->where('kelompok.id_kelompok', $id)
            ->orderBy('kelompok.nama')
            ->get();

        return view('Pengunjung.kelompok', [
            'kelompok' => $kelompok,
            'struktur' => $struktur
        ]);
    }

    
    public function edit(string $id)
    {
        
    }

    
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
