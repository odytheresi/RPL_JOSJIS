<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use App\Models\Pengemudi;
use Illuminate\Http\Request;

class KendaraanController extends Controller
{
    // Menampilkan daftar semua kendaraan beserta data pengemudinya
    public function index()
    {
        $kendaraans = Kendaraan::with('pengemudi.login')->get();
        return view('kendaraan.index', compact('kendaraans'));
    }

    // Menampilkan form tambah kendaraan
    public function create()
    {
        
        $pengemudis = Pengemudi::with('login')->get();
        return view('kendaraan.create', compact('pengemudis'));
    }

    // Menyimpan data kendaraan baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'id_pengemudi' => 'required|exists:pengemudi,id_pengemudi',
            'no_plat' => 'required|string|max:15|unique:kendaraan,no_plat',
            'merk' => 'required|string|max:50',
            'model' => 'required|string|max:50',
            'tahun' => 'required|digits:4',
            'kapasitas_baterai' => 'required|numeric',
        ]);

        Kendaraan::create($request->all());

        return redirect()->route('kendaraan.index')->with('success', 'Data kendaraan berhasil ditambahkan!');
    }

    // Menampilkan form edit kendaraan
    public function edit($id)
    {
        $kendaraan = Kendaraan::findOrFail($id);
        $pengemudis = Pengemudi::with('login')->get();
        return view('kendaraan.edit', compact('kendaraan', 'pengemudis'));
    }

    // Mengupdate data kendaraan
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_pengemudi' => 'required|exists:pengemudi,id_pengemudi',
            'no_plat' => 'required|string|max:15|unique:kendaraan,no_plat,' . $id . ',id_kendaraan',
            'merk' => 'required|string|max:50',
            'model' => 'required|string|max:50',
            'tahun' => 'required|digits:4',
            'kapasitas_baterai' => 'required|numeric',
        ]);

        $kendaraan = Kendaraan::findOrFail($id);
        $kendaraan->update($request->all());

        return redirect()->route('kendaraan.index')->with('success', 'Data kendaraan berhasil diperbarui!');
    }

    // Menghapus data kendaraan
    public function destroy($id)
    {
        $kendaraan = Kendaraan::findOrFail($id);
        $kendaraan->delete();

        return redirect()->route('kendaraan.index')->with('success', 'Data kendaraan berhasil dihapus!');
    }
}