<?php

use Illuminate\Support\Facades\Http;
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
    // Route::get('/authorise', 'App\Services\JobAdder\API\OAuth@authorise')->name('.authorise');

    Route::prefix('token')->group(function () {
        Route::get('/', 'App\Services\JobAdder\API\OAuth@token')->name('.token');
        // Route::get('/refresh', 'App\Services\JobAdder\API\OAuth@refresh')->name('.refresh');
    });

    Route::get('/', function () {
        dd(app()->make('jobadder'));
    });

    Route::get('/job-ads', function () {
        $ads = Http::withHeaders([
			'Authorization' => 'Bearer ' . app()->make('jobadder')->cache['access_token']
		])->get(app()->make('jobadder')->cache['api'] . '/jobads/')->json();

		foreach ($ads['items'] as $ad) {
			$job = Http::withHeaders([
				'Authorization' => 'Bearer ' . app()->make('jobadder')->cache['access_token']
			])->get(app()->make('jobadder')->cache['api'] . '/jobs/' . $ad['reference'])->json();

			dump($ad, $job);
		}

		dd();
    });
});
