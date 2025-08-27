<?php

declare(strict_types=1);

namespace Modules\Xot\Filament\Widgets;

// use Symfony\Component\Console\Output\BufferedOutput;

use Modules\Xot\Filament\Widgets\XotBaseWidget;

class Clock extends XotBaseWidget
{
    public string $start = '';

    protected static string $view = 'xot::filament.widgets.clock';

    /**
     * Get the form schema for the widget.
     *
     * @return array<int|string, \Filament\Forms\Components\Component>
     */
    public function getFormSchema(): array
    {
        return [];
    }

    public function begin(): void
    {
        // while ($this->start >= 0) {
        $cond = true;
        while ($cond) {
            // Stream the current count to the browser...
            $this->stream(
                to: 'count',
                content: $this->start,
                replace: true,
            );

            // Pause for 1 second between numbers...
            // sleep(1);

            // Decrement the counter...
            // $this->start = $this->start - 1;
            $this->start = (string) now();
            if ('impossible' === $this->start) {
                $cond = false;
            }
        }
    }
}
