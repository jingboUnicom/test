@if (filled($brand = config('filament.brand')))
<div class="flex items-center justify-start">
	<img src="{{ asset('/images/logo-64.png') }}" alt="Icon" class="object-contain w-full h-full mr-2" />
	<div @class([ 'text-xl font-bold tracking-tight filament-brand' , 'dark:text-white'=> config('filament.dark_mode'),
		])>
		{{
		\Illuminate\Support\Str::of($brand)
		->snake()
		->upper()
		->explode('_')
		->map(fn (string $string) => \Illuminate\Support\Str::substr($string, 0, 1))
		->take(2)
		->implode('')
		}}
	</div>
</div>
@endif