<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use App\Models\Pasien;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Statistik Role Staf
        $stats = Staff::select('role', DB::raw('count(*) as total'))
                      ->groupBy('role')
                      ->get();

        // Data untuk tabel
        $allStaff = Staff::all();
        $allPasien = Pasien::all(); 

        return view('admin.dashboard', compact('stats', 'allStaff', 'allPasien'));
    }
}