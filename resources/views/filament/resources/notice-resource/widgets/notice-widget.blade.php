<x-filament::widget>
    @foreach($notices as $notice)
    <x-filament::card class="mb-8">
        <x-filament::header :heading="$notice->title"></x-filament::header>
        <div>
            {{ date('l, F j, Y', strtotime($notice->started_at)); }}
        </div>
        <div>
            {!! $notice->description !!}
        </div>
    </x-filament::card>
    @endforeach
</x-filament::widget>