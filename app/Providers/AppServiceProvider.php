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
            \Illuminate\Support\Facades\Config::set('database.default', 'mysql');
            \Illuminate\Support\Facades\Config::set('database.connections.mysql.url', $privateUrl);
            \Illuminate\Support\Facades\DB::purge('mysql');
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