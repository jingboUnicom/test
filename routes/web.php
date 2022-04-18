<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::statamic('job/{ja_ad_id}', 'pages.job')->name('job');

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified'
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });

Route::prefix('jobadder')->name('jobadder')->middleware(['web', 'jobadder'])->group(function () {
    // Route::get('/authorise', 'App\Services\JobAdder\API\OAuth@authorise')->name('.authorise');

    Route::prefix('token')->group(function () {
        Route::get('/', 'App\Services\JobAdder\API\OAuth@token')->name('.token');
        // Route::get('/refresh', 'App\Services\JobAdder\API\OAuth@refresh')->name('.refresh');
    });

    // Route::prefix('sync')->group(function () {
    //     Route::get('locations', function () {
    //         $job = new App\Jobs\JobAdderSyncLocations();
    //         $job->handle();
    //     });

    //     Route::get('categories', function () {
    //         $job = new App\Jobs\JobAdderSyncCategories();
    //         $job->handle();
    //     });

    //     Route::get('worktypes', function () {
    //         $job = new App\Jobs\JobAdderSyncWorkTypes();
    //         $job->handle();
    //     });

    //     Route::get('jobads', function () {
    //         $job = new App\Jobs\JobAdderSyncJobAds();
    //         $job->handle();
    //     });
    // });
});
