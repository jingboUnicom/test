<?php

namespace App\Jobs;

use App\Models\Work;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use App\Services\JobAdder\DTO\WorkTypeData;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class JobAdderSyncWorkTypes implements ShouldQueue
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
        $jobadder = app()->make('jobadder');

        $access_token = $jobadder->cache['access_token'];

        $api_url = $jobadder->cache['api'];

        Log::info(json_encode($jobadder));

        $worktypes = Http::withHeaders(['Authorization' => 'Bearer ' . $access_token])->get($api_url . '/worktypes')->json();

        foreach ($worktypes['items'] as $worktype) {
            $worktype_data = new WorkTypeData($worktype);

            Work::firstOrCreate(
                $worktype_data->toArray()
            );
        }
    }
}
