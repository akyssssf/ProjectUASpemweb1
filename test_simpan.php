<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    $pendaftaran = App\Models\Pendaftaran::create([
        'pasien_id'         => 1,
        'jenis_pendaftaran' => 'umum',
        'klinik'            => 'Klinik Red Grave',
        'poli'              => 'Poli Bedah',
        'dokter'            => 'Dr. Dante',
        'tanggal'           => '2026-07-09',
        'keluhan'           => 'Sakit dada',
        'status'            => 'menunggu',
    ]);
    
    $antrian = App\Models\Antrian::buatUntuk($pendaftaran);
    echo "SUCCESS: " . $antrian->nomor_antrian . "\n";
} catch (\Throwable $e) {
    echo "ERROR: " . $e->getMessage() . "\n" . $e->getTraceAsString();
}
