<?php

namespace App\Http\Controllers\Admin_Kelompok;

use App\Http\Controllers\Controller;
use App\Models\InformasiUser;
use App\Models\UserAdmin;
use Illuminate\Support\Facades\Hash;
use App\Models\Kelompok;


use Illuminate\Http\Request;

class ProfilKelompokController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function index(Request $request)
    {
        $userId = auth()->id();

        $admin_kelompok = InformasiUser::with('kelompok')
            ->where('id_user', $userId)
            ->first();

        if (!$admin_kelompok) {
            abort(403, 'Data admin_kelompok tidak ditemukan untuk user yang login.');
        }

        return view('Admin_Kelompok.profil', compact('admin_kelompok'));
    }

    public function show($id)
    {
        $kelompok = Kelompok::findOrFail($id);
        $admin_kelompok = auth()->user()->informasi_user;
        return view('Admin_Kelompok.profil', compact('kelompok', 'admin_kelompok'));
    }

    public function update(Request $request, $id)
    {
        $admin_kelompok = InformasiUser::findOrFail($id);

        $field = $request->input('field');
        $value = $request->input('value');

        if (in_array($field, ['password', 'no_telp', 'ig', 'facebook', 'email'])) {

            // ✅ Hash password kalau field yang diupdate adalah password
            if ($field === 'password') {
                $admin_kelompok->$field = Hash::make($value);
            } else {
                $admin_kelompok->$field = $value;
            }

            $admin_kelompok->save();

            return response()->json([
                'message' => 'Profil berhasil diperbarui',
                'field'   => $field,
                'value'   => $field === 'password' ? '***' : $value, // jangan kirim hash ke UI
            ], 200);
        }

        return response()->json([
            'message' => 'Field tidak diizinkan'
        ], 400);
    }

    public function updatePassword(Request $request, $id)
    {
        \Log::info('UPDATE PASSWORD DIPANGGIL', ['id_dikirim' => $id]);

        $request->validate([
            'password_lama' => 'required',
            'password_baru' => 'required|min:6',
            'konfirmasi_password' => 'required|same:password_baru',
        ]);

        $user = InformasiUser::findOrFail($id);

        // ✅ Cek password lama pakai Hash::check
        if (!Hash::check($request->password_lama, $user->password)) {
            return response()->json([
                'errors' => [
                    'password_lama' => ['Password lama salah']
                ]
            ], 422);
        }

        // ✅ Simpan password baru dalam bentuk hash
        $user->password = Hash::make($request->password_baru);
        $user->save();

        \Log::info('PASSWORD BERHASIL DIUPDATE', [
            'id' => $id,
        ]);

        return response()->json([
            'message' => 'Password berhasil diubah'
        ], 200);
    }

    
}