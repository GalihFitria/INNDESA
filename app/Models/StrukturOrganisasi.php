<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StrukturOrganisasi extends Model
{
    use HasFactory;
    protected $table = 'struktur_organisasi';
    protected $primaryKey = 'id_struktur';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = ['id_kelompok', 'nama', 'jabatan', 'id_rentan']; 

    public function kelompok()
    {
        return $this->belongsTo(Kelompok::class, 'id_kelompok', 'id_kelompok');
    }

    public function rentan()
    {
        return $this->belongsTo(KelompokRentan::class, 'id_rentan', 'id_rentan'); // relasi ke tabel rentan
    }

    public function getKodeStrukturAttribute()
    {
        return 'ST' . str_pad($this->id_struktur, 1, STR_PAD_LEFT);
    }
}
