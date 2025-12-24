<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdukPertahun extends Model
{
    use HasFactory;
    protected $table = 'produk_pertahun';
    protected $primaryKey = 'id_tahun';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = ['tahun', 'id_produk', 'nama_kelompok', 'nama_produk', 'harga', 'produk_terjual', 'satuan'];

    public function getKodeTahunAttribute()
    {
        return 'TH' . str_pad($this->id_tahun, 1, STR_PAD_LEFT);
    }
}
