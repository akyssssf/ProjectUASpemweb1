<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    $user = App\Models\Pasien::first();
    if (!$user) die("No Pasien found.");
    Illuminate\Support\Facades\Auth::guard('pasien')->login($user);

    $request = Illuminate\Http\Request::create('/pendaftaran/simpan-umum', 'POST', [
        'klinik' => 'RS Aisyiyah Ponorogo',
        'poli' => 'Poli Kandungan',
        'dokter' => 'dr. Fatimah Az-Zahra Sp.OG',
        'tanggal' => date('Y-m-d', strtotime('+1 day')),
        'keluhan' => 'Sakit',
    ]);

    $controller = new App\Http\Controllers\PendaftaranProsesController();
    $response = $controller->simpanUmum($request);
    
    echo "SUCCESS!\n";
} catch (\Throwable $e) {
    echo "=== ERROR TERDETEKSI ===\n";
    echo "Pesan: " . $e->getMessage() . "\n";
    echo "Baris: " . $e->getFile() . ":" . $e->getLine() . "\n";
    echo "Trace: " . substr($e->getTraceAsString(), 0, 1000) . "...\n";
}
