<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KonfigSistem extends Model
{
    protected $table = 'konfig_sistem';
    protected $primaryKey = 'id_konfig';
    public $timestamps = false;
    protected $fillable = [
        'id_konfig',
        'nm_konfig',
        'nilai',
        'deskripsi',
        'updated_at',
    ];

    protected $casts = [
        'updated_at' => 'datetime',
    ];
}
