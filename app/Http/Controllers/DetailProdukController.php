<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

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

    public function show(string $id)
    {
        $produk = Produk::select('id_produk', 'id_kelompok', 'nama', 'harga', 'stok', 'foto', 'deskripsi', 'sertifikat')
            ->with('kelompok')
            ->findOrFail($id);

        // Prepare certificate data as an array for the carousel
        $sertifikatImages = $produk->sertifikat ? collect([['file' => $produk->sertifikat, 'nama_sertifikat' => 'Sertifikat Produk ' . $produk->nama]]) : collect([]);

        return view('Pengunjung.detail_produk', compact('produk', 'sertifikatImages'));
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
