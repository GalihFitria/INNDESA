<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Katalog;
use App\Models\Kelompok;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class KatalogController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $katalog = Katalog::with('kelompok')
            ->when($search, function ($query, $search) {
                return $query->where('id_katalog', 'like', "%{$search}%")
                    ->orWhereHas('kelompok', function ($q) use ($search) {
                        $q->where('nama', 'like', "%{$search}%");
                    });
            })
            ->get();
        return view('Admin.katalog.index', compact('katalog'));
    }


    public function create()
    {
        $kelompok = Kelompok::all();


        $kelompokWithKatalog = Katalog::pluck('id_kelompok')->toArray();

        return view('admin.katalog.create', compact('kelompok', 'kelompokWithKatalog'));
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'id_kelompok' => 'required|exists:kelompok,id_kelompok|unique:katalog,id_kelompok',
            'katalog' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ], [
            'id_kelompok.required' => 'Nama kelompok harus dipilih',
            'id_kelompok.exists' => 'Kelompok yang dipilih tidak valid',
            'id_kelompok.unique' => 'Katalog untuk kelompok ini sudah ada',
            'katalog.file' => 'File harus berupa file yang valid',
            'katalog.mimes' => 'File harus berupa JPG, JPEG, PNG, atau PDF',
            'katalog.max' => 'Ukuran file tidak boleh lebih dari 2MB',
        ]);

        $data = $request->except('katalog');

        if ($request->hasFile('katalog')) {
            $originalName = $request->file('katalog')->getClientOriginalName();
            $baseName = pathinfo($originalName, PATHINFO_FILENAME);
            $extension = $request->file('katalog')->getClientOriginalExtension();
            $fileName = $originalName;
            $counter = 1;

            while (Storage::disk('public')->exists('uploads/' . $fileName)) {
                $fileName = $baseName . '_' . $counter . '.' . $extension;
                $counter++;
            }

            $path = $request->file('katalog')->storeAs('uploads', $fileName, 'public');
            Log::info('Stored file: ' . $path);
            $data['katalog'] = $path;
        }

        Katalog::create($data);

        return redirect()->route('Admin.katalog.index')->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit(string $id)
    {
        $katalog = Katalog::findOrFail($id);
        $kelompok = Kelompok::all();
        return view('Admin.katalog.edit', compact('katalog', 'kelompok'));
    }

    public function update(Request $request, string $id)
    {
        $katalog = Katalog::findOrFail($id);

        $rules = [
            'katalog' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ];

        // Hanya validasi unik jika id_kelompok diubah
        if ($request->id_kelompok != $katalog->id_kelompok) {
            $rules['id_kelompok'] = [
                'required',
                'exists:kelompok,id_kelompok',
                Rule::unique('katalog', 'id_kelompok')->ignore($katalog->id_katalog, 'id_katalog'),
            ];
        } else {
            $rules['id_kelompok'] = 'required|exists:kelompok,id_kelompok';
        }

        $validate = $request->validate($rules, [
            'id_kelompok.required' => 'Nama kelompok harus dipilih',
            'id_kelompok.exists' => 'Kelompok yang dipilih tidak valid',
            'id_kelompok.unique' => 'Katalog untuk kelompok ini sudah ada',
            'katalog.file' => 'File harus berupa file yang valid',
            'katalog.mimes' => 'File harus berupa JPG, JPEG, PNG, atau PDF',
            'katalog.max' => 'Ukuran file tidak boleh lebih dari 2MB',
        ]);

        $data = $request->except('katalog');

        if ($request->hasFile('katalog')) {
            if ($katalog->katalog) {
                Storage::disk('public')->delete($katalog->katalog);
            }

            $originalName = $request->file('katalog')->getClientOriginalName();
            $baseName = pathinfo($originalName, PATHINFO_FILENAME);
            $extension = $request->file('katalog')->getClientOriginalExtension();
            $fileName = $originalName;
            $counter = 1;

            while (Storage::disk('public')->exists('uploads/' . $fileName)) {
                $fileName = $baseName . '_' . $counter . '.' . $extension;
                $counter++;
            }

            $path = $request->file('katalog')->storeAs('uploads', $fileName, 'public');
            Log::info('Updated file: ' . $path);
            $data['katalog'] = $path;
        }

        $katalog->update($data);

        return redirect()->route('Admin.katalog.index')->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy(string $id)
    {
        $katalog = Katalog::findOrFail($id);

        if ($katalog->katalog) {
            Storage::disk('public')->delete($katalog->katalog);
        }

        $katalog->delete();

        return redirect()->route('Admin.katalog.index')->with('success', 'Data berhasil dihapus!');
    }
}
