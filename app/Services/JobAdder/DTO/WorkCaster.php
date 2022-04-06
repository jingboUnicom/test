<?php

namespace App\Services\JobAdder\DTO;

use Spatie\DataTransferObject\Caster;
use App\Models\Work;

class WorkCaster implements Caster
{
	public function cast(mixed $value): mixed
	{
		$work = Work::where('name', $value)->first();

		if ($work) {
			return $work->id;
		}

		return null;
	}
}
