<?php

namespace App\Filament\Resources\JobOrderResource\Pages;

use App\Filament\Resources\JobOrderResource;
use Filament\Resources\Pages\ViewRecord;

class ViewJobOrder extends ViewRecord
{
    protected static string $resource = JobOrderResource::class;

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
