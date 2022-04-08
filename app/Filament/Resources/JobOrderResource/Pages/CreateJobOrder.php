<?php

namespace App\Filament\Resources\JobOrderResource\Pages;

use App\Models\Vacancy;
use Illuminate\Support\Facades\Auth;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\JobOrderResource;

class CreateJobOrder extends CreateRecord
{
    protected static string $resource = JobOrderResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['status'] = Vacancy::STATUS_OPEN;

        $user = Auth::user();

        if ($user->employer) {
            $data['user_id'] = $user->id;

            if ($user->company) {
                $data['company_id'] = $user->company->id;
            }
        }

        return $data;
    }
}
