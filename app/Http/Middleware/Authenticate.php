<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    protected function redirectTo(Request $request): ?string
    {
        // Jika route diawali "Admin" atau "Admin_Kelompok"
        if ($request->is('Admin/*') || $request->is('Admin_Kelompok/*')) {
            return url('admin_login');
        }

        // default (misalnya user umum)
        return url('admin_login'); // ubah juga default-nya ke sini biar aman
    }
}
