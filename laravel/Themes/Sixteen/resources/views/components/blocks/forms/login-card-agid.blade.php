@props([
    'title' => 'Accedi ai servizi',
    'subtitle' => 'Utilizza le tue credenziali per accedere all\'area riservata',
    'livewireComponent' => '\Modules\User\Http\Livewire\Auth\Login'
])

<div class="max-w-md mx-auto">
    <!-- Card Login AGID -->
    <div class="bg-white rounded-lg shadow-lg border border-gray-200 overflow-hidden">
        <!-- Header Card con Colori AGID -->
        <div class="bg-blue-600 text-white px-6 py-4">
            <h1 class="text-2xl font-bold mb-2">{{ $title }}</h1>
            <p class="text-blue-100 text-sm">{{ $subtitle }}</p>
        </div>
        
        <!-- Body Card -->
        <div class="px-6 py-8">
            <!-- Livewire Login Component (OBBLIGATORIO - NON MODIFICARE) -->
            @livewire($livewireComponent)
        </div>
        
        <!-- Footer Card con Info Assistenza -->
        <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
            <div class="text-center text-sm text-gray-600">
                <p class="mb-2">
                    <strong>Problemi di accesso?</strong>
                </p>
                <p>
                    Contatta l'assistenza tecnica al numero 
                    <a href="tel:+390123456789" class="text-blue-600 hover:text-blue-800 font-semibold underline">
                        01 2345 6789
                    </a>
                </p>
            </div>
        </div>
    </div>
    
    <!-- Info Accessibilità AGID -->
    <div class="mt-6 text-center text-sm text-gray-600">
        <p class="mb-2">
            <strong>Accessibilità:</strong> Questo servizio è conforme alle linee guida WCAG 2.1 AA.
        </p>
        <p>
            <a href="{{ route('pages.view', ['slug' => 'accessibility']) }}" 
               class="text-blue-600 hover:text-blue-800 underline">
                Dichiarazione di accessibilità
            </a>
        </p>
        <p class="mt-2 text-xs">
            <strong>Navigazione da tastiera:</strong> Usa Tab per navigare tra i campi e Invio per inviare il modulo.
        </p>
    </div>
</div>
