<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kelompok;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class ProdukController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $produk = Produk::with('kelompok')
            ->when($search, function ($query, $search) {
                return $query->where('id_produk', 'like', "%{$search}%")
                    ->orWhere('nama', 'like', "%{$search}%")
                    ->orWhereHas('kelompok', function ($q) use ($search) {
                        $q->where('nama', 'like', "%{$search}%");
                    });
            })
            ->get();

        return view('Admin.produk.index', compact('produk'));
    }

    public function create()
    {
        $kelompok = Kelompok::all();
        return view('Admin.produk.create', compact('kelompok'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_kelompok' => 'required|exists:kelompok,id_kelompok',
            'nama' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'stok' => 'required|integer',
            'foto' => 'required|mimes:jpg,jpeg,png|max:2048',
            'deskripsi' => 'required|string',
            'sertifikat.*' => 'nullable|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $data = $request->except(['foto', 'sertifikat']);

        // Simpan foto produk
        if ($request->hasFile('foto')) {
            $originalName = $request->file('foto')->getClientOriginalName();
            $baseName = pathinfo($originalName, PATHINFO_FILENAME);
            $extension = $request->file('foto')->getClientOriginalExtension();
            $fileName = $originalName;
            $counter = 1;

            while (Storage::disk('public')->exists('foto/' . $fileName)) {
                $fileName = $baseName . '_' . $counter . '.' . $extension;
                $counter++;
            }

            $path = $request->file('foto')->storeAs('foto', $fileName, 'public');
            if ($path) {
                Log::info('Stored foto file: ' . $path);
                $data['foto'] = $path;
            } else {
                Log::error('Failed to store foto file for product: ' . $originalName);
                return back()->withErrors(['foto' => 'Gagal mengunggah foto.']);
            }
        }

        // Simpan sertifikat sebagai JSON
        if ($request->hasFile('sertifikat')) {
            $sertifikatPaths = [];
            foreach ($request->file('sertifikat') as $index => $file) {
                $originalName = $file->getClientOriginalName();
                $baseName = pathinfo($originalName, PATHINFO_FILENAME);
                $extension = $file->getClientOriginalExtension();
                $fileName = $originalName;
                $counter = 1;

                while (Storage::disk('public')->exists('sertifikat/' . $fileName)) {
                    $fileName = $baseName . '_' . $counter . '.' . $extension;
                    $counter++;
                }

                $path = $file->storeAs('sertifikat', $fileName, 'public');
                if ($path) {
                    Log::info("Stored sertifikat file {$index}: " . $path);
                    $sertifikatPaths[] = $path;
                } else {
                    Log::error("Failed to store sertifikat file {$index}: " . $originalName);
                }
            }
            $data['sertifikat'] = !empty($sertifikatPaths) ? json_encode($sertifikatPaths) : null;
        } else {
            $data['sertifikat'] = null;
        }

        Produk::create($data);

        return redirect()->route('Admin.produk.index')->with('success', 'Data produk berhasil ditambahkan!');
    }

    public function edit(string $id)
    {
        $produk = Produk::findOrFail($id);
        $kelompok = Kelompok::all();
        return view('Admin.produk.edit', compact('produk', 'kelompok'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'id_kelompok' => 'required|exists:kelompok,id_kelompok',
            'nama' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'stok' => 'required|integer',
            'foto' => 'nullable|mimes:jpg,jpeg,png|max:2048',
            'deskripsi' => 'required|string',
            'sertifikat.*' => 'nullable|mimes:jpg,jpeg,png,pdf|max:2048',
            'produk_terjual' => 'required|integer',
            'remove_foto' => 'nullable|in:0,1',
            'remove_sertifikat' => 'nullable|array', // Array of paths to remove
            'existing_sertifikat' => 'nullable|array', // Array of paths to retain
        ]);

        $produk = Produk::findOrFail($id);
        $data = $request->except(['foto', 'sertifikat', 'remove_foto', 'remove_sertifikat', 'existing_sertifikat']);

        // Handle foto produk
        if ($request->input('remove_foto') == '1' && !$request->hasFile('foto')) {
            if ($produk->foto) {
                Storage::disk('public')->delete($produk->foto);
                Log::info('Deleted foto file: ' . $produk->foto);
                $data['foto'] = null;
            }
        } elseif ($request->hasFile('foto')) {
            if ($produk->foto) {
                Storage::disk('public')->delete($produk->foto);
                Log::info('Deleted previous foto file: ' . $produk->foto);
            }
            $originalName = $request->file('foto')->getClientOriginalName();
            $baseName = pathinfo($originalName, PATHINFO_FILENAME);
            $extension = $request->file('foto')->getClientOriginalExtension();
            $fileName = $originalName;
            $counter = 1;

            while (Storage::disk('public')->exists('foto/' . $fileName)) {
                $fileName = $baseName . '_' . $counter . '.' . $extension;
                $counter++;
            }

            $path = $request->file('foto')->storeAs('foto', $fileName, 'public');
            if ($path) {
                Log::info('Updated foto file: ' . $path);
                $data['foto'] = $path;
            } else {
                Log::error('Failed to store foto file: ' . $originalName);
                return back()->withErrors(['foto' => 'Gagal mengunggah foto.']);
            }
        } else {
            $data['foto'] = $produk->foto; // Keep existing photo if no change
        }

        // Handle sertifikat
        $sertifikatPaths = $produk->sertifikat ? json_decode($produk->sertifikat, true) ?? [] : [];
        $removeSertifikat = $request->input('remove_sertifikat', []);
        $existingSertifikat = $request->input('existing_sertifikat', []);

        // Remove certificates marked for deletion
        foreach ($removeSertifikat as $path) {
            if (in_array($path, $sertifikatPaths)) {
                if (Storage::disk('public')->exists($path)) {
                    Storage::disk('public')->delete($path);
                    Log::info('Deleted sertifikat file: ' . $path);
                }
                $sertifikatPaths = array_diff($sertifikatPaths, [$path]);
            }
        }

        // Retain only existing certificates that are not marked for removal
        $sertifikatPaths = array_intersect($sertifikatPaths, $existingSertifikat);

        // Add new certificates
        if ($request->hasFile('sertifikat')) {
            foreach ($request->file('sertifikat') as $file) {
                $originalName = $file->getClientOriginalName();
                $baseName = pathinfo($originalName, PATHINFO_FILENAME);
                $extension = $file->getClientOriginalExtension();
                $fileName = $originalName;
                $counter = 1;

                while (Storage::disk('public')->exists('sertifikat/' . $fileName)) {
                    $fileName = $baseName . '_' . $counter . '.' . $extension;
                    $counter++;
                }

                $path = $file->storeAs('sertifikat', $fileName, 'public');
                if ($path) {
                    Log::info('Updated sertifikat file: ' . $path);
                    $sertifikatPaths[] = $path;
                } else {
                    Log::error('Failed to store sertifikat file: ' . $originalName);
                }
            }
        }

        $data['sertifikat'] = !empty($sertifikatPaths) ? json_encode(array_values($sertifikatPaths)) : null;

        $produk->update($data);

        return redirect()->route('Admin.produk.index')->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy(string $id)
    {
        $produk = Produk::findOrFail($id);

        // Hapus foto produk
        if ($produk->foto) {
            Storage::disk('public')->delete($produk->foto);
        }

        // Hapus sertifikat
        if ($produk->sertifikat) {
            $sertifikatPaths = json_decode($produk->sertifikat, true) ?? [];
            foreach ($sertifikatPaths as $path) {
                Storage::disk('public')->delete($path);
            }
        }

        $produk->delete();

        return redirect()->route('Admin.produk.index')->with('success', 'Data berhasil dihapus!');
    }
}
