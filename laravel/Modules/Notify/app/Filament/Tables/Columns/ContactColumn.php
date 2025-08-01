<?php

declare(strict_types=1);

namespace Modules\Notify\Filament\Tables\Columns;

use Filament\Tables\Columns\ViewColumn;

/**
 * ContactColumn - Colonna Filament riutilizzabile per rendering contatti
 * 
 * Utilizza ViewColumn + Blade view + ContactTypeEnum per separare
 * completamente logica e presentazione seguendo i principi DRY/KISS
 * 
 * PATTERN CORRETTO:
 * - ViewColumn per layout complessi
 * - Blade view separata per HTML
 * - ContactTypeEnum come single source of truth
 * - Helper nel modello per dati
 * - Accessibilità WCAG 2.1 AA compliant
 * 
 * @author Laraxot Team
 * @version 2.0 - REFACTOR COMPLETO
 * @since 2025-08-01
 */
class ContactColumn extends ViewColumn
{
    /**
     * View Blade per il rendering della colonna
     */
    protected string $view = 'notify::filament.tables.columns.contact';
    
    protected function setUp(): void
    {
        
            $this->view(static::getView())
            ->searchable(['phone', 'mobile', 'email', 'pec', 'whatsapp', 'fax'])
            ->sortable(false)
            ->wrap()
            ->toggleable(isToggledHiddenByDefault: false);
    }
    
    
}