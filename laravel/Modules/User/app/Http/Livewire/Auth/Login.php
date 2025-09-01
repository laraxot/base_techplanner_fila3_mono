<?php

declare(strict_types=1);

namespace Modules\User\Http\Livewire\Auth;

use Filament\Forms\ComponentContainer;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Modules\Xot\Actions\File\ViewCopyAction;

/**
 * Componente Livewire per la gestione del login.
 *
 * @property ComponentContainer $form
 */
class Login extends Component implements HasForms
{
    use InteractsWithForms;

    /**
     * Regole di validazione.
     *
     * @var array<string, array<string|object>>
     */
    protected array $rules = [
        'email' => ['required', 'email'],
        'password' => ['required'],
        'remember' => ['boolean'],
    ];

    /**
     * Email dell'utente.
     */
    public string $email = '';

    /**
     * Password dell'utente.
     */
    public string $password = '';

    /**
     * Flag per ricordare l'utente.
     */
    public bool $remember = false;

    /**
     * Inizializza il componente.
     */
    public function mount(): void
    {
        $this->form = $this->form();
    }

    /**
     * Definisce lo schema del form.
     *
     * @return array<TextInput|Checkbox>
     */
    protected function getFormSchema(): array
    {
        return [
            TextInput::make('email')
                ->email()
                ->required()
                ->label(__('Email'))
                ->placeholder(__('Inserisci la tua email'))
                ->suffixIcon('heroicon-m-envelope')
                ->autofocus()
                ->live()
                ->afterStateUpdated(fn ($state) => $this->validateOnly('email'))
                ->dehydrated(),

            TextInput::make('password')
                ->password()
                ->required()
                ->label(__('Password'))
                ->placeholder(__('Inserisci la tua password'))
                ->suffixIcon('heroicon-m-key')
                ->revealable()
                ->minLength(8)
                ->maxLength(255)
                ->dehydrated(),

            Checkbox::make('remember')
                ->label(__('Ricordami'))
                ->default(false)
                ->dehydrated(),
        ];
    }

    /**
     * Crea il form.
     */
    public function form(): Form
    {
        return $this->makeForm()
            ->schema($this->getFormSchema());
    }

    /**
     * Esegue l'autenticazione dell'utente.
     *
     * @return RedirectResponse|void
     */
    public function authenticate()
    {
        try {
            /** @var array{email: string, password: string, remember?: bool} $data */
            $data = $this->validate();

            // Estrai remember dal data array e assicurati che sia un booleano
            $remember = $data['remember'] ?? false;
            // Converto esplicitamente a bool per PHPStan livello 10
            $remember = (bool) $remember;
            unset($data['remember']);

            if (Auth::attempt($data, $remember)) {
                session()->regenerate();

                // Redirect intelligente basato sui ruoli dell'utente
                return $this->getRedirectUrl();
            }

            $this->addError('email', __('Le credenziali fornite non sono corrette..'));
        } catch (\Exception $e) {
            $this->addError('email', __('Si è verificato un errore durante il login. Riprova più tardi.'));
            report($e);
        }
    }

    /**
     * Determina l'URL di redirect appropriato per l'utente autenticato.
     */
    protected function getRedirectUrl(): RedirectResponse
    {
        $user = Auth::user();

        if (! $user) {
            return redirect()->to('/');
        }

        // Se l'utente ha ruoli admin, redirect al pannello appropriato
        $adminRoles = $user->roles->filter(function ($role) {
            return str_ends_with($role->name, '::admin');
        });

        if ($adminRoles->count() === 1) {
            // Un solo ruolo admin - redirect al modulo specifico
            $role = $adminRoles->first();
            if ($role !== null) {
                $moduleName = str_replace('::admin', '', $role->name);

                return redirect()->to("/{$moduleName}/admin");
            }
        } elseif ($adminRoles->count() > 1) {
            // Più ruoli admin - redirect alla dashboard principale
            return redirect()->to('/admin');
        }

        // Utente senza ruoli admin - redirect alla homepage
        return redirect()->to('/'.app()->getLocale());
    }

    /**
     * Renderizza il componente.
     */
    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
    {
        // app(ViewCopyAction::class)->execute('user::livewire.auth.login', 'pub_theme::livewire.auth.login');
        return view('user::livewire.auth.login');
    }
}
