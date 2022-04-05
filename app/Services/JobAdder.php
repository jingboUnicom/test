<?php

namespace App\Services;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Psr\Container\NotFoundExceptionInterface;
use Psr\Container\ContainerExceptionInterface;
use Illuminate\Contracts\Container\BindingResolutionException;

class JobAdder
{
	public $oauth;

	public function __construct()
	{
		$this->oauth = Cache::get('jobadder::oauth');
	}

	public function authorise(): mixed
	{
		$query = http_build_query([
			'response_type' => 'code',
			'client_id' => config('jobadder.client_id'),
			'scope' => 'read write offline_access',
			'redirect_uri' => config('jobadder.redirect_uri'),
		]);

		return redirect('https://id.jobadder.com/connect/authorize?' . $query);
	}

	public function token(Request $request): mixed
	{
		$response = json_decode(Http::asForm()->post('https://id.jobadder.com/connect/token', [
			'grant_type' => 'authorization_code',
			'code' => $request->code,
			'redirect_uri' => config('jobadder.redirect_uri'),
			'client_id' => config('jobadder.client_id'),
			'client_secret' => config('jobadder.client_secret'),
		]), true);

		if (isset($response['error']) && !empty($response['error'])) {
			Log::error('JobAdder@token: ' . $response['error']);
		} else {
			Cache::put('jobadder::oauth', $response, now()->addHour());
		}

		return redirect(route('filament.pages.dashboard') . '/job-adder');
	}

	public function refresh(): void
	{
		if ($this->oauth === null) {
			Log::error('JobAdder@refresh: ' . 'jobadder::oauth');

			exit();
		}

		$response = json_decode(Http::asForm()->post('https://id.jobadder.com/connect/token', [
			'grant_type' => 'refresh_token',
			'client_id' => config('jobadder.client_id'),
			'client_secret' => config('jobadder.client_secret'),
			'refresh_token' => $this->oauth['refresh_token'],
		]), true);

		if (isset($response['error']) && !empty($response['error'])) {
			Log::error('JobAdder@refresh: ' . $response['error']);
		} else {
			Cache::put('jobadder::oauth', $response, now()->addHour());
		}
	}
}
