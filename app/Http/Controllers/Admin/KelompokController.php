<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KategoriKelompok;
use App\Models\Kelompok;
use Illuminate\Http\Request;

class KelompokController extends Controller
{
    public function index()
    {
        $kelompok = Kelompok::with('kategori')->get(); // eager load biar ga N+1
        return view('Admin.kelompok.index', compact('kelompok'));
    }

    public function create()
    {
        $kategori = KategoriKelompok::all();
        return view('Admin.kelompok.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_kategori' => 'required|exists:kategori_kelompok,id_kategori',
            'nama' => 'required|string|max:255',
            'sejarah' => 'required|string',
            'sk_desa' => 'nullable|mimes:pdf|max:2048',
            'background' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'logo' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        // Upload file
        if ($request->hasFile('sk_desa')) {
            $validated['sk_desa'] = $request->file('sk_desa')->store('sk_desa', 'public');
        }
        if ($request->hasFile('background')) {
            $validated['background'] = $request->file('background')->store('background', 'public');
        }
        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('logo', 'public');
        }

        Kelompok::create($validated);

        return redirect()->route('Admin.kelompok.index')->with('success', 'Kelompok berhasil ditambahkan');
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
            'id_kategori' => 'required|integer',
            'nama' => 'required|string',
            'sejarah' => 'required|string',
            'sk_desa' => 'nullable|mimes:pdf|max:2048',
            'background' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $kelompok = Kelompok::findOrFail($id);

        $data = $request->only(['id_kategori', 'nama', 'sejarah']);

        // Update SK Desa
        if ($request->hasFile('sk_desa')) {
            $skName = time() . '_sk.' . $request->sk_desa->extension();
            $request->sk_desa->move(public_path('uploads/skdesa'), $skName);
            $data['sk_desa'] = $skName;
        }

        // Update Background
        if ($request->hasFile('background')) {
            $bgName = time() . '_bg.' . $request->background->extension();
            $request->background->move(public_path('uploads/background'), $bgName);
            $data['background'] = $bgName;
        }

        // Update Logo
        if ($request->hasFile('logo')) {
            $logoName = time() . '_logo.' . $request->logo->extension();
            $request->logo->move(public_path('uploads/logo'), $logoName);
            $data['logo'] = $logoName;
        }

        $kelompok->update($data);

        return redirect()->route('Admin.kelompok.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $kelompok = Kelompok::findOrFail($id);
        $kelompok->delete();

        return redirect()->route('Admin.kelompok.index')->with('success', 'Data berhasil dihapus.');
    }
}
