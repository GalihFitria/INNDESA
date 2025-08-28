<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Katalog;
use App\Models\Kelompok;
use Illuminate\Http\Request;

class KatalogController extends Controller
{
    
    public function index()
    {
        $katalog = Katalog::with('kelompok')->get();
        return view ('Admin.katalog.index', compact('katalog'));
    }

  
    public function create()
    {
        $kelompok = Kelompok::all();
        return view('Admin.katalog.create', compact('kelompok'));
    }

  
    public function store(Request $request)
    {
        $request->validate([
            'id_kelompok' => 'required|exists:kelompok,id_kelompok',
            'katalog' => 'nullable|mimes:pdf,jpg,jpeg,png|max:2048', 
        ]);

        $data = $request->except('katalog'); 
        if ($request->hasFile('katalog')) {
            $file = $request->file('katalog');
            $fileName = time() . '_' . $file->getClientOriginalName(); 
            $file->storeAs('public/inovasi', $fileName); 
            $data['katalog'] = 'inovasi/' . $fileName; 
        }

        Katalog::create($request->all());

        return redirect()->route('Admin.katalog.index')->with('success', 'Data berhasil ditambahkan!');
    }


    public function edit(string $id)
    {
        $katalog = Katalog::findOrFail($id);
        $kelompok = Kelompok::all();

        return view('Admin.katalog.edit', compact('katalog', 'kelompok'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'id_kelompok' => 'required|exists:kelompok,id_kelompok',
            'katalog' => 'nullable|mimes:pdf,jpg,jpeg,png|max:2048', // Tambah jpg, jpeg, png
        ]);

        $data = $request->except('katalog'); // Ambil semua data kecuali foto
        if ($request->hasFile('katalog')) {
            $file = $request->file('katalog');
            $fileName = time() . '_' . $file->getClientOriginalName(); // Nama unik
            $file->storeAs('public/inovasi', $fileName); // Simpan di storage/app/public/inovasi
            $data['katalog'] = 'inovasi/' . $fileName; // Simpan path relatif
        }

        $katalog = Katalog::findOrFail($id);

        $katalog->update($request->all());

        return redirect()->route('Admin.katalog.index')->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy(string $id)
    {
        $katalog = Katalog::findOrFail($id);
        $katalog->delete();

        return redirect()->route('Admin.katalog.index')->with('success', 'Data berhasil dihapus!');
    }
}
