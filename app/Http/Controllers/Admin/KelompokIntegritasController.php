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
            // 'id_kategori' => 'required|string|unique:kategori_kelompok,id_kategori',
            'nama' => 'required|string',
        ]);

        KategoriKelompok::create([
            // 'id_kategori' => $request->id_kategori,
            'nama' => $request->nama,
        ]);

        return redirect()->route('Admin.kelompok_integritas.index')->with('success', 'Data berhasil ditambahkan.');
    }


    public function edit(string $id)
    {
        $kategori = KategoriKelompok::findOrFail($id);
        return view('Admin.kelompok_integritas.edit', compact('kategori'));
    }

  
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama' => 'required|string',
        ]);

        $kategori = KategoriKelompok::findOrFail($id);
        $kategori->update([
            'nama' => $request->nama,
        ]);

        return redirect()->route('Admin.kelompok_integritas.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $kategori = KategoriKelompok::findOrFail($id);
        $kategori->delete();

        return redirect()->route('Admin.kelompok_integritas.index')->with('success', 'Data berhasil dihapus.');
    }   
    
}
