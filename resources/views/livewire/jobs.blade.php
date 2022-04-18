<div>
	<div class="container mx-auto px-[15px] mt-[-50px] mb-[30px]">
		<div class="w-full bg-primary p-[15px] border-2 border-primary rounded-xl relative">
			<form wire:submit.prevent="resetFilters">
				<div class="grid grid-cols-12 gap-y-[15px] gap-x-0 xl:gap-y-0 xl:gap-x-[15px]">
					<div class="col-span-12">
						<div
							class="font-secondary font-bold text-[20px] text-primary-75 uppercase mb-[15px] xl:ml-[15px]">
							{{ $content['title_search'] }}
						</div>
					</div>
					<div class="col-span-12 xl:col-span-4">
						<input wire:model="keyword" type="text" placeholder="{{ $content['label_keyword'] }}"
							class="font-secondary bg-primary-75 w-full border-2 border-primary-75 rounded-lg placeholder:font-secondary placeholder:font-semibold placeholder:text-[16px] placeholder:text-primary">
					</div>
					<div class="col-span-12 xl:col-span-3">
						<select wire:model="classification"
							class="bg-primary-75 w-full border-2 border-primary-75 rounded-lg font-secondary font-semibold text-[16px] text-primary">
							<option value="" selected>{{ $content['label_classification'] }}</option>
							@foreach(Arr::sort($classifications) as $key => $value)
							<option value="{{ $key }}">{{ $value }}</option>
							@endforeach
						</select>
					</div>
					<div class="col-span-12 xl:col-span-3">
						<select wire:model="location"
							class="bg-primary-75 w-full border-2 border-primary-75 rounded-lg font-secondary font-semibold text-[16px] text-primary">
							<option value="" selected>{{ $content['label_location'] }}</option>
							@foreach(Arr::sort($locations) as $key => $value)
							<option value="{{ $key }}">{{ $value }}</option>
							@endforeach
						</select>
					</div>
					<div class="col-span-12 xl:col-span-2">
						<button wire:loading.attr="disabled" type="submit"
							class="font-secondary font-semibold text-[16px] text-primary-150 uppercase bg-primary w-full h-[44px] rounded-lg hover:bg-primary-75 hover:text-primary transition-all border-2 border-primary-75">
							{{ $content['label_reset'] }}
						</button>
					</div>
				</div>
			</form>
		</div>
	</div>
	<div class="container mx-auto px-[15px] relative">
		<div class="grid grid-cols-12 gap-y-[15px]">
			@if ($this->total)
			<div class="col-span-12">
				<div class="font-secondary font-semibold text-[16px] text-primary">{{ $this->total }} {{
					$content['label_jobs_found'] }}</div>
			</div>
			@foreach($vacancies as $vacancy)
			<div class="col-span-12 border-2 border-primary bg-primary-75 p-[15px] rounded-xl">
				<div class="flex items-start justify-between flex-wrap xl:flex-nowrap gap-y-[15px] mb-[30px]">
					<div
						class="font-primary font-semibold text-[23px] leading-[23px] xl:text-[30px] xl:leading-[30px] text-primary">
						{{ $vacancy->job_title }}
					</div>
					<div>
						<div class="font-secondary font-semibold text-[16px] text-primary">
							@if((new Carbon\Carbon(new DateTime($vacancy->posted_at)))->diffInDays())
							{{ (new Carbon\Carbon(new DateTime($vacancy->posted_at)))->diffInDays() }}{{
							$content['label_days_ago'] }}
							@else
							{{ (new Carbon\Carbon(new DateTime($vacancy->posted_at)))->diffInHours() }}{{
							$content['label_hours_ago'] }}
							@endif
						</div>
					</div>
				</div>
				@if ($vacancy->category)
				<div class="font-primary text-[18px] text-primary">{{ $vacancy->category->name }}</div>
				@endif
				@if($vacancy->location)
				<div class="font-primary text-[18px] text-primary">{{ $vacancy->location->name }}</div>
				@endif
				@if($vacancy->work)
				<div class="font-primary text-[18px] text-primary">{{ $vacancy->work->name }}</div>
				@endif
				@if ($vacancy->salary_min && $vacancy->salary_max)
				<div class="font-primary text-[18px] text-primary">${{ number_format($vacancy->salary_min, 0) }} - ${{
					number_format($vacancy->salary_max, 0) }}</div>
				@endif
				@if ($vacancy->short_description)
				<div class="font-primary font-semibold text-[18px] text-primary mt-[60px] mb-[30px]">
					@nl2br($vacancy->short_description)
				</div>
				@endif
				<div class="flex items-end justify-between flex-wrap xl:flex-nowrap gap-y-[15px]">
					<button wire:click="view({{ $vacancy->ja_ad_id }})"
						class="font-secondary font-semibold text-[16px] text-primary-150 uppercase bg-primary w-full h-[44px] rounded-lg hover:text-white hover:bg-primary-700 transition-all max-w-[280px]">
						{{ $content['label_view'] }}
					</button>
					<div>
						<div class="font-secondary font-semibold text-[16px] text-primary">{{
							$content['label_reference'] }} {{ $vacancy->ja_ad_id }}</div>
					</div>
				</div>
			</div>
			@endforeach
			@else
			<div class="col-span-12">
				<div class="font-primary text-[18px] text-primary">@nl2br($content['label_search_error'])</div>
			</div>
			@endif
		</div>
		<div wire:loading.delay class="absolute bottom-0 left-[50%] transform translate-y-[200%] translate-x-[-50%]">
			<svg class="animate-spin text-primary w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none"
				viewBox="0 0 24 24">
				<circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
				</circle>
				<path class="opacity-75" fill="currentColor"
					d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
				</path>
			</svg>
		</div>
	</div>
	@if($can_load_more)
	<div x-data="" x-intersect.half="$wire.call('loadMore')"></div>
	@endif
</div>