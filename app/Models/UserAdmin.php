<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; // penting untuk auth login
use Illuminate\Notifications\Notifiable;

class UserAdmin extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users'; // pastikan sama dengan tabel di DB
    protected $primaryKey = 'id_user';     // ganti kalau nama primary key beda
    public $timestamps = false;       // ubah ke false kalau tabel gak punya created_at & updated_at

    protected $fillable = [
        'username',  // ✅ ganti dari name
        'password',
        'role',
        // 'status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];



    public function getKodeUserAttribute()
    {
        return 'U' . $this->id_user;
    }
}
