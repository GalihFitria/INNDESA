<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class Update_KegiatanController extends Controller
{

    public function index()
    {
        //
        return view ('Pengunjung.update_kegiatan');
    }

    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }

    public function show(string $hashSlug)
    {
        $hash = explode('-', $hashSlug)[0];

        $id = $this->findIdFromHash($hash);
        if (!$id) {
            abort(404);
        }

        $kegiatan = Kegiatan::select('id_kegiatan', 'id_kelompok', 'judul', 'deskripsi', 'foto', 'tanggal', 'sumber_berita')
            ->with('kelompok')
            ->findOrFail($id);

        $sumberBerita = $kegiatan->sumber_berita ? explode(', ', $kegiatan->sumber_berita) : [];

        $kegiatanLainnya = Kegiatan::select('id_kegiatan', 'judul', 'foto', 'tanggal')
            ->where('id_kegiatan', '!=', $id)
            ->latest('tanggal')
            ->take(12)
            ->get();

        return view('Pengunjung.update_kegiatan', compact('kegiatan', 'sumberBerita', 'kegiatanLainnya'));
    }

    
    private function findIdFromHash(String $hash)
    {
        // Decode the hash to get the original ID
        $secretKey = 'INNDESA_SECRET_KEY_2024';

        $maxId = Kegiatan::max('id_kegiatan') ?? 1000;

        // Loop untuk menemukan ID yang cocok dengan hash
        for ($i = 1; $i <= $maxId; $i++) {
            // Buat hash dari ID dan kunci rahasia
            $generatedHash = substr(md5($i . $secretKey), 0, 8);
            if ($generatedHash === $hash) {
                return $i; // Kembalikan ID jika hash cocok
            }
        }

        return null; 
    }

    public static function createHashUrl(int $id, string $judul)
    {
        $secretKey = 'INNDESA_SECRET_KEY_2024';
        $hash = substr(md5($id . $secretKey), 0, 8);
        
        // Buat slug dari judul (menggunakan Laravel Str helper)
        $slug = Str::slug($judul, '-');
        
        return $hash . '-' . $slug;
    }
    
    public function edit(string $id)
    {
        //
    }


    public function update(Request $request, string $id)
    {
        //
    }


    public function destroy(string $id)
    {
        //
    }
}
