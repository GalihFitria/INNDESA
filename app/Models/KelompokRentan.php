<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelompokRentan extends Model
{
    use HasFactory;
    protected $table = 'rentan';
    protected $primaryKey = 'id_rentan';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = ['nama_rentan', 'total'];

    public function getKodeRentanAttribute()
    {
        return 'KR' . str_pad($this->id_rentan, 1, STR_PAD_LEFT);
    }

}
