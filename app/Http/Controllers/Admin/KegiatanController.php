<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use App\Models\Kelompok;
use Illuminate\Http\Request;

class KegiatanController extends Controller
{
    
    public function index()
    {
        $kegiatan = Kegiatan::with('kelompok')->get();
        return view ('Admin.kegiatan.index', compact('kegiatan'));
    }


    public function create()
    {
        $kelompok = Kelompok::all();
        return view('Admin.kegiatan.create', compact('kelompok'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_kelompok'   => 'required|exists:kelompok,id_kelompok',
            'judul'         => 'required|string|max:255',
            'deskripsi'     => 'required|string',
            'tanggal'       => 'required|date',
            'sumber_berita' => 'nullable|string|max:255',
            'foto'          => 'nullable|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->except('foto');

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/kegiatan', $fileName);
            $data['foto'] = 'kegiatan/' . $fileName;
        }

        Kegiatan::create($data);

        return redirect()->route('Admin.kegiatan.index')->with('success', 'Data kegiatan berhasil ditambahkan!');
    }


    public function edit(string $id)
    {
        $kegiatan = Kegiatan::findOrFail($id);
        $kelompok = Kelompok::all();

        return view('Admin.kegiatan.edit', compact('kegiatan', 'kelompok'));
    }


    public function update(Request $request, string $id)
    {
        $request->validate([
            'id_kelompok'   => 'required|exists:kelompok,id_kelompok',
            'judul'         => 'required|string|max:255',
            'deskripsi'     => 'required|string',
            'tanggal'       => 'required|date',
            'sumber_berita' => 'nullable|string|max:255',
            'foto'          => 'nullable|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->except('foto');

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/kegiatan', $fileName);
            $data['foto'] = 'kegiatan/' . $fileName;
        }

        $kegiatan = Kegiatan::findOrFail($id);
        $kegiatan->update($data);

        return redirect()->route('Admin.kegiatan.index')->with('success', 'Data kegiatan berhasil diperbarui!');
    }

    public function destroy(string $id)
    {
        $kegiatan = Kegiatan::findOrFail($id);
        $kegiatan->delete();

        return redirect()->route('Admin.kegiatan.index')->with('success', 'Data berhasil dihapus!');
    }
    }