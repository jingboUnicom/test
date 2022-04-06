<x-filament::page>
	<x-filament::card class="mb-8">
		<div class="flex items-center justify-start space-x-4">
			<h2 class="text-lg sm:text-xl font-bold tracking-tight">
				{{ __('Status:') }}
			</h2>
			@if($this->isAuthorised())
			<x-filament::header :heading="'Authorised'" class="text-green-500"></x-filament::header>
			@else
			<x-filament::header :heading="'Unauthorised'" class="text-red-500"></x-filament::header>
			@endif
		</div>
		@if($this->isAuthorised())
		<x-filament::button wire:click="refresh">{{ __('Refresh') }}</x-filament::button>
		@else
		<x-filament::button wire:click="authorise">{{ __('Authorise') }}</x-filament::button>
		@endif
	</x-filament::card>
</x-filament::page>