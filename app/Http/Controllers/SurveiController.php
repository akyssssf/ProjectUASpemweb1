<?php

namespace App\Http\Controllers;

use App\Models\Survei;
use App\Http\Requests\StoreSurveiRequest;
use App\Http\Resources\SurveiResource;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class SurveiController extends Controller
{
    // GET ALL + Fitur Filter Rentang Tanggal
    public function index(Request $request)
    {
        $query = Survei::query();

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
        $survei = Survei::create($request->validated());
        return (new SurveiResource($survei))
            ->additional(['message' => 'Survei kepuasan berhasil dikirim'])
            ->response()
            ->setStatusCode(201);
    }

    // GET BY ID
    public function show($id)
    {
        try {
            $survei = Survei::findOrFail($id);
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
            $survei->update($request->validated());
            
            return (new SurveiResource($survei))
                ->additional(['message' => 'Data survei berhasil diperbarui']);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Resource tidak ditemukan',
                'message' => 'Data survei dengan ID ' . $id . ' tidak ada di sistem.'
            ], 404);
        }
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