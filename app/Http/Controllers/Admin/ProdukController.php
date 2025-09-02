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
            'foto' => 'nullable|mimes:jpg,jpeg,png|max:2048',
            'deskripsi' => 'required|string',
            'sertifikat' => 'nullable|mimes:jpg,jpeg,png|max:2048',
            'produk_terjual' => 'required|integer',
        ]);

        $data = $request->except(['foto', 'sertifikat']);

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
            Log::info('Stored foto file: ' . $path);
            $data['foto'] = $path;
        }

        if ($request->hasFile('sertifikat')) {
            $originalName = $request->file('sertifikat')->getClientOriginalName();
            $baseName = pathinfo($originalName, PATHINFO_FILENAME);
            $extension = $request->file('sertifikat')->getClientOriginalExtension();
            $fileName = $originalName;
            $counter = 1;

            while (Storage::disk('public')->exists('sertifikat/' . $fileName)) {
                $fileName = $baseName . '_' . $counter . '.' . $extension;
                $counter++;
            }

            $path = $request->file('sertifikat')->storeAs('sertifikat', $fileName, 'public');
            Log::info('Stored sertifikat file: ' . $path);
            $data['sertifikat'] = $path;
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
            'sertifikat' => 'nullable|mimes:jpg,jpeg,png|max:2048',
            'produk_terjual' => 'required|integer',
        ]);

        $produk = Produk::findOrFail($id);
        $data = $request->except(['foto', 'sertifikat']);

        if ($request->hasFile('foto')) {
            if ($produk->foto) {
                Storage::disk('public')->delete($produk->foto);
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
            Log::info('Updated foto file: ' . $path);
            $data['foto'] = $path;
        }

        if ($request->hasFile('sertifikat')) {
            if ($produk->sertifikat) {
                Storage::disk('public')->delete($produk->sertifikat);
            }

            $originalName = $request->file('sertifikat')->getClientOriginalName();
            $baseName = pathinfo($originalName, PATHINFO_FILENAME);
            $extension = $request->file('sertifikat')->getClientOriginalExtension();
            $fileName = $originalName;
            $counter = 1;

            while (Storage::disk('public')->exists('sertifikat/' . $fileName)) {
                $fileName = $baseName . '_' . $counter . '.' . $extension;
                $counter++;
            }

            $path = $request->file('sertifikat')->storeAs('sertifikat', $fileName, 'public');
            Log::info('Updated sertifikat file: ' . $path);
            $data['sertifikat'] = $path;
        }

        $produk->update($data);

        return redirect()->route('Admin.produk.index')->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy(string $id)
    {
        $produk = Produk::findOrFail($id);

        if ($produk->foto) {
            Storage::disk('public')->delete($produk->foto);
        }
        if ($produk->sertifikat) {
            Storage::disk('public')->delete($produk->sertifikat);
        }

        $produk->delete();

        return redirect()->route('Admin.produk.index')->with('success', 'Data berhasil dihapus!');
    }
}
