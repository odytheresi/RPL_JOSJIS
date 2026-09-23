<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class kendaraan extends Model
{
    protected $table = 'kendaraan';
    protected $primaryKey = 'id_kendaraan';

    protected $fillable = [
        'id_pengemudi',
        'no_plat',
        'merk',
        'model',
        'tahun',
        'kapasitas_baterai',
    ];

   
    public function pengemudi()
    {
        return $this->belongsTo(Pengemudi::class, 'id_pengemudi', 'id_pengemudi');
    }
}
