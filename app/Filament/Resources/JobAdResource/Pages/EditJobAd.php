<?php

namespace App\Filament\Resources\JobAdResource\Pages;

use App\Filament\Resources\JobAdResource;
use Filament\Resources\Pages\EditRecord;

class EditJobAd extends EditRecord
{
    protected static string $resource = JobAdResource::class;

    public static function authorizeResourceAccess(): void
    {
        $user = auth()->user();

        if ($user->super) {
            abort(403);
        }

        if ($user->employer) {
            abort(403);
        }

        abort(403);
    }
}
