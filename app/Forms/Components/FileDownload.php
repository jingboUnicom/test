<?php

namespace App\Forms\Components;

use Illuminate\Support\Facades\Storage;
use Filament\Forms\Components\Component;

class FileDownload extends Component
{
    protected string $view = 'forms.components.file-download';

    protected string $column = '';

    public static function make(): static
    {
        return new static();
    }

    public function download(string $column): static
    {
        $this->column = $column;

        return $this;
    }

    public function showDownloadLink(): bool
    {
        return $this->getRecord() && $this->getRecord()->{$this->column};
    }

    public function getDownloadLink(): string
    {
        return Storage::url($this->getRecord()->{$this->column});
    }
}
