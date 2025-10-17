<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;

class LupaPasswordController extends Controller
{
    public function showLinkRequestForm()
    {
        return view('Pengunjung.lupa_password');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        try {
            // Gunakan broker admin_kelompok
            $status = Password::broker('admin_kelompok')->sendResetLink(
                $request->only('email')
            );

            if ($status === Password::RESET_LINK_SENT) {
                return back()->with('status', __($status));
            }

            // Jika email tidak ditemukan atau gagal kirim
            return back()->withErrors(['email' => __($status)]);

        } catch (TransportExceptionInterface $e) {
            // ✨ Tangkap error koneksi SMTP (biasanya karena sinyal, firewall, dll)
            Log::error('SMTP connection failed: ' . $e->getMessage());
            return back()->withErrors([
                'email' => '⚠️ Sinyal anda terganggu, silakan coba lagi nanti.'
            ]);

        } catch (\Exception $e) {
            // ✨ Tangkap error umum lainnya
            Log::error('Error kirim reset password: ' . $e->getMessage());
            return back()->withErrors([
                'email' => 'Terjadi kesalahan, silakan coba lagi nanti.'
            ]);
        }
    }
}
