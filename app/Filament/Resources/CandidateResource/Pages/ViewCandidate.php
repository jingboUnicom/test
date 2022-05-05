<?php

namespace App\Filament\Resources\CandidateResource\Pages;

use App\Models\User;
use App\Models\Interview;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotifyAdminInterviewMail;
use Filament\Pages\Actions\ButtonAction;
use Filament\Resources\Pages\ViewRecord;
use App\Filament\Resources\CandidateResource;

class ViewCandidate extends ViewRecord
{
    protected static string $resource = CandidateResource::class;

    protected function getActions(): array
    {
        return Arr::prepend(parent::getActions(), ButtonAction::make('Interview this candidate')->action('interview')->requiresConfirmation());
    }

    public function interview(): void
    {
        $candidate = $this->record;
        $user = Auth::user();

        $interview = new Interview();
        $interview->user_id = $user->id;
        $interview->candidate_id = $candidate->id;
        $interview->save();

        $admin = User::where('super', 1)->first();

        Mail::to($admin->email, $admin->contact_name)->queue(new NotifyAdminInterviewMail($interview, $user));
    }
}
