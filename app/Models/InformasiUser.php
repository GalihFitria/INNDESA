<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Auth\Passwords\CanResetPassword as CanResetPasswordTrait;
use App\Notifications\CustomResetPasswordNotification;

use Illuminate\Notifications\Notifiable; // ✅ Tambahkan ini
use Illuminate\Auth\Notifications\ResetPassword;

class InformasiUser extends Authenticatable implements CanResetPassword
{
    use CanResetPasswordTrait, Notifiable; // ✅ Pakai trait Notifiable juga

    protected $table = 'admin_kelompok';
    protected $primaryKey = 'id_admin';
    public $timestamps = false;

    protected $fillable = [
        'id_kelompok',
        'id_user',
        'username',
        'password',
        'no_telp',
        'ig',
        'facebook',
        'email',
    ];

    protected static function booted()
    {
        static::deleted(function ($informasiUser) {
            UserAdmin::where('id_user', $informasiUser->id_user)
                ->update([
                    'email' => null,
                    'status' => 'belum daftar',
                ]);
        });
    }

    public function kelompok()
    {
        return $this->belongsTo(Kelompok::class, 'id_kelompok');
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new \Illuminate\Auth\Notifications\ResetPassword($token));
    }

    // app/Models/InformasiUser.php
    public function getKodeAdminAttribute()
    {
        return 'AK' . $this->id_admin;
    }

    public function kategori()
    {
        return $this->belongsTo(KategoriKelompok::class, 'id_kategori', 'id_kategori');
    }
}
