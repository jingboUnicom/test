<?php

namespace App\Services\JobAdder\DTO;

use Spatie\DataTransferObject\Caster;
use App\Models\State;

class StateCaster implements Caster
{
	public function cast(mixed $value): mixed
	{
		$state = State::where('name', $value)->first();

		if ($state) {
			return $state->id;
		}

		return null;
	}
}
