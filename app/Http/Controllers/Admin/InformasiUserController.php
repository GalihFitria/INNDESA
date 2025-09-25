<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use App\Models\InformasiUser;
use App\Models\Kelompok;
use App\Models\UserAdmin;
use Illuminate\Http\Request;

class InformasiUserController extends Controller
{
     public function index()
    {
        $users = InformasiUser::all();
        return view('Admin.informasi_user.index', compact('users'));
    }
 
    public function create()
{
   // Ambil id_user dan id_kelompok yang sudah terpakai
    $usedUsers = InformasiUser::pluck('id_user')->toArray();
    $usedKelompoks = InformasiUser::pluck('id_kelompok')->toArray();

    // Ambil hanya yang belum dipakai
    $users = UserAdmin::whereNotIn('id_user', $usedUsers)->get();
    $kelompoks = Kelompok::whereNotIn('id_kelompok', $usedKelompoks)->get();

    return view('Admin.Informasi_User.create', compact('kelompoks', 'users'));;
}

 public function store(Request $request)
{
    $request->validate([
        'id_kelompok' => 'required|exists:kelompok,id_kelompok',
        'id_user'     => [
            'required',
            Rule::unique('admin_kelompok')->where(function ($query) use ($request) {
                return $query->where('id_user', $request->id_user)
                             ->where('id_kelompok', $request->id_kelompok);
            }),
        ],
        'username'    => 'required',
        'password'    => 'required',
        'no_telp'     => 'required',
        'email'       => 'required|email|unique:admin_kelompok,email',
    ], [
        'id_user.unique' => 'User ini sudah terdaftar di kelompok tersebut!',
    ]);

    $user = UserAdmin::where('id_user', $request->id_user)->first();

    if (!$user) {
        return back()->withErrors(['id_user' => 'User tidak ditemukan!'])->withInput();
    }

    // ✅ Validasi password dengan Hash::check kalau user.password sudah di-hash
    if (!Hash::check($request->password, $user->password)) {
        return back()->with('warning', 'Password tidak sesuai dengan data Users!')
                     ->withInput($request->except(['password']));
    }

    // ✅ Simpan password hash & simpan password asli di kolom baru (misalnya password_plain)
    InformasiUser::create([
        'id_kelompok' => $request->id_kelompok,
        'id_user'     => $request->id_user,
        'username'    => $request->username,
        'password'    => Hash::make($request->password), // HASH
        'no_telp'     => $request->no_telp,
        'ig'          => $request->ig,
        'facebook'    => $request->facebook,
        'email'       => $request->email,
    ]);

    UserAdmin::where('id_user', $request->id_user)
        ->update(['status' => 'sudah daftar']);

    return redirect()->route('Admin.informasi_user.index')
                     ->with('success', 'Informasi User berhasil ditambahkan dan status user diperbarui!');
}


public function edit($id)
{
    $user = InformasiUser::findOrFail($id);
        $kelompoks = Kelompok::all(); // Ambil semua data kelompok
        return view('Admin.Informasi_User.edit', compact('user', 'kelompoks'));
}

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_kelompok' => 'required|exists:kelompok,id_kelompok',
            'id_user'     => 'required',
            'username'    => 'required',
            'password'    => 'nullable', // Tidak wajib diisi
            'no_telp'     => 'required',
            'email'       => 'required|email',
        ]);

        $user = InformasiUser::findOrFail($id);

        // Update data
        $user->id_kelompok = $request->id_kelompok;
        $user->id_user = $request->id_user;
        $user->username = $request->username;
        $user->no_telp = $request->no_telp;
        $user->ig = $request->ig;
        $user->facebook = $request->facebook;
        $user->email = $request->email;

        // Update password hanya jika diisi
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('Admin.informasi_user.index')
            ->with('success', 'Informasi User berhasil diperbarui');
    }



public function destroy($id)
{
    $user = InformasiUser::findOrFail($id);
    $user->delete();

    return redirect()->route('Admin.informasi_user.index')
                     ->with('success', 'Informasi User berhasil dihapus');
}








}