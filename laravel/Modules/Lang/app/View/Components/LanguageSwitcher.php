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
 * @package Modules\Lang\View\Components *
 * Wrappa il LanguageSwitcherWidget per l'uso nei temi tramite sintassi Blade.
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
        $this->widget = new LanguageSwitcherWidget();        $this->widget = new LanguageSwitcherWidget;
    }

    /**
     * Renderizza il componente.
     */
    public function render(): View
    {
        if (! LanguageSwitcherWidget::canView()) {
            /** @var view-string $view */
            $view = 'lang::components.empty';
            return view($view);
        }

        // Ottiene i dati dal widget tramite metodo pubblico
        $viewData = $this->widget->exposeViewData();
        /** @var view-string $view */
        $view = 'lang::filament.widgets.language-switcher';
        return view($view, $viewData);
    }
}
