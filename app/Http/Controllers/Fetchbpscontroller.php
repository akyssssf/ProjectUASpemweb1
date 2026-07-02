<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

class FetchBpsController extends Controller
{
    // Dataset BPS SIMDASI: Jumlah RS Umum, RS Khusus,
    // Puskesmas Rawat Inap, Puskesmas Non Rawat Inap per Provinsi
    private const BPS_URL = 'https://webapi.bps.go.id/v1/api/interoperabilitas/datasource/simdasi/id/25/tahun/2025/id_tabel/biszcFRCUnVKUXNnTDZvWnA3ZWtyUT09/wilayah/0000000/key/edd523f7d5c4c57dbe1a078b5271b69f';
    private const CACHE_TTL = 3600; // 1 jam

    public function fetch(): JsonResponse
    {
        $cacheFile = sys_get_temp_dir() . '/bps_faskes_pemweb.json';

        // Kembalikan cache jika masih fresh
        if (file_exists($cacheFile) && (time() - filemtime($cacheFile)) < self::CACHE_TTL) {
            $cached = file_get_contents($cacheFile);
            return response()->json(json_decode($cached, true))
                ->header('X-BPS-Cache', 'HIT')
                ->header('Cache-Control', 'public, max-age=' . self::CACHE_TTL);
        }

        // Fetch langsung dari API BPS
        $ctx = stream_context_create([
            'http' => [
                'timeout'       => 15,
                'ignore_errors' => true,
            ],
            'ssl' => [
                'verify_peer'      => false,
                'verify_peer_name' => false,
            ],
        ]);

        $response = @file_get_contents(self::BPS_URL, false, $ctx);

        if ($response === false) {
            // Fallback ke cache lama walau expired
            if (file_exists($cacheFile)) {
                $stale = file_get_contents($cacheFile);
                return response()->json(json_decode($stale, true))
                    ->header('X-BPS-Cache', 'STALE');
            }

            return response()->json([
                'error'   => true,
                'message' => 'Gagal mengambil data dari API BPS.',
            ], 502);
        }

        // Simpan cache baru
        file_put_contents($cacheFile, $response);

        return response()->json(json_decode($response, true))
            ->header('X-BPS-Cache', 'MISS')
            ->header('Cache-Control', 'public, max-age=' . self::CACHE_TTL);
    }
}