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

    protected $fillable = ['id_kelompok', 'nama', 'jabatan', 'rentan'];

    public function kelompok()
    {
        return $this->belongsTo(Kelompok::class, 'id_kelompok', 'id_kelompok');
    }

    public function getKodeStrukturAttribute()
    {
        $singkatan = match ($this->jabatan) {
            'Ketua' => 'KT',
            'Wakil Ketua' => 'WK',
            'Sekretaris' => 'SK',
            'Bendahara' => 'BD',
            'Anggota' => 'AG',
            default => 'XX',
        };

        $nomor = self::where('jabatan', $this->jabatan)->where('id_struktur', '<=', $this->id_struktur)->count();

        return $singkatan . '-' . str_pad($nomor, 1, STR_PAD_LEFT);
    }
}
