<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Dashboard Admin
     */
    public function dashboard()
    {
        $jumlahAdmin = Admin::count();
        $jumlahRole = Role::count();

        return view('admin.dashboard', compact(
            'jumlahAdmin',
            'jumlahRole'
        ));
    }

    /**
     * Menampilkan daftar akun Admin
     */
    public function index()
    {
        $admins = Admin::with('role')->get();

        return view('admin.akun.index', compact('admins'));
    }

    /**
     * Menampilkan form tambah Admin
     */
    public function create()
    {
        $roles = Role::all();

        return view('admin.akun.create', compact('roles'));
    }

    /**
     * Menyimpan Admin baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_role' => 'required|exists:role,id_role',
            'nma_admin' => 'required|string|max:100',
            'email' => 'required|email|max:100|unique:admin,email',
            'pass' => 'required|string|min:8',
        ]);

        Admin::create([
            'id_role' => $validated['id_role'],
            'nma_admin' => $validated['nma_admin'],
            'email' => $validated['email'],
            'pass' => Hash::make($validated['pass']),
        ]);

        return redirect()
            ->route('admin.akun.index')
            ->with('success', 'Akun Admin berhasil ditambahkan.');
    }

    /**
     * Menampilkan form edit Admin
     */
    public function edit($id)
    {
        $admin = Admin::findOrFail($id);
        $roles = Role::all();

        return view('admin.akun.edit', compact(
            'admin',
            'roles'
        ));
    }

    /**
     * Mengupdate data Admin
     */
    public function update(Request $request, $id)
    {
        $admin = Admin::findOrFail($id);

        $validated = $request->validate([
            'id_role' => 'required|exists:role,id_role',
            'nma_admin' => 'required|string|max:100',
            'email' => 'required|email|max:100|unique:admin,email,' . $id . ',id_admin',
            'pass' => 'nullable|string|min:8',
        ]);

        $data = [
            'id_role' => $validated['id_role'],
            'nma_admin' => $validated['nma_admin'],
            'email' => $validated['email'],
        ];

        // Password hanya diubah jika diisi
        if (!empty($validated['pass'])) {
            $data['pass'] = Hash::make($validated['pass']);
        }

        $admin->update($data);

        return redirect()
            ->route('admin.akun.index')
            ->with('success', 'Data Admin berhasil diperbarui.');
    }

    /**
     * Menghapus akun Admin
     */
    public function destroy($id)
    {
        $admin = Admin::findOrFail($id);

        $admin->delete();

        return redirect()
            ->route('admin.akun.index')
            ->with('success', 'Akun Admin berhasil dihapus.');
    }
}