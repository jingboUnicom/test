<?php

namespace App\Console;

use App\Jobs\LogTime;
use App\Jobs\JobAdderSyncJobAds;
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
        // $schedule->job(new LogTime())->everyMinute();

        $schedule->job(new JobAdderRefreshAccessToken())->name('App\Jobs\JobAdderRefreshAccessToken')->hourly();

        $schedule->job(new JobAdderSyncJobAds())->name('App\Jobs\JobAdderSyncJobAds')->hourly();
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
