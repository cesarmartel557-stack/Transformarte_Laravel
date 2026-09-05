<?php

namespace App\Providers;

use App\Models\Contacto;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }

        // Datos de contacto disponibles en el layout (header/footer),
        // con fallback a los valores originales si no hay registro.
        View::composer('layouts.app', function ($view) {
            $contacto = Contacto::first();

            $view->with('contactoGlobal', [
                'email' => $contacto?->email ?: 'hola@espaciotransformarte.com',
                'whatsapp' => $contacto?->whatsapp ?: '5491149274026',
                'calendly_url' => $contacto?->calendly_url ?: 'https://calendar.app.google/yyE2dN7uzjg9H9TR9',
                'instagram_url' => $contacto?->instagram_url ?: 'https://www.instagram.com/espacio_transformarte/',
            ]);
        });
    }
}
