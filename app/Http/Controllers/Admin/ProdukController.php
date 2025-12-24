<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kelompok;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

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
            'nama' => [
                'required',
                'string',
                'max:255',
                Rule::unique('produk')->where(function ($query) use ($request) {
                    return $query->where('id_kelompok', $request->id_kelompok);
                }),
            ],
            'harga' => 'required|numeric',
            'stok' => 'required|integer',
            'satuan' => 'required|string|max:100',
            'foto' => 'required|mimes:jpg,jpeg,png|max:2048',
            'deskripsi' => 'required|string',
            'sertifikat.*' => 'nullable|mimes:jpg,jpeg,png,pdf|max:2048',
        ], [
            'id_kelompok.required' => 'Kelompok wajib dipilih.',
            'id_kelompok.exists' => 'Kelompok yang dipilih tidak valid.',
            'nama.required' => 'Nama produk wajib diisi.',
            'nama.string' => 'Nama produk harus berupa teks.',
            'nama.max' => 'Nama produk tidak boleh lebih dari 255 karakter.',
            'nama.unique' => 'Produk dengan nama ini sudah ada dalam kelompok yang dipilih.',
            'harga.required' => 'Harga produk wajib diisi.',
            'harga.numeric' => 'Harga harus berupa angka.',
            'stok.required' => 'Stok produk wajib diisi.',
            'stok.integer' => 'Stok harus berupa bilangan bulat.',
            'satuan.required' => 'Satuan produk wajib diisi.',
            'satuan.string' => 'Satuan harus berupa teks.',
            'satuan.max' => 'Satuan tidak boleh lebih dari 100 karakter.',
            'foto.required' => 'Foto produk wajib diunggah.',
            'foto.mimes' => 'Foto harus berformat: jpg, jpeg, atau png.',
            'foto.max' => 'Ukuran foto tidak boleh lebih dari 2MB.',
            'deskripsi.required' => 'Deskripsi produk wajib diisi.',
            'deskripsi.string' => 'Deskripsi harus berupa teks.',
            'sertifikat.*.mimes' => 'Sertifikat harus berformat: jpg, jpeg, png, atau pdf.',
            'sertifikat.*.max' => 'Ukuran sertifikat tidak boleh lebih dari 2MB.',
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
            $data['sertifikat'] = !empty($sertifikatPaths) ? implode(',', $sertifikatPaths) : null;
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
        $produk = Produk::findOrFail($id);

        $rules = [
            'id_kelompok' => 'required|exists:kelompok,id_kelompok',
            'harga' => 'required|numeric',
            'stok' => 'required|integer',
            'satuan' => 'required|string|max:100',
            'foto' => 'nullable|mimes:jpg,jpeg,png|max:2048',
            'deskripsi' => 'required|string',
            'sertifikat.*' => 'nullable|mimes:jpg,jpeg,png,pdf|max:2048',
            'remove_foto' => 'nullable|in:0,1',
            'remove_sertifikat' => 'nullable|array',
            'existing_sertifikat' => 'nullable|array',
        ];

        // Hanya validasi unik jika nama produk diubah
        if ($request->nama != $produk->nama || $request->id_kelompok != $produk->id_kelompok) {
            $rules['nama'] = [
                'required',
                'string',
                'max:255',
                Rule::unique('produk')->where(function ($query) use ($request) {
                    return $query->where('id_kelompok', $request->id_kelompok);
                })->ignore($produk->id_produk, 'id_produk'),
            ];
        } else {
            $rules['nama'] = 'required|string|max:255';
        }

        $request->validate($rules, [
            'id_kelompok.required' => 'Kelompok wajib dipilih.',
            'id_kelompok.exists' => 'Kelompok yang dipilih tidak valid.',
            'nama.required' => 'Nama produk wajib diisi.',
            'nama.string' => 'Nama produk harus berupa teks.',
            'nama.max' => 'Nama produk tidak boleh lebih dari 255 karakter.',
            'nama.unique' => 'Produk dengan nama ini sudah ada dalam kelompok yang dipilih.',
            'harga.required' => 'Harga produk wajib diisi.',
            'harga.numeric' => 'Harga harus berupa angka.',
            'stok.required' => 'Stok produk wajib diisi.',
            'stok.integer' => 'Stok harus berupa bilangan bulat.',
            'satuan.required' => 'Satuan produk wajib diisi.',
            'satuan.string' => 'Satuan harus berupa teks.',
            'satuan.max' => 'Satuan tidak boleh lebih dari 100 karakter.',
            'foto.mimes' => 'Foto harus berformat: jpg, jpeg, atau png.',
            'foto.max' => 'Ukuran foto tidak boleh lebih dari 2MB.',
            'deskripsi.required' => 'Deskripsi produk wajib diisi.',
            'deskripsi.string' => 'Deskripsi harus berupa teks.',
            'sertifikat.*.mimes' => 'Sertifikat harus berformat: jpg, jpeg, png, atau pdf.',
            'sertifikat.*.max' => 'Ukuran sertifikat tidak boleh lebih dari 2MB.',
        ]);

        // Validasi tambahan untuk foto
        if ($request->input('remove_foto') == '1' && !$request->hasFile('foto')) {
            return back()->withErrors(['foto' => 'Foto produk tidak boleh kosong. Silakan unggah foto baru.'])->withInput();
        }

        $data = $request->except(['foto', 'sertifikat', 'remove_foto', 'remove_sertifikat', 'existing_sertifikat']);

        // Pastikan produk_terjual menggunakan nilai dari database
        $data['produk_terjual'] = $produk->produk_terjual;

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
        $sertifikatPaths = $produk->sertifikat ? explode(',', $produk->sertifikat) : [];

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

        $data['sertifikat'] = !empty($sertifikatPaths) ? implode(',', $sertifikatPaths) : null;

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
            $sertifikatPaths = explode(',', $produk->sertifikat);
            foreach ($sertifikatPaths as $path) {
                Storage::disk('public')->delete($path);
            }
        }

        $produk->delete();

        return redirect()->route('Admin.produk.index')->with('success', 'Data berhasil dihapus!');
    }
}
