<?php

namespace App\Http\Controllers\Admin_Kelompok;
use App\Http\Controllers\Controller;
use App\Models\InformasiUser;
use Illuminate\Http\Request;
use App\Models\Katalog;
use App\Models\Kegiatan;
use App\Models\Kelompok;
use App\Models\KelompokRentan;
use App\Models\ProdukPertahun;
use App\Models\InovasiPenghargaan;

use App\Models\Produk;
use App\Models\StrukturOrganisasi;
use App\Models\V_Struktur__Rentan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;



class KelompokController extends Controller
{
    

    public function index()
    {
    //     $jabatanOrder = [
    //     'Ketua' => 1,
    //     'Wakil Ketua' => 2,
    //     'Sekretaris' => 3,
    //     'Bendahara' => 4,
    //     'Anggota' => 5,
    // ];

   $struktur = StrukturOrganisasi::all();
   $kelompok = Kelompok::findOrFail(1);

     //$kelompok = Kelompok::findOrFail($id);
    // $struktur = StrukturOrganisasi::select('id_struktur', 'nama', 'jabatan', 'id_rentan')
    //     ->get()
    //     ->sortBy(fn ($item) => $jabatanOrder[$item->jabatan] ?? 999);

    $rentan = KelompokRentan::all();

    // default null untuk edit
    $strukturEdit = null;

     $strukturRentan = DB::table('struktur_organisasi')
        ->leftJoin('rentan', 'struktur_organisasi.id_rentan', '=', 'rentan.id_rentan')
        ->select('struktur_organisasi.nama', 'rentan.id_rentan')
        ->get();

    // ✅ mapping: nama_rentan => list anggota
    $dataRentan = [];
    foreach ($rentan as $r) {
        $dataRentan[$r->nama_rentan] = $strukturRentan->where('id_rentan', $r->id_rentan)->pluck('nama')->toArray();
    }

    // default null untuk edit
    $strukturEdit = null;
    $inovasi = InovasiPenghargaan::where('id_kelompok', 1)->get();



    return view('Admin_Kelompok.kelompok', compact(
        'kelompok', 'struktur', 'rentan', 'strukturEdit', 'dataRentan','inovasi',
    ));
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

    $kelompok = Kelompok::findOrFail($id);

    // Ambil produk sesuai id_kelompok
    $produk = Produk::with('kelompok')
        ->where('id_kelompok', $id)
        ->get();

    $totalProdukTerjual = Produk::where('id_kelompok', $id)
        ->sum('produk_terjual');

    $struktur = DB::table('struktur_organisasi')
        ->join('rentan', 'struktur_organisasi.id_rentan', '=', 'rentan.id_rentan')
        ->where('struktur_organisasi.id_kelompok', $id)
        ->select(
            'struktur_organisasi.id_struktur',
            'struktur_organisasi.nama',
            'struktur_organisasi.jabatan',
            'struktur_organisasi.id_rentan',
            'rentan.nama_rentan as rentan'
        )
        ->orderByRaw("CASE 
            WHEN struktur_organisasi.jabatan = 'Ketua' THEN 1
            WHEN struktur_organisasi.jabatan = 'Wakil Ketua' THEN 2
            WHEN struktur_organisasi.jabatan = 'Sekretaris' THEN 3
            WHEN struktur_organisasi.jabatan = 'Bendahara' THEN 4
            WHEN struktur_organisasi.jabatan = 'Anggota' THEN 5
            ELSE 99 END")
        ->get();

    $strukturGrouped = $struktur->groupBy('jabatan');

    $rentan = DB::table('rentan')->get();
    $dataRentan = [];
    foreach ($rentan as $r) {
        $dataRentan[$r->nama_rentan] = $struktur
            ->where('rentan', $r->nama_rentan)
            ->pluck('nama')
            ->toArray();
    }

    $inovasi = InovasiPenghargaan::where('id_kelompok', $id)->get();


    $kegiatan = Kegiatan::where('id_kelompok', $id)->get();

    $produkPertahun = DB::table('produk_pertahun')
        ->join('produk', 'produk.id_produk', '=', 'produk_pertahun.id_produk')
        ->select(
            'produk_pertahun.id_tahun',
            'produk_pertahun.id_produk',
            'produk_pertahun.harga',
            'produk_pertahun.produk_terjual',
            'produk_pertahun.tahun',
            'produk.nama as nama_produk'
        )
        ->get();

    $katalog = Katalog::where('id_kelompok', $id)->first();

    // Ambil id_kelompok dari admin_kelompok yang sedang login
    // Ambil id_kelompok dari admin_kelompok yang sedang login
    $userKelompokId = null;
    if (auth()->check()) {
        $admin = InformasiUser::where('id_user', auth()->id())->first();
        if ($admin) {
            $userKelompokId = $admin->id_kelompok;
        }
    }

    $data = [
        'kelompok' => $kelompok,
        'struktur' => $struktur,
        'strukturGrouped' => $strukturGrouped,
        'rentan' => $rentan,
        'dataRentan' => $dataRentan,
        'produk' => $produk,
        'inovasi' => $inovasi,
        'kegiatan' => $kegiatan,
        'produkPertahun' => $produkPertahun,
        'totalProdukTerjual' => $totalProdukTerjual,
        'katalog' => $katalog,
        'user_kelompok_id' => $userKelompokId, // Tambahkan ini
    ];

    // Pilih view sesuai kelompok login
    if ($userKelompokId === $kelompok->id_kelompok) {
        return view('Admin_Kelompok.kelompok', $data);
    }

    return view('Pengunjung.kelompok', $data);
}




    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         $kelompok = Kelompok::all();
        $rentan = KelompokRentan::all(); // ambil semua kelompok rentan
        return view('Admin_kelompok.create', compact('kelompok', 'rentan'));
   
    }

    /**
     * Store a newly created resource in storage.
     */
   

    /**
     * Display the specified resource.
     */
    

    public function edit(string $id)
    {
       
        $struktur = StrukturOrganisasi::findOrFail($id);
    $kelompok = Kelompok::all();
    $rentan = KelompokRentan::all();

    return view('Admin_Kelompok.kelompok.edit', compact('struktur', 'kelompok', 'rentan'));
}
    

    /**
     * Update the specified resource in storage.
     */
public function storeStruktur(Request $request, $id)
{
    $validated = $request->validate([
        'jabatan'   => 'required|string|max:255',
        'nama'      => 'required|string|max:255',
        'id_rentan' => 'nullable|exists:rentan,id_rentan',
    ]);

    $struktur = StrukturOrganisasi::create([
        'id_kelompok' => $id,
        'jabatan'     => $validated['jabatan'],
        'nama'        => $validated['nama'],
        'id_rentan'   => ($request->id_rentan && $request->id_rentan !== '-') 
                           ? $request->id_rentan 
                           : null,
    ]);

    return redirect()
        ->route('Admin_Kelompok.kelompok.show', $id)
        ->with('success', 'Data struktur berhasil disimpan!');
}

public function updateStruktur(Request $request, $id)
{
    $struktur = StrukturOrganisasi::findOrFail($id);

    $validated = $request->validate([
        'jabatan'   => 'required|string',
        'nama'      => 'required|string',
        'id_rentan' => 'nullable|exists:rentan,id_rentan',
    ]);

    $validated['id_rentan'] = ($request->id_rentan && $request->id_rentan !== '-') 
                                ? $request->id_rentan 
                                : null;

    $struktur->update($validated);

    return redirect()
        ->route('Admin_Kelompok.kelompok.show', $struktur->id_kelompok)
        ->with('success', 'Data struktur berhasil diperbarui!');
}



public function deleteStruktur($id)
{
    $struktur = StrukturOrganisasi::findOrFail($id);
    $idKelompok = $struktur->id_kelompok; // ambil id_kelompok sebelum hapus
    
    $struktur->delete();

    return redirect()
        ->route('Admin_Kelompok.kelompok.show', $idKelompok)
        ->with('success', 'Data struktur berhasil dihapus!');
}





    /**
     * SEJARAH
     */
    public function updateSejarah(Request $request, $id)
{
    $request->validate([
        'sejarah' => 'required|string',
    ]);

    $kelompok = Kelompok::findOrFail($id);
    $kelompok->update([
        'sejarah' => $request->sejarah,
    ]);

      return redirect()->route('Admin_Kelompok.kelompok.show', $id)
                     ->with('success', 'Sejarah berhasil diperbarui!');
}

public function kelompokRentan()
{
    $rentanList = DB::table('rentan')->pluck('nama_rentan', 'id_rentan'); 

    $struktur = DB::table('struktur_organisasi')
        ->leftJoin('rentan', 'struktur_organisasi.id_rentan', '=', 'rentan.id_rentan')
        ->select('struktur_organisasi.nama', 'rentan.id_rentan')
        ->get();

    $data = [];
    foreach ($rentanList as $id => $namaRentan) {
        $data[$namaRentan] = $struktur->where('id_rentan', $id)->pluck('nama')->toArray();
    }

    return redirect()->route('Admin_Kelompok.kelompok.show', $id)
                     ->with('success', 'Sejarah berhasil diperbarui!');
                    }
public function storeSkDesa(Request $request, $id)
{
    $request->validate([
        'file'  => 'nullable|mimes:jpg,jpeg,png,pdf|max:2048',
        'cropped_file' => 'nullable|string',
    ]);

    $kelompok = Kelompok::findOrFail($id);

    if (!empty($kelompok->sk_desa)) {
        return redirect()->back()->with('error', 'SK Desa sudah ada, tidak bisa menambah lagi.');
    }

    $filePath = null;

    if ($request->filled('cropped_file')) {
        $originalName = $request->input('file_original_name', 'skdesa.jpg');
        $baseName = Str::slug(pathinfo($originalName, PATHINFO_FILENAME));
        $extension = pathinfo($originalName, PATHINFO_EXTENSION) ?: 'jpg';
        $fileName = $baseName . '.' . $extension;

        $counter = 1;
        while (Storage::disk('public')->exists('sk_desa/' . $fileName)) {
            $fileName = $baseName . '_' . $counter . '.' . $extension;
            $counter++;
        }

        $imageData = $request->input('cropped_file');
        $image = preg_replace('#^data:image/\w+;base64,#i', '', $imageData);
        Storage::disk('public')->put('sk_desa/' . $fileName, base64_decode($image));

        // simpan path lengkap ke DB
        $filePath = 'sk_desa/' . $fileName;

    } elseif ($request->hasFile('file')) {
        $originalName = $request->file('file')->getClientOriginalName();
        $baseName = pathinfo($originalName, PATHINFO_FILENAME);
        $extension = $request->file('file')->getClientOriginalExtension();
        $fileName = $originalName;
        $counter = 1;

        while (Storage::disk('public')->exists('sk_desa/' . $fileName)) {
            $fileName = $baseName . '_' . $counter . '.' . $extension;
            $counter++;
        }

        $request->file('file')->storeAs('sk_desa', $fileName, 'public');

        // simpan path lengkap ke DB
        $filePath = 'sk_desa/' . $fileName;
    }

    if ($filePath) {
        $kelompok->update(['sk_desa' => $filePath]);
    }

    return redirect()->back()->with('success', 'SK Desa berhasil ditambahkan!');
}


public function updateSkDesa(Request $request, $id)
{
    $request->validate([
        'file'  => 'nullable|mimes:jpg,jpeg,png,pdf|max:2048',
        'cropped_file' => 'nullable|string',
    ]);

    $kelompok = Kelompok::findOrFail($id);

    // hapus jika diminta
    if ($request->boolean('delete_sk_desa')) {
        if (!empty($kelompok->sk_desa) && Storage::disk('public')->exists($kelompok->sk_desa)) {
            Storage::disk('public')->delete($kelompok->sk_desa);
        }
        $kelompok->update(['sk_desa' => null]);
        return redirect()->back()->with('success', 'SK Desa berhasil dihapus!');
    }

    $filePath = null;

    if ($request->filled('cropped_file')) {
        $originalName = $request->input('file_original_name', 'skdesa.jpg');
        $baseName = Str::slug(pathinfo($originalName, PATHINFO_FILENAME));
        $extension = pathinfo($originalName, PATHINFO_EXTENSION) ?: 'jpg';
        $fileName = $baseName . '.' . $extension;

        $counter = 1;
        while (Storage::disk('public')->exists('sk_desa/' . $fileName)) {
            $fileName = $baseName . '_' . $counter . '.' . $extension;
            $counter++;
        }

        $imageData = $request->input('cropped_file');
        $image = preg_replace('#^data:image/\w+;base64,#i', '', $imageData);
        Storage::disk('public')->put('sk_desa/' . $fileName, base64_decode($image));

        $filePath = 'sk_desa/' . $fileName;

    } elseif ($request->hasFile('file')) {
        $originalName = $request->file('file')->getClientOriginalName();
        $baseName = pathinfo($originalName, PATHINFO_FILENAME);
        $extension = $request->file('file')->getClientOriginalExtension();
        $fileName = $originalName;
        $counter = 1;

        while (Storage::disk('public')->exists('sk_desa/' . $fileName)) {
            $fileName = $baseName . '_' . $counter . '.' . $extension;
            $counter++;
        }

        $request->file('file')->storeAs('sk_desa', $fileName, 'public');

        $filePath = 'sk_desa/' . $fileName;
    }

    if ($filePath) {
        // hapus file lama biar nggak numpuk
        if (!empty($kelompok->sk_desa) && Storage::disk('public')->exists($kelompok->sk_desa)) {
            Storage::disk('public')->delete($kelompok->sk_desa);
        }

        $kelompok->update(['sk_desa' => $filePath]);
    }

    return redirect()->back()->with('success', 'SK Desa berhasil diperbarui!');
}


public function deleteSkDesa($id)
{
    $kelompok = Kelompok::findOrFail($id);

    if (!empty($kelompok->sk_desa)) {
        $filePath = 'sk_desa/' . $kelompok->sk_desa;

        // hapus file di storage kalau ada
        if (Storage::disk('public')->exists($filePath)) {
            Storage::disk('public')->delete($filePath);
        }

        // kosongkan di DB
        $kelompok->update([
            'sk_desa' => null
        ]);
    }

    return redirect()->back()->with('success', 'SK Desa berhasil dihapus!');
}




// STORE PRODUK
public function storeProduk(Request $request, $id_kelompok)
{
    $request->validate([
        'nama'       => 'required|string|max:255',
        'harga'      => 'required|numeric',
        'stok'       => 'required|integer',
        'deskripsi'  => 'required|string',
        'foto'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'sertifikat.*' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048'
    ]);

    // Simpan Foto Produk
    $fotoName = null;
    if ($request->hasFile('foto')) {
    $fotoName = $this->uniqueFileName($request->file('foto'), 'foto_produk');
    $request->file('foto')->storeAs('foto_produk', $fotoName, 'public');
    $fotoName = 'foto_produk/'.$fotoName; // ✅ simpan path lengkap
}

    // Simpan Banyak Sertifikat
    $sertifikatPaths = [];
    if ($request->hasFile('sertifikat')) {
    foreach ($request->file('sertifikat') as $file) {
        $fileName = $this->uniqueFileName($file, 'sertifikat_produk');
        $file->storeAs('sertifikat_produk', $fileName, 'public');
        $sertifikatPaths[] = 'sertifikat_produk/'.$fileName; // ✅ simpan path lengkap
    }
}

    Produk::create([
        'id_kelompok'    => $id_kelompok,
        'nama'           => $request->nama,
        'harga'          => $request->harga,
        'stok'           => $request->stok,
        'deskripsi'      => $request->deskripsi,
        'produk_terjual' => 0,
        'foto'           => $fotoName,
        // simpan jadi string dipisah koma
    'sertifikat'     => !empty($sertifikatPaths) ? implode(',', $sertifikatPaths) : null,
    ]);

    return redirect()->back()->with('success', 'Produk berhasil ditambahkan');
}

public function updateProduk(Request $request, $id)
{
    $produk = Produk::findOrFail($id);

    $request->validate([
        'nama'         => 'required|string|max:255',
        'harga'        => 'required|numeric',
        'stok'         => 'required|integer',
        'deskripsi'    => 'required|string',
        'foto'         => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'sertifikat.*' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048'
    ]);

    $data = [
        'nama'           => $request->nama,
        'harga'          => $request->harga,
        'stok'           => $request->stok,
        'deskripsi'      => $request->deskripsi,
        'produk_terjual' => $request->produk_terjual ?? $produk->produk_terjual,
    ];

    // === HAPUS FOTO JIKA USER KLIK ❌ ===
    if ($request->removed_foto == "1") {
        if ($produk->foto && Storage::disk('public')->exists('foto_produk/'.$produk->foto)) {
            Storage::disk('public')->delete('foto_produk/'.$produk->foto);
        }
        $data['foto'] = null;
    }

    // === UPDATE FOTO BARU JIKA DIUPLOAD ===
    if ($request->hasFile('foto')) {
    if ($produk->foto && Storage::disk('public')->exists($produk->foto)) {
        Storage::disk('public')->delete($produk->foto);
    }
    $fileName = $this->uniqueFileName($request->file('foto'), 'foto_produk');
    $request->file('foto')->storeAs('foto_produk', $fileName, 'public');
    $data['foto'] = 'foto_produk/'.$fileName; // ✅ simpan path lengkap
}

 // === LOGIKA UPDATE SERTIFIKAT ===
$existing = $produk->sertifikat ? explode(',', $produk->sertifikat) : [];

// ✅ Parsing removed_sertifikat konsisten (selalu JSON)
$removedSertifikat = [];
if ($request->filled('removed_sertifikat')) {
    $removedSertifikat = json_decode($request->removed_sertifikat, true);
    $removedSertifikat = is_array($removedSertifikat) ? $removedSertifikat : [];
}

if (!empty($removedSertifikat)) {
    foreach ($removedSertifikat as $remove) {
        if (in_array($remove, $existing)) {
            if (Storage::disk('public')->exists('sertifikat_produk/'.$remove)) {
                Storage::disk('public')->delete('sertifikat_produk/'.$remove);
            }
            // hapus dari array existing
            $existing = array_values(array_diff($existing, [$remove]));
        }
    }
}

// === TAMBAH FILE BARU JIKA ADA ===
if ($request->hasFile('sertifikat')) {
    foreach ($request->file('sertifikat') as $file) {
        $fileName = $this->uniqueFileName($file, 'sertifikat_produk');
        $file->storeAs('sertifikat_produk', $fileName, 'public');
        $existing[] = 'sertifikat_produk/'.$fileName; // ✅ simpan path lengkap
    }
}

// ✅ simpan sebagai string dipisahkan koma
$data['sertifikat'] = !empty($existing) ? implode(',', $existing) : null;


    $produk->update($data);

    return back()->with('success', 'Produk berhasil diperbarui');
}






// FUNGSI BANTU BUAT NAMA FILE UNIK
private function uniqueFileName($file, $folder)
{
    $originalName = $file->getClientOriginalName();
    $baseName = pathinfo($originalName, PATHINFO_FILENAME);
    $extension = $file->getClientOriginalExtension();
    $fileName = $originalName;
    $counter = 1;

    while (Storage::disk('public')->exists($folder.'/'.$fileName)) {
        $fileName = $baseName.'_'.$counter.'.'.$extension;
        $counter++;
    }

    return $fileName;
}

public function deleteProduk($id)
{
    try {
        $produk = Produk::findOrFail($id);

        // simpan id_kelompok kalau kamu perlu validasi tambahan
        $idKelompok = $produk->id_kelompok;

        // Hapus file foto jika ada
        if ($produk->foto && Storage::disk('public')->exists($produk->foto)) {
            Storage::disk('public')->delete($produk->foto);
        }

        // Hapus file sertifikat jika ada
        if ($produk->sertifikat && Storage::disk('public')->exists($produk->sertifikat)) {
            Storage::disk('public')->delete($produk->sertifikat);
        }

        $produk->delete();

        // balik ke halaman sebelumnya (misal: /Admin_Kelompok/kelompok/2)
        return redirect()->back()->with('success', 'Produk berhasil dihapus');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', $e->getMessage());
    }
}


// STORE Inovasi
 public function storeInovasi(Request $request, $idKelompok)
{
    $request->validate([
        'judul_inovasi' => 'required|string|max:255',
        'foto' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
    ]);

    $inovasi = new InovasiPenghargaan();
    $inovasi->id_kelompok = $idKelompok;
    $inovasi->judul_inovasi = $request->judul_inovasi;

    $originalName = $request->file('foto')->getClientOriginalName();
    $baseName = pathinfo($originalName, PATHINFO_FILENAME);
    $extension = $request->file('foto')->getClientOriginalExtension();

    $fileName = $originalName;
    $counter = 1;

    while (Storage::disk('public')->exists('inovasi/' . $fileName)) {
        $fileName = $baseName . '_' . $counter . '.' . $extension;
        $counter++;
    }

    $path = $request->file('foto')->storeAs('inovasi', $fileName, 'public');
    $inovasi->foto = $path;

    $inovasi->save();

    return redirect("/Admin_Kelompok/kelompok/{$idKelompok}")
        ->with('success', 'Inovasi berhasil ditambahkan!');
}

public function updateInovasi(Request $request, $id)
{
    $inovasi = InovasiPenghargaan::findOrFail($id);

    // Jika hapus file + record
    if ($request->input('deleteInovasiFile') === "1") {
        if ($inovasi->foto && Storage::disk('public')->exists($inovasi->foto)) {
            Storage::disk('public')->delete($inovasi->foto);
        }
        $inovasi->delete();

        return redirect("/Admin_Kelompok/kelompok/{$inovasi->id_kelompok}")
            ->with('success', 'Inovasi berhasil dihapus!');
    }

    $request->validate([
        'judul_inovasi' => 'required|string|max:255',
        'foto' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
    ]);

    $inovasi->judul_inovasi = $request->judul_inovasi;

    if ($request->hasFile('foto')) {
        if ($inovasi->foto && Storage::disk('public')->exists($inovasi->foto)) {
            Storage::disk('public')->delete($inovasi->foto);
        }

        $originalName = $request->file('foto')->getClientOriginalName();
        $path = $request->file('foto')->storeAs('inovasi', $originalName, 'public');
        $inovasi->foto = $path;
    }

    $inovasi->save();

    return redirect("/Admin_Kelompok/kelompok/{$inovasi->id_kelompok}")
        ->with('success', 'Inovasi berhasil diperbarui!');
}





// Controller: KelompokController.php
public function deleteInovasi($id)
{
    $inovasi = InovasiPenghargaan::findOrFail($id);

    // Hapus file dari storage kalau ada
    if ($inovasi->foto && Storage::disk('public')->exists($inovasi->foto)) {
        Storage::disk('public')->delete($inovasi->foto);
    }

    // Hapus record dari DB
    $inovasi->delete();

    return redirect()->back()->with('success', 'Inovasi berhasil dihapus!');
}


public function updateStok(Request $request, $id)
{
    $produk = \DB::table('produk')->where('id_produk', $id)->first();

    if (!$produk) {
        return redirect()->back()->with('error', 'Produk tidak ditemukan');
    }

    \DB::table('produk')
        ->where('id_produk', $id)
        ->update([
            'stok' => $request->stok,
        ]);

    return redirect()->back()->with('success', 'Stok berhasil diperbarui');
}



 public function storeKegiatan(Request $request, $id)
{
    $validated = $request->validate([
        'judul'         => 'required|max:200',
        'deskripsi'     => 'required|max:500',
        'tanggal'       => 'required|date',
        'sumber_berita' => 'nullable|string',
        'foto'          => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $kegiatan = new Kegiatan();
    $kegiatan->id_kelompok   = $id;
    $kegiatan->judul         = $validated['judul'];
    $kegiatan->deskripsi     = $validated['deskripsi'];
    $kegiatan->tanggal       = $validated['tanggal'];
    $kegiatan->sumber_berita = $validated['sumber_berita']
        ? implode(',', array_map('trim', explode(',', $validated['sumber_berita'])))
        : null;

    // ✅ Upload foto ke folder "kegiatan" + simpan path dengan foldernya
    // Saat menyimpan file baru
if ($request->hasFile('foto')) {
    $file = $request->file('foto');
    $fileName = $this->uniqueFileName($file, 'kegiatan');
    $path = $file->storeAs('kegiatan', $fileName, 'public'); // Simpan di storage/app/public/kegiatan/
    $kegiatan->foto = $path; // Simpan path lengkap: "kegiatan/nama_file.jpg"
}
    $kegiatan->save();

    return back()->with('success', 'Kegiatan berhasil ditambahkan');
}

public function updateKegiatan(Request $request, $id)
{
    $kegiatan = Kegiatan::findOrFail($id);

    // Hapus foto kalau user klik ❌
    if ($request->input('deleteKegiatanFile') === "1") {
        if ($kegiatan->foto && Storage::disk('public')->exists($kegiatan->foto)) {
            Storage::disk('public')->delete($kegiatan->foto);
        }
        $kegiatan->foto = null;
    }

    $kegiatan->judul         = $request->input('judul');
    $kegiatan->deskripsi     = $request->input('deskripsi');
    $kegiatan->tanggal       = $request->input('tanggal');
    $kegiatan->sumber_berita = $request->input('sumber_berita');

    // Replace dengan upload baru
     // Saat menyimpan file baru
if ($request->hasFile('foto')) {
    $file = $request->file('foto');
    $fileName = $this->uniqueFileName($file, 'kegiatan');
    $path = $file->storeAs('kegiatan', $fileName, 'public'); // Simpan di storage/app/public/kegiatan/
    $kegiatan->foto = $path; // Simpan path lengkap: "kegiatan/nama_file.jpg"
}
    $kegiatan->save();

    return redirect("/Admin_Kelompok/kelompok/{$kegiatan->id_kelompok}")
        ->with('success', 'Kegiatan berhasil diperbarui!');
}



public function deleteKegiatan($id_kegiatan)
{
    $kegiatan = Kegiatan::findOrFail($id_kegiatan);
    $kegiatan->delete();
    return back()->with('success', 'Kegiatan berhasil dihapus');
}



//PRODUK TAHUNAN
// ===== PRODUK PERTAHUN =====
 /**
 * Store a newly created ProdukPertahun in storage.
 */
public function storeProdukPertahun(Request $request)
{
    $validated = $request->validate([
        'tahun' => 'required|numeric|min:1900|max:9999',
        'id_produk' => 'required|exists:produk,id_produk',
        'harga' => 'required|numeric|min:0',
        'produk_terjual' => 'required|numeric|min:0',
    ]);

    try {
        // Ambil data produk dan kelompok tanpa relasi
        $produk = DB::table('produk')
            ->join('kelompok', 'produk.id_kelompok', '=', 'kelompok.id_kelompok')
            ->where('produk.id_produk', $validated['id_produk'])
            ->select('produk.nama as nama_produk', 'kelompok.nama as nama_kelompok', 'kelompok.id_kelompok')
            ->first();

        if (!$produk) {
            throw new \Exception('Produk atau kelompok tidak ditemukan.');
        }

        ProdukPertahun::create([
            'tahun' => $validated['tahun'],
            'id_produk' => $validated['id_produk'],
            'nama_kelompok' => $produk->nama_kelompok ?? 'Tidak Diketahui',
            'nama_produk' => $produk->nama_produk,
            'harga' => $validated['harga'],
            'produk_terjual' => $validated['produk_terjual'],
        ]);

        return redirect()->route('Admin_Kelompok.kelompok.show', $produk->id_kelompok)
            ->with('success', 'Produk pertahun berhasil ditambahkan!');
    } catch (\Exception $e) {
        return redirect()->back()
            ->with('error', 'Gagal menyimpan data: ' . $e->getMessage())
            ->withInput();
    }
}

/**
 * Update the specified ProdukPertahun in storage.
 */
public function updateProdukPertahun(Request $request, $id)
{
    $validated = $request->validate([
        'tahun' => 'required|numeric|min:1900|max:9999',
        'id_produk' => 'required|exists:produk,id_produk',
        'harga' => 'required|numeric|min:0',
        'produk_terjual' => 'required|numeric|min:0',
    ]);

    try {
        $produk_pertahun = ProdukPertahun::where('id_tahun', $id)->firstOrFail();
        $produk = DB::table('produk')
            ->join('kelompok', 'produk.id_kelompok', '=', 'kelompok.id_kelompok')
            ->where('produk.id_produk', $validated['id_produk'])
            ->select('produk.nama as nama_produk', 'kelompok.nama as nama_kelompok', 'kelompok.id_kelompok')
            ->first();

        if (!$produk) {
            throw new \Exception('Produk atau kelompok tidak ditemukan.');
        }

        $produk_pertahun->update([
            'tahun' => $validated['tahun'],
            'id_produk' => $validated['id_produk'],
            'nama_kelompok' => $produk->nama_kelompok ?? 'Tidak Diketahui',
            'nama_produk' => $produk->nama_produk,
            'harga' => $validated['harga'],
            'produk_terjual' => $validated['produk_terjual'],
        ]);

        return redirect()->route('Admin_Kelompok.kelompok.show', $request->id_kelompok ?? $produk->id_kelompok)
            ->with('success', 'Produk pertahun berhasil diperbarui!');
    } catch (\Exception $e) {
        return redirect()->back()
            ->with('error', 'Gagal memperbarui data: ' . $e->getMessage())
            ->withInput();
    }
}

/**
 * Remove the specified ProdukPertahun from storage.
 */
public function deleteProdukPertahun($id)
{
    try {
        $produk_pertahun = ProdukPertahun::where('id_tahun', $id)->firstOrFail();

        $produk = DB::table('produk')
            ->where('id_produk', $produk_pertahun->id_produk)
            ->select('id_kelompok')
            ->first();

        if (!$produk || !$produk->id_kelompok) {
            throw new \Exception('Kelompok tidak ditemukan.');
        }

        $produk_pertahun->delete();

        return redirect()->route('Admin_Kelompok.kelompok.show', $produk->id_kelompok)
            ->with('success', 'Produk pertahun berhasil dihapus!');
    } catch (\Exception $e) {
        return redirect()->back()
            ->with('error', 'Gagal menghapus data: ' . $e->getMessage());
    }
}


//  public function deleteProdukPertahun(Request $request, $id)
// {
//     $produkTahun = ProdukPertahun::findOrFail($id);
//     $produkTahun->delete();

//     return redirect('/Admin_Kelompok/kelompok/' . $request->id_kelompok)
//            ->with('success', 'Produk pertahun berhasil dihapus');
// }

// public function getProduk($id)
// {
//     $produk = \App\Models\Produk::find($id);

//     if (!$produk) {
//         return response()->json(['error' => 'Produk tidak ditemukan'], 404);
//     }

//     return response()->json([
//         'id'   => $produk->id_produk,
//         'nama' => $produk->nama
//     ]);
// }


// ===============================
// STORE KATALOG
// ===============================
 

// ===============================
// STORE KATALOG
// ===============================
// ===============================
// ===============================
// STORE KATALOG
// ===============================
public function storeKatalog(Request $request)
{
    $request->validate([
        'katalog' => 'required|mimes:jpg,jpeg,png,pdf|max:2048',
        'id_kelompok' => 'required|integer'
    ]);

    // Cek kalau kelompok sudah punya katalog
    $exists = Katalog::where('id_kelompok', $request->id_kelompok)->first();
    if ($exists) {
        return redirect()
            ->back()
            ->with('error', 'Kelompok ini sudah memiliki katalog. Gunakan Edit untuk memperbarui.');
    }

    $filePath = null;
    if ($request->hasFile('katalog')) {
        $originalName = $request->file('katalog')->getClientOriginalName();
        $baseName = pathinfo($originalName, PATHINFO_FILENAME);
        $extension = $request->file('katalog')->getClientOriginalExtension();
        $fileName = $originalName;
        $counter = 1;

        // pastikan tidak bentrok nama file
        while (Storage::disk('public')->exists('katalog/' . $fileName)) {
            $fileName = $baseName . '_' . $counter . '.' . $extension;
            $counter++;
        }

        // Simpan file ke dalam folder katalog
        $request->file('katalog')->storeAs('katalog', $fileName, 'public');
        
        // Simpan path lengkap ke database
        $filePath = 'katalog/' . $fileName;
    }

    // Simpan ke DB dengan path lengkap
    $katalog = Katalog::create([
        'id_kelompok' => $request->id_kelompok,
        'katalog' => $filePath,
    ]);

    return redirect()
        ->route('Admin_Kelompok.kelompok.show', $request->id_kelompok)
        ->with('success', 'Katalog berhasil ditambahkan!');
}

// ===============================
// UPDATE KATALOG
// ===============================
public function updateKatalog(Request $request, $id)
{
    $katalog = Katalog::findOrFail($id);

    // Cek apakah user minta hapus file
    if ($request->input('deleteExistingKatalog') === "1") {
        if ($katalog->katalog && Storage::disk('public')->exists($katalog->katalog)) {
            Storage::disk('public')->delete($katalog->katalog);
        }

        $id_kelompok = $katalog->id_kelompok;
        $katalog->delete();

        return redirect()
            ->route('Admin_Kelompok.kelompok.show', $id_kelompok)
            ->with('success', 'Katalog berhasil dihapus!');
    }

    $request->validate([
        'katalog' => 'nullable|mimes:jpg,jpeg,png,pdf|max:2048',
    ]);

    if ($request->hasFile('katalog')) {
        // Hapus file lama jika ada
        if ($katalog->katalog && Storage::disk('public')->exists($katalog->katalog)) {
            Storage::disk('public')->delete($katalog->katalog);
        }

        $originalName = $request->file('katalog')->getClientOriginalName();
        $baseName = pathinfo($originalName, PATHINFO_FILENAME);
        $extension = $request->file('katalog')->getClientOriginalExtension();
        $fileName = $originalName;
        $counter = 1;

        while (Storage::disk('public')->exists('katalog/' . $fileName)) {
            $fileName = $baseName . '_' . $counter . '.' . $extension;
            $counter++;
        }

        // Simpan file baru
        $request->file('katalog')->storeAs('katalog', $fileName, 'public');
        
        // Update path di database
        $katalog->katalog = 'katalog/' . $fileName;
    }

    $katalog->save();

    return redirect()
        ->route('Admin_Kelompok.kelompok.show', $katalog->id_kelompok)
        ->with('success', 'Katalog berhasil diperbarui!');
}

// ===============================
// DELETE KATALOG
// ===============================
public function deleteKatalog($id)
{
    $katalog = Katalog::findOrFail($id);

    // Hapus file dari storage
    if ($katalog->katalog && Storage::disk('public')->exists($katalog->katalog)) {
        Storage::disk('public')->delete($katalog->katalog);
    }

    $id_kelompok = $katalog->id_kelompok;
    $katalog->delete();

    return redirect()
        ->route('Admin_Kelompok.kelompok.show', $id_kelompok)
        ->with('success', 'Katalog berhasil dihapus!');
}



}
