<?php

namespace App\Services\JobAdder\DTO;

use App\Models\Category;
use Illuminate\Support\Carbon;
use Spatie\DataTransferObject\Caster;

class PostedAtCaster implements Caster
{
	public function cast(mixed $value): mixed
	{
		return new Carbon($value);
	}
}
