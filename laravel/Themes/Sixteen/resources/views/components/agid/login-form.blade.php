<div class="max-w-md mx-auto">
    <!-- Form Header -->
    <div class="text-center mb-8">
        <h1 class="text-2xl font-bold text-gray-900 mb-2">
            {{ __('auth.login.title') }}
        </h1>
        <p class="text-gray-600">
            {{ __('auth.login.description') }}
        </p>
    </div>
    
    <!-- Login Form Card -->
    <div class="bg-white rounded-lg shadow-lg border border-gray-200 overflow-hidden">
        <!-- Card Header -->
        <div class="bg-blue-50 px-6 py-4 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-900 flex items-center">
                <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                </svg>
                Accedi al servizio
            </h2>
            <p class="text-sm text-gray-600 mt-1">
                Inserisci le tue credenziali per accedere
            </p>
        </div>
        
        <!-- Form Body -->
        <div class="px-6 py-6">
            <!-- MANDATORY: Use Livewire Component -->
            @livewire(\Modules\User\Http\Livewire\Auth\Login::class)
        </div>
        
        <!-- Card Footer -->
        <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
            <div class="text-sm text-gray-600 space-y-3">
                <!-- Security Notice -->
                <div class="flex items-start space-x-2">
                    <svg class="w-5 h-5 text-green-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                    </svg>
                    <div>
                        <p class="font-medium text-gray-900">Sicurezza garantita</p>
                        <p class="text-xs">I tuoi dati sono protetti con crittografia SSL/TLS</p>
                    </div>
                </div>
                
                <!-- Help Link -->
                <div class="flex items-start space-x-2">
                    <svg class="w-5 h-5 text-blue-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <div>
                        <a href="{{ route('pages.view', ['slug' => 'help']) }}" 
                           class="font-medium text-blue-600 hover:text-blue-800 hover:underline focus:outline-none focus:underline focus:ring-2 focus:ring-blue-600 focus:ring-offset-1 rounded px-1">
                            Hai bisogno di aiuto?
                        </a>
                        <p class="text-xs">Consulta la guida o contatta il supporto</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Registration Link (if enabled) -->
    @if (Route::has('register'))
        <div class="text-center mt-6 p-4 bg-blue-50 rounded-lg border border-blue-200">
            <p class="text-sm text-gray-700 mb-2">
                <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                </svg>
                Non hai ancora un account?
            </p>
            <a href="{{ route('register') }}" 
               class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-offset-2 transition-colors">
                {{ __('auth.login.create_account') }}
                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                </svg>
            </a>
        </div>
    @endif
</div>
