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
    Route::get('/authorise', 'App\Services\JobAdder@authorise')->name('.authorise');

    Route::prefix('token')->group(function () {
        Route::get('/', 'App\Services\JobAdder@token')->name('.token');
        // Route::get('/refresh', 'App\Services\JobAdder@refresh')->name('.refresh');
    });

    // Route::get('/', function () {
    //     $jobadder = app()->make(App\Services\JobAdder::class);
    //     dd($jobadder);
    // });

    Route::get('/find-job-ads', function () {
        $jobadder = app()->make(App\Services\JobAdder::class);
        dd($jobadder->findJobAds());
    });
});
