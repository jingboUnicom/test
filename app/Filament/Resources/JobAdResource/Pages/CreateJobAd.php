<?php

namespace App\Filament\Resources\JobAdResource\Pages;

use App\Filament\Resources\JobAdResource;
use Filament\Resources\Pages\CreateRecord;

class CreateJobAd extends CreateRecord
{
    protected static string $resource = JobAdResource::class;

    public static function authorizeResourceAccess(): void
    {
        $user = auth()->user();

        if ($user->super) {
            return;
        }

        if ($user->agent) {
            return;
        }

        if ($user->employer) {
            return;
        }

        abort(403);
    }
}
