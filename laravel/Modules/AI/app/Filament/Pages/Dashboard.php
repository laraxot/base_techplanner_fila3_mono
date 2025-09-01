<?php

declare(strict_types=1);

namespace Modules\AI\Filament\Pages;

use Modules\Xot\Filament\Pages\XotBasePage;

class Dashboard extends XotBasePage
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'ai::filament.pages.dashboard';
}
