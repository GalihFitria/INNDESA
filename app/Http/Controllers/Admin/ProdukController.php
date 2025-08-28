<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kelompok;
use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{

    public function index()
    {
        $produk = Produk::with('kelompok')->get();
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
            'harga' => 'required|numeric', // Ubah ke numeric untuk harga
            'stok' => 'required|integer', // Ubah ke integer untuk stok
            'foto' => 'nullable|mimes:jpg,jpeg,png|max:2048',
            'deskripsi' => 'required|string',
            'sertifikat' => 'nullable|mimes:jpg,jpeg,png|max:2048',
            'produk_terjual' => 'required|integer', // Konsisten dengan huruf kecil dan ubah ke integer
        ]);

        $data = $request->except('foto', 'sertifikat');

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('foto', 'public');
        }
        if ($request->hasFile('sertifikat')) {
            $data['sertifikat'] = $request->file('sertifikat')->store('sertifikat', 'public'); // Ubah 'background' ke 'sertifikat' untuk konsistensi
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
            'id_kelompok'   => 'required|exists:kelompok,id_kelompok',
            'nama'         => 'required|string|max:255',
            'harga'     => 'required|string',
            'stok'       => 'required|string',
            'foto'          => 'nullable|mimes:jpg,jpeg,png|max:2048',
            'deskripsi'       => 'required|string',
            'sertifikat'          => 'nullable|mimes:jpg,jpeg,png|max:2048',
            'produk_terjual'       => 'required|string',

        ]);

        $produk = Produk::findOrFail($id);

        $data = $request->only(['id_kelompok', 'nama', 'harga', 'stok', 'foto', 'deskripsi', 'sertifikat', 'produk_terjual']);

        if ($request->hasFile('foto')) {
            $ftName = time() . '_ft.' . $request->foto->extension();
            $request->foto->move(public_path('uploads/foto'), $ftName);
            $data['foto'] = $ftName;
        }


        if ($request->hasFile('sertifikat')) {
            $sName = time() . '_s.' . $request->sertifikat->extension();
            $request->sertifikat->move(public_path('uploads/sertifikat'), $sName);
            $data['sertifikat'] = $sName;
        }

        $produk->update($data);

        return redirect()->route('Admin.produk.index')->with('success', 'Data berhasil diperbarui!');
    }


    public function destroy(string $id) {
        $produk = Produk::findOrFail($id);
        $produk->delete();

        return redirect()->route('Admin.produk.index')->with('success', 'Data berhasil dihapus!');
    }
}
