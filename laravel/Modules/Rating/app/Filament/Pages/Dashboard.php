<?php

declare(strict_types=1);

namespace Modules\Rating\Filament\Pages;

use Filament\Pages\Page;

class Dashboard extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-home';

    protected static string $view = 'rating::filament.pages.dashboard';
}
