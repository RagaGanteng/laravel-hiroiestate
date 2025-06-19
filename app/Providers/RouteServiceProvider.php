<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RoleMiddleware;

class RouteServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // Register web routes
        Route::middleware('web')
            ->group(base_path('routes/web.php'));

        // Register auth routes
        Route::middleware('web')
            ->group(base_path('routes/auth.php'));

        // Register your custom middleware alias
        Route::aliasMiddleware('role', RoleMiddleware::class);
    }
}
