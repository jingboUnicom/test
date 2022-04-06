<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class JobAdder extends Page
{
    protected static ?string $navigationGroup = null;

    protected static ?int $navigationSort = 11;

    protected static ?string $navigationIcon = 'heroicon-o-star';

    protected static ?string $title = 'Job Adder';

    protected static string $view = 'filament.pages.job-adder';

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
        return [
            'jobadder' => app()->make('jobadder'),
        ];
    }

    public function authorise()
    {
        app()->make('jobadder')->authorise();
    }

    public function refresh(): void
    {
        app()->make('jobadder')->refresh();
    }

    public function isAuthorised(): bool
	{
		return app()->make('jobadder')->isAuthorised();
	}
}
