<?php

declare(strict_types=1);

namespace Modules\User\Filament\Widgets\Auth;

<<<<<<< HEAD
use Filament\Forms;
use Filament\Forms\Form;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Filament\Forms\ComponentContainer;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Illuminate\Support\Facades\Password;
=======
use Filament\Forms\ComponentContainer;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
>>>>>>> 9831a351 (.)
use Modules\Xot\Filament\Widgets\XotBaseWidget;

/**
 * Reset password widget for user password reset functionality.
 *
 * Handles password reset functionality with token validation,
 * proper security measures, and user feedback. Follows Laraxot
 * architectural patterns and security best practices.
 *
 * @property ComponentContainer $form Form container from XotBaseWidget
 */
class ResetPasswordWidget extends XotBaseWidget
{
    /**
     * The view for this widget.
     *
     * @var view-string
     */
    protected static string $view = 'user::widgets.auth.reset-password-widget';

    /**
     * Get the form schema for password reset.
     *
     * Uses string keys for Filament form compatibility and follows
     * the pattern established in widget documentation.
     *
     * @return array<string, \Filament\Forms\Components\Component>
     */
    public function getFormSchema(): array
    {
        return [
            'email' => TextInput::make('email')
                ->email()
                ->required()
                ->autocomplete('email'),
            'password' => TextInput::make('password')
                ->password()
                ->required()
                ->minLength(8)
                ->same('password_confirmation')
                ->autocomplete('new-password'),
            'password_confirmation' => TextInput::make('password_confirmation')
                ->password()
                ->required()
                ->autocomplete('new-password'),
        ];
    }

    /**
     * Mount the widget and initialize the form.
<<<<<<< HEAD
     *
     * @return void
=======
>>>>>>> 9831a351 (.)
     */
    public function mount(): void
    {
        $this->form->fill();
    }

    /**
     * Configure the form for this widget.
<<<<<<< HEAD
     *
     * @param \Filament\Forms\Form $form
     * @return \Filament\Forms\Form
=======
>>>>>>> 9831a351 (.)
     */
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema($this->getFormSchema())
                    ->columns(1),
            ])
            ->statePath('data');
    }

    /**
     * Handle password reset with proper security and error handling.
     *
     * Implements Laravel's password reset functionality with explicit
     * type casting for security and proper error feedback.
     *
     * @return \Illuminate\Http\RedirectResponse|void
     */
    public function resetPassword()
    {
        $data = $this->form->getState();

<<<<<<< HEAD
        $reset_data =Arr::only($data,['email','password','password_confirmation','token']);
        $status = Password::reset( $reset_data,
=======
        $reset_data = Arr::only($data, ['email', 'password', 'password_confirmation', 'token']);
        $status = Password::reset($reset_data,
>>>>>>> 9831a351 (.)
            function ($user, $password): void {
                $user->forceFill([
                    'password' => Hash::make($password),
                    'remember_token' => Str::random(60),
                ])->save();
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            session()->flash('status', __($status));
<<<<<<< HEAD
=======

>>>>>>> 9831a351 (.)
            return redirect()->route('login');
        } else {
            /** @phpstan-ignore-next-line */
            $this->addError('email', __($status));
        }
    }
}
