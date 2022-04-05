<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Illuminate\Support\Facades\Cache;
use App\Services\JobAdder as ServiceJobAdder;

class JobAdder extends Page
{
    protected static ?string $navigationGroup = 'Job Adder Management';

    protected static ?int $navigationSort = 0;

    protected static ?string $navigationIcon = 'heroicon-o-star';

    protected static ?string $title = 'Job Adder';

    protected static string $view = 'filament.pages.job-adder';

    protected $jobadder;

    public function mount()
    {
        abort_unless(auth()->user()->super, 403);
    }

    protected static function shouldRegisterNavigation(): bool
    {
        return auth()->user()->super;
    }

    protected function getViewData(): array
    {
        return [];
    }

    public function isUnauthorised(): bool
    {
        $this->jobadder = app()->make(ServiceJobAdder::class);

        return $this->jobadder->oauth === null;
    }

    public function refresh(): void
    {
        $this->jobadder = app()->make(ServiceJobAdder::class);

        $this->jobadder->refresh();
    }
}
