<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
   
    public function index()
    {
        $roles = Role::withCount('logins')->get();
        return view('role.index', compact('roles'));
    }

   
    public function create()
    {
        return view('role.create');
    }

  
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nma_role' => 'required|string|max:50',
        ]);

        Role::create($validated);

        return redirect()->route('role.index')->
            with('success', 'Role berhasil ditambahkan.');
    
    }

    
    public function show(Role $role)
    {
        $role->load('users');
        return view('role.show', compact('role'));
    }

    
    public function edit(Role $role)
    {
        return view('role.edit', compact('role'));
    }

   
    public function update(Request $request, Role $role)
    {
        $validated = $request->validate([
            'nma_role' => 'required|string|max:50',
        ]);

        $role->update($validated);

        return redirect()->route('role.index')
            ->with('success', 'Role berhasil diupdate.');
    }

    
    public function destroy(Role $role)
    {
        if ($role->users()->exists()) {
            return redirect()->route('role.index')
                ->with('error', 'Role tidak bisa dihapus karena masih digunakan oleh user.');
        }

        $role->delete();

        return redirect()->route('role.index')
            ->with('success', 'Role berhasil dihapus.');
    }
    
}
