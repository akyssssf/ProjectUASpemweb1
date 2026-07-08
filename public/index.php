<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

// RAILWAY FIX: Force Private Network URL to avoid 30s IPv6 public proxy timeout
if (isset($_ENV['MYSQL_PRIVATE_URL']) || getenv('MYSQL_PRIVATE_URL')) {
    $privateUrl = $_ENV['MYSQL_PRIVATE_URL'] ?? getenv('MYSQL_PRIVATE_URL');
    $_ENV['DATABASE_URL'] = $privateUrl;
    $_SERVER['DATABASE_URL'] = $privateUrl;
    putenv('DATABASE_URL=' . $privateUrl);
} else {
    // If they want to use SQLite, destroy the injected DATABASE_URL so it doesn't force MySQL
    putenv('DATABASE_URL');
    unset($_ENV['DATABASE_URL'], $_SERVER['DATABASE_URL']);
}

define('LARAVEL_START', microtime(true));

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register the Composer autoloader...
require __DIR__.'/../vendor/autoload.php';

// Bootstrap Laravel and handle the request...
/** @var Application $app */
$app = require_once __DIR__.'/../bootstrap/app.php';

$app->handleRequest(Request::capture());
