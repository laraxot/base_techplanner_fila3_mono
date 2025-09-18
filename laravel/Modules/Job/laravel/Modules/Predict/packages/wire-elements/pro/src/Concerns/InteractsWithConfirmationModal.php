<?php

declare(strict_types=1);

namespace WireElements\Pro\Concerns;

trait InteractsWithConfirmationModal
{
    public bool $actionConfirmed = false;

    public string $confirmationCaller;

    public array $confirmationCallerArguments = [];

    public function bootInteractsWithConfirmationModal()
    {
        $this->listeners = array_merge(
            $this->listeners,
            $this->getListeners(),
            ['actionConfirmed' => 'actionConfirmed']
        );
    }

    public function askForConfirmation(
        callable $callback,
        array $prompt = [],
        $tableHeaders = [],
        $tableData = [],
        $confirmPhrase = null,
        $theme = 'warning',
        $metaData = [],
        $modalBehavior = [],
        $modalAttributes = [],
        $modalCloseArguments = [],
    ): void {
        if ($this->actionConfirmed) {
            $callback();
            $this->actionConfirmed = false;

            return;
        }

        $trace = debug_backtrace();
        $trace = next($trace);

        $this->confirmationCaller = $trace['function'] ?? null;
        $this->confirmationCallerArguments = $trace['args'] ?? [];

        $this->dispatch('modal.open', 'modal-pro-confirmation', [
            $this->getName(),
            $prompt,
            $tableHeaders,
            $tableData,
            $confirmPhrase,
            $theme,
            $metaData,
            $modalCloseArguments,
        ], $modalAttributes, $modalBehavior);
    }

    public function actionConfirmed()
    {
        if (method_exists($this, $this->confirmationCaller)) {
            $reflection = new \ReflectionMethod($this, $this->confirmationCaller);
            if ($reflection->isPublic()) {
                $this->actionConfirmed = true;
                $this->{$this->confirmationCaller}(...$this->confirmationCallerArguments);
            }
        }
    }
}
