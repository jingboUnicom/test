<?php

namespace App\Filament\Resources\JobOrderResource\Pages;

use App\Models\User;
use App\Models\Vacancy;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotifyAdminJobOrderMail;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\JobOrderResource;

class CreateJobOrder extends CreateRecord
{
    protected static string $resource = JobOrderResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $user = Auth::user();

        if ($user->employer) {
            $data['user_id'] = $user->id;

            if ($user->company) {
                $data['company_id'] = $user->company->id;
            }

            $data['status'] = Vacancy::STATUS_OPEN;
        }

        return $data;
    }

    protected function afterCreate(): void
    {
        $user = Auth::user();

        if ($user->employer) {
            $admin = User::where('super', 1)->first();

            Mail::to($admin->email, $admin->contact_name)->queue(new NotifyAdminJobOrderMail($this->record, $user));
        }
    }
}
