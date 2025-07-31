<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>{{ $title ?? 'Accesso' }} - {{ config('app.name', 'Laravel') }}</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    
    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'], 'themes/Sixteen')
    @livewireStyles
    
    <!-- SEO and Accessibility -->
    <meta name="description" content="Accesso sicuro ai servizi digitali dell'ente">
    <meta name="robots" content="noindex, nofollow">
    <link rel="canonical" href="{{ request()->url() }}">
    
    <!-- AGID Compliance -->
    <meta name="theme-color" content="#0066cc">
    <meta name="application-name" content="{{ config('app.name') }}">
</head>
<body class="h-full bg-gray-50 font-sans antialiased">
    <!-- Skip Links for Accessibility -->
    <div class="sr-only focus:not-sr-only">
        <a href="#main-content" 
           class="absolute top-0 left-0 bg-blue-600 text-white px-4 py-2 z-50 focus:relative">
            Salta al contenuto principale
        </a>
        <a href="#login-form" 
           class="absolute top-0 left-0 bg-blue-600 text-white px-4 py-2 z-50 focus:relative">
            Vai al modulo di accesso
        </a>
    </div>

    <!-- Header Slim -->
    <x-pub_theme::blocks.navigation.header-slim 
        :ente-name="config('app.institution_name', 'Ente di appartenenza')"
        :ente-url="config('app.institution_url', '#')"
        background="primary" />
    
    <!-- Header Main -->
    <x-pub_theme::blocks.navigation.header-main 
        :logo-src="asset('images/logo.svg')"
        :logo-alt="config('app.name') . ' - Logo'"
        :ente-name="config('app.name', 'Nome Ente')"
        :service-tagline="config('app.tagline', 'Servizi digitali per i cittadini')"
        :home-url="route('home')"
        position="sticky" />
    
    <!-- Breadcrumb -->
    <x-pub_theme::blocks.navigation.breadcrumb-agid 
        :current-page="$title ?? 'Accesso'"
        :home-url="route('home')"
        background="light" />

    <!-- Main Content -->
    <main id="main-content" role="main" class="flex-1 py-12">
        <div class="container mx-auto px-4">
            <div class="max-w-md mx-auto">
                <!-- Page Header -->
                <div class="text-center mb-8">
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">
                        {{ $title ?? 'Accesso ai servizi' }}
                    </h1>
                    <p class="text-gray-600">
                        {{ $description ?? 'Inserisci le tue credenziali per accedere ai servizi digitali' }}
                    </p>
                </div>

                <!-- Login Form Container -->
                <div id="login-form" 
                     class="bg-white rounded-lg shadow-lg border border-gray-200 overflow-hidden"
                     role="region" 
                     aria-labelledby="login-heading">
                    
                    <!-- Form Header -->
                    <div class="bg-blue-50 px-6 py-4 border-b border-gray-200">
                        <h2 id="login-heading" class="text-lg font-semibold text-gray-900">
                            Accedi con le tue credenziali
                        </h2>
                        <p class="text-sm text-gray-600 mt-1">
                            Utilizza le credenziali fornite dall'amministratore
                        </p>
                    </div>
                    
                    <!-- Form Body -->
                    <div class="px-6 py-6">
                        {{ $slot }}
                    </div>
                    
                    <!-- Form Footer -->
                    <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
                        <div class="text-sm text-gray-600 space-y-2">
                            <p class="flex items-center">
                                <svg class="w-4 h-4 mr-2 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                                </svg>
                                I tuoi dati sono protetti e crittografati
                            </p>
                            <p>
                                <a href="{{ route('help') }}" 
                                   class="text-blue-600 hover:text-blue-800 underline focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 rounded">
                                    Hai bisogno di aiuto?
                                </a>
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Additional Information -->
                <div class="mt-8 text-center text-sm text-gray-600">
                    <p class="mb-2">
                        Questo servizio è conforme alle 
                        <a href="https://www.agid.gov.it/" 
                           target="_blank" 
                           rel="noopener noreferrer"
                           class="text-blue-600 hover:text-blue-800 underline focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 rounded">
                            linee guida AGID
                        </a>
                    </p>
                    <p>
                        Per informazioni sulla privacy consulta la 
                        <a href="{{ route('pages.view', ['slug' => 'privacy']) }}" 
                           class="text-blue-600 hover:text-blue-800 underline focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 rounded">
                            informativa sulla privacy
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <x-pub_theme::blocks.navigation.footer-institutional 
        :logo-src="asset('images/logo-white.svg')"
        :logo-alt="config('app.name') . ' - Logo'"
        :ente-name="config('app.name', 'Nome Ente')"
        :ente-description="config('app.tagline', 'Servizi digitali per i cittadini')"
        background="dark" />

    @livewireScripts
    
    <!-- Focus Management Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Focus management for accessibility
            const firstInput = document.querySelector('input[type="email"], input[type="text"]');
            if (firstInput) {
                firstInput.focus();
            }
            
            // Handle form submission feedback
            const form = document.querySelector('form');
            if (form) {
                form.addEventListener('submit', function() {
                    const submitButton = form.querySelector('button[type="submit"]');
                    if (submitButton) {
                        submitButton.setAttribute('aria-busy', 'true');
                        submitButton.disabled = true;
                    }
                });
            }
        });
    </script>
</body>
</html>
