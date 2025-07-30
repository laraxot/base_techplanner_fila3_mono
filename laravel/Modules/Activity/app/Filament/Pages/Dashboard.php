<?php

declare(strict_types=1);

namespace Modules\Activity\Filament\Pages;

use Modules\Xot\Filament\Pages\XotBaseDashboard;

/**
 * Dashboard per il modulo Activity.
 * 
 * Estende XotBaseDashboard che gestisce automaticamente:
 * - Navigazione (icon, title, label, sort)
 * - Filtri del dashboard
 * - Struttura base del dashboard
 * 
 * REGOLA CRITICA: NON ridefinire proprietà di navigazione
 * che sono già gestite centralmente da XotBaseDashboard.
 */
class Dashboard extends XotBaseDashboard
{
    // ❌ NON ridefinire queste proprietà (gestite da XotBaseDashboard):
    // protected static ?string $navigationIcon
    // protected static ?string $title
    // protected static ?string $navigationLabel
    // protected static ?int $navigationSort
    
    // ✅ XotBaseDashboard auto-configura tutto basandosi sul modulo
    
    protected static string $view = 'activity::filament.pages.dashboard';

    // public function mount(): void
    // {
    //     // $user = auth()->user();
    //     // if(!$user->hasRole('super-admin')){
    //     //     redirect('/admin');
    //     // }
    //     ActivityEvent::dispatch();
    // }
}
