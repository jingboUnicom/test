<?php

namespace App\Filament\Resources\SubscriberResource\Pages;

use Illuminate\Support\Arr;
use Filament\Pages\Actions\ButtonAction;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\SubscriberResource;

class ListSubscribers extends ListRecords
{
    protected static string $resource = SubscriberResource::class;

    protected function getActions(): array
    {
        return Arr::prepend(parent::getActions(), ButtonAction::make('Export Subscribers')->action('export'));
    }

    public function export()
    {
        return redirect(SubscriberResource::getUrl('export'));
    }
}
