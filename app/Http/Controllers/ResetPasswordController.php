<?php

namespace App\Http\Controllers;
use App\Models\InformasiUser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Log;

class ResetPasswordController extends Controller
{
    public function reset(Request $request)
    {
        $request->validate([
            'token'    => 'required',
            'email'    => 'required|email',
            'password' => [
                'required',
                'string',
                'min:8', // ✅ minimal 8 karakter
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/', // ✅ kombinasi huruf besar, kecil, angka, simbol
                'confirmed'
            ],
        ], [
            'password.min' => 'Password minimal harus 8 karakter.',
            'password.regex' => 'Password harus mengandung huruf besar, huruf kecil, angka, dan karakter unik (misal: @, #, $, !).',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        Log::info("🔍 Mencoba reset password untuk: {$request->email}");

        $status = Password::broker('admin_kelompok')->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                Log::info("✅ CALLBACK DIPANGGIL UNTUK: " . $user->email);

                // ✅ Simpan password baru dalam bentuk hash
                $user->password = Hash::make($password);
                $user->save();
            }
        );

        Log::info("📌 STATUS PASSWORD RESET: {$status}");

        return $status === Password::PASSWORD_RESET
            ? back()->with('status', '✅ Kata sandi berhasil diubah!')
            : back()->withErrors(['email' => __($status)]);
    }
}
