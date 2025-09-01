<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class V_Struktur__Rentan extends Model
{
    use HasFactory;
    protected $table = 'v_struktur_rentan';
    protected $primaryKey = 'id_struktur';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = ['nama_anggota', 'id_kelompok', 'nama', 'id_rentan', 'nama_rentan', 'jabatan'];
}
