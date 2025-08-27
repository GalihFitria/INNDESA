<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InovasiPenghargaan;
use App\Models\Kelompok;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InovasiController extends Controller
{
    public function index()
    {
        $inovasi = InovasiPenghargaan::with('kelompok')->get();
        return view('Admin.inovasi.index', compact('inovasi'));
    }

    public function create()
    {
        $kelompok = Kelompok::all();
        return view('Admin.inovasi.create', compact('kelompok'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_kelompok' => 'required|exists:kelompok,id_kelompok',
            'foto' => 'nullable|mimes:pdf,jpg,jpeg,png|max:2048', // Tambah jpg, jpeg, png
        ]);

        $data = $request->except('foto'); // Ambil semua data kecuali foto
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $fileName = time() . '_' . $file->getClientOriginalName(); // Nama unik
            $file->storeAs('public/inovasi', $fileName); // Simpan di storage/app/public/inovasi
            $data['foto'] = 'inovasi/' . $fileName; // Simpan path relatif
        }

        InovasiPenghargaan::create($data);

        return redirect()->route('Admin.inovasi.index')->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit(string $id)
    {
        $inovasi = InovasiPenghargaan::findOrFail($id);
        $kelompok = Kelompok::all();
        return view('Admin.inovasi.edit', compact('inovasi', 'kelompok'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'id_kelompok' => 'required|exists:kelompok,id_kelompok',
            'foto' => 'nullable|mimes:pdf,jpg,jpeg,png|max:2048', // Tambah jpg, jpeg, png
        ]);

        $inovasi = InovasiPenghargaan::findOrFail($id);
        $data = $request->except('foto'); // Ambil semua data kecuali foto
        if ($request->hasFile('foto')) {
            // Hapus file lama kalau ada
            if ($inovasi->foto) {
                Storage::disk('public')->delete($inovasi->foto);
            }
            $file = $request->file('foto');
            $fileName = time() . '_' . $file->getClientOriginalName(); // Nama unik
            $file->storeAs('public/inovasi', $fileName); // Simpan di storage/app/public/inovasi
            $data['foto'] = 'inovasi/' . $fileName; // Simpan path relatif
        }

        $inovasi->update($data);

        return redirect()->route('Admin.inovasi.index')->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy(string $id)
    {
        $inovasi = InovasiPenghargaan::findOrFail($id);
        // Hapus file kalau ada
        if ($inovasi->foto) {
            Storage::disk('public')->delete($inovasi->foto);
        }
        $inovasi->delete();

        return redirect()->route('Admin.inovasi.index')->with('success', 'Data berhasil dihapus!');
    }
}
