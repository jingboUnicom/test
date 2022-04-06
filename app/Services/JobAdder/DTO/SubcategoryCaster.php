<?php

namespace App\Services\JobAdder\DTO;

use Spatie\DataTransferObject\Caster;
use App\Models\Subcategory;

class SubcategoryCaster implements Caster
{
	public function cast(mixed $value): mixed
	{
		$subcategory = Subcategory::where('name', $value)->first();

		if ($subcategory) {
			return $subcategory->id;
		}

		return null;
	}
}
