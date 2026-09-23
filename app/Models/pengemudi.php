<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class pengemudi extends Model
{
    protected $table = 'pengemudi';
    protected $primaryKey = 'id_pengemudi';

    protected $fillable = [
        'user_id',
        'no_sim',
    ];

    
    public function login()
    {
        return $this->belongsTo(Login::class, 'user_id', 'user_id');
    }

    
    public function kendaraan()
    {
        return $this->hasOne(Kendaraan::class, 'id_pengemudi', 'id_pengemudi');
    }
}
