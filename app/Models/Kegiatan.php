<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    use HasFactory;
    protected $table = 'kegiatan';
    protected $primaryKey = 'id_kegiatan';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = true;

    protected $fillable = ['id_kelompok', 'judul', 'deskripsi', 'foto', 'tanggal', 'sumber_berita',
        'created_at',
        'updated_at'];

    public function kelompok()
    {
        return $this->belongsTo(Kelompok::class, 'id_kelompok', 'id_kelompok');
    }

    public function getKodeKegiatanAttribute()
    {
        return 'KG' . str_pad($this->id_kegiatan, 1, STR_PAD_LEFT);
    }
}
