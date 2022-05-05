<?php

namespace App\Filament\Resources\CandidateResource\Pages;

use App\Models\User;
use App\Models\Company;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotifyEmployerCandidateMail;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\CandidateResource;

class CreateCandidate extends CreateRecord
{
    protected static string $resource = CandidateResource::class;

    protected function afterCreate(): void
    {
        $recipients = [];

        $contacts = User::whereIn('id', $this->data['user_id'])->get();

        foreach ($contacts as $contact) {
            $recipients[$contact->id] = [
                'name' => $contact->contact_name,
                'email' => $contact->email,
            ];
        }

        $companyContacts = Company::whereIn('id', $this->data['company_id'])->with('user')->get();

        foreach ($companyContacts as $companyContact) {
            if (!isset($recipients[$companyContact->user->id])) {
                $recipients[$companyContact->user->id] = [
                    'name' => $companyContact->user->contact_name,
                    'email' => $companyContact->user->email,
                ];
            }
        }

        foreach ($recipients as $recipient) {
            Mail::to($recipient['email'], $recipient['name'])->queue(new NotifyEmployerCandidateMail($this->record));
        }
    }
}
