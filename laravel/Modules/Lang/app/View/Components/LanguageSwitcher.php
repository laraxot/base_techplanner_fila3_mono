<?php

declare(strict_types=1);

namespace Modules\Lang\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;
use Modules\Lang\Filament\Widgets\LanguageSwitcherWidget;

/**
 * Componente Blade per il Language Switcher.
 * 
 * Wrappa il LanguageSwitcherWidget per l'uso nei temi tramite sintassi Blade.
 * 
 * @package Modules\Lang\View\Components
 */
class LanguageSwitcher extends Component
{
    /**
     * Widget associato al componente.
     */
    protected LanguageSwitcherWidget $widget;

    /**
     * Crea una nuova istanza del componente.
     */
    public function __construct()
    {
        $this->widget = new LanguageSwitcherWidget();
    }

    /**
     * Renderizza il componente.
     */
    public function render(): View
    {
        // Verifica se il widget può essere visualizzato
        if (!LanguageSwitcherWidget::canView()) {
            return view('lang::components.empty');
        }

        // Ottiene i dati dal widget
        $viewData = $this->widget->getViewData();

        return view('lang::filament.widgets.language-switcher', $viewData);
    }
}
