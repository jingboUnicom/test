<?php

namespace App\Filament\Resources\SubscriberResource\Pages;

use App\Models\Subscriber;
use Filament\Resources\Pages\Page;
use App\Filament\Resources\SubscriberResource;

class ExportSubscribers extends Page
{
    protected static string $resource = SubscriberResource::class;

    protected static string $view = 'filament.resources.subscriber-resource.pages.export-subscribers';

    public function mount(): void
    {
        $this->emails = implode(', ', Subscriber::all()->pluck('email')->toArray());
    }
}
