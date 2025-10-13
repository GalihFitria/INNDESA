<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KelompokRentan;
use Illuminate\Http\Request;

class KelompokRentanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $rentan = KelompokRentan::all();
        return view('Admin.kelompok_rentan.index', compact('rentan'));
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('Admin.kelompok_rentan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_rentan' => 'required|string|unique:rentan,nama_rentan',
        ], [
            'nama_rentan.required' => 'Nama Kelompok Rentan wajib diisi.',
            'nama_rentan.unique'   => 'Kelompok Rentan sudah ada.',
        ]);
        KelompokRentan::create([
            'nama_rentan' => $request->nama_rentan,
        ]);

        return redirect()->route('Admin.kelompok_rentan.index')->with('success', 'Data berhasil ditambahkan!');
    }


    public function edit(string $id)
    {
        $rentan = KelompokRentan::findOrFail($id);
        return view('Admin.kelompok_rentan.edit', compact('rentan'));
    }


    public function update(Request $request, string $id)
    {
        $request->validate([
            // Tambahkan pengecualian untuk ID yang sedang diedit
            'nama_rentan' => 'required|string|unique:rentan,nama_rentan,' . $id . ',id_rentan',
        ], [
            'nama_rentan.required' => 'Nama Kelompok Rentan wajib diisi.',
            'nama_rentan.unique'   => 'Kelompok Rentan sudah ada.',
        ]);

        $rentan = KelompokRentan::findOrFail($id);
        $rentan->update([
            'nama_rentan' => $request->nama_rentan,
        ]);

        return redirect()->route('Admin.kelompok_rentan.index')->with('success', 'Data berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $rentan = KelompokRentan::findOrFail($id);
        $rentan->delete();

        return redirect()->route('Admin.kelompok_rentan.index')->with('success', 'Data berhasil dihapus!');
    }
}
