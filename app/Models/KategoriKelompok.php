<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriKelompok extends Model
{
    use HasFactory;

    protected $table = 'kategori_kelompok';
    protected $primaryKey = 'id_kategori';
    public $incrementing = true; 
    protected $keyType = 'int';   
    public $timestamps = false;   

    protected $fillable = ['nama'];

    public function getKodeKategoriAttribute()
    {
        return 'KT' . str_pad($this->id_kategori, 1, STR_PAD_LEFT);
    }
}
