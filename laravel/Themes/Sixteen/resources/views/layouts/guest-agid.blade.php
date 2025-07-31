<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>{{ $title ?? 'Accesso' }} - {{ config('app.name') }}</title>
    
    <!-- Fonts AGID - Titillium Web -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Titillium+Web:wght@300;400;600;700&display=swap" rel="stylesheet">
    
    <!-- Favicon PA -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    
    <!-- Meta AGID per SEO e Accessibilità -->
    <meta name="description" content="Accesso sicuro ai servizi digitali di {{ config('app.name') }}">
    <meta name="robots" content="noindex, nofollow">
    <meta name="theme-color" content="#0066CC">
    
    <!-- Scripts con tema specificato -->
    @vite(['resources/css/app.css', 'resources/js/app.js'], 'themes/Sixteen')
    @livewireStyles
    
    <!-- CSS Custom AGID -->
    <style>
        :root {
            --primary-blue: #0066CC;
            --primary-dark: #004080;
            --primary-light: #CCE6FF;
            --secondary-grey: #5A6772;
            --light-grey: #F5F5F5;
        }
        
        body {
            font-family: 'Titillium Web', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }
        
        .bg-primary-blue { background-color: var(--primary-blue); }
        .bg-primary-dark { background-color: var(--primary-dark); }
        .bg-light-grey { background-color: var(--light-grey); }
        .text-primary-blue { color: var(--primary-blue); }
        .text-primary-dark { color: var(--primary-dark); }
        .text-secondary-grey { color: var(--secondary-grey); }
        
        .skip-link {
            position: absolute;
            top: -40px;
            left: 6px;
            background: var(--primary-blue);
            color: white;
            padding: 8px;
            text-decoration: none;
            border-radius: 4px;
            z-index: 1000;
        }
        
        .skip-link:focus {
            top: 6px;
        }
    </style>
</head>
<body class="antialiased bg-white">
    <!-- Skip Links per Accessibilità WCAG 2.1 AA -->
    <a href="#main-content" class="skip-link">
        Salta al contenuto principale
    </a>
    <a href="#footer" class="skip-link">
        Salta al footer
    </a>
    
    <!-- Header Slim AGID -->
    <x-pub_theme::blocks.navigation.header-slim 
        :ente="config('app.name')"
        :links="[
            ['url' => route('pages.view', ['slug' => 'contacts']), 'text' => 'Contatti'],
            ['url' => route('pages.view', ['slug' => 'help']), 'text' => 'Assistenza']
        ]"
    />
    
    <!-- Header Main AGID -->
    <x-pub_theme::blocks.navigation.header-main 
        :logo="asset('images/logo-pa.svg')"
        :ente="config('app.name')"
        :tagline="config('app.tagline', 'Servizi digitali per i cittadini')"
    />
    
    <!-- Breadcrumb AGID -->
    <x-pub_theme::blocks.navigation.breadcrumb-agid 
        :items="[
            ['url' => route('home'), 'text' => 'Home'],
            ['text' => 'Accesso']
        ]"
    />
    
    <!-- Main Content Area -->
    <main id="main-content" role="main" class="min-h-screen bg-light-grey py-12">
        <div class="container mx-auto px-4">
            <!-- Contenuto della pagina -->
            {{ $slot }}
        </div>
    </main>
    
    <!-- Footer Istituzionale AGID -->
    <footer id="footer" role="contentinfo">
        <x-pub_theme::blocks.navigation.footer-institutional 
            :ente="config('app.name')"
            :links="[
                ['url' => route('pages.view', ['slug' => 'privacy']), 'text' => 'Privacy'],
                ['url' => route('pages.view', ['slug' => 'accessibility']), 'text' => 'Accessibilità'],
                ['url' => route('pages.view', ['slug' => 'legal-notes']), 'text' => 'Note legali'],
                ['url' => route('pages.view', ['slug' => 'help']), 'text' => 'Assistenza']
            ]"
        />
    </footer>
    
    @livewireScripts
    
    <!-- Focus Management Script per Accessibilità -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Focus sul primo input del form
            const firstInput = document.querySelector('input[type="email"], input[type="text"]');
            if (firstInput) {
                firstInput.focus();
            }
            
            // Gestione form submission per feedback utente
            const form = document.querySelector('form');
            if (form) {
                form.addEventListener('submit', function() {
                    const submitButton = form.querySelector('button[type="submit"]');
                    if (submitButton) {
                        submitButton.setAttribute('aria-busy', 'true');
                        submitButton.disabled = true;
                        submitButton.innerHTML = 'Accesso in corso...';
                    }
                });
            }
            
            // Gestione errori per screen reader
            const errorMessages = document.querySelectorAll('.error-message');
            errorMessages.forEach(function(error) {
                error.setAttribute('role', 'alert');
                error.setAttribute('aria-live', 'polite');
            });
        });
    </script>
</body>
</html>
