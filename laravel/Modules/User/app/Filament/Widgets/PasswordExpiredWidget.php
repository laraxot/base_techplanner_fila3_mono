<?php

declare(strict_types=1);

namespace Modules\User\Filament\Widgets;

<<<<<<< HEAD
use Filament\Forms;
use Filament\Forms\Form;
use Illuminate\Support\Arr;
use Filament\Actions\Action;
use Filament\Widgets\Widget;
use Webmozart\Assert\Assert;
use Filament\Facades\Filament;
use Filament\Actions\ActionGroup;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Modules\User\Datas\PasswordData;
use Filament\Forms\ComponentContainer;
use Filament\Forms\Contracts\HasForms;
use Illuminate\Support\Facades\Schema;
use Modules\User\Events\NewPasswordSet;
use Filament\Forms\Components\Component;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form as FilamentForm;
use Filament\Notifications\Notification;
use Modules\User\Rules\CheckOtpExpiredRule;
use Modules\Xot\Filament\Traits\TransTrait;
use Filament\Forms\Concerns\InteractsWithForms;
use Modules\Xot\Filament\Widgets\XotBaseWidget;
use Modules\Xot\Actions\Cast\SafeStringCastAction;
use Filament\Pages\Concerns\InteractsWithFormActions;
use Modules\User\Http\Response\PasswordResetResponse;
use Illuminate\Validation\Rules\Password as PasswordRule;
use Illuminate\Auth\Events\PasswordReset as PasswordResetResponseEvent; 


/**
 * Widget for handling expired password reset.
 * 
=======
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Facades\Filament;
use Filament\Forms\ComponentContainer;
use Filament\Forms\Components\Component;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Widgets\Widget;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\Rules\Password as PasswordRule;
use Modules\User\Datas\PasswordData;
use Modules\User\Http\Response\PasswordResetResponse;
use Modules\User\Rules\CheckOtpExpiredRule;
use Modules\Xot\Actions\Cast\SafeStringCastAction;
use Modules\Xot\Filament\Traits\TransTrait;
use Modules\Xot\Filament\Widgets\XotBaseWidget;

/**
 * Widget for handling expired password reset.
 *
>>>>>>> 9831a351 (.)
 * @property ComponentContainer $form
 * @property string|null $current_password
 * @property string|null $password
 * @property string|null $passwordConfirmation
 * @property array<string, mixed>|null $data
 */
class PasswordExpiredWidget extends XotBaseWidget implements HasForms
{
    use InteractsWithForms;
    use TransTrait;

    public ?string $current_password = '';
<<<<<<< HEAD
    public ?string $password = '';
=======

    public ?string $password = '';

>>>>>>> 9831a351 (.)
    public ?string $passwordConfirmation = '';

    /** @var array<string, mixed>|null */
    public ?array $data = [];

    /**
     * @var view-string
     */
    protected static string $view = 'user::filament.widgets.password-expired';

    protected static bool $shouldRegisterNavigation = false;

    /**
     * Get the form schema for password reset.
     *
     * @return array<int, Component>
     */
    public function getFormSchema(): array
    {
        return [
            $this->getCurrentPasswordFormComponent(),
            ...PasswordData::make()->getPasswordFormComponents('password'),
        ];
    }

    /**
     * Get the reset password form action.
<<<<<<< HEAD
     *
     * @return Action
=======
>>>>>>> 9831a351 (.)
     */
    public function getResetPasswordFormAction(): Action
    {
        return Action::make('resetPassword')
            ->submit('resetPassword');
    }

    /**
     * Check if the widget should display a logo.
<<<<<<< HEAD
     *
     * @return bool
=======
>>>>>>> 9831a351 (.)
     */
    public function hasLogo(): bool
    {
        return false;
    }

    /**
     * Reset the user's password.
<<<<<<< HEAD
     *
     * @return PasswordResetResponse|null
=======
>>>>>>> 9831a351 (.)
     */
    public function resetPassword(): ?PasswordResetResponse
    {
        $this->validate();

        $user = Auth::user();
<<<<<<< HEAD
        if (!$user || !($user instanceof \Illuminate\Database\Eloquent\Model)) {
            $this->addError('current_password', __('user::auth.user_not_found'));
=======
        if (! $user || ! ($user instanceof \Illuminate\Database\Eloquent\Model)) {
            $this->addError('current_password', __('user::auth.user_not_found'));

>>>>>>> 9831a351 (.)
            return null;
        }

        // Cast e verifica esistenza dei dati del form
        $data = $this->data ?? [];
        $currentPassword = SafeStringCastAction::cast($data['current_password'] ?? '');
        $newPassword = SafeStringCastAction::cast($data['password'] ?? '');
<<<<<<< HEAD
        
        if (empty($currentPassword) || empty($newPassword)) {
            $this->addError('current_password', __('user::auth.password_fields_required'));
=======

        if (empty($currentPassword) || empty($newPassword)) {
            $this->addError('current_password', __('user::auth.password_fields_required'));

>>>>>>> 9831a351 (.)
            return null;
        }

        $userPassword = SafeStringCastAction::cast($user->getAttribute('password'));
        // Cast esplicito di mixed a string per PHPStan
        $userPasswordString = $userPassword;
<<<<<<< HEAD
        
        if (!Hash::check($currentPassword, $userPasswordString)) {
            $this->addError('current_password', __('user::auth.password_current_incorrect'));
=======

        if (! Hash::check($currentPassword, $userPasswordString)) {
            $this->addError('current_password', __('user::auth.password_current_incorrect'));

>>>>>>> 9831a351 (.)
            return null;
        }

        $user->setAttribute('password', Hash::make($newPassword));
        $user->save();

<<<<<<< HEAD
        return new PasswordResetResponse();
=======
        return new PasswordResetResponse;
>>>>>>> 9831a351 (.)
    }

    /**
     * Get the current password form component.
<<<<<<< HEAD
     *
     * @return Component
=======
>>>>>>> 9831a351 (.)
     */
    protected function getCurrentPasswordFormComponent(): Component
    {
        $authUser = Filament::auth()->user();

        if ($authUser instanceof \Modules\User\Models\User) {
            return TextInput::make('current_password')
                ->password()
                ->revealable()
                ->required()
                ->rule(new CheckOtpExpiredRule($authUser))
                ->validationAttribute(static::trans('fields.current_password.validation_attribute'));
        }

        // Fallback nel caso l'utente non sia del tipo corretto
        return TextInput::make('current_password')
            ->password()
            ->revealable()
            ->required()
            ->validationAttribute(static::trans('fields.current_password.validation_attribute'));
    }

    /*
    protected function getPasswordFormComponent(): Component
    {
        $validation_messages = __('user::validation');

        return TextInput::make('password')
            ->password()
            // ->revealable(filament()->arePasswordsRevealable())
            ->revealable()
            ->required()
            ->rule(PasswordRule::default())
            ->same('passwordConfirmation')
            ->validationMessages($validation_messages)
            ->validationAttribute(static::trans('fields.password.validation_attribute'));
    }

    protected function getPasswordConfirmationFormComponent(): Component
    {
        return TextInput::make('passwordConfirmation')
            ->password()
            // ->revealable(filament()->arePasswordsRevealable())
            ->revealable()
            ->required()
            ->dehydrated(false);
    }
    */

    /**
     * Get the form actions.
     *
     * @return array<int, Action|ActionGroup>
     */
    protected function getFormActions(): array
    {
        return [
            $this->getResetPasswordFormAction(),
        ];
    }
}
