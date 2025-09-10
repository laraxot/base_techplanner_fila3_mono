<?php
<<<<<<< HEAD
=======

>>>>>>> 9831a351 (.)
declare(strict_types=1);

namespace Modules\User\Filament\Widgets\Auth;

<<<<<<< HEAD
use Filament\Forms\ComponentContainer;
=======
>>>>>>> 9831a351 (.)
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
<<<<<<< HEAD
use Illuminate\Http\RedirectResponse;
=======
>>>>>>> 9831a351 (.)
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Modules\User\Models\User;
use Modules\Xot\Filament\Widgets\XotBaseWidget;
<<<<<<< HEAD
use Webmozart\Assert\Assert;
=======
>>>>>>> 9831a351 (.)

class RegisterWidget extends XotBaseWidget
{
    protected static string $view = 'user::widgets.auth.register-widget';
<<<<<<< HEAD
    protected static ?int $sort = 2;
=======

    protected static ?int $sort = 2;

>>>>>>> 9831a351 (.)
    protected static ?string $maxHeight = '600px';

    public static function canView(): bool
    {
<<<<<<< HEAD
        return !Auth::check();
=======
        return ! Auth::check();
>>>>>>> 9831a351 (.)
    }

    public function mount(): void
    {
        $this->form->fill([]);
        Log::debug('Registration form initialized', [
            'ip' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);
    }

    public function getFormSchema(): array
    {
        return [
            'user_info' => Section::make()
                ->schema([
                    'first_name' => TextInput::make('first_name')
                        ->label(__('user::auth.fields.first_name'))
                        ->required()
                        ->string()
                        ->minLength(2)
                        ->maxLength(255)
                        ->autocomplete('given-name')
                        ->validationAttribute(__('user::auth.fields.first_name')),
<<<<<<< HEAD
                    
=======

>>>>>>> 9831a351 (.)
                    'last_name' => TextInput::make('last_name')
                        ->label(__('user::auth.fields.last_name'))
                        ->required()
                        ->string()
                        ->minLength(2)
                        ->maxLength(255)
                        ->autocomplete('family-name')
                        ->validationAttribute(__('user::auth.fields.last_name')),
<<<<<<< HEAD
                    
=======

>>>>>>> 9831a351 (.)
                    'email' => TextInput::make('email')
                        ->label(__('user::auth.fields.email'))
                        ->required()
                        ->email()
                        ->maxLength(255)
                        ->unique(User::class, 'email')
                        ->autocomplete('email')
                        ->validationAttribute(__('user::auth.fields.email'))
                        ->helperText(__('user::auth.help.email')),
<<<<<<< HEAD
                    
=======

>>>>>>> 9831a351 (.)
                    'password_grid' => Grid::make(2)
                        ->schema([
                            'password' => TextInput::make('password')
                                ->label(__('user::auth.fields.password'))
                                ->password()
                                ->required()
                                ->string()
                                ->minLength(12)
                                ->maxLength(255)
                                ->rules([
                                    'required',
                                    'string',
                                    'min:12',
                                    'regex:/[A-Z]/',
                                    'regex:/[a-z]/',
                                    'regex:/[0-9]/',
<<<<<<< HEAD
                                    'regex:/[^A-Za-z0-9]/'
=======
                                    'regex:/[^A-Za-z0-9]/',
>>>>>>> 9831a351 (.)
                                ])
                                ->validationMessages([
                                    'password.regex' => __('user::auth.validation.password.complexity'),
                                ])
                                ->autocomplete('new-password')
                                ->validationAttribute(__('user::auth.fields.password'))
                                ->helperText(__('user::auth.help.password'))
                                ->confirmed(),
<<<<<<< HEAD
                            
=======

>>>>>>> 9831a351 (.)
                            'password_confirmation' => TextInput::make('password_confirmation')
                                ->label(__('user::auth.fields.password_confirmation'))
                                ->password()
                                ->required()
                                ->string()
                                ->minLength(12)
                                ->maxLength(255)
                                ->autocomplete('new-password')
                                ->validationAttribute(__('user::auth.fields.password_confirmation'))
                                ->dehydrated(false)
                                ->same('password'),
                        ]),
                ]),
        ];
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema($this->getFormSchema())
            ->statePath('data')
            ->operation('create');
    }

    public function submit(): void
    {
        try {
            $validatedData = $this->validateForm();
            $this->logRegistrationAttempt($validatedData);
<<<<<<< HEAD
            
            $user = DB::transaction(function () use ($validatedData) {
                $user = $this->createUser($validatedData);
                $this->afterUserCreated($user);
                return $user;
            });
            
            $this->handleSuccessfulRegistration($user);
            
=======

            $user = DB::transaction(function () use ($validatedData) {
                $user = $this->createUser($validatedData);
                $this->afterUserCreated($user);

                return $user;
            });

            $this->handleSuccessfulRegistration($user);

>>>>>>> 9831a351 (.)
        } catch (ValidationException $e) {
            throw $e;
        } catch (\Exception $e) {
            $this->handleRegistrationError($e);
        }
    }

    protected function validateForm(): array
    {
        $data = $this->form->getState();
<<<<<<< HEAD
        
=======

>>>>>>> 9831a351 (.)
        return [
            'first_name' => app(\Modules\Xot\Actions\Cast\SafeStringCastAction::class)->execute($data['first_name']),
            'last_name' => app(\Modules\Xot\Actions\Cast\SafeStringCastAction::class)->execute($data['last_name']),
            'email' => app(\Modules\Xot\Actions\Cast\SafeStringCastAction::class)->execute($data['email']),
            'password' => Hash::make(app(\Modules\Xot\Actions\Cast\SafeStringCastAction::class)->execute($data['password'])),
            'type' => 'standard',
            'state' => 'pending',
            'email_verified_at' => null,
        ];
    }

    protected function logRegistrationAttempt(array $data): void
    {
        $email = app(\Modules\Xot\Actions\Cast\SafeStringCastAction::class)->execute($data['email']);
        Log::info('Registration attempt', [
            'email_hash' => hash('sha256', $email),
            'ip' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);
    }

    protected function createUser(array $data): User
    {
        return User::create($data);
    }

    protected function afterUserCreated(User $user): void
    {
        activity()
            ->causedBy($user)
            ->performedOn($user)
            ->withProperties([
                'type' => $user->type,
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent(),
            ])
            ->log('User registered via RegisterWidget');
    }

    protected function handleSuccessfulRegistration(User $user): void
    {
        if (config('auth.must_verify_email')) {
            $user->sendEmailVerificationNotification();
        }

        Auth::login($user);
<<<<<<< HEAD
        
=======

>>>>>>> 9831a351 (.)
        Notification::make()
            ->title(__('user::auth.registration.success'))
            ->success()
            ->send();
<<<<<<< HEAD
            
=======

>>>>>>> 9831a351 (.)
        $this->redirect(route('dashboard'));
    }

    protected function handleRegistrationError(\Exception $e): void
    {
<<<<<<< HEAD
        Log::error('Registration failed: ' . $e->getMessage(), [
=======
        Log::error('Registration failed: '.$e->getMessage(), [
>>>>>>> 9831a351 (.)
            'exception' => $e,
            'trace' => $e->getTraceAsString(),
            'ip' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);

        throw new \RuntimeException(__('user::auth.registration.error_occurred'));
    }
}
