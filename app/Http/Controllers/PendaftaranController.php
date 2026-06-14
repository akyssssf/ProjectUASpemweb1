<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PendaftaranController extends Controller
{
    public function pilihJenis()
    {
        // Ini akan mencari file di resources/views/pendaftaran/pilih-jenis.blade.php
        return view('pendaftaran.pilih-jenis');
    }
}