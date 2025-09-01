<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InovasiPenghargaan;
use App\Models\Kelompok;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class InovasiController extends Controller
{
    public function index(Request $request) // Tambahkan Request $request sebagai parameter
    {
        $search = $request->query('search');
        $inovasi = InovasiPenghargaan::with('kelompok') // Diperbaiki dari 'inovasi' ke 'kelompok' berdasarkan konteks
            ->when($search, function ($query, $search) {
                return $query->where('id_inovasi', 'like', "%{$search}%")
                    ->orWhereHas('kelompok', function ($q) use ($search) {
                        $q->where('nama', 'like', "%{$search}%");
                    });
            })
            ->get();
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
            'foto' => 'nullable|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        $data = $request->except('foto');

        if ($request->hasFile('foto')) {
            $originalName = $request->file('foto')->getClientOriginalName();
            $baseName = pathinfo($originalName, PATHINFO_FILENAME);
            $extension = $request->file('foto')->getClientOriginalExtension();
            $fileName = $originalName;
            $counter = 1;

            while (Storage::disk('public')->exists('uploads/' . $fileName)) {
                $fileName = $baseName . '_' . $counter . '.' . $extension;
                $counter++;
            }

            $path = $request->file('foto')->storeAs('uploads', $fileName, 'public');
            Log::info('Stored file: ' . $path);
            $data['foto'] = $path;
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
            'foto' => 'nullable|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        $data = $request->except('foto');
        $inovasi = InovasiPenghargaan::findOrFail($id);

        if ($request->hasFile('foto')) {
            if ($inovasi->foto) {
                Storage::disk('public')->delete($inovasi->foto);
            }

            $originalName = $request->file('foto')->getClientOriginalName();
            $baseName = pathinfo($originalName, PATHINFO_FILENAME);
            $extension = $request->file('foto')->getClientOriginalExtension();
            $fileName = $originalName;
            $counter = 1;

            while (Storage::disk('public')->exists('uploads/' . $fileName)) {
                $fileName = $baseName . '_' . $counter . '.' . $extension;
                $counter++;
            }

            $path = $request->file('foto')->storeAs('uploads', $fileName, 'public');
            Log::info('Updated file: ' . $path);
            $data['foto'] = $path;
        }

        $inovasi->update($data);

        return redirect()->route('Admin.inovasi.index')->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy(string $id)
    {
        $inovasi = InovasiPenghargaan::findOrFail($id);

        if ($inovasi->foto) {
            Storage::disk('public')->delete($inovasi->foto);
        }
        $inovasi->delete();

        return redirect()->route('Admin.inovasi.index')->with('success', 'Data berhasil dihapus!');
    }
}
