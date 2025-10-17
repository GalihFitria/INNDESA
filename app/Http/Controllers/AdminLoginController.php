<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserAdmin;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminLoginController extends Controller
{
    public function index()
    {
        return view('pengunjung.admin_login');
    }

    public function store(Request $request)
{
    $user = UserAdmin::where('username', $request->username)->first();

      

    $user = UserAdmin::where('username', $request->username)->first();

    // ✅ Gunakan Hash::check untuk verifikasi password
    if ($user && Hash::check($request->password, $user->password)) {
        Auth::login($user);
        


        // role admin web
        if ($user->role === 'admin_web') {
    return redirect()->route('Admin.dashboard.index')
        ->with('success', 'Login berhasil sebagai Admin Web!');
}


        // role admin kelompok
        if ($user->role === 'admin_kelompok' && $user->status === 'sudah daftar') {
            $adminKelompok = DB::table('admin_kelompok')
                ->where('id_user', $user->id_user)
                ->first();

            if ($adminKelompok) {
                return redirect()->route('Admin_Kelompok.kelompok.show', $adminKelompok->id_kelompok);
            }
        }

        if ($user->role === 'admin_kelompok' && $user->status === 'belum daftar') {
            return back()->withErrors([
                'username' => 'Belum Pernah Daftar',
            ]);
        }
    }

    return back()->withErrors([
        'username' => 'Username atau password salah.',
    ]);
}

    public function destroy()
    {
        Auth::logout();
        return redirect()->route('admin_login.index')->with('success', 'Logout berhasil!');
    }

    public function checkSession()
{
    return response()->json([
        'active' => Auth::check()
    ]);
}

}
