<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StaffController extends Controller
{
    public function create() { return view('petugas.staff-register'); }

    public function store(Request $request) {
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:staffs',
            'role' => 'required|in:admin,dokter',
            'password' => 'required|min:6',
        ]);
        $data['password'] = Hash::make($data['password']);
        Staff::create($data);
        return redirect()->route('admin.dashboard')->with('success', 'Staf ditambah');
    }

    public function edit($id) {
        $staff = Staff::findOrFail($id);
        return view('petugas.staff-edit', compact('staff'));
    }

    public function update(Request $request, $id) {
        $staff = Staff::findOrFail($id);
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:staffs,email,'.$id,
            'role' => 'required|in:admin,dokter',
        ]);
        $staff->update($data);
        return redirect()->route('admin.dashboard')->with('success', 'Data diupdate');
    }

    public function destroy($id) {
        Staff::findOrFail($id)->delete();
        return redirect()->route('admin.dashboard')->with('success', 'Staf dihapus');
    }
}
