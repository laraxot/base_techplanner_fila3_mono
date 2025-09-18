<?php

declare(strict_types=1);

namespace Modules\Predict\Filament\Pages;

use Filament\Pages\Page;

class Dashboard extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'predict::filament.pages.dashboard';
}
