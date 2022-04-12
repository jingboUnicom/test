@if (filled($brand = config('filament.brand')))
<div class="flex items-center justify-start">
	<img src="{{ asset('/images/logo-256.png') }}" alt="Logo" class="h-10 mr-4">
	<div @class([ 'text-xl font-bold tracking-tight filament-brand' , 'dark:text-white'=> config('filament.dark_mode'),
		])>
		{{ $brand }}
	</div>
</div>
@endif