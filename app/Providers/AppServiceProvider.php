<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\InformasiUser;
use App\Models\Kelompok;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Bagikan data user_kelompok_id + kelompok ke semua view
        View::composer('*', function ($view) {
            $userKelompokId = null;
            $kelompok = null;

            if (Auth::check()) {
                $admin = InformasiUser::where('id_user', Auth::id())->first();
                if ($admin) {
                    $userKelompokId = $admin->id_kelompok;
                    $kelompok = Kelompok::find($admin->id_kelompok); // kelompok sesuai user login
                }
            }

            // fallback → kalau tidak login tetap ada default
            if (!$kelompok) {
                $kelompok = Kelompok::find(1);
            }

          $view->with([
    'user_kelompok_id' => $userKelompokId,
    'kelompok_login'   => $kelompok, // ganti nama
]);

        });
    }
}
