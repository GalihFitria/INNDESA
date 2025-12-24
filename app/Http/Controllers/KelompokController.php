<?php

namespace App\Http\Controllers;

use App\Models\Katalog;
use App\Models\Kegiatan;
use App\Models\Kelompok;
use App\Models\KelompokRentan;
use App\Models\Produk;
use App\Models\ProdukPertahun;
use App\Models\StrukturOrganisasi;
use App\Models\V_Struktur__Rentan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KelompokController extends Controller
{
    public function index()
    {
        $jabatanOrder = [
            'Ketua' => 1,
            'Wakil Ketua' => 2,
            'Sekretaris' => 3,
            'Bendahara' => 4,
            'Anggota' => 5,
        ];

        $kelompok = Kelompok::all();

        $struktur = StrukturOrganisasi::select('nama', 'jabatan')
            ->get()
            ->sortBy(function ($item) use ($jabatanOrder) {
                return $jabatanOrder[$item->jabatan] ?? 999;
            });

        $katalog = Katalog::first();
        $totalProdukTerjual = Produk::sum('produk_terjual');

        return view('Pengunjung.kelompok', compact('kelompok', 'struktur', 'katalog', 'totalProdukTerjual'));
    }

    public function show(string $id)
    {
        $jabatanOrder = [
            'Ketua' => 1,
            'Wakil Ketua' => 2,
            'Sekretaris' => 3,
            'Bendahara' => 4,
            'Anggota' => 5,
        ];

        $kelompok = Kelompok::where('id_kelompok', $id)->firstOrFail();

        $struktur = DB::table('struktur_organisasi')
            ->join('kelompok', 'struktur_organisasi.id_kelompok', '=', 'kelompok.id_kelompok')
            ->select(
                'kelompok.nama as nama_kelompok',
                'struktur_organisasi.nama',
                'struktur_organisasi.jabatan'
            )
            ->where('kelompok.id_kelompok', $id)
            ->get()
            ->sortBy(function ($item) use ($jabatanOrder) {
                return $jabatanOrder[$item->jabatan] ?? 999;
            });

        $rentanCategories = KelompokRentan::where('nama_rentan', '!=', '-')
            ->select('nama_rentan')
            ->distinct()
            ->pluck('nama_rentan')
            ->sort()
            ->values();

        $kelompokRentan = V_Struktur__Rentan::where('id_kelompok', $id)
            ->where('nama_rentan', '!=', '-')
            ->select('nama_anggota', 'nama_rentan')
            ->get();

        $rentanGrouped = $kelompokRentan->groupBy('nama_rentan');

        $produk = Produk::where('id_kelompok', $id)
            ->select('nama', 'stok', 'satuan', 'harga', 'foto', 'id_produk')
            ->get();

        $katalog = Katalog::where('id_kelompok', $id)->first();

        $totalProdukTerjual = Produk::where('id_kelompok', $id)->sum('produk_terjual');

        $inovasiImages = \App\Models\InovasiPenghargaan::where('id_kelompok', $id)->get();

        $kegiatan = Kegiatan::where('id_kelompok', $id)
            ->select('judul', 'foto', 'tanggal', 'deskripsi', 'id_kegiatan')
            ->orderBy('tanggal', 'desc')
            ->get();

        $rekap = ProdukPertahun::select(
            'produk_pertahun.tahun',
            'produk_pertahun.nama_produk',
            'produk_pertahun.harga',
            'produk_pertahun.produk_terjual'
        )
            ->join('produk', 'produk.id_produk', '=', 'produk_pertahun.id_produk')
            ->where('produk.id_kelompok', $id) // filter sesuai kelompok
            ->orderBy('produk_pertahun.nama_produk')
            ->orderBy('produk_pertahun.tahun')
            ->get()
            ->groupBy('nama_produk');

        $informasiUser = \App\Models\InformasiUser::where('id_kelompok', $id)->first();

        return view('Pengunjung.kelompok', [
            'kelompok' => $kelompok,
            'struktur' => $struktur,
            'rentanGrouped' => $rentanGrouped,
            'rentanCategories' => $rentanCategories,
            'produk' => $produk,
            'katalog' => $katalog,
            'totalProdukTerjual' => $totalProdukTerjual,
            'inovasiImages' => $inovasiImages,
            'kegiatan' => $kegiatan,
            'rekap' => $rekap,
            'informasiUser' => $informasiUser
        ]);
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
