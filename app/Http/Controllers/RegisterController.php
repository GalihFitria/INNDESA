<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\InformasiUser;
use Illuminate\Support\Facades\Hash;
use App\Models\Kelompok;
use App\Models\UserAdmin;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
     public function create()
{
    // Ambil semua id_kelompok yang sudah dipakai di admin_kelompok
    $usedKelompok = \DB::table('admin_kelompok')->pluck('id_kelompok');

    // Ambil semua kelompok yang id-nya TIDAK ada di admin_kelompok
    $kelompok = \App\Models\Kelompok::whereNotIn('id_kelompok', $usedKelompok)->get();

    return view('pengunjung.register', compact('kelompok'));
}


public function store(Request $request)
{
    // Cari user dari tabel users berdasarkan username
    $user = UserAdmin::where('username', $request->username)->first();

    if (!$user) {
        return back()->withInput()->with('error', 'Username tidak ditemukan!');
    }

    // Validasi password
    if (!Hash::check($request->password, $user->password)) {
        return back()->withInput()->with('error', 'Password salah!');
    }

    // Simpan ke tabel InformasiUser
    $informasiUser = InformasiUser::create([
        'id_kelompok' => $request->id_kelompok,
        'id_user'     => $user->id_user,
        'username'    => $request->username,
        'password'    => Hash::make($request->password),
        'no_telp'     => $request->no_telp,
        'ig'          => $request->ig,
        'facebook'    => $request->facebook,
        'email'       => $request->email,
    ]);

    // Update status user di tabel users
    $user->update([
        'status' => 'sudah daftar',
        'email'  => $request->email,
    ]);

    // 🔥 Arahkan langsung ke halaman kelompok sesuai id_kelompok
    return redirect()
        ->route('kelompok.show', $request->id_kelompok)
        ->with('success', 'Registrasi berhasil! Anda langsung diarahkan ke kelompok Anda.');
}


public function destroy($id)
{
    $info = InformasiUser::findOrFail($id);
    $info->delete(); // otomatis update table users juga

    return back()->with('success', 'Data berhasil dihapus');
}




}