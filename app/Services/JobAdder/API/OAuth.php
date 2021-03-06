<?php

namespace App\Services\JobAdder\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use App\Services\JobAdder\DTO\OAuthData;

class OAuth
{
	public $cache;

	public function __construct()
	{
		$this->cache = Cache::get('jobadder::oauth');

		if (!$this->isAuthorised()) {
			$this->cache = (new OAuthData())->toArray();
		}
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
			Cache::put('jobadder::oauth', $data->toArray());
		}

		return redirect(route('filament.pages.dashboard') . '/job-adder');
	}

	public function refresh(): void
	{
		$data = new OAuthData(Http::asForm()->post('https://id.jobadder.com/connect/token', [
			'grant_type' => 'refresh_token',
			'client_id' => config('jobadder.client_id'),
			'client_secret' => config('jobadder.client_secret'),
			'refresh_token' => $this->cache['refresh_token'],
		])->json());

		if ($data->error) {
			Log::error('App\Services\JobAdder\API\OAuth@refresh: ' . $data->error);
		} else {
			Cache::put('jobadder::oauth', $data->toArray());
		}
	}

	public function isAuthorised(): bool
	{
		return Cache::get('jobadder::oauth') !== null;
	}

	public function submitAJobApplication(int $adId, string $firstName, string $lastName, string $email, string $phone): mixed
	{
		$response = Http::withHeaders([
			'Authorization' => 'Bearer ' . $this->cache['access_token']
		])->post($this->cache['api'] . '/jobboards/' . config('jobadder.board_id') . '/ads/' . $adId . '/applications', [
			'firstName' => $firstName,
			'lastName' => $lastName,
			'email' => $email,
			'phone' => $phone,
		]);

		return $response->json();
	}

	public function submitJobApplicationDocuments(int $adId, int $applicationId, string $attachmentType, string $fileData): mixed
	{
		$response = Http::withHeaders([
			'Authorization' => 'Bearer ' . $this->cache['access_token']
		])->attach('fileData', File::get($fileData))->post($this->cache['api'] . '/jobboards/' . config('jobadder.board_id') . '/ads/' . $adId . '/applications/' . $applicationId . '/' . $attachmentType);

		return $response->json();
	}
}
