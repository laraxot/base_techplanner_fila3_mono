<?php
<<<<<<< HEAD
declare(strict_types=1);
use Modules\Patient\Models\User;
=======

use App\Models\User;
>>>>>>> 1b374b6 (.)
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Livewire\Volt\Component;
<<<<<<< HEAD
=======
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Wizard\Step;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Form;
use Illuminate\Support\HtmlString;
use Livewire\Attributes\Validate;
>>>>>>> 1b374b6 (.)
use function Laravel\Folio\{middleware, name};

middleware(['guest']);
name('register');

new class extends Component
{
<<<<<<< HEAD
    public array $types = [];

    public function mount(): void
    {
        $this->types = (new User())->getChildTypes();
    }
};
?>

<x-layouts.app>
    @volt('register')
    <div class="register-container">
        <div class="min-h-screen bg-gradient-to-b from-blue-50 to-white py-12">
=======
    #[Validate('required')]
    public $name = '';

    #[Validate('required|email|unique:users')]
    public $email = '';

    #[Validate('required|min:8|same:passwordConfirmation')]
    public $password = '';

    #[Validate('required|min:8|same:password')]
    public $passwordConfirmation = '';

    public function register()
    {
        $this->validate();

        $user = User::create([
            'email' => $this->email,
            'name' => $this->name,
            'password' => Hash::make($this->password),
        ]);

        event(new Registered($user));

        Auth::login($user, true);

        return redirect()->intended('/');
    }
};

?>

<x-layouts.app>
    <div class="min-h-screen bg-gradient-to-b from-blue-50 to-white py-12">
        <div class="max-w-lg mx-auto px-6">
>>>>>>> 1b374b6 (.)
            <!-- Logo e intestazione -->
            <div class="text-center mb-8">
                <div class="flex justify-center mb-4">
                    <x-ui.logo class="h-12 text-blue-900" />
                </div>
                <h1 class="text-3xl font-light text-blue-900">Benvenuto in <span class="font-bold">SaluteOra</span></h1>
<<<<<<< HEAD
                <p class="text-gray-600 mt-2">Crea il tuo account per accedere a tutti i servizi4</p>
=======
                <p class="text-gray-600 mt-2">Crea il tuo account per accedere a tutti i servizi</p>
>>>>>>> 1b374b6 (.)
            </div>

            <!-- Card contenente il form di registrazione -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
<<<<<<< HEAD
                @foreach($types as $type => $class)
                    <x-filament::button size="sm" href="{{ route('register.type', ['type'=>$type]) }}" tag="a">
                        {{ ucfirst($type) }}
                    </x-filament::button>
                @endforeach
            </div>
        </div>

        <div class="mt-8 text-center text-sm text-gray-500">
            <p>Hai bisogno di assistenza? <a href="#" class="text-blue-800 hover:underline">Contattaci</a></p>
        </div>
    </div>
    @endvolt
=======
                <!-- Intestazione card -->
                <div class="bg-blue-900 px-6 py-4">
                    <h2 class="text-xl font-medium text-white flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                        </svg>
                        Registrazione
                    </h2>
                </div>

                <!-- Form di registrazione -->
                <div class="p-6">
                    @livewire(\Modules\User\Filament\Widgets\RegistrationWidget::class)
                </div>
            </div>

            <!-- Footer con informazioni aggiuntive -->
            <div class="mt-8 text-center text-sm text-gray-500">
                <p>Hai bisogno di assistenza? <a href="#" class="text-blue-800 hover:underline">Contattaci</a></p>
            </div>
        </div>
    </div>
>>>>>>> 1b374b6 (.)
</x-layouts.app>
