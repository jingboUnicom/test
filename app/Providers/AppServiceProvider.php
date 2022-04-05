<?php

namespace App\Providers;

use Filament\Facades\Filament;
use App\Services\JobAdder;
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
        $this->app->singleton(JobAdder::class, function ($app) {
            return new JobAdder();
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

        Filament::registerNavigationGroups([
            'Recruitment Management',
            'Candidate Management',
            'Order Management',
            'Payment Management',
            'System Management',
            'Portal Management',
            'Job Adder Management',
        ]);
    }
}
