<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminManagementController extends Controller
{
    // ── INDEX ──────────────────────────────────────────
    public function index()
    {
        $admins = Admin::orderBy('admin_id')->get();
        return view('admin.admins.index', compact('admins'));
    }

    // ── CREATE ─────────────────────────────────────────
    public function create()
    {
        $this->authorizeSuper();
        return view('admin.admins.create');
    }

    // ── STORE ──────────────────────────────────────────
    public function store(Request $request)
    {
        $this->authorizeSuper();

        $request->validate([
            'name'     => 'required|string|max:100',
            'username' => 'required|string|max:50|unique:admins,username',
            'email'    => 'required|email|unique:admins,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        Admin::create([
            'name'      => $request->name,
            'username'  => $request->username,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
            'role'      => 'cashier', 
            'is_active' => true,
        ]);

        return redirect()->route('admin.admins.index')
            ->with('success', 'Akun cashier berhasil ditambahkan.');
    }

    // ── EDIT ───────────────────────────────────────────
    public function edit($id)
    {
        $this->authorizeSuper();
        $admin = Admin::findOrFail($id);
        return view('admin.admins.edit', compact('admin'));
    }

    // ── UPDATE ─────────────────────────────────────────
    private function authorizeSuper()
    {
        if (auth()->user()->role !== 'manager') {
            abort(403);
        }
    }

    public function update(Request $request, $id)
    {
        $this->authorizeSuper();
        $admin = Admin::findOrFail($id);

        $request->validate([
            'name'     => 'required|string|max:100',
            'username' => 'required|string|max:50|unique:admins,username,' . $id . ',admin_id',
            'email'    => 'required|email|unique:admins,email,' . $id . ',admin_id',
        ]);

        $admin->update([
            'name'     => $request->name,
            'username' => $request->username,
            'email'    => $request->email,
        ]);

        return redirect()->route('admin.admins.index')
            ->with('success', 'Admin berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $this->authorizeSuper();
        $admin = Admin::findOrFail($id);

        if (auth()->user()->admin_id == $id) {
            return back()->with('error', 'Tidak dapat menghapus akun yang sedang login.');
        }

        $admin->delete();
        return back()->with('success', 'Admin berhasil dihapus.');
    }

    // ── RESET PASSWORD ─────────────────────────────────
    public function resetPassword($id)
    {
        $this->authorizeSuper();
        $admin = Admin::findOrFail($id);

        $newPassword = Str::random(8);
        $admin->update(['password' => Hash::make($newPassword)]);

        return back()->with([
            'reset_success' => true,
            'reset_name'    => $admin->name ?? $admin->username,
            'new_password'  => $newPassword,
        ]);
    }
}
    
