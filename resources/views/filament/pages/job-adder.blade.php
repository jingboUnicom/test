<x-filament::page>
	<x-filament::card class="mb-8">
		<div class="flex items-center justify-start space-x-4">
			<h2 class="text-lg sm:text-xl font-bold tracking-tight">
				{{ __('Status:') }}
			</h2>
			@if($this->isUnauthorised())
			<x-filament::header :heading="'Unauthorised'" class="text-red-500"></x-filament::header>
			@else
			<x-filament::header :heading="'Authorised'" class="text-green-500"></x-filament::header>
			@endif
		</div>
		@if($this->isUnauthorised())
		<x-filament::button tag='a' href="{{ route('jobadder.authorise') }}">{{ __('Authorise') }}</x-filament::button>
		@else
		<x-filament::button wire:click="refresh">{{ __('Refresh') }}</x-filament::button>
		@endif
	</x-filament::card>
</x-filament::page>