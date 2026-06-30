<?php

/**
 * File ini diperlukan oleh Vercel untuk menjalankan aplikasi PHP secara serverless.
 */

// Fitur diagnostik sementara untuk mengecek versi PHP di Vercel
if (isset($_GET['check-php'])) {
    header('Content-Type: text/plain');
    echo "Versi PHP di Vercel saat ini: " . phpversion() . "\n";
    echo "Harusnya versi 8.3.x agar aplikasi Laravel Anda bisa berjalan.";
    exit;
}

require __DIR__ . '/../public/index.php';