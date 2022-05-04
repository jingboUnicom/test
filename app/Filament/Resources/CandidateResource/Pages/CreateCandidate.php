<?php

namespace App\Filament\Resources\CandidateResource\Pages;

use App\Models\Company;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotifyEmployerCandidateMail;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\CandidateResource;

class CreateCandidate extends CreateRecord
{
    protected static string $resource = CandidateResource::class;

    protected function afterSave(): void
    {
        foreach (Company::whereIn('id', $this->data['company_id'])->with('user')->get() as $companyContact) {
            Mail::to($companyContact->user->email, $companyContact->user->contact_name)->queue(new NotifyEmployerCandidateMail($this->data));
        }
    }
}
