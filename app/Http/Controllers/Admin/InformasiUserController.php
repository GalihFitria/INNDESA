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

 // Simpan user baru
public function store(Request $request)
{
    $request->validate([
        'username' => 'required',
        'password' => [
            'required',
            'string',
            'min:8',
            'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/',
        ],
        'role' => 'required',
    ], [
        'password.min'   => 'Kata sandi wajib minimal 8 karakter.',
        'password.regex' => 'Kata sandi harus mengandung huruf besar, huruf kecil, angka, dan karakter unik (misal: * $ @ # !).',
    ]);

    UserAdmin::create([
        'username' => $request->username,
        'password' => Hash::make($request->password),
        'role'     => $request->role,
    ]);

    return redirect()->route('Admin.users.index')
        ->with('success', 'User berhasil ditambahkan!');
}


// Update user
public function update(Request $request, $id)
{
    $request->validate([
        'username' => 'required|string|max:255',
        'password' => [
            'nullable',
            'string',
            'min:8',
            'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/',
        ],
        'role' => 'required|string',
    ], [
        'password.min'   => 'Kata sandi wajib minimal 8 karakter.',
        'password.regex' => 'Kata sandi harus mengandung huruf besar, huruf kecil, angka, dan karakter unik (misal: * $ @ # !).',
    ]);

    $user = UserAdmin::findOrFail($id);
    $user->username = $request->username;
    if ($request->filled('password')) {
        $user->password = Hash::make($request->password);
    }
    $user->role = $request->role;
    $user->save();

    return redirect()->route('Admin.users.index')
        ->with('success', 'User berhasil diperbarui.');
}


public function edit($id)
{
    $user = InformasiUser::findOrFail($id);
        $kelompoks = Kelompok::all(); // Ambil semua data kelompok
        return view('Admin.Informasi_User.edit', compact('user', 'kelompoks'));
}

 

public function destroy($id)
{
    $user = InformasiUser::findOrFail($id);
    $user->delete();

    return redirect()->route('Admin.informasi_user.index')
                     ->with('success', 'Informasi User berhasil dihapus');
}








}