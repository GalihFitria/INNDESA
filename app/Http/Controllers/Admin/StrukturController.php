<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StrukturOrganisasi;
use App\Models\Kelompok;
use Illuminate\Http\Request;

class StrukturController extends Controller
{
    
    public function index()
    {
        $struktur = StrukturOrganisasi::with('kelompok')->get();
        return view ('Admin.struktur.index', compact('struktur'));
    }


    public function create()
    {
        $kelompok = Kelompok::all();
        return view('Admin.struktur.create', compact('kelompok'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'id_kelompok' => 'required|exists:kelompok,id_kelompok',
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:50',
            'rentan' => 'nullable|string|max:255',
        ]);

        StrukturOrganisasi::create($request->all());

        return redirect()->route('Admin.struktur.index')->with('success', 'Data berhasil ditambahkan!');
    }


    public function edit(string $id)
    {
        $struktur = StrukturOrganisasi::findOrFail($id);
        $kelompok = Kelompok::all(); 

        return view('Admin.struktur.edit', compact('struktur', 'kelompok'));
    }


    public function update(Request $request, string $id)
    {
        $request->validate([
            'id_kelompok' => 'required|exists:kelompok,id_kelompok',
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:50',
            'rentan' => 'nullable|string|max:255',
        ]);

        
        $struktur = StrukturOrganisasi::findOrFail($id);

        
        $struktur->update($request->all());

        return redirect()->route('Admin.struktur.index')->with('success', 'Data berhasil diperbarui!');
    }


    public function destroy(string $id)
    {
        $struktur = StrukturOrganisasi::findOrFail($id);
        $struktur->delete();

        return redirect()->route('Admin.struktur.index')->with('success', 'Data berhasil dihapus!');
    }
}
