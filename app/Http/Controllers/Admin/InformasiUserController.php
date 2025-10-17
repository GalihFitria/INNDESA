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
        $validator = Validator::make($request->all(), [
            'id_kelompok' => 'required|exists:kelompok,id_kelompok',
            'id_user'     => 'required|exists:user_admin,id_user',
            'username'    => 'required|string|max:255',
            'password'    => [
                'required',
                'string',
                'min:8',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/',
            ],
            'no_telp'  => ['required', 'regex:/^[0-9]+$/', 'max:20'],

            'ig'       => 'nullable|string|max:255',
            'facebook' => 'nullable|string|max:255',
            'email'    => 'required|email|max:255|unique:informasi_user,email',
        ], [
            'email.unique' => 'Email sudah terdaftar, silakan gunakan akun email yang lain.',
        ]);

        // Kalau validasi gagal
        if ($validator->fails()) {
            // Kalau error karena email sudah terdaftar → kosongkan field email
            if ($validator->errors()->has('email')) {
                $oldInput = $request->except('email');
                $oldInput['email'] = ''; // kosongkan email
                return back()
                    ->withErrors($validator)
                    ->withInput($oldInput);
            }

            return back()->withErrors($validator)->withInput();
        }

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
        $validator = Validator::make($request->all(), [
            'id_kelompok' => 'required|exists:kelompok,id_kelompok',
            'username'    => 'required|string|max:255',
            'password'    => [
                'nullable',
                'string',
                'min:8',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/',
            ],
           'no_telp'  => ['required', 'regex:/^[0-9]+$/', 'max:20'],

            'ig'       => 'nullable|string|max:255',
            'facebook' => 'nullable|string|max:255',
            'email'    => [
                'required',
                'email',
                'max:255',
                Rule::unique('admin_kelompok', 'email')->ignore($id, 'id_admin'),
            ],
        ], [
            'email.unique' => 'Email sudah terdaftar, silakan gunakan akun email yang lain.',
        ]);

        if ($validator->fails()) {
            // Kalau error karena email sudah terdaftar → kosongkan field email
            if ($validator->errors()->has('email')) {
                $oldInput = $request->except('email');
                $oldInput['email'] = ''; // kosongkan email
                return back()
                    ->withErrors($validator)
                    ->withInput($oldInput);
            }

            return back()->withErrors($validator)->withInput();
        }

        $user = InformasiUser::findOrFail($id);

        // Update semua data
        $user->id_kelompok = $request->id_kelompok;
        $user->username = $request->username;
        $user->no_telp = $request->no_telp;
        $user->ig = $request->ig;
        $user->facebook = $request->facebook;
        $user->email = $request->email;

        // Hanya update password jika diisi
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('Admin.informasi_user.index')
                         ->with('success', 'Informasi user berhasil diperbarui!');
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