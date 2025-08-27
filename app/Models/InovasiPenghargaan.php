<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InovasiPenghargaan extends Model
{
    use HasFactory;
    protected $table = 'inovasi_penghargaan';
    protected $primaryKey = 'id_inovasi';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = ['id_kelompok', 'foto'];

    public function kelompok()
    {
        return $this->belongsTo(Kelompok::class, 'id_kelompok', 'id_kelompok');
    }

    public function getKodeInovasiAttribute()
    {
        return 'S' . str_pad($this->id_inovasi, 1, STR_PAD_LEFT);
    }
}
