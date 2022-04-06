<?php

namespace App\Services\JobAdder\DTO;

use Spatie\DataTransferObject\Attributes\MapFrom;
use Spatie\DataTransferObject\DataTransferObject;
use Spatie\DataTransferObject\Attributes\CastWith;

class JobAdData extends DataTransferObject
{
	#[MapFrom('adId')]
	public $id;

	public $company_id;

	public $user_id;

	#[MapFrom('title')]
	public $job_title;

	#[MapFrom('summary')]
	public $short_description;

	#[MapFrom('bulletPoints')]
	public $bullet_points;

	#[MapFrom('state')]
	#[CastWith(StateCaster::class)]
	public $state;

	public $status;

	#[MapFrom('postAt')]
	#[CastWith(PostedAtCaster::class)]
	public $posted_at;
}
