<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$user = App\Models\Pasien::first();
if (!$user) {
    die("No Pasien found to test with.");
}
Illuminate\Support\Facades\Auth::guard('pasien')->login($user);

$request = Illuminate\Http\Request::create('/pendaftaran/simpan-umum', 'POST', [
    'klinik' => 'Klinik Red Grave',
    'poli' => 'Poli Bedah',
    'dokter' => 'Dr. Dante',
    'tanggal' => date('Y-m-d', strtotime('+1 day')),
    'keluhan' => 'Sakit',
    '_token' => csrf_token(),
]);

$response = $kernel->handle($request);

echo "HTTP Status: " . $response->getStatusCode() . "\n";
if ($response->getStatusCode() === 500 && $response->exception) {
    echo "ERROR MESSAGE: " . $response->exception->getMessage() . "\n";
    echo $response->exception->getTraceAsString() . "\n";
} else {
    echo "Content/Redirect: " . substr($response->getContent(), 0, 500) . "\n";
}
