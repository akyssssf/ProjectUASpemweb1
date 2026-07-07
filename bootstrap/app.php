<?php

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // Daftarkan alias 'role' di sini agar Laravel mengenali middleware tersebut
        $middleware->alias([
            'role' => \App\Http\Middleware\CheckRole::class,
        ]);

        // Percaya semua proxy (Railway jadi reverse-proxy di depan aplikasi).
        // Tanpa ini, Laravel gak tau request aslinya lewat HTTPS, sehingga
        // form action / URL yang di-generate jadi http:// bukan https://,
        // dan browser nunjukin warning "not secure" pas submit form.
        $middleware->trustProxies(
            at: '*',
            headers: Request::HEADER_X_FORWARDED_FOR |
                     Request::HEADER_X_FORWARDED_HOST |
                     Request::HEADER_X_FORWARDED_PORT |
                     Request::HEADER_X_FORWARDED_PROTO
        );
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->shouldRenderJsonWhen(
            fn (Request $request) => $request->is('api/*'),
        );

        // Penanganan redirect untuk staf yang belum login
        $exceptions->render(function (AuthenticationException $e, Request $request) {
            if ($request->is('petugas/*')) {
                return redirect('/petugas/login');
            }
        });
    })->create();