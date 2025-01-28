<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class EditPdf extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.edit-pdf';

    public static function canAccess(): bool
    {
        return false;
    }
}
