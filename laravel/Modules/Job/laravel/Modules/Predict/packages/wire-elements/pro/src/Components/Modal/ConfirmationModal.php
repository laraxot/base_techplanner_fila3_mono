<?php

declare(strict_types=1);

namespace WireElements\Pro\Components\Modal;

class ConfirmationModal extends Modal
{
    public mixed $callbackComponent;

    public array $prompt = [];

    public mixed $confirmPhrase = null;

    public mixed $confirmPhraseInput = null;

    public array $tableHeaders;

    public array $tableData;

    public mixed $theme;

    public array $metaData;

    public array $modalCloseArguments = [];

    public function mount($callbackComponent, array $prompt = [], array $tableHeaders = [], array $tableData = [], $confirmPhrase = null, $theme = 'warning', $metaData = [], $modalCloseArguments = [])
    {
        $this->callbackComponent = $callbackComponent;

        $this->prompt = array_merge([
            'title' => __('wire-elements-pro::modal.confirmation.title'),
            'message' => __('wire-elements-pro::modal.confirmation.message'),
            'confirm' => __('wire-elements-pro::modal.confirmation.confirm'),
            'cancel' => __('wire-elements-pro::modal.confirmation.cancel'),
        ], $prompt);

        $this->confirmPhrase = $confirmPhrase;
        $this->tableHeaders = empty($tableHeaders) ? [__('wire-elements-pro::modal.confirmation.resource'), __('wire-elements-pro::modal.confirmation.count')] : $tableHeaders;
        $this->tableData = $tableData;
        $this->theme = $theme;
        $this->metaData = $metaData;
        $this->modalCloseArguments = $modalCloseArguments;
    }

    public function getMessages()
    {
        return [
            'confirmPhraseInput.in' => __('wire-elements-pro::modal.confirmation.please_enter_phrase_to_continue', ['phrase' => $this->confirmPhrase]),
        ];
    }

    public function getRules()
    {
        return [
            'confirmPhraseInput' => ['required_with:confirmPhrase', 'in:'.$this->confirmPhrase],
        ];
    }

    public function confirm()
    {
        $this->validate();

        $this->dispatch('actionConfirmed')->to($this->callbackComponent);

        call_user_func_array([$this, 'close'], $this->modalCloseArguments);
    }

    public function render()
    {
        return view($this->config('confirmation_view'));
    }
}
