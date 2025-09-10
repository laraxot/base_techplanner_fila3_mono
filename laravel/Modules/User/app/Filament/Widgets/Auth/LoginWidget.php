<?php
<<<<<<< HEAD
=======

>>>>>>> 9831a351 (.)
declare(strict_types=1);

namespace Modules\User\Filament\Widgets\Auth;

use Filament\Forms;
<<<<<<< HEAD
use Filament\Forms\Form;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\ComponentContainer;
use Modules\Xot\Filament\Widgets\XotBaseWidget;

/**
 * 
=======
use Filament\Forms\ComponentContainer;
use Illuminate\Support\Facades\Auth;
use Modules\Xot\Filament\Widgets\XotBaseWidget;

/**
>>>>>>> 9831a351 (.)
 * LoginWidget: Widget di login conforme alle regole Windsurf/Xot.
 * - Estende XotBaseWidget
 * - Usa solo componenti Filament importati
 * - Validazione e sicurezza integrate
 * - Facilmente estendibile (2FA, captcha, login social)
 *
 * @property array<string, mixed>|null $data
 * @property ComponentContainer $form
 */
class LoginWidget extends XotBaseWidget
{
    public ?array $data = [];

    /**
     * Blade view del widget nel modulo User.
     * IMPORTANTE: quando il widget viene usato con @livewire() direttamente nelle Blade,
     * il path deve essere senza il namespace del modulo (senza "user::").
<<<<<<< HEAD
     * 
     * @see \Modules\User\docs\WIDGETS_STRUCTURE.md - Sezione B
     * @var view-string
     * @phpstan-ignore property.defaultValue 
=======
     *
     * @see \Modules\User\docs\WIDGETS_STRUCTURE.md - Sezione B
     *
     * @var view-string
     *
     * @phpstan-ignore property.defaultValue
>>>>>>> 9831a351 (.)
     */
    protected static string $view = 'pub_theme::filament.widgets.auth.login';

    public function getFormSchema(): array
    {
        return [
            Forms\Components\TextInput::make('email')
                ->email()
                ->required(),

            Forms\Components\TextInput::make('password')
                ->password()
                ->required(),

<<<<<<< HEAD
            Forms\Components\Checkbox::make('remember')
                ,
=======
            Forms\Components\Checkbox::make('remember'),
>>>>>>> 9831a351 (.)
        ];
    }

    public function login(): void
    {
        $data = $this->form->getState();

        $credentials = [
            'email' => is_string($data['email'] ?? null) ? $data['email'] : '',
            'password' => is_string($data['password'] ?? null) ? $data['password'] : '',
        ];
<<<<<<< HEAD
        
=======

>>>>>>> 9831a351 (.)
        if (Auth::attempt($credentials)) {
            session()->regenerate();
            redirect()->intended('/');
        }

        $this->addError('email', __('auth.failed'));
    }
}
