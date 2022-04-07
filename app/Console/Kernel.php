<?php

namespace App\Console;

use App\Jobs\LogTime;
use App\Jobs\JobAdderSyncJobAds;
use App\Jobs\JobAdderSyncLocations;
use App\Jobs\JobAdderSyncWorkTypes;
use App\Jobs\JobAdderSyncCategories;
use App\Jobs\JobAdderRefreshAccessToken;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->job(new JobAdderRefreshAccessToken())->name('App\Jobs\JobAdderRefreshAccessToken')->everyMinute();

        $schedule->job(new JobAdderSyncLocations())->name('App\Jobs\JobAdderSyncLocations')->everyMinute();

        $schedule->job(new JobAdderSyncCategories())->name('App\Jobs\JobAdderSyncCategories')->everyMinute();

        $schedule->job(new JobAdderSyncWorkTypes())->name('App\Jobs\JobAdderSyncWorkTypes')->everyMinute();

        $schedule->job(new JobAdderSyncJobAds())->name('App\Jobs\JobAdderSyncJobAds')->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
