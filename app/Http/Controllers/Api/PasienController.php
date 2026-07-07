<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pasien;
use App\Http\Resources\PasienResource;
use Illuminate\Http\Request;

class PasienController extends Controller
{
    // GET ALL + Filtering (nama & NIK) + Pagination
    public function index(Request $request)
    {
        $query = Pasien::query();

        // Filter berdasarkan nama
        if ($request->has('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        // Filter berdasarkan NIK
        if ($request->has('nik')) {
            $query->where('nik', 'like', '%' . $request->nik . '%');
        }

        $pasien = $query->paginate(10);

        return PasienResource::collection($pasien);
    }
}