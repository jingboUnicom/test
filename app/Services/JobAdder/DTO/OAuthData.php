<?php

namespace App\Services\JobAdder\DTO;

use Spatie\DataTransferObject\DataTransferObject;

class OAuthData extends DataTransferObject
{
	public $id_token;
	public $access_token;
	public $expires_in;
	public $token_type;
	public $refresh_token;
	public $api;
	public $instance;
	public $account;
	public $error;
}
