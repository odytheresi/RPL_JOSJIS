<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class admin extends Model
{
    protected $table = 'admin';
    protected $primaryKey = 'id_admin';
    public $timestamps = false;
    protected $fillable = [
        'id_role',
        'nma_admin',
        'email',
        'pass',
    ];

    /**
     * Admin memiliki satu Role
     */
    public function role()
    {
        return $this->belongsTo(Role::class, 'id_role', 'id_role');
    }

    /**
     * Admin memiliki banyak Audit Log
     */
    public function auditLogs()
    {
        return $this->hasMany(AuditLog::class, 'id_admin', 'id_admin');
    }
}
