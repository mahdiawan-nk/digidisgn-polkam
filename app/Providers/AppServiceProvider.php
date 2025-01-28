<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Filament\Facades\Filament;
use Filament\Navigation\UserMenuItem;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        $loader = \Illuminate\Foundation\AliasLoader::getInstance();
        $loader->alias('Debugbar', \Barryvdh\Debugbar\Facades\Debugbar::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Filament::serving(function () {
        //     Filament::registerUserMenuItems([
        //         'profile' => UserMenuItem::make()
        //             ->label(auth()->user()->name)
        //             ->url('#')
        //             ->icon('heroicon-s-users'),
        //         // ->image('logo.png'), // Gunakan gambar profil
        //     ]);
        // });
    }
}
