<?php

namespace App\Jobs;

use App\Models\Location;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Http;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use App\Services\JobAdder\DTO\LocationData;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class JobAdderSyncLocations implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $access_token = app()->make('jobadder')->cache['access_token'];

        $api_url = app()->make('jobadder')->cache['api'];

        $locations = Http::withHeaders(['Authorization' => 'Bearer ' . $access_token])->get($api_url . '/locations?embed=Areas')->json();

        foreach ($locations['items'] as $location) {
            $location_data = new LocationData($location);

            Location::firstOrCreate(
                $location_data->toArray()
            );
        }
    }
}
