<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KategoriKelompok;
use Illuminate\Http\Request;

class KelompokIntegritasController extends Controller
{

    public function index()
    {
        
        $kategori = KategoriKelompok::all();
        return view('Admin.kelompok_integritas.index', compact('kategori'));
    }


    public function create()
    {
        
        return view('Admin.kelompok_integritas.create');
    }


    public function store(Request $request)
    {

        $request->validate([
            'nama' => 'required|string|unique:kategori_kelompok,nama',
        ], [
            'nama.required' => 'Nama Kelompok Integritas wajib diisi.',
            'nama.unique'   => 'Kelompok Integritas sudah ada.',
        ]);
        KategoriKelompok::create([
            'nama' => $request->nama,
        ]);

        return redirect()->route('Admin.kelompok_integritas.index')->with('success', 'Data berhasil ditambahkan!');
    }


    public function edit(string $id)
    {
        $kategori = KategoriKelompok::findOrFail($id);
        return view('Admin.kelompok_integritas.edit', compact('kategori'));
    }

  
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama' => 'required|string|unique:kategori_kelompok,nama,' . $id . ',id_kategori',
        ], [
            'nama.required' => 'Nama Kelompok Integritas wajib diisi.',
            'nama.unique'   => 'Kelompok Integritas sudah ada.',
        ]);

        $kategori = KategoriKelompok::findOrFail($id);
        $kategori->update([
            'nama' => $request->nama,
        ]);

        return redirect()->route('Admin.kelompok_integritas.index')->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy(string $id)
    {
        $kategori = KategoriKelompok::findOrFail($id);
        $kategori->delete();

        return redirect()->route('Admin.kelompok_integritas.index')->with('success', 'Data berhasil dihapus!');
    }   
    
}
