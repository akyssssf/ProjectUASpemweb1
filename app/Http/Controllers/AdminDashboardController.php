<?php

namespace App\Http\Controllers;

use App\Models\Antrian;
use App\Models\Klinik;
use App\Models\Pasien;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminDashboardController extends Controller
{
    public function index(Request $request)
    {
        $staffCounts = Staff::select('role', DB::raw('count(*) as total'))
            ->whereIn('role', ['admin', 'dokter'])
            ->groupBy('role')
            ->pluck('total', 'role');

        $inactiveRoleCount = Staff::whereNotIn('role', ['admin', 'dokter'])->count();

        $summary = [
            'admin' => (int) ($staffCounts['admin'] ?? 0),
            'dokter' => (int) ($staffCounts['dokter'] ?? 0),
            'pasien' => Pasien::count(),
            'klinik' => Klinik::count(),
            'antrian_aktif' => Antrian::whereDate('tanggal_antrian', now()->toDateString())
                ->where('status', '!=', 'selesai')
                ->count(),
            'inactive_roles' => $inactiveRoleCount,
        ];

        $staffQuery = Staff::query();

        if ($request->filled('staff_name')) {
            $staffQuery->where('name', 'like', '%' . $request->staff_name . '%');
        }
        if ($request->filled('staff_role')) {
            $staffQuery->where('role', $request->staff_role);
        }

        $allStaff = $staffQuery
            ->orderByRaw("case when role = 'admin' then 0 when role = 'dokter' then 1 else 2 end")
            ->orderBy('name')
            ->paginate(8, ['*'], 'staff_page')
            ->withQueryString();

        $pasienQuery = Pasien::query();

        if ($request->filled('pasien_name')) {
            $pasienQuery->where('name', 'like', '%' . $request->pasien_name . '%');
        }
        if ($request->filled('pasien_nik')) {
            $pasienQuery->where('nik', 'like', '%' . $request->pasien_nik . '%');
        }

        $allPasien = $pasienQuery
            ->withCount('medicalRecords')
            ->orderByDesc('created_at')
            ->paginate(8, ['*'], 'pasien_page')
            ->withQueryString();

        return view('admin.dashboard', compact('summary', 'allStaff', 'allPasien'));
    }

    public function destroyPasien($id)
    {
        Pasien::findOrFail($id)->delete();
        return redirect()->route('admin.dashboard')->with('success', 'Data pasien dihapus');
    }

    public function editPasien($id)
    {
        $pasien = Pasien::findOrFail($id);

        return view('admin.pasien-edit', compact('pasien'));
    }

    public function updatePasien(Request $request, $id)
    {
        $pasien = Pasien::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:pasiens,email,' . $pasien->id,
            'nik' => 'required|digits:16|unique:pasiens,nik,' . $pasien->id,
            'no_hp' => 'nullable|string|max:20',
            'alamat' => 'nullable|string|max:500',
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $pasien->update($validated);

        return redirect()->route('admin.dashboard')->with('success', 'Data pasien berhasil diperbarui');
    }
}
