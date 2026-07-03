<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

class FetchBpsController extends Controller
{
    private const BPS_URL = 'https://webapi.bps.go.id/v1/api/interoperabilitas/datasource/simdasi/id/25/tahun/2025/id_tabel/biszcFRCUnVKUXNnTDZvWnA3ZWtyUT09/wilayah/0000000/key/edd523f7d5c4c57dbe1a078b5271b69f';
    private const CACHE_TTL = 3600;

    // ── Fallback statis BPS 2023 (jika API tidak bisa diakses) ──
    private const FALLBACK = [
        'source' => 'BPS RI, Statistik Indonesia 2023 (Tabel 4.1.1)',
        'tahun'  => '2023',
        'data'   => [
            ['label' => 'Aceh',                  'rsUmum' => 24,  'rsKhusus' => 14,  'pkmRI' => 118, 'pkmNonRI' => 223],
            ['label' => 'Sumatera Utara',         'rsUmum' => 87,  'rsKhusus' => 97,  'pkmRI' => 220, 'pkmNonRI' => 362],
            ['label' => 'Sumatera Barat',         'rsUmum' => 27,  'rsKhusus' => 9,   'pkmRI' => 101, 'pkmNonRI' => 157],
            ['label' => 'Riau',                   'rsUmum' => 33,  'rsKhusus' => 13,  'pkmRI' => 74,  'pkmNonRI' => 163],
            ['label' => 'Jambi',                  'rsUmum' => 20,  'rsKhusus' => 3,   'pkmRI' => 75,  'pkmNonRI' => 122],
            ['label' => 'Sumatera Selatan',       'rsUmum' => 33,  'rsKhusus' => 13,  'pkmRI' => 101, 'pkmNonRI' => 226],
            ['label' => 'Bengkulu',               'rsUmum' => 12,  'rsKhusus' => 2,   'pkmRI' => 57,  'pkmNonRI' => 124],
            ['label' => 'Lampung',                'rsUmum' => 23,  'rsKhusus' => 10,  'pkmRI' => 91,  'pkmNonRI' => 218],
            ['label' => 'DKI Jakarta',            'rsUmum' => 81,  'rsKhusus' => 169, 'pkmRI' => 44,  'pkmNonRI' => 300],
            ['label' => 'Jawa Barat',             'rsUmum' => 117, 'rsKhusus' => 83,  'pkmRI' => 279, 'pkmNonRI' => 804],
            ['label' => 'Jawa Tengah',            'rsUmum' => 99,  'rsKhusus' => 61,  'pkmRI' => 347, 'pkmNonRI' => 531],
            ['label' => 'DI Yogyakarta',          'rsUmum' => 28,  'rsKhusus' => 27,  'pkmRI' => 36,  'pkmNonRI' => 85],
            ['label' => 'Jawa Timur',             'rsUmum' => 122, 'rsKhusus' => 72,  'pkmRI' => 443, 'pkmNonRI' => 526, 'highlight' => true],
            ['label' => 'Bali',                   'rsUmum' => 21,  'rsKhusus' => 14,  'pkmRI' => 42,  'pkmNonRI' => 78],
            ['label' => 'Nusa Tenggara Barat',    'rsUmum' => 14,  'rsKhusus' => 4,   'pkmRI' => 76,  'pkmNonRI' => 99],
            ['label' => 'Nusa Tenggara Timur',    'rsUmum' => 16,  'rsKhusus' => 2,   'pkmRI' => 148, 'pkmNonRI' => 272],
            ['label' => 'Kalimantan Barat',       'rsUmum' => 22,  'rsKhusus' => 4,   'pkmRI' => 79,  'pkmNonRI' => 157],
            ['label' => 'Kalimantan Tengah',      'rsUmum' => 15,  'rsKhusus' => 2,   'pkmRI' => 77,  'pkmNonRI' => 157],
            ['label' => 'Kalimantan Selatan',     'rsUmum' => 22,  'rsKhusus' => 11,  'pkmRI' => 80,  'pkmNonRI' => 157],
            ['label' => 'Kalimantan Timur',       'rsUmum' => 23,  'rsKhusus' => 9,   'pkmRI' => 69,  'pkmNonRI' => 124],
            ['label' => 'Sulawesi Utara',         'rsUmum' => 18,  'rsKhusus' => 6,   'pkmRI' => 74,  'pkmNonRI' => 111],
            ['label' => 'Sulawesi Tengah',        'rsUmum' => 13,  'rsKhusus' => 2,   'pkmRI' => 87,  'pkmNonRI' => 140],
            ['label' => 'Sulawesi Selatan',       'rsUmum' => 56,  'rsKhusus' => 24,  'pkmRI' => 179, 'pkmNonRI' => 295],
            ['label' => 'Maluku',                 'rsUmum' => 12,  'rsKhusus' => 1,   'pkmRI' => 72,  'pkmNonRI' => 124],
            ['label' => 'Papua',                  'rsUmum' => 12,  'rsKhusus' => 2,   'pkmRI' => 150, 'pkmNonRI' => 340],
        ],
    ];

    public function fetch(): JsonResponse
    {
        $cacheFile = sys_get_temp_dir() . '/bps_faskes_pemweb.json';

        // Kembalikan cache jika masih fresh
        if (file_exists($cacheFile) && (time() - filemtime($cacheFile)) < self::CACHE_TTL) {
            $cached = file_get_contents($cacheFile);
            $decoded = json_decode($cached, true);
            if ($decoded && !isset($decoded['error'])) {
                return response()->json($decoded)->header('X-BPS-Cache', 'HIT');
            }
        }

        // Fetch dari API BPS
        $ctx = stream_context_create([
            'http' => ['timeout' => 10, 'ignore_errors' => true],
            'ssl'  => ['verify_peer' => false, 'verify_peer_name' => false],
        ]);
        $response = @file_get_contents(self::BPS_URL, false, $ctx);

        if ($response !== false) {
            $decoded = json_decode($response, true);
            if ($decoded && !isset($decoded['error'])) {
                file_put_contents($cacheFile, $response);
                return response()->json($decoded)->header('X-BPS-Cache', 'MISS');
            }
        }

        // ── Fallback: kembalikan data statis ──
        return response()->json([
            'fallback' => true,
            'source'   => self::FALLBACK['source'],
            'tahun'    => self::FALLBACK['tahun'],
            'data'     => self::FALLBACK['data'],
        ])->header('X-BPS-Cache', 'FALLBACK');
    }
}