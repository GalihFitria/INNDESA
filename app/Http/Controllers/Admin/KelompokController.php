<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KategoriKelompok;
use App\Models\Kelompok;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class KelompokController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $kelompok = Kelompok::with('kategori')
            ->when($search, function ($query, $search) {
                return $query->where('id_kelompok', 'like', "%{$search}%")
                    ->orWhere('nama', 'like', "%{$search}%")
                    ->orWhereHas('kategori', function ($q) use ($search) {
                        $q->where('nama_kategori', 'like', "%{$search}%");
                    });
            })
            ->get();

        return view('Admin.kelompok.index', compact('kelompok'));
    }

    public function create()
    {
        $kategori = KategoriKelompok::all();
        return view('Admin.kelompok.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_kategori' => 'required|exists:kategori_kelompok,id_kategori',
            'nama' => 'required|string|max:255',
            'sejarah' => 'required|string',
            'sk_desa' => 'nullable|mimes:jpg,png,jpeg,pdf|max:2048',
            'background' => 'nullable|image|mimes:jpg,png,jpeg,pdf|max:2048',
            'logo' => 'nullable|image|mimes:jpg,png,jpeg,pdf|max:2048',
        ]);

        $data = $request->except(['sk_desa', 'background', 'logo']);

        if ($request->hasFile('sk_desa')) {
            $originalName = $request->file('sk_desa')->getClientOriginalName();
            $baseName = pathinfo($originalName, PATHINFO_FILENAME);
            $extension = $request->file('sk_desa')->getClientOriginalExtension();
            $fileName = $originalName;
            $counter = 1;

            while (Storage::disk('public')->exists('sk_desa/' . $fileName)) {
                $fileName = $baseName . '_' . $counter . '.' . $extension;
                $counter++;
            }

            $path = $request->file('sk_desa')->storeAs('sk_desa', $fileName, 'public');
            Log::info('Stored SK Desa file: ' . $path);
            $data['sk_desa'] = $path;
        }

        if ($request->hasFile('background')) {
            $originalName = $request->file('background')->getClientOriginalName();
            $baseName = pathinfo($originalName, PATHINFO_FILENAME);
            $extension = $request->file('background')->getClientOriginalExtension();
            $fileName = $originalName;
            $counter = 1;

            while (Storage::disk('public')->exists('background/' . $fileName)) {
                $fileName = $baseName . '_' . $counter . '.' . $extension;
                $counter++;
            }

            $path = $request->file('background')->storeAs('background', $fileName, 'public');
            Log::info('Stored background file: ' . $path);
            $data['background'] = $path;
        }

        if ($request->hasFile('logo')) {
            $originalName = $request->file('logo')->getClientOriginalName();
            $baseName = pathinfo($originalName, PATHINFO_FILENAME);
            $extension = $request->file('logo')->getClientOriginalExtension();
            $fileName = $originalName;
            $counter = 1;

            while (Storage::disk('public')->exists('logo/' . $fileName)) {
                $fileName = $baseName . '_' . $counter . '.' . $extension;
                $counter++;
            }

            $path = $request->file('logo')->storeAs('logo', $fileName, 'public');
            Log::info('Stored logo file: ' . $path);
            $data['logo'] = $path;
        }

        Kelompok::create($data);

        return redirect()->route('Admin.kelompok.index')->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit(string $id)
    {
        $kelompok = Kelompok::findOrFail($id);
        $kategori = KategoriKelompok::all();
        return view('Admin.kelompok.edit', compact('kelompok', 'kategori'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'id_kategori' => 'required|exists:kategori_kelompok,id_kategori',
            'nama' => 'required|string|max:255',
            'sejarah' => 'required|string',
            'sk_desa' => 'nullable|mimes:jpg,png,jpeg,pdf|max:2048',
            'background' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'logo' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $data = $request->except(['sk_desa', 'background', 'logo']);
        $kelompok = Kelompok::findOrFail($id);

        if ($request->hasFile('sk_desa')) {
            if ($kelompok->sk_desa) {
                Storage::disk('public')->delete($kelompok->sk_desa);
            }

            $originalName = $request->file('sk_desa')->getClientOriginalName();
            $baseName = pathinfo($originalName, PATHINFO_FILENAME);
            $extension = $request->file('sk_desa')->getClientOriginalExtension();
            $fileName = $originalName;
            $counter = 1;

            while (Storage::disk('public')->exists('sk_desa/' . $fileName)) {
                $fileName = $baseName . '_' . $counter . '.' . $extension;
                $counter++;
            }

            $path = $request->file('sk_desa')->storeAs('sk_desa', $fileName, 'public');
            Log::info('Updated SK Desa file: ' . $path);
            $data['sk_desa'] = $path;
        }

        if ($request->hasFile('background')) {
            if ($kelompok->background) {
                Storage::disk('public')->delete($kelompok->background);
            }

            $originalName = $request->file('background')->getClientOriginalName();
            $baseName = pathinfo($originalName, PATHINFO_FILENAME);
            $extension = $request->file('background')->getClientOriginalExtension();
            $fileName = $originalName;
            $counter = 1;

            while (Storage::disk('public')->exists('background/' . $fileName)) {
                $fileName = $baseName . '_' . $counter . '.' . $extension;
                $counter++;
            }

            $path = $request->file('background')->storeAs('background', $fileName, 'public');
            Log::info('Updated background file: ' . $path);
            $data['background'] = $path;
        }

        if ($request->hasFile('logo')) {
            if ($kelompok->logo) {
                Storage::disk('public')->delete($kelompok->logo);
            }

            $originalName = $request->file('logo')->getClientOriginalName();
            $baseName = pathinfo($originalName, PATHINFO_FILENAME);
            $extension = $request->file('logo')->getClientOriginalExtension();
            $fileName = $originalName;
            $counter = 1;

            while (Storage::disk('public')->exists('logo/' . $fileName)) {
                $fileName = $baseName . '_' . $counter . '.' . $extension;
                $counter++;
            }

            $path = $request->file('logo')->storeAs('logo', $fileName, 'public');
            Log::info('Updated logo file: ' . $path);
            $data['logo'] = $path;
        }

        $kelompok->update($data);

        return redirect()->route('Admin.kelompok.index')->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy(string $id)
    {
        $kelompok = Kelompok::findOrFail($id);

        if ($kelompok->sk_desa) {
            Storage::disk('public')->delete($kelompok->sk_desa);
        }
        if ($kelompok->background) {
            Storage::disk('public')->delete($kelompok->background);
        }
        if ($kelompok->logo) {
            Storage::disk('public')->delete($kelompok->logo);
        }

        $kelompok->delete();

        return redirect()->route('Admin.kelompok.index')->with('success', 'Data berhasil dihapus!');
    }
}
