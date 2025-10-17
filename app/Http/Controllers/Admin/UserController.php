<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserAdmin;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Tampilkan semua user
    public function index()
    {
        $users = UserAdmin::all();
        return view('Admin.useradmin.index', compact('users'));
    }

    // Form tambah user
    public function create()
    {
        return view('Admin.useradmin.create');
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
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/', // ✅ huruf kecil, besar, angka, & karakter unik
            ],
            'role'     => 'required',
        ], [
            'password.regex' => 'Password harus mengandung huruf besar, huruf kecil, angka, dan karakter unik (misal: * $ @ # !).',
        ]);

        UserAdmin::create([
            'username' => $request->username,
            'password' => Hash::make($request->password), // ✅ HASH password
            'role'     => $request->role,
        ]);

        return redirect()->route('Admin.users.index')
            ->with('success', 'User berhasil ditambahkan!');
    }

    // Form edit user
    public function edit($id)
    {
        $user = UserAdmin::findOrFail($id);
        return view('Admin.useradmin.edit', compact('user'));
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
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/', // ✅ aturan sama tapi opsional
            ],
            'role'     => 'required|string',
            // 'status'   => 'required|string',
        ], [
            'password.regex' => 'Password harus mengandung huruf besar, huruf kecil, angka, dan karakter unik (misal: * $ @ # !).',
        ]);

        $user = UserAdmin::findOrFail($id);

        $user->username = $request->username;

        // ✅ Hash password hanya jika diisi
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->role   = $request->role;
        $user->status = $request->status;

        $user->save();

        return redirect()->route('Admin.users.index')
            ->with('success', 'User berhasil diperbarui.');
    }

    // Hapus user
    // Hapus user
public function destroy($id)
{
    $user = UserAdmin::findOrFail($id);

    // 🚫 Tambahan baru → Cegah hapus jika status = 'sudah daftar'
    if ($user->status === 'sudah daftar') {
        return redirect()->route('Admin.users.index')
            ->with('error', 'User sudah didaftarkan, tidak dapat dihapus.');
    }

    $user->delete();

    return redirect()->route('Admin.users.index')
        ->with('success', 'User berhasil dihapus!');
}

}
