<?php

namespace App\Http\Controllers\Admin_Kelompok;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Katalog;
use App\Models\Kegiatan;
use App\Models\Kelompok;
use App\Models\KelompokRentan;
use App\Models\Produk;
use App\Models\StrukturOrganisasi;
use App\Models\V_Struktur__Rentan;
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

        $kelompok = Kelompok::firstOrFail();

        if ($kelompok->sk_desa && !is_array(json_decode($kelompok->sk_desa, true))) {
            $kelompok->update(['sk_desa' => json_encode([])]);
        }

        $struktur = StrukturOrganisasi::select('id_struktur', 'nama', 'jabatan', 'id_rentan')
            ->where('id_kelompok', $kelompok->id_kelompok)
            ->get()
            ->sortBy(fn($item) => $jabatanOrder[$item->jabatan] ?? 999);

        $rentan = KelompokRentan::all();

        $strukturRentan = DB::table('struktur_organisasi')
            ->leftJoin('rentan', 'struktur_organisasi.id_rentan', '=', 'rentan.id_rentan')
            ->select('struktur_organisasi.nama', 'rentan.id_rentan')
            ->where('struktur_organisasi.id_kelompok', $kelompok->id_kelompok)
            ->get();

        $dataRentan = [];
        foreach ($rentan as $r) {
            $dataRentan[$r->nama_rentan] = $strukturRentan->where('id_rentan', $r->id_rentan)->pluck('nama')->toArray();
        }

        $strukturEdit = null;

        return view('Admin_Kelompok.kelompok', compact(
            'kelompok',
            'struktur',
            'rentan',
            'strukturEdit',
            'dataRentan'
        ));
    }

    public function create()
    {
         $kelompok = Kelompok::all();
        $rentan = KelompokRentan::all(); 
        return view('Admin_kelompok.create', compact('kelompok', 'rentan'));
   
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

        //$kelompok = Kelompok::where('id_kelompok', $id)->firstOrFail();
            $kelompok = Kelompok::findOrFail($id);

         $struktur = DB::table('struktur_organisasi')
            ->join('rentan', 'struktur_organisasi.id_rentan', '=', 'rentan.id_rentan')
            ->where('struktur_organisasi.id_kelompok', $id) // ✅ filter by kelompok
            ->select(
                'struktur_organisasi.id_struktur',
                'struktur_organisasi.nama',
                'struktur_organisasi.jabatan',
                'rentan.nama_rentan as rentan'
            )
            ->get()
            ->sortBy(function ($item) use ($jabatanOrder) {
                return $jabatanOrder[$item->jabatan] ?? 999;
            });

            $rentan = DB::table('rentan')->get();
            $dataRentan = [];
            foreach ($rentan as $r) {
                $dataRentan[$r->nama_rentan] = $struktur
                    ->where('rentan', $r->nama_rentan)
                    ->pluck('nama')
                    ->toArray();
    }
             return view('Admin_Kelompok.kelompok', [
            'kelompok' => $kelompok,
            'struktur' => $struktur,
             'rentan'   => $rentan,
              'dataRentan' => $dataRentan,
        
        ]);
    }

    public function edit(string $id)
    {
       
        $struktur = StrukturOrganisasi::findOrFail($id);
    $kelompok = Kelompok::all();
    $rentan = KelompokRentan::all();

    return view('Admin_Kelompok.kelompok.edit', compact('struktur', 'kelompok', 'rentan'));
}


//STRUKTUR
    public function storeStruktur(Request $request)
    {

        $request->validate([
            'id_kelompok' => 'required|exists:kelompok,id_kelompok',
            'nama'       => 'required|string|max:255',
            'jabatan'    => 'required|string|max:50',
            'id_rentan'  => 'required|exists:rentan,id_rentan',
        ]);

        StrukturOrganisasi::create($request->only('id_kelompok', 'nama', 'jabatan', 'id_rentan'));

        return redirect()->route('Admin_Kelompok.kelompok.show', $request->id_kelompok)
            ->with('success', 'Data berhasil ditambahkan!');
    }

    public function updateStruktur(Request $request, string $id)
    {
         $request->validate([
            'id_kelompok' => 'required|exists:kelompok,id_kelompok',
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:50',
            'id_rentan' => 'required|exists:rentan,id_rentan',
        ]);

        $struktur = StrukturOrganisasi::findOrFail($id);

        $struktur->update([
            'id_kelompok' => $request->id_kelompok,
            'nama' => $request->nama,
            'jabatan' => $request->jabatan,
            'id_rentan' => $request->id_rentan,
        ]);

         return redirect()->route('Admin_Kelompok.kelompok.show', $request->id_kelompok)
                     ->with('success', 'Data berhasil diperbarui!');
    }

    public function deleteStruktur(Request $request, string $id)
{
    try {
        $struktur = StrukturOrganisasi::findOrFail($id);
        $idKelompok = $request->id_kelompok ?? $struktur->id_kelompok; // ✅ prioritas dari form

        $struktur->delete();
        
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Data berhasil dihapus dari database!'
            ]);
        }

        return redirect()->route('Admin_Kelompok.kelompok.show', $idKelompok)
                         ->with('success', 'Data berhasil dihapus!');
    } catch (\Exception $e) {
        if ($request->ajax()) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus data: ' . $e->getMessage()
            ], 500);
        }
        
        return redirect()->back()->with('error', 'Gagal menghapus data!');
    }
}


// SEJARAH
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


// KELOMPOK RENTAN
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


// SK DESA
public function storeSkDesa(Request $request, $id)
{
    $request->validate([
        'judul' => 'required|string|max:255',
        'file' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
    ]);

    $kelompok = Kelompok::findOrFail($id);

    $originalName = $request->file('file')->getClientOriginalName();
    $baseName = pathinfo($originalName, PATHINFO_FILENAME);
    $extension = $request->file('file')->getClientOriginalExtension();
    $fileName = $originalName;
    $counter = 1;

    while (Storage::disk('public')->exists('sk_desa/' . $fileName)) {
        $fileName = $baseName . '_' . $counter . '.' . $extension;
        $counter++;
    }

    $filePath = $request->file('file')->storeAs('sk_desa', $fileName, 'public');

    $skDesa = $kelompok->sk_desa ? json_decode($kelompok->sk_desa, true) : [];

    $skDesa[] = [
        'judul' => $request->judul,
        'file_path' => $filePath,
    ];

    $kelompok->update([
        'sk_desa' => json_encode($skDesa)
    ]);

    return redirect()->back()->with('success', 'SK Desa berhasil ditambahkan');
}

public function deleteSkDesa($id, $index)
{
    $kelompok = Kelompok::findOrFail($id);
    $skDesa = $kelompok->sk_desa ?? [];

    if (isset($skDesa[$index])) {
        $filePath = $skDesa[$index]['file_path'];

        if (file_exists(storage_path('app/public/'.$filePath))) {
            unlink(storage_path('app/public/'.$filePath));
        }

        unset($skDesa[$index]);
        $skDesa = array_values($skDesa);

        $kelompok->update(['sk_desa' => $skDesa]);
    }

    return back()->with('success', 'SK Desa berhasil dihapus!');
}

//PRODUK


}
