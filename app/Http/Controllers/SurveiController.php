<?php

namespace App\Http\Controllers;

use App\Models\Survei;
use App\Models\Pendaftaran;
use App\Models\Klinik;
use App\Http\Requests\StoreSurveiRequest;
use App\Http\Resources\SurveiResource;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;

class SurveiController extends Controller
{
    // GET ALL + Fitur Filter Rentang Tanggal
    public function index(Request $request)
    {
        $query = Survei::with(['klinik', 'poli'])->verifiedVisit();

        // Fitur Filter Rentang Tanggal berdasarkan created_at
        if ($request->has('start_date') && $request->has('end_date')) {
            $query->whereBetween('created_at', [$request->start_date . ' 00:00:00', $request->end_date . ' 23:59:59']);
        }

        $surveys = $query->paginate(10);
        return SurveiResource::collection($surveys);
    }

    // POST (Create Data Baru)
    public function store(StoreSurveiRequest $request)
    {
        $survei = Survei::create($this->dataSurveiTerverifikasi($request->validated()));
        return (new SurveiResource($survei))
            ->additional(['message' => 'Survei kepuasan berhasil dikirim'])
            ->response()
            ->setStatusCode(201);
    }

    // GET BY ID
    public function show($id)
    {
        try {
            $survei = Survei::with(['klinik', 'poli'])->verifiedVisit()->findOrFail($id);
            return new SurveiResource($survei);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Resource tidak ditemukan',
                'message' => 'Data survei dengan ID ' . $id . ' tidak ada di sistem.'
            ], 404);
        }
    }

    // TUGAS MANDIRI: PUT/PATCH (Update)
    public function update(StoreSurveiRequest $request, $id)
    {
        try {
            $survei = Survei::findOrFail($id);
            $survei->update($this->dataSurveiTerverifikasi($request->validated(), $survei));
            
            return (new SurveiResource($survei))
                ->additional(['message' => 'Data survei berhasil diperbarui']);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Resource tidak ditemukan',
                'message' => 'Data survei dengan ID ' . $id . ' tidak ada di sistem.'
            ], 404);
        }
    }

    private function dataSurveiTerverifikasi(array $data, ?Survei $survei = null): array
    {
        $pendaftaran = Pendaftaran::with(['antrian', 'survei'])
            ->findOrFail($data['pendaftaran_id']);

        if (!$pendaftaran->antrian || $pendaftaran->antrian->status !== 'selesai') {
            throw ValidationException::withMessages([
                'pendaftaran_id' => 'Survei hanya bisa dibuat dari kunjungan yang sudah selesai.',
            ]);
        }

        if ($pendaftaran->survei && (!$survei || $pendaftaran->survei->id !== $survei->id)) {
            throw ValidationException::withMessages([
                'pendaftaran_id' => 'Kunjungan ini sudah pernah diberi survei.',
            ]);
        }

        $klinik = Klinik::where('nama', $pendaftaran->klinik)->first();
        $poli = $klinik?->polis()->where('nama', $pendaftaran->poli)->first();

        if (!$klinik || !$poli) {
            throw ValidationException::withMessages([
                'pendaftaran_id' => 'Data klinik atau poli untuk kunjungan ini tidak valid.',
            ]);
        }

        return [
            'pasien_id'      => $pendaftaran->pasien_id,
            'klinik_id'      => $klinik->id,
            'poli_id'        => $poli->id,
            'pendaftaran_id' => $pendaftaran->id,
            'tipe'           => 'spesifik',
            'rating'         => $data['rating'],
            'komentar'       => $data['komentar'] ?? null,
        ];
    }

    // TUGAS MANDIRI: DELETE (Destroy)
    public function destroy($id)
    {
        try {
            $survei = Survei::findOrFail($id);
            $survei->delete();
            
            return response()->json([
                'message' => 'Data survei berhasil dihapus secara permanen.'
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Resource tidak ditemukan',
                'message' => 'Data survei dengan ID ' . $id . ' tidak ada di sistem.'
            ], 404);
        }
    }
}
