<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class role extends Model
{
    protected $table = 'role';
    protected $primaryKey = 'id_role';
    public $incrementing = false;
    protected $keyType = 'int';
    public $timestamps = false;
    protected $fillable = [
        'id_role',
        'nma_role',
    ];

    /**
     * Satu Role dapat dimiliki banyak Admin
     */
    public function admins()
    {
        return $this->hasMany(Admin::class, 'id_role', 'id_role');
    }
}
