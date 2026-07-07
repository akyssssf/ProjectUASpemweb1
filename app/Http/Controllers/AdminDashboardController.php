<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use App\Models\Pasien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index(Request $request)
    {
        // Statistik Role Staf
        $stats = Staff::select('role', DB::raw('count(*) as total'))
                      ->groupBy('role')
                      ->get();

        // --- Filtering Staff ---
        $staffQuery = Staff::query();

        if ($request->filled('staff_name')) {
            $staffQuery->where('name', 'like', '%' . $request->staff_name . '%');
        }
        if ($request->filled('staff_role')) {
            $staffQuery->where('role', $request->staff_role);
        }

        $allStaff = $staffQuery->get();

        // --- Filtering Pasien ---
        $pasienQuery = Pasien::query();

        if ($request->filled('pasien_name')) {
            $pasienQuery->where('name', 'like', '%' . $request->pasien_name . '%');
        }
        if ($request->filled('pasien_nik')) {
            $pasienQuery->where('nik', 'like', '%' . $request->pasien_nik . '%');
        }

        $allPasien = $pasienQuery->get();

        return view('admin.dashboard', compact('stats', 'allStaff', 'allPasien'));
    }

    public function destroyPasien($id)
    {
        Pasien::findOrFail($id)->delete();
        return redirect()->route('admin.dashboard')->with('success', 'Data pasien dihapus');
    }
}