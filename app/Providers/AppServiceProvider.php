<?php

namespace App\Providers;

use Filament\Facades\Filament;
use App\Services\JobAdder\API\OAuth;
use Illuminate\Support\Facades\Blade;
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

        Filament::registerNavigationGroups([
            'Portal Management',
            'Job Adder Management',
        ]);

        Blade::directive('nl2br', function ($string) {
            return "<?php echo nl2br(htmlentities($string)); ?>";
        });
    }
}
