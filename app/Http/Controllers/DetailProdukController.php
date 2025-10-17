<?php

namespace App\Http\Controllers;

use App\Models\InformasiUser;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class DetailProdukController extends Controller
{
    public function index()
    {
        $produk = Produk::select('id_produk', 'id_kelompok', 'nama', 'harga', 'stok', 'foto', 'deskripsi', 'sertifikat')
            ->with('kelompok')
            ->firstOrFail();

        // Prepare certificate data as an array for the carousel
        $sertifikatImages = $produk->sertifikat ? collect([['file' => $produk->sertifikat, 'nama_sertifikat' => 'Sertifikat Produk ' . $produk->nama]]) : collect([]);

        return view('Pengunjung.detail_produk', compact('produk', 'sertifikatImages'));
    }

    public function show(string $hashSlug)
    {
        $hash = explode('-', $hashSlug)[0];

        $id = $this->findIdFromHash($hash);
        if (!$id) {
            abort(404);
        }

        $produk = Produk::select('id_produk', 'id_kelompok', 'nama', 'harga', 'stok', 'foto', 'deskripsi', 'sertifikat')
            ->with('kelompok')
            ->findOrFail($id);

        // Ambil data kontak (WhatsApp, Instagram, Facebook)
        $kontak = InformasiUser::where('id_kelompok', $produk->id_kelompok)
            ->select('no_telp', 'ig', 'facebook')
            ->first();

        // Prepare certificate data
        $sertifikatImages = $produk->sertifikat ? collect([['file' => $produk->sertifikat, 'nama_sertifikat' => 'Sertifikat Produk ' . $produk->nama]]) : collect([]);

        return view('Pengunjung.detail_produk', compact('produk', 'sertifikatImages', 'kontak'));
    }

    private function findIdFromHash(String $hash)
    {
        // Decode the hash to get the original ID
        $secretKey = 'INNDESA_SECRET_KEY_2024';

        $maxId = Produk::max('id_produk') ?? 1000;

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

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
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
