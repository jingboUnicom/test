<?php

namespace App\Providers;

use Filament\Facades\Filament;
use Illuminate\Support\ServiceProvider;
use App\Services\JobAdder\API\OAuth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('jobadder', function ($app) {
            return new OAuth();
        });
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

        Filament::registerNavigationGroups([]);
    }
}
