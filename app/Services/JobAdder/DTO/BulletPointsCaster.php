<?php

namespace App\Services\JobAdder\DTO;

use Spatie\DataTransferObject\Caster;

class BulletPointsCaster implements Caster
{
	public function cast(mixed $value): mixed
	{
		$bullet_points = [];

		foreach ($value as $point) {
			$bullet_points[] = [
				'point' => $point
			];
		}

		return $bullet_points;
	}
}
