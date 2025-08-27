<?php

declare(strict_types=1);

namespace Modules\Job\Filament\Pages;

use Modules\Xot\Filament\Resources\Pages\XotBasePage;
use Modules\Xot\Filament\Traits\NavigationLabelTrait;

class JobMonitor extends XotBasePage
{
    use NavigationLabelTrait;

    protected static ?string $navigationIcon = 'heroicon-o-computer-desktop';

    protected static string $view = 'job::filament.pages.job-monitor';

    // public function mount(): void {
    //     $user = auth()->user();
    //     if(!$user->hasRole('super-admin')){
    //         redirect('/admin');
    //     }
    // }
}
