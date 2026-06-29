<?php

namespace App\Http\Controllers;

use App\Models\MedicalRecord;
use App\Models\Pasien;
use Illuminate\Http\Request;

class MedicalRecordController extends Controller
{
    // 1. Menampilkan form rekam medis
    public function create($pasien_id)
    {
        // Ambil data pasien untuk ditampilkan namanya di form
        $pasien = Pasien::findOrFail($pasien_id);
        return view('rekam_medis.create', compact('pasien'));
    }

    // 2. Menyimpan data rekam medis
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
            'pasien_id'  => $request->pasien_id,
            'staff_id'   => auth()->user()->id, // Mengambil ID dokter yang login
            'subjective' => $request->subjective,
            'objective'  => $request->objective,
            'assessment' => $request->assessment,
            'plan'       => $request->plan,
        ]);

        // Setelah simpan, balik ke daftar pasien
        return redirect()->route('pasien.index')->with('success', 'Rekam medis berhasil ditambahkan!');
    }
}