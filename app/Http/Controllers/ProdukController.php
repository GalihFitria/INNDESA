<?php

namespace App\Http\Controllers;

use App\Models\Kelompok;
use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //

        $query = Produk::select('nama', 'stok', 'harga', 'foto', 'id_produk');

        if ($request->has('search') && !empty($request->input('search'))) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                    ->orWhereHas('kelompok', function ($subQuery) use ($search) {
                        $subQuery->where('nama', 'like', "%{$search}%");
                    });
            });
        }

        if ($request->has('kategori') && !empty($request->input('kategori'))) {
            $query->whereHas('kelompok', function ($q) use ($request) {
                $q->where('nama', $request->input('kategori'));
            });
        }

        // $produk = $query->paginate(15);
        // Deteksi device menggunakan User-Agent
        $isMobile = request()->header('User-Agent') &&
            preg_match('/Mobile|Android|iPhone|iPad|iPod|BlackBerry|Opera Mini/i', request()->header('User-Agent'));

        // Set pagination berdasarkan device
        $perPage = $isMobile ? 14 : 15;
        $produk = $query->paginate($perPage);
        $kelompok = Kelompok::all();

        return view('Pengunjung.produk', compact('produk', 'kelompok'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(string $id)
    {
        $produk = Produk::where('id_produk', $id)->firstOrFail();
        return view('Pengunjung.detail_produk', compact('produk'));
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
