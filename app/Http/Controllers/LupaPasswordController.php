<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class LupaPasswordController extends Controller
{
    public function showLinkRequestForm()
    {
        return view('Pengunjung.lupa_password');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        // Gunakan broker admin_kelompok
        $status = Password::broker('admin_kelompok')->sendResetLink(
            $request->only('email')
        );

        if ($status === Password::RESET_LINK_SENT) {
            // ✅ Sukses → kirim session status (hijau di view)
            return back()->with('status', __($status));
        }

        // ❌ Gagal → kirim error (merah di view)
        return back()->withErrors(['email' => __($status)]);
    }
}
