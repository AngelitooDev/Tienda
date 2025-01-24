<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Registra los servicios de la aplicación.
     */
    public function register()
    {
        //
    }

    /**
     * Inicia los servicios de la aplicación.
     */
    public function boot()
    {
        // Rutas web
        Route::middleware('web')
            ->group(base_path('routes/web.php'));

        // Rutas API (con prefijo /api)
        Route::prefix('api')
            ->middleware('api')
            ->group(base_path('routes/api.php'));
    }
}
