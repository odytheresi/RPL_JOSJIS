<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuditLog extends Model
{
    protected $table = 'audit_log';
    protected $primaryKey = 'id_audit';
    public $timestamps = false;
    protected $fillable = [
        'id_admin',
        'aktivitas',
        'waktu',
        'keterangan',
    ];

    protected $casts = [
        'waktu' => 'datetime',
    ];

    /**
     * Audit Log dimiliki oleh satu Admin
     */
    public function admin()
    {
        return $this->belongsTo(Admin::class, 'id_admin', 'id_admin');
    }
}
