<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;

class AuditLogController extends Controller
{
    /**
     * Menampilkan semua aktivitas Admin
     */
    public function index()
    {
        $logs = AuditLog::with('admin')
            ->orderByDesc('waktu')
            ->get();

        return view('admin.audit.index', compact('logs'));
    }

    /**
     * Menampilkan detail aktivitas Admin
     */
    public function show($id)
    {
        $log = AuditLog::with('admin')->findOrFail($id);

        return view('admin.audit.show', compact('log'));
    }
}