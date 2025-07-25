<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // API Routes
        Route::middleware('api')
            ->prefix('api') // you can remove or change it if needed
            ->group(base_path('routes/api.php'));

        // Web Routes
        Route::middleware('web')
            ->group(base_path('routes/web.php'));
    }
}
