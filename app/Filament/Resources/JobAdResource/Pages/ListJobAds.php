<?php

namespace App\Filament\Resources\JobAdResource\Pages;

use App\Filament\Resources\JobAdResource;
use Filament\Resources\Pages\ListRecords;

class ListJobAds extends ListRecords
{
    protected static string $resource = JobAdResource::class;

    public static function authorizeResourceAccess(): void
    {
        $user = auth()->user();

        if ($user->super) {
            return;
        }

        if ($user->employer) {
            abort(403);
        }

        abort(403);
    }
}
