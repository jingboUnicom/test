<?php

namespace App\Providers;

use Filament\Facades\Filament;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Filament::serving(function (): void {
            Filament::registerTheme(mix('css/filament.css'));
        });

        Filament::registerNavigationGroups([
            'Recruitment Management',
            'Candidate Management',
            'Order Management',
            'Payment Management',
            'System Management',
            'Attributes Management'
        ]);
    }
}
