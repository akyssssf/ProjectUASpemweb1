<?php

/**
 * File ini diperlukan oleh Vercel untuk menjalankan aplikasi PHP secara serverless.
 * Kita cukup mengarahkan request dari Vercel ke index.php bawaan Laravel.
 */

require __DIR__ . '/../public/index.php';