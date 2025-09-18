<?php

declare(strict_types=1);

namespace Modules\User\Http\Livewire\Auth;

use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Modules\Xot\Actions\File\ViewCopyAction;
use Filament\Forms\ComponentContainer;

/**
 * @property ComponentContainer $form
 */
class Login extends Component implements HasForms
{
    use InteractsWithForms;

    /**
     * @var array<string, mixed>
     */
    protected $rules = [
        'email' => ['required', 'email'],
        'password' => ['required'],
        'remember' => ['boolean'],
    ];

    public string $email = '';

    public string $password = '';

    public bool $remember = false;

    public function mount(): void
    {
        $this->form = $this->form();
    }

    protected function getFormSchema(): array
    {
        return [
            TextInput::make('email')
                ->email()
                ->required()
                ->label(__('Email'))
                ->placeholder(__('Inserisci la tua email'))
                ->suffixIcon('heroicon-m-envelope'),

            TextInput::make('password')
                ->password()
                ->required()
                ->label(__('Password'))
                ->placeholder(__('Inserisci la tua password'))
                ->suffixIcon('heroicon-m-key'),

            Checkbox::make('remember')
                ->label(__('Ricordami')),
        ];
    }

    public function form(): Form
    {
        return $this->makeForm()
            ->schema($this->getFormSchema());
    }

    /**
     * Execute the action.
     *
     * @return RedirectResponse|void
     */
    public function authenticate()
    {
        $data = $this->validate();

        // Estrai remember dal data array
        $remember = $data['remember'] ?? false;
        unset($data['remember']);

        if (Auth::attempt($data, $remember)) {
            session()->regenerate();

            return redirect()->intended();
        }

        $this->addError('email', __('Le credenziali fornite non sono corrette.'));
    }

    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
    {
        app(ViewCopyAction::class)->execute('user::livewire.auth.login', 'pub_theme::livewire.auth.login');
        app(ViewCopyAction::class)->execute('user::layouts.auth', 'pub_theme::layouts.auth');
        app(ViewCopyAction::class)->execute('user::layouts.base', 'pub_theme::layouts.base');

        /**
         * @phpstan-var view-string
         */
        $view = 'pub_theme::livewire.auth.login';

        return view($view)
            ->extends('pub_theme::layouts.auth');
    }
}
