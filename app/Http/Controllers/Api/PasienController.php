<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePasienRequest;
use App\Models\Pasien;
use App\Http\Resources\PasienResource;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PasienController extends Controller
{
    // GET ALL + Filtering (nama, NIK, rentang tanggal) + Pagination
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

        // Filter berdasarkan rentang tanggal pendaftaran (created_at)
        if ($request->has('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }

        if ($request->has('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        $pasien = $query->paginate(10);

        return PasienResource::collection($pasien);
    }

    // GET BY ID + Error Handling Manual
    public function show($id)
    {
        try {
            $pasien = Pasien::findOrFail($id);
            return new PasienResource($pasien);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Resource tidak ditemukan',
                'message' => 'Data pasien dengan ID ' . $id . ' tidak ada di sistem.'
            ], 404);
        }
    }

    // PUT/PATCH (Update) + Form Request Validation + Error Handling Manual
    public function update(StorePasienRequest $request, $id)
    {
        try {
            $pasien = Pasien::findOrFail($id);
            $pasien->update($request->validated());

            return (new PasienResource($pasien))
                ->additional(['message' => 'Data pasien berhasil diperbarui'])
                ->response()
                ->setStatusCode(200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Resource tidak ditemukan',
                'message' => 'Data pasien dengan ID ' . $id . ' tidak ada di sistem.'
            ], 404);
        }
    }

    // DELETE (Destroy) + Error Handling Manual
    public function destroy($id)
    {
        try {
            $pasien = Pasien::findOrFail($id);
            $pasien->delete();

            return response()->json([
                'message' => 'Data pasien dengan ID ' . $id . ' berhasil dihapus'
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Resource tidak ditemukan',
                'message' => 'Data pasien dengan ID ' . $id . ' tidak ada di sistem.'
            ], 404);
        }
    }
}