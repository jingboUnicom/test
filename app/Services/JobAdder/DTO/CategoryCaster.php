<?php

namespace App\Services\JobAdder\DTO;

use Spatie\DataTransferObject\Caster;
use App\Models\Category;

class CategoryCaster implements Caster
{
	public function cast(mixed $value): mixed
	{
		$category = Category::where('name', $value)->first();

		if ($category) {
			return $category->id;
		}

		return null;
	}
}
