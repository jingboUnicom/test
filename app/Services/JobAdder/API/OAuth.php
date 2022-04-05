<?php

namespace App\Services\JobAdder\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use App\Services\JobAdder\DTO\OAuthData;

class OAuth
{
	public $cache;

	public function __construct()
	{
		$this->cache = Cache::get('jobadder::oauth');
	}

	public function authorise(): mixed
	{
		return redirect('https://id.jobadder.com/connect/authorize?' . http_build_query([
			'response_type' => 'code',
			'client_id' => config('jobadder.client_id'),
			'scope' => 'read write offline_access',
			'redirect_uri' => config('jobadder.redirect_uri'),
		]));
	}

	public function token(Request $request): mixed
	{
		$data = new OAuthData(Http::asForm()->post('https://id.jobadder.com/connect/token', [
			'grant_type' => 'authorization_code',
			'code' => $request->code,
			'redirect_uri' => config('jobadder.redirect_uri'),
			'client_id' => config('jobadder.client_id'),
			'client_secret' => config('jobadder.client_secret'),
		])->json());

		if ($data->error) {
			Log::error('App\Services\JobAdder\API\OAuth@token: ' . $data->error);
		} else {
			Cache::put('jobadder::oauth', $data->toArray(), now()->addHour());
		}

		return redirect(route('filament.pages.dashboard') . '/job-adder');
	}

	public function refresh(): void
	{
		if (!$this->isAuthorised()) {
			Log::error('App\Services\JobAdder\API\OAuth@refresh: ' . 'jobadder::oauth');

			exit();
		}

		$data = new OAuthData(Http::asForm()->post('https://id.jobadder.com/connect/token', [
			'grant_type' => 'refresh_token',
			'client_id' => config('jobadder.client_id'),
			'client_secret' => config('jobadder.client_secret'),
			'refresh_token' => $this->cache['refresh_token'],
		])->json());

		if ($data->error) {
			Log::error('App\Services\JobAdder\API\OAuth@refresh: ' . $data->error);
		} else {
			Cache::put('jobadder::oauth', $data->toArray(), now()->addHour());
		}
	}

	public function isAuthorised(): bool
	{
		return $this->cache !== null;
	}
}
