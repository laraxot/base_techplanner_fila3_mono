<?php

declare(strict_types=1);

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class AppLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        $view = 'layouts.app';
        if (! view()->exists($view)) {
            dddx(['message' => 'no view found', 'view' => $view]);
        }

        return view($view);
    }
}
