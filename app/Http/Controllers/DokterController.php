<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use App\Models\MedicalRecord;
use Illuminate\Http\Request;

class DokterController extends Controller
{
    public function index()
    {
        $pasiens = Pasien::all();
        return view('petugas.dashboard-dokter', compact('pasiens'));
    }

    public function create($pasien_id)
    {
        $pasien = Pasien::findOrFail($pasien_id);
        return view('petugas.rekam-medis-create', compact('pasien'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pasien_id' => 'required',
            'subjective' => 'required',
            'objective' => 'required',
            'assessment' => 'required',
            'plan' => 'required',
        ]);

        MedicalRecord::create([
            'pasien_id'  => $request->pasien_id, // Sesuai kolom database
            'staff_id'   => auth()->guard('staff')->user()->id,
            'subjective' => $request->subjective,
            'objective'  => $request->objective,
            'assessment' => $request->assessment,
            'plan'       => $request->plan,
        ]);

        return redirect()->route('dokter.dashboard')->with('success', 'Rekam medis tersimpan!');
    }
}