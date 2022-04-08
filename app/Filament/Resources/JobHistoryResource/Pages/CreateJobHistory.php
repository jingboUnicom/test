<?php

namespace App\Filament\Resources\JobHistoryResource\Pages;

use App\Models\Vacancy;
use Illuminate\Support\Facades\Auth;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\JobHistoryResource;

class CreateJobHistory extends CreateRecord
{
    protected static string $resource = JobHistoryResource::class;

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
