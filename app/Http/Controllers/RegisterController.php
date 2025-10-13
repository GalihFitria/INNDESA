<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\InformasiUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Kelompok;
use Illuminate\Support\Facades\DB;
use App\Models\UserAdmin;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index()
{
    return redirect()->route('register.create');
}

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

    if (!$user || !Hash::check($request->password, optional($user)->password)) {
    return back()
        ->withErrors([
            'username' => 'Username atau kata sandi salah',
            'password' => 'Username atau kata sandi salah'
        ])
        ->withInput($request->except(['username', 'password']));
}



    // Validasi password
    if (!Hash::check($request->password, $user->password)) {
        return back()->withInput()->with('error', 'Password salah!');
    }

    // ✅ Cek apakah email sudah ada di tabel InformasiUser
    $emailExists = InformasiUser::where('email', $request->email)->exists();
    if ($emailExists) {
        return back()->withInput()->with('email_warning', 'Email sudah terdaftar. Silakan gunakan email lainnya!');
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

    // ✅ Langsung login user setelah registrasi
    Auth::login($user);

    // ✅ Cari data admin_kelompok untuk user ini
    $adminKelompok = DB::table('admin_kelompok')
        ->where('id_user', $user->id_user)
        ->first();

        

    // ✅ Jika ditemukan, arahkan ke halaman kelompok
    if ($adminKelompok) {
        return redirect()
            ->route('Admin_Kelompok.kelompok.show', $adminKelompok->id_kelompok)
            ->with('success', 'Registrasi berhasil! Anda telah masuk ke halaman kelompok Anda.');
    }

    // Jika belum ada data admin_kelompok, fallback ke beranda
    return redirect()->route('beranda')->with('success', 'Registrasi berhasil!');
}


public function destroy($id)
{
    $info = InformasiUser::findOrFail($id);
    $info->delete(); // otomatis update table users juga

    return back()->with('success', 'Data berhasil dihapus');
}




}