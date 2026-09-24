<?php

namespace App\Http\Controllers;

use App\Models\KonfigSistem;
use Illuminate\Http\Request;

class KonfigSistemController extends Controller
{
    /**
     * Menampilkan daftar konfigurasi sistem
     */
    public function index()
    {
        $konfigs = KonfigSistem::orderBy('nm_konfig')->get();

        return view('admin.konfigurasi.index', compact('konfigs'));
    }

    /**
     * Menampilkan form tambah konfigurasi
     */
    public function create()
    {
        return view('admin.konfigurasi.create');
    }

    /**
     * Menyimpan konfigurasi baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_konfig' => 'required|integer|unique:konfig_sistem,id_konfig',
            'nm_konfig' => 'required|string|max:100',
            'nilai' => 'required|string',
            'deskripsi' => 'nullable|string',
        ]);

        KonfigSistem::create($validated);

        return redirect()
            ->route('admin.konfigurasi.index')
            ->with('success', 'Konfigurasi berhasil ditambahkan.');
    }

    /**
     * Menampilkan form edit konfigurasi
     */
    public function edit($id)
    {
        $konfig = KonfigSistem::findOrFail($id);

        return view('admin.konfigurasi.edit', compact('konfig'));
    }

    /**
     * Mengupdate konfigurasi
     */
    public function update(Request $request, $id)
    {
        $konfig = KonfigSistem::findOrFail($id);

        $validated = $request->validate([
            'nm_konfig' => 'required|string|max:100',
            'nilai' => 'required|string',
            'deskripsi' => 'nullable|string',
        ]);

        $konfig->update($validated);

        return redirect()
            ->route('admin.konfigurasi.index')
            ->with('success', 'Konfigurasi berhasil diperbarui.');
    }

    /**
     * Menghapus konfigurasi
     */
    public function destroy($id)
    {
        $konfig = KonfigSistem::findOrFail($id);

        $konfig->delete();

        return redirect()
            ->route('admin.konfigurasi.index')
            ->with('success', 'Konfigurasi berhasil dihapus.');
    }
}