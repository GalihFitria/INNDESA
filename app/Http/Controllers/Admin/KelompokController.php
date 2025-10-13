<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KategoriKelompok;
use App\Models\Kelompok;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

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
            'nama' => 'required|string|max:255|unique:kelompok,nama',
            'sejarah' => 'nullable|string',
            'sk_desa' => 'nullable|mimes:jpg,png,jpeg,pdf|max:2048',
            'background' => 'nullable|image|mimes:jpg,png,jpeg,pdf|max:2048',
            'logo' => 'nullable|image|mimes:jpg,png,jpeg,pdf|max:2048',
        ], [
            'id_kategori.required' => 'Kategori kelompok wajib dipilih.',
            'id_kategori.exists' => 'Kategori yang dipilih tidak valid.',
            'nama.required' => 'Nama kelompok wajib diisi.',
            'nama.string' => 'Nama kelompok harus berupa teks.',
            'nama.max' => 'Nama kelompok tidak boleh lebih dari 255 karakter.',
            'nama.unique' => 'Nama kelompok sudah ada dalam database.',
            'sejarah.string' => 'Sejarah harus berupa teks.',
            'sk_desa.mimes' => 'SK Desa harus berformat: jpg, png, jpeg, atau pdf.',
            'sk_desa.max' => 'Ukuran SK Desa tidak boleh lebih dari 2MB.',
            'background.image' => 'Background harus berupa gambar.',
            'background.mimes' => 'Background harus berformat: jpg, png, jpeg, atau pdf.',
            'background.max' => 'Ukuran background tidak boleh lebih dari 2MB.',
            'logo.image' => 'Logo harus berupa gambar.',
            'logo.mimes' => 'Logo harus berformat: jpg, png, jpeg, atau pdf.',
            'logo.max' => 'Ukuran logo tidak boleh lebih dari 2MB.',
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
        $kelompok = Kelompok::findOrFail($id);

        $rules = [
            'id_kategori' => 'required|exists:kategori_kelompok,id_kategori',
            'sejarah' => 'nullable|string',
            'sk_desa' => 'nullable|mimes:jpg,png,jpeg,pdf|max:2048',
            'background' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'logo' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ];

        // Hanya validasi unik jika nama kelompok diubah
        if ($request->nama != $kelompok->nama) {
            $rules['nama'] = [
                'required',
                'string',
                'max:255',
                Rule::unique('kelompok')->where(function ($query) use ($request) {
                    return $query->where('id_kategori', $request->id_kategori);
                })->ignore($kelompok->id_kelompok, 'id_kelompok'),
            ];
        } else {
            $rules['nama'] = 'required|string|max:255';
        }

        $request->validate($rules, [
            'id_kategori.required' => 'Kategori kelompok wajib dipilih.',
            'id_kategori.exists' => 'Kategori yang dipilih tidak valid.',
            'nama.required' => 'Nama kelompok wajib diisi.',
            'nama.string' => 'Nama kelompok harus berupa teks.',
            'nama.max' => 'Nama kelompok tidak boleh lebih dari 255 karakter.',
            'nama.unique' => 'Kombinasi nama kelompok dan kategori sudah ada.',
            'sejarah.string' => 'Sejarah harus berupa teks.',
            'sk_desa.mimes' => 'SK Desa harus berformat: jpg, png, jpeg, atau pdf.',
            'sk_desa.max' => 'Ukuran SK Desa tidak boleh lebih dari 2MB.',
            'background.image' => 'Background harus berupa gambar.',
            'background.mimes' => 'Background harus berformat: jpg, png, atau jpeg.',
            'background.max' => 'Ukuran background tidak boleh lebih dari 2MB.',
            'logo.image' => 'Logo harus berupa gambar.',
            'logo.mimes' => 'Logo harus berformat: jpg, png, atau jpeg.',
            'logo.max' => 'Ukuran logo tidak boleh lebih dari 2MB.',
        ]);

        $data = $request->except(['sk_desa', 'background', 'logo', 'remove_sk_desa', 'remove_background', 'remove_logo']);

        // ===== SK DESA =====
        // Prioritaskan memproses file baru terlebih dahulu
        if ($request->hasFile('sk_desa')) {
            // Hapus file lama jika ada
            if ($kelompok->sk_desa && Storage::disk('public')->exists($kelompok->sk_desa)) {
                Storage::disk('public')->delete($kelompok->sk_desa);
            }

            // Simpan file baru
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
        // Jika tidak ada file baru, periksa apakah file lama harus dihapus
        elseif ($request->input('remove_sk_desa') == '1') {
            if ($kelompok->sk_desa && Storage::disk('public')->exists($kelompok->sk_desa)) {
                Storage::disk('public')->delete($kelompok->sk_desa);
            }
            $data['sk_desa'] = null;
        }
        // Jika tidak ada perubahan, pertahankan file lama
        else {
            $data['sk_desa'] = $kelompok->sk_desa;
        }

        // ===== BACKGROUND =====
        if ($request->hasFile('background')) {
            if ($kelompok->background && Storage::disk('public')->exists($kelompok->background)) {
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
        } elseif ($request->input('remove_background') == '1') {
            if ($kelompok->background && Storage::disk('public')->exists($kelompok->background)) {
                Storage::disk('public')->delete($kelompok->background);
            }
            $data['background'] = null;
        } else {
            $data['background'] = $kelompok->background;
        }

        // ===== LOGO =====
        if ($request->hasFile('logo')) {
            if ($kelompok->logo && Storage::disk('public')->exists($kelompok->logo)) {
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
        } elseif ($request->input('remove_logo') == '1') {
            if ($kelompok->logo && Storage::disk('public')->exists($kelompok->logo)) {
                Storage::disk('public')->delete($kelompok->logo);
            }
            $data['logo'] = null;
        } else {
            $data['logo'] = $kelompok->logo;
        }

        // Update DB
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
