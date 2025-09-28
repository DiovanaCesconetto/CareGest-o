<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Filament\Facades\Filament;
use Illuminate\Support\HtmlString;



class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
     {
        return $panel
         //   ->default()
            ->id('admin')
            ->path('admin')
          // ->login()
            ->login(\App\Filament\Pages\Auth\CustomLogin::class)
            ->brandLogo(fn () => new HtmlString('<img src="' . asset('images/logo.png') . '" alt="Seu Logo" class="h-10">'))

                    ->brandName(null) // AQUI! Esta linha deve estar presente.

            ->colors([
                // Troque Amber por um tom de verde
                // Opção 1: Verde padrão do Filament
                'primary' => Color::Emerald,

                // Opção 2: Verde customizado pelo HEX do seu logo
                // 'primary' => Color::hex('#22c55e'),
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
    \App\Filament\Widgets\DashboardStats::class,   // 1º: cards
    \App\Filament\Widgets\ConsultationsChart::class, // 2º: gráfico
    \App\Filament\Widgets\DateFilterWidget::class, // 3º: pesquisa
])

            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
