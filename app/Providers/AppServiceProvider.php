<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // RAILWAY FIX: Force Private Network URL to avoid 30s IPv6 public proxy timeout
        $privateUrl = getenv('MYSQL_PRIVATE_URL') ?: (isset($_ENV['MYSQL_PRIVATE_URL']) ? $_ENV['MYSQL_PRIVATE_URL'] : null);
        if ($privateUrl) {
            $_ENV['DATABASE_URL'] = $privateUrl;
            $_SERVER['DATABASE_URL'] = $privateUrl;
            putenv('DATABASE_URL=' . $privateUrl);
        } else {
            // Destroy DATABASE_URL if no MySQL private URL exists, forcing fallback to config/database.php (e.g. sqlite)
            putenv('DATABASE_URL');
            unset($_ENV['DATABASE_URL'], $_SERVER['DATABASE_URL']);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Railway (dan platform hosting sejenis) men-terminate HTTPS di reverse
        // proxy mereka, lalu meneruskan trafik ke aplikasi lewat HTTP biasa.
        // Tanpa ini, Laravel tidak tahu request aslinya HTTPS, sehingga semua
        // URL/form yang di-generate (route(), url(), form action, dst) memakai
        // http:// dan memicu peringatan "not secure" di browser.
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }
    }
}