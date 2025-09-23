<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelompok extends Model
{
    use HasFactory;

    protected $table = 'kelompok';
    protected $primaryKey = 'id_kelompok';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = ['id_kategori', 'nama', 'total_anggota', 'sejarah', 'sk_desa', 'background', 'logo'];

    public function kategori()
    {
        return $this->belongsTo(KategoriKelompok::class, 'id_kategori', 'id_kategori');
    }

    public function getKodeKelompokAttribute()
    {
        return 'KL' . str_pad($this->id_kelompok, 1, STR_PAD_LEFT);
    }
}

