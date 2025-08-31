<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\DriveGoogleController;
use App\Models\Katalog;
use App\Models\Kelompok;
use Illuminate\Http\Request;

class KatalogController extends Controller
{
    public function index()
    {
        $katalog = Katalog::with('kelompok')->get();
        return view('Admin.katalog.index', compact('katalog'));
    }

    public function create()
    {
        $kelompok = Kelompok::all();
        return view('Admin.katalog.create', compact('kelompok'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_kelompok' => 'required|exists:kelompok,id_kelompok',
            'katalog' => 'nullable|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        $data = $request->except('katalog');

        if ($request->hasFile('katalog')) {
            $googleDrive = new DriveGoogleController();
            $response = $googleDrive->upload($request);

            // Cek apakah upload berhasil
            if ($response->getStatusCode() == 200) {
                $responseData = json_decode($response->getContent(), true);
                $data['katalog'] = $responseData['file_name']; // Simpan nama file
            } else {
                return redirect()->back()->with('error', 'Gagal mengunggah file ke Google Drive');
            }
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
        $request->validate([
            'id_kelompok' => 'required|exists:kelompok,id_kelompok',
            'katalog' => 'nullable|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        $data = $request->except('katalog');
        $katalog = Katalog::findOrFail($id);

        if ($request->hasFile('katalog')) {
            $googleDrive = new DriveGoogleController();

            // Hapus file lama dari Google Drive jika ada
            if ($katalog->katalog) {
                $deleteResponse = $googleDrive->destroy($katalog->katalog);
                if ($deleteResponse->getStatusCode() != 200) {
                    return redirect()->back()->with('error', 'Gagal menghapus file lama dari Google Drive');
                }
            }

            // Unggah file baru
            $response = $googleDrive->upload($request);
            if ($response->getStatusCode() == 200) {
                $responseData = json_decode($response->getContent(), true);
                $data['katalog'] = $responseData['file_name']; // Simpan nama file baru
            } else {
                return redirect()->back()->with('error', 'Gagal mengunggah file ke Google Drive');
            }
        }

        $katalog->update($data);

        return redirect()->route('Admin.katalog.index')->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy(string $id)
    {
        $katalog = Katalog::findOrFail($id);

        // Hapus file dari Google Drive jika ada
        if ($katalog->katalog) {
            $googleDrive = new DriveGoogleController();
            $deleteResponse = $googleDrive->destroy($katalog->katalog);
            if ($deleteResponse->getStatusCode() != 200) {
                return redirect()->back()->with('error', 'Gagal menghapus file dari Google Drive');
            }
        }

        $katalog->delete();

        return redirect()->route('Admin.katalog.index')->with('success', 'Data berhasil dihapus!');
    }
}
