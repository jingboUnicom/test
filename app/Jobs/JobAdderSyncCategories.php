<?php

namespace App\Jobs;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use App\Services\JobAdder\DTO\CategoryData;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Services\JobAdder\DTO\SubcategoryData;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class JobAdderSyncCategories implements ShouldQueue
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

        $categories = Http::withHeaders(['Authorization' => 'Bearer ' . $access_token])->get($api_url . '/categories?embed=SubCategories')->json();

        if (isset($categories['items'])) {
            foreach ($categories['items'] as $category_item) {
                $category_data = new CategoryData($category_item);

                $category = Category::firstOrCreate(
                    $category_data->toArray()
                );

                if (isset($category_item['subCategories'])) {
                    foreach ($category_item['subCategories'] as $subcategory) {
                        $subcategory_data = new SubcategoryData($subcategory);

                        Subcategory::firstOrCreate(
                            $subcategory_data->toArray(),
                            ['category_id' => $category->id]
                        );
                    }
                }
            }
        }
    }
}
