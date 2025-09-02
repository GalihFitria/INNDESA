<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Illuminate\Http\Request;

class Update_KegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view ('Pengunjung.update_kegiatan');
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
        $kegiatan = Kegiatan::select('id_kegiatan', 'id_kelompok', 'judul', 'deskripsi', 'foto', 'tanggal', 'sumber_berita')
            ->with('kelompok')
            ->findOrFail($id);

        $sumberBerita = $kegiatan->sumber_berita ? explode(', ', $kegiatan->sumber_berita) : [];

        $kegiatanLainnya = Kegiatan::select('id_kegiatan', 'judul', 'foto', 'tanggal')
            ->where('id_kegiatan', '!=', $id)
            ->latest('tanggal')
            ->take(12)
            ->get();

        return view('Pengunjung.update_kegiatan', compact('kegiatan', 'sumberBerita', 'kegiatanLainnya'));
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
