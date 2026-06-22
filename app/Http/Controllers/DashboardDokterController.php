<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use Illuminate\Http\Request;

class DashboardDokterController extends Controller
{
    public function index()
    {
        // Dokter bisa melihat daftar pasien yang ada di sistem
        $pasiens = Pasien::all();
        return view('petugas.dashboard-dokter.index', compact('pasiens'));
    }
}