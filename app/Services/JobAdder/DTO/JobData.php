<?php

namespace App\Services\JobAdder\DTO;

use Spatie\DataTransferObject\Attributes\MapFrom;
use Spatie\DataTransferObject\DataTransferObject;
use Spatie\DataTransferObject\Attributes\CastWith;

class JobData extends DataTransferObject
{
	#[MapFrom('workType.name')]
	#[CastWith(WorkCaster::class)]
	public $work_id;

	#[MapFrom('salary.rateLow')]
	public $salary_min;

	#[MapFrom('salary.rateHigh')]
	public $salary_max;

	#[MapFrom('jobDescription')]
	public $job_description;

	#[MapFrom('category.name')]
	#[CastWith(CategoryCaster::class)]
	public $category_id;

	#[MapFrom('category.subCategory.name')]
	#[CastWith(SubcategoryCaster::class)]
	public $subcategory_id;

	#[MapFrom('location.name')]
	#[CastWith(LocationCaster::class)]
	public $location_id;
}
