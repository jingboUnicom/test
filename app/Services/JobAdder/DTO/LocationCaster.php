<?php

namespace App\Services\JobAdder\DTO;

use Spatie\DataTransferObject\Caster;
use App\Models\Location;

class LocationCaster implements Caster
{
	public function cast(mixed $value): mixed
	{
		$location = Location::where('name', $value)->first();

		if ($location) {
			return $location->id;
		}

		return null;
	}
}
