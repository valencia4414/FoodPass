<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\RateLimiter;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        RateLimiter::for('foodpass', function (Request $request): Limit {
            $key = $request->user()?->getAuthIdentifier() ?: $request->ip();

            return Limit::perMinute(100)
                ->by((string) $key)
                ->response(function (Request $request, array $headers) {
                    return response()->json([
                        'mensaje' => 'Has superado el límite de 100 solicitudes por minuto. Inténtalo de nuevo más tarde.',
                    ], 429, $headers);
                });
        });
    }
}
