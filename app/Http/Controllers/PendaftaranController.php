<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PendaftaranController extends Controller
{
    public function pilihJenis()
    {
        return view('pendaftaran.pilih-jenis');
    }
}