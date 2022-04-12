<?php

namespace App\Filament\Resources\CandidateResource\Pages;

use App\Models\Interview;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
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

        Interview::create([
            'user_id' => $user->id,
            'candidate_id' => $candidate->id,
            'user_id' => $user->id,
        ])->save();
    }
}
