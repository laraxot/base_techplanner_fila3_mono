<?php

<<<<<<< HEAD
declare(strict_types=1);

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use function Laravel\Folio\{middleware, name};
use function Livewire\Volt\{state, rules};
=======
use App\Models\User;
use Illuminate\Auth\Events\Login;
use function Laravel\Folio\{middleware, name};
use Livewire\Attributes\Validate;
use Livewire\Volt\Component;
>>>>>>> 1b374b6 (.)

middleware(['guest']);
name('login');

<<<<<<< HEAD
state([
    'email' => '',
    'password' => '',
    'remember' => false,
]);

rules([
    'email' => ['required', 'email'],
    'password' => ['required'],
]);

$authenticate = function() {
    $this->validate();

    if (!Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
        $this->addError('email', __('auth.failed'));
        return;
    }

    // Laravel gestirà automaticamente l'evento Login
    return redirect()->intended(route('home'));
=======
new class extends Component
{
    #[Validate('required|email')]
    public $email = '';

    #[Validate('required')]
    public $password = '';

    public $remember = false;

    public function authenticate()
    {
        $this->validate();

        if (!Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            $this->addError('email', trans('auth.failed'));

            return;
        }

        event(new Login(auth()->guard('web'), User::where('email', $this->email)->first(), $this->remember));

        return redirect()->intended('/');
    }
>>>>>>> 1b374b6 (.)
};

?>

<x-layouts.main>
<<<<<<< HEAD
    <div class="flex flex-col items-stretch justify-center w-full min-h-screen py-10 sm:items-center">
        <div class="mx-auto w-full max-w-md">
            <a href="{{ route('home') }}" class="block text-center">
                <x-filament::icon name="heroicon-o-home" class="w-auto h-10 mx-auto text-primary-600" />
            </a>

            <h2 class="mt-5 text-2xl font-extrabold leading-9 text-center text-gray-900 dark:text-white">
                {{ __('auth.login.title') }}
            </h2>
            <div class="text-sm leading-5 text-center text-gray-600 dark:text-gray-400 space-x-0.5">
                <span>{{ __('auth.login.or') }}</span>
                <a href="{{ route('register') }}" class="text-primary-600 hover:text-primary-500 font-medium">
                    {{ __('auth.login.create_account') }}
                </a>
            </div>
        </div>

        <div class="mt-8 mx-auto w-full max-w-md">
            <div class="px-10 py-8 bg-white dark:bg-gray-800 rounded-lg shadow-lg">
                @volt('auth.login')
                <form wire:submit="authenticate" class="space-y-6">
                    <x-ui.input
                        label="{{ __('auth.login.email') }}"
                        type="email"
                        id="email"
                        name="email"
                        wire:model="email"
                        required
                        autocomplete="email"
                    />

                    <x-ui.input
                        label="{{ __('auth.login.password') }}"
                        type="password"
                        id="password"
                        name="password"
                        wire:model="password"
                        required
                        autocomplete="current-password"
                    />

                    <div class="flex items-center justify-between mt-6 text-sm leading-5">
                        <x-ui.checkbox
                            label="{{ __('auth.login.remember_me') }}"
                            id="remember"
                            name="remember"
                            wire:model="remember"
                        />

                        <a href="{{ route('password.request') }}" class="text-primary-600 hover:text-primary-500 font-medium">
                            {{ __('auth.login.forgot_password') }}
                        </a>
                    </div>

                    <x-ui.button type="primary" rounded="md" submit="true" class="w-full">
                        {{ __('auth.login.submit') }}
                    </x-ui.button>
=======

    <div class="flex flex-col items-stretch justify-center w-screen min-h-screen py-10 sm:items-center">

        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <x-ui.link href="{{ route('home') }}">
                <x-ui.logo class="w-auto h-10 mx-auto text-gray-700 fill-current dark:text-gray-100" />
            </x-ui.link>

            <h2 class="mt-5 text-2xl font-extrabold leading-9 text-center text-gray-800 dark:text-gray-200">Sign in to
                your account</h2>
            <div class="text-sm leading-5 text-center text-gray-600 dark:text-gray-400 space-x-0.5">
                <span>Or</span>
                <x-ui.text-link href="{{ route('register') }}">create a new account</x-ui.text-link>
            </div>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="px-10 py-0 sm:py-8 sm:shadow-sm sm:bg-white dark:sm:bg-gray-950/50 dark:border-gray-200/10 sm:border sm:rounded-lg border-gray-200/60">
                @volt('auth.login')
                <form wire:submit="authenticate" class="space-y-6">

                    <x-ui.input label="Email address" type="email" id="email" name="email" wire:model="email" />
                    <x-ui.input label="Password" type="password" id="password" name="password" wire:model="password" />

                    <div class="flex items-center justify-between mt-6 text-sm leading-5">
                        <x-ui.checkbox label="Remember me" id="remember" name="remember" wire:model="remember" />
                        <x-ui.text-link href="{{ route('password.request') }}">Forgot your password?</x-ui.text-link>
                    </div>

                    <x-ui.button type="primary" rounded="md" submit="true">Sign in</x-ui.button>
>>>>>>> 1b374b6 (.)
                </form>
                @endvolt
            </div>
        </div>
<<<<<<< HEAD
    </div>
</x-layouts.main>
=======

    </div>

</x-layouts.main>
>>>>>>> 1b374b6 (.)
