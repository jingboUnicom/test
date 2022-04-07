<?php

namespace App\Jobs;

use App\Models\Work;
use App\Models\State;
use App\Models\Vacancy;
use App\Models\Category;
use App\Models\Location;
use App\Models\Subcategory;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Http;
use App\Services\JobAdder\DTO\JobData;
use Illuminate\Queue\SerializesModels;
use App\Services\JobAdder\DTO\JobAdData;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class JobAdderSyncJobAds implements ShouldQueue
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

        $job_ads = Http::withHeaders(['Authorization' => 'Bearer ' . $access_token])->get($api_url . '/jobads/')->json();

        foreach ($job_ads['items'] as $job_ad) {
            $job = Http::withHeaders(['Authorization' => 'Bearer ' . $access_token])->get($api_url . '/jobs/' . $job_ad['reference'])->json();

            if (isset($job['location']['name'])) {
                Location::firstOrCreate(
                    ['name' => $job['location']['name']]
                );
            }

            if (isset($job_ad['state'])) {
                State::firstOrCreate(
                    ['name' => $job_ad['state']]
                );
            }

            $job_ad_data = new JobAdData($job_ad);

            $job_data = new JobData($job);

            $vacancy_data = array_merge($job_ad_data->toArray(), $job_data->toArray());

            $vacancy = Vacancy::updateOrCreate(
                [
                    'ja_ad_id' => $job_ad_data->ja_ad_id,
                    'ja_job_id' => $job_data->ja_job_id,
                ],
                $vacancy_data
            );

            $vacancy->status = Vacancy::STATUS_SYNCED_FROM_JOB_ADDER;

            $vacancy->update();
        }
    }
}
