<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use App\Models\Kelompok;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class KegiatanController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $kegiatan = Kegiatan::with('kelompok')
            ->when($search, function ($query, $search) {
                return $query->where('id_kegiatan', 'like', "%{$search}%")
                    ->orWhere('judul', 'like', "%{$search}%")
                    ->orWhereHas('kelompok', function ($q) use ($search) {
                        $q->where('nama', 'like', "%{$search}%");
                    });
            })
            ->get(); // Gunakan get() untuk client-side pagination

        return view('Admin.kegiatan.index', compact('kegiatan'));
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
            'foto'          => 'nullable|mimes:jpg,jpeg,png,pdf|max:1024',
        ]);

        $data = $request->except('foto');
        
        if ($request->hasFile('foto')) {
            $originalName = $request->file('foto')->getClientOriginalName();
            $baseName = pathinfo($originalName, PATHINFO_FILENAME);
            $extension = $request->file('foto')->getClientOriginalExtension();
            $fileName = $originalName;
            $counter = 1;

            while (Storage::disk('public')->exists('kegiatan/' . $fileName)) {
                $fileName = $baseName . '_' . $counter . '.' . $extension;
                $counter++;
            }

            $path = $request->file('foto')->storeAs('kegiatan', $fileName, 'public');
            Log::info('Stored foto file: ' . $path);
            $data['foto'] = $path;
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
            'foto'          => 'nullable|mimes:jpg,jpeg,png,pdf|max:1024',
        ]);

        $kegiatan = Kegiatan::findOrFail($id);
        $data = $request->except('foto');

        

        if ($request->hasFile('foto')) {
            if ($kegiatan->foto) {
                Storage::disk('public')->delete($kegiatan->foto);
            }

            $originalName = $request->file('foto')->getClientOriginalName();
            $baseName = pathinfo($originalName, PATHINFO_FILENAME);
            $extension = $request->file('foto')->getClientOriginalExtension();
            $fileName = $originalName;
            $counter = 1;

            while (Storage::disk('public')->exists('kegiatan/' . $fileName)) {
                $fileName = $baseName . '_' . $counter . '.' . $extension;
                $counter++;
            }

            $path = $request->file('foto')->storeAs('kegiatan', $fileName, 'public');
            Log::info('Updated foto file: ' . $path);
            $data['foto'] = $path;
        }

        $kegiatan->update($data);

        return redirect()->route('Admin.kegiatan.index')->with('success', 'Data kegiatan berhasil diperbarui!');
    }

    public function destroy(string $id)
    {
        $kegiatan = Kegiatan::findOrFail($id);

        if ($kegiatan->foto) {
            Storage::disk('public')->delete($kegiatan->foto);
        }

        $kegiatan->delete();

        return redirect()->route('Admin.kegiatan.index')->with('success', 'Data berhasil dihapus!');
    }
}