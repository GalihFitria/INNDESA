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
        return view('Pengunjung.detail_produk', compact('produk'));
    }

    public function show(string $id)
    {
        $produk = Produk::select('id_produk', 'id_kelompok', 'nama', 'harga', 'stok', 'foto', 'deskripsi', 'sertifikat')
            ->with('kelompok')
            ->findOrFail($id);
        return view('Pengunjung.detail_produk', compact('produk'));
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
