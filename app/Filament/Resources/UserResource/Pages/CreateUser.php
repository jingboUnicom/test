<?php

namespace App\Filament\Resources\UserResource\Pages;

use Illuminate\Support\Facades\Auth;
use App\Filament\Resources\UserResource;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $user = Auth::user();

        if ($user->employer && $user->company) {
            $data['company_id'] = $user->company->id;
        }

        return $data;
    }
}
