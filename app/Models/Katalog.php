<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Katalog extends Model
{
    use HasFactory;
    protected $table = 'katalog';
    protected $primaryKey = 'id_katalog';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = ['id_kelompok', 'katalog'];

    public function kelompok()
    {
        return $this->belongsTo(Kelompok::class, 'id_kelompok', 'id_kelompok');
    }

    public function getKodeKatalogAttribute()
    {
        return 'KT' . str_pad($this->id_katalog, 1, STR_PAD_LEFT);
    }
}
