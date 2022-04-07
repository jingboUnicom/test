<?php

namespace App\Services\JobAdder\DTO;

use Spatie\DataTransferObject\Attributes\MapFrom;
use Spatie\DataTransferObject\DataTransferObject;

class CategoryData extends DataTransferObject
{
	#[MapFrom('name')]
	public $name;
}
