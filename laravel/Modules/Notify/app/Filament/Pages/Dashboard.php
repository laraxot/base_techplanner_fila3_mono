<?php

declare(strict_types=1);

namespace Modules\Notify\Filament\Pages;

<<<<<<< HEAD
use Modules\Xot\Filament\Pages\XotBasePage;

class Dashboard extends XotBasePage
=======
use Filament\Pages\Page;

class Dashboard extends Page
>>>>>>> c57e89d (.)
{
    protected static ?string $navigationIcon = 'heroicon-o-home';

    protected static string $view = 'notify::filament.pages.dashboard';

    public function mount(): void
    {
        /*
        $user = auth()->user();
        if (! $user->hasRole('super-admin')) {
            redirect('/admin');
        }
        */
    }
}
