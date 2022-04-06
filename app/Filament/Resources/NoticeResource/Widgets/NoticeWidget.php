<?php

namespace App\Filament\Resources\NoticeResource\Widgets;

use App\Models\Notice;
use Filament\Widgets\Widget;

class NoticeWidget extends Widget
{
    protected static string $view = 'filament.resources.notice-resource.widgets.notice-widget';

    protected int | string | array $columnSpan = 'full';

    public function mount(): void
    {
    }

    public function getNoticesProperty()
    {
        $notices = Notice::where('started_at', '<=', now())->where('ended_at', '>=', now())->orderBy('id', 'desc')->get();

        return $notices;
    }

    protected function getViewData(): array
    {
        return [
            'notices' => $this->notices,
        ];
    }
}
