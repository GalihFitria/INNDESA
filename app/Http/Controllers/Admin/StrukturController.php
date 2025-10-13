<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StrukturOrganisasi;
use App\Models\Kelompok;
use App\Models\KelompokRentan;
use App\Models\Rentan;
use Illuminate\Http\Request;

class StrukturController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $struktur = StrukturOrganisasi::with(['kelompok', 'rentan'])->get();
        return view('Admin.struktur.index', compact('struktur'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kelompok = Kelompok::all();
        $rentan = KelompokRentan::all();

        // Ambil semua struktur organisasi untuk validasi jabatan
        $strukturList = StrukturOrganisasi::all();

        return view('Admin.struktur.create', compact('kelompok', 'rentan', 'strukturList'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_kelompok' => 'required|exists:kelompok,id_kelompok',
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:50',
            'id_rentan' => 'required|exists:rentan,id_rentan',
        ]);

        // Validasi khusus untuk Ketua dan Wakil Ketua
        if (in_array($request->jabatan, ['Ketua', 'Wakil Ketua'])) {
            $existing = StrukturOrganisasi::where('id_kelompok', $request->id_kelompok)
                ->where('jabatan', $request->jabatan)
                ->exists();

            if ($existing) {
                return redirect()->back()
                    ->withErrors(['jabatan' => 'Jabatan ' . $request->jabatan . ' sudah ada di kelompok ini'])
                    ->withInput();
            }
        }

        StrukturOrganisasi::create([
            'id_kelompok' => $request->id_kelompok,
            'nama' => $request->nama,
            'jabatan' => $request->jabatan,
            'id_rentan' => $request->id_rentan,
        ]);

        return redirect()->route('Admin.struktur.index')->with('success', 'Data berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $struktur = StrukturOrganisasi::findOrFail($id);
        $kelompok = Kelompok::all();
        $rentan = KelompokRentan::all();

        // Ambil semua struktur organisasi untuk validasi jabatan
        $strukturList = StrukturOrganisasi::all();

        return view('Admin.struktur.edit', compact('struktur', 'kelompok', 'rentan', 'strukturList'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'id_kelompok' => 'required|exists:kelompok,id_kelompok',
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:50',
            'id_rentan' => 'required|exists:rentan,id_rentan',
        ]);

        $struktur = StrukturOrganisasi::findOrFail($id);

        // Validasi khusus untuk Ketua dan Wakil Ketua
        if (in_array($request->jabatan, ['Ketua', 'Wakil Ketua'])) {
            $existing = StrukturOrganisasi::where('id_kelompok', $request->id_kelompok)
                ->where('jabatan', $request->jabatan)
                ->where('id_struktur', '!=', $id) // Perbaikan di sini - gunakan id_struktur bukan id
                ->exists();

            if ($existing) {
                return redirect()->back()
                    ->withErrors(['jabatan' => 'Jabatan ' . $request->jabatan . ' sudah ada di kelompok ini'])
                    ->withInput();
            }
        }

        $struktur->update([
            'id_kelompok' => $request->id_kelompok,
            'nama' => $request->nama,
            'jabatan' => $request->jabatan,
            'id_rentan' => $request->id_rentan,
        ]);

        return redirect()->route('Admin.struktur.index')->with('success', 'Data berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $struktur = StrukturOrganisasi::findOrFail($id);
        $struktur->delete();

        return redirect()->route('Admin.struktur.index')->with('success', 'Data berhasil dihapus!');
    }
}
