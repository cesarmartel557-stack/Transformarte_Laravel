<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Enums\ThemeMode;
use Filament\Widgets\AccountWidget;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\PreventRequestForgery;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Sujip\Filament\Turnstile\Pages\Auth\Login;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            // La ruta no puede ser "admin": el servidor de Hostinger
            // devuelve 403 para esa URL exacta.
            ->path('gestion')
            ->viteTheme('resources/css/filament/admin/theme.css')
            // Login con captcha invisible Cloudflare Turnstile
            // (plugin sudiptpa/filament-turnstile).
            ->login(Login::class)
            ->brandName('Transformarte')
            ->brandLogo(asset('assets/img/Logo-Transformarte.png'))
            ->favicon(asset('assets/img/favicon/favicon-32x32.png'))
            ->defaultThemeMode(ThemeMode::Light)
            ->colors([
                'primary' => [
                    50 => '#f4f4ef',
                    100 => '#e6e7dc',
                    200 => '#cccfba',
                    300 => '#adb294',
                    400 => '#8a906d',
                    500 => '#666c4b',
                    600 => '#393c25',
                    700 => '#2f3220',
                    800 => '#262818',
                    900 => '#1d1f12',
                    950 => '#13140b',
                ],
                'success' => [
                    50 => '#f4f6ef',
                    100 => '#e5e9da',
                    200 => '#cbd3b5',
                    300 => '#a8b48b',
                    400 => '#8a9a6b',
                    500 => '#71815c',
                    600 => '#576446',
                    700 => '#454f37',
                    800 => '#383f2d',
                    900 => '#2f3526',
                    950 => '#181b13',
                ],
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\Filament\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\Filament\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\Filament\Widgets')
            ->widgets([
                AccountWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                PreventRequestForgery::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
