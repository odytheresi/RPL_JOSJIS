<?php

namespace App\Http\Controllers;

use App\Models\Pengemudi;
use Illuminate\Http\Request;

class PengemudiController extends Controller
{
    // Menampilkan daftar pengemudi dan kendaraannya
    public function index()
    {
        
        $pengemudis = Pengemudi::with(['login', 'kendaraan'])->get();
        return view('pengemudi.index', compact('pengemudis'));
    }

    // Menyimpan data pengemudi baru beserta kendaraannya sekaligus
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:login,user_id',
            'no_sim' => 'required|string|max:30',
            'no_plat' => 'required|string|max:15',
            'merk' => 'required|string|max:50',
            'model' => 'required|string|max:50',
            'tahun' => 'required|digits:4',
            'kapasitas_baterai' => 'required|numeric',
        ]);

        // 1. Simpan data ke tabel pengemudi
        $pengemudi = Pengemudi::create([
            'user_id' => $request->user_id,
            'no_sim' => $request->no_sim,
        ]);

        // 2. Simpan data ke tabel kendaraan dengan mengambil id_pengemudi yang baru dibuat
        $pengemudi->kendaraan()->create([
            'no_plat' => $request->no_plat,
            'merk' => $request->merk,
            'model' => $request->model,
            'tahun' => $request->tahun,
            'kapasitas_baterai' => $request->kapasitas_baterai,
        ]);

        return redirect()->route('pengemudi.index')->with('success', 'Data pengemudi dan kendaraan berhasil ditambahkan!');
    }
}