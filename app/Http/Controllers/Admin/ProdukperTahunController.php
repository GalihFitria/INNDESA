<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use App\Models\ProdukPertahun;
use Illuminate\Support\Facades\Http;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ProdukperTahunController extends Controller
{
    // Tambahkan method untuk memperbarui data produk
    private function updateProdukData(ProdukPertahun $produkPertahun)
    {
        $produk = Produk::with('kelompok')->find($produkPertahun->id_produk);
        if ($produk) {
            $produkPertahun->nama_produk = $produk->nama;
            $produkPertahun->nama_kelompok = $produk->kelompok->nama ?? 'Tidak Diketahui';
            $produkPertahun->save();
        }
    }

    public function index(Request $request)
    {
        $search = $request->input('search');
        $query = ProdukPertahun::query();

        if ($search) {
            $query->where('id_tahun', 'like', "%{$search}%")
                ->orWhere('nama_kelompok', 'like', "%{$search}%")
                ->orWhere('nama_produk', 'like', "%{$search}%");
        }

        $produks_pertahun = $query->get();

        // Perbarui data untuk setiap produk_pertahun
        foreach ($produks_pertahun as $produkPertahun) {
            $this->updateProdukData($produkPertahun);
        }

        return view('Admin.produk_pertahun.index', compact('produks_pertahun', 'search'));
    }

    public function create()
    {
        $produks = Produk::with('kelompok')->get();
        return view('Admin.produk_pertahun.create', compact('produks'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tahun' => 'required|numeric|min:1900|max:9999',
            'id_produk' => 'required|exists:produk,id_produk',
            'harga' => 'required|numeric|min:0',
            'jumlah_terjual' => 'required|numeric|min:0',
        ]);

        try {
            $produk = Produk::with('kelompok')->findOrFail($validated['id_produk']);
            ProdukPertahun::create([
                'tahun' => $validated['tahun'],
                'id_produk' => $validated['id_produk'],
                'nama_kelompok' => $produk->kelompok->nama ?? 'Tidak Diketahui',
                'nama_produk' => $produk->nama,
                'harga' => $validated['harga'],
                'produk_terjual' => $validated['jumlah_terjual'],
            ]);

            return redirect()->route('Admin.produk_pertahun.index')->with('success', 'Data produk berhasil disimpan!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    }

    public function edit(string $id)
    {
        $produk_pertahun = ProdukPertahun::findOrFail($id);

        // Perbarui data sebelum ditampilkan
        $this->updateProdukData($produk_pertahun);

        $produks = Produk::with('kelompok')->get();
        return view('Admin.produk_pertahun.edit', compact('produk_pertahun', 'produks'));
    }

    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'tahun' => 'required|numeric|min:1900|max:9999',
            'id_produk' => 'required|exists:produk,id_produk',
            'harga' => 'required|numeric|min:0',
            'jumlah_terjual' => 'required|numeric|min:0',
        ]);

        try {
            $produk_pertahun = ProdukPertahun::findOrFail($id);
            $produk = Produk::with('kelompok')->findOrFail($validated['id_produk']);

            $produk_pertahun->update([
                'tahun' => $validated['tahun'],
                'id_produk' => $validated['id_produk'],
                'nama_kelompok' => $produk->kelompok->nama ?? 'Tidak Diketahui',
                'nama_produk' => $produk->nama,
                'harga' => $validated['harga'],
                'produk_terjual' => $validated['jumlah_terjual'],
            ]);

            return redirect()->route('Admin.produk_pertahun.index')->with('success', 'Data produk berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memperbarui data: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy(string $id)
    {
        try {
            $produk_pertahun = ProdukPertahun::findOrFail($id);
            $produk_pertahun->delete();
            return redirect()->route('Admin.produk_pertahun.index')->with('success', 'Data produk berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }

    public function exportPdf(Request $request)
    {
        try {
            $produks_pertahun = ProdukPertahun::orderBy('nama_kelompok', 'asc')
                ->orderBy('nama_produk', 'asc')
                ->orderBy('tahun', 'asc')
                ->get();

            if ($produks_pertahun->isEmpty()) {
                return back()->with('error', 'Tidak ada data produk untuk diexport.');
            }

            // Perbarui data sebelum diexport
            foreach ($produks_pertahun as $produkPertahun) {
                $this->updateProdukData($produkPertahun);
            }

            $pdf = Pdf::loadView('pdf.cetak', compact('produks_pertahun'))
                ->setPaper('a4', 'landscape');

            return $pdf->download('laporan_produk_pertahun.pdf');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal membuat PDF: ' . $e->getMessage());
        }
    }
}
