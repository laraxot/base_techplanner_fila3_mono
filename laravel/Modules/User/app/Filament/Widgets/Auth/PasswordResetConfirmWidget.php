<?php

declare(strict_types=1);

namespace Modules\User\Filament\Widgets\Auth;

use Filament\Forms;
use Filament\Forms\ComponentContainer;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Modules\Xot\Filament\Widgets\XotBaseWidget;
use Webmozart\Assert\Assert;

/**
 * Password Reset Confirmation Widget .
 *
 * Handles the password reset confirmation flow using a token
 * from the password reset email link.
 *
 * @property ComponentContainer $form
 */
class PasswordResetConfirmWidget extends XotBaseWidget
{
    public ?array $data = [];
    public ?string $token = null;
    public ?string $email = null;
    public string $currentState = 'form'; // form, success, error, expired
    public ?string $errorMessage = null;

    /**
     * @phpstan-ignore-next-line
     */
    protected static string $view = 'pub_theme::filament.widgets.auth.password.reset-confirm';

    /**
     * Mount the widget with token and optional email.
     */
    public function mount(?string $token = null, ?string $email = null): void
    {
        $this->token = $token;
        $this->email = $email;

        // Pre-fill the form if email is provided
        if ($this->email) {
            $this->form->fill(['email' => $this->email]);
        }
    }

    /**
     * Get the form schema for password reset confirmation.
     *
     * @return array<string, mixed>
     */
    #[\Override]
    public function getFormSchema(): array
    {
        return [
            'email' => Forms\Components\TextInput::make('email')
                ->email()
                ->required()
                ->autocomplete('email')
                ->maxLength(255)
                ->disabled('form' !== $this->currentState)
                ->extraInputAttributes(['class' => 'text-center'])
                ->suffixIcon('heroicon-o-envelope'),

            'password' => Forms\Components\TextInput::make('password')
                ->password()
                ->required()
                ->revealable()
                ->minLength(8)
                ->disabled('form' !== $this->currentState)
                ->extraInputAttributes(['class' => 'text-center'])
                ->suffixIcon('heroicon-o-key'),

            'password_confirmation' => Forms\Components\TextInput::make('password_confirmation')
                ->password()
                ->required()
                ->same('password')
                ->disabled('form' !== $this->currentState)
                ->extraInputAttributes(['class' => 'text-center'])
                ->suffixIcon('heroicon-o-key'),
        ];
    }

    /**
     * Handle the password reset confirmation.
     */
    public function confirmPasswordReset(): void
    {
        if ('form' !== $this->currentState) {
            return;
        }

        $this->currentState = 'loading';

        try {
            $data = $this->form->getState();

            $response = Password::broker()->reset(
                [
                    'token' => $this->token,
                    'email' => $data['email'],
                    'password' => $data['password'],
                ],
                function ($user, $password) {
                    $user->password = Hash::make($password);
                    $user->setRememberToken(Str::random(60));
                    $user->save();

                    event(new PasswordReset($user));
                }
            );

            if (Password::PASSWORD_RESET === $response) {
                $this->currentState = 'success';

                Notification::make()
                    ->title(__('user::auth.password_reset.success.title'))
                    ->body(__('user::auth.password_reset.success.message'))
                    ->success()
                    ->duration(8000)
                    ->send();

                // Auto-login the user after successful password reset
                // $user = \Modules\Xot\Datas\XotData::make()->getUserClass()::where('email', $data['email'])->first();
                Assert::string($email = $data['email']);
                $user = \Modules\Xot\Datas\XotData::make()->getUserByEmail($email);
                // if ($user) {
                Auth::guard()->login($user);
                // }

                // Redirect after a short delay to show success message
                $this->js('setTimeout(() => { window.location.href = "'.route('login').'"; }, 3000);');
            } else {
                /* @phpstan-ignore argument.type */
                $this->handleResetError($response);
            }
        } catch (\Exception $e) {
            $this->handleResetError('passwords.generic_error');
        }
    }

    /**
     * Handle password reset errors.
     */
    protected function handleResetError(string $response): void
    {
        $this->currentState = 'error';

        // Map Laravel password reset responses to user-friendly messages
        $errorMessages = [
            Password::INVALID_TOKEN => __('user::auth.password_reset.errors.invalid_token'),
            Password::INVALID_USER => __('user::auth.password_reset.errors.invalid_user'),
            'passwords.generic_error' => __('user::auth.password_reset.errors.generic'),
        ];

        $this->errorMessage = $errorMessages[$response] ?? trans($response);

        Notification::make()
            ->title(__('user::auth.password_reset.errors.title'))
            ->body($this->errorMessage)
            ->danger()
            ->duration(10000)
            ->send();
    }

    /**
     * Reset the widget to allow another attempt.
     */
    public function resetForm(): void
    {
        $this->currentState = 'form';
        $this->errorMessage = null;
        $this->form->fill(['email' => $this->email ?? '']);
    }

    /**
     * Get the current state for the view.
     */
    public function getCurrentState(): string
    {
        return $this->currentState;
    }

    /**
     * Get the error message if any.
     */
    public function getErrorMessage(): ?string
    {
        return $this->errorMessage;
    }

    /**
     * Check if the form should be shown.
     */
    public function shouldShowForm(): bool
    {
        return in_array($this->currentState, ['form', 'loading']);
    }

    /**
     * Check if the widget is in loading state.
     */
    public function isLoading(): bool
    {
        return 'loading' === $this->currentState;
    }

    /**
     * Check if the password reset was successful.
     */
    public function isSuccess(): bool
    {
        return 'success' === $this->currentState;
    }

    /**
     * Check if there was an error.
     */
    public function hasError(): bool
    {
        return 'error' === $this->currentState;
    }
}
