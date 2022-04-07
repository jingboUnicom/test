<?php

namespace App\Filament\Resources\JobOrderResource\Pages;

use App\Models\Vacancy;
use Illuminate\Support\Facades\Auth;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\JobOrderResource;

class CreateJobOrder extends CreateRecord
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

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['status'] = Vacancy::STATUS_OPEN;

        $user = Auth::user();

        if ($user->employer) {
            if ($user->company) {
                $data['company_id'] = $user->company->id;
            }

            $data['user_id'] = $user->id;
        }

        return $data;
    }
}
