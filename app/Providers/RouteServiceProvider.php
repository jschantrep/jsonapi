<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Define tu namespace base si lo deseas.
     */
    public const HOME = '/home';

    /**
     * Define tus rutas de aplicación.
     */
    public function boot(): void
    {
        $this->routes(function () {
            // Rutas API (usa prefijo /api automáticamente)
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            // Rutas web
            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
    }
}
