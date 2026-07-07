<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Antrian;
use App\Http\Requests\StoreAntrianRequest;
use App\Http\Resources\AntrianResource;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AntrianController extends Controller
{
    public function index(Request $request)
    {
        $query = Antrian::query();

        if ($request->has('poli')) {
            $query->where('poli', 'like', '%' . $request->poli . '%');
        }

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        if ($request->has('start_date') && $request->has('end_date')) {
            $query->whereBetween('tanggal_antrian', [
                $request->start_date,
                $request->end_date,
            ]);
        }

        $antrian = $query->paginate(10);

        return AntrianResource::collection($antrian);
    }

    public function store(StoreAntrianRequest $request)
    {
        $antrian = Antrian::create($request->validated());

        return (new AntrianResource($antrian))
            ->additional(['message' => 'Data antrian berhasil dicatat'])
            ->response()
            ->setStatusCode(201);
    }

    public function show($id)
    {
        try {
            $antrian = Antrian::findOrFail($id);
            return new AntrianResource($antrian);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error'   => 'Resource tidak ditemukan',
                'message' => 'Data antrian dengan ID ' . $id . ' tidak ada di sistem.'
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $antrian = Antrian::findOrFail($id);
            $antrian->update($request->only(['nomor_antrian', 'poli', 'tanggal_antrian', 'status']));
            return new AntrianResource($antrian);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error'   => 'Resource tidak ditemukan',
                'message' => 'Data antrian dengan ID ' . $id . ' tidak ada di sistem.'
            ], 404);
        }
    }

    public function destroy($id)
    {
        try {
            $antrian = Antrian::findOrFail($id);
            $antrian->delete();
            return response()->json(['message' => 'Data antrian berhasil dihapus'], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error'   => 'Resource tidak ditemukan',
                'message' => 'Data antrian dengan ID ' . $id . ' tidak ada di sistem.'
            ], 404);
        }
    }
}