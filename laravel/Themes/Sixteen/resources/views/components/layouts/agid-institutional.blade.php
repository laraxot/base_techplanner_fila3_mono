<!DOCTYPE html>
<html lang="it" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- AGID Required Meta Tags -->
    <meta name="description" content="{{ $description ?? 'Servizio digitale della Pubblica Amministrazione' }}">
    <meta name="keywords" content="{{ $keywords ?? 'PA, servizi digitali, AGID' }}">
    <meta name="author" content="{{ config('app.institution_name') }}">
    
    <!-- Open Graph AGID -->
    <meta property="og:title" content="{{ $title ?? config('app.name') }}">
    <meta property="og:description" content="{{ $description ?? 'Servizio digitale AGID-compliant' }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    
    <title>{{ $title ?? config('app.name') }} - {{ config('app.institution_name') }}</title>
    
    <!-- AGID Fonts: Titillium Web -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Titillium+Web:ital,wght@0,200;0,300;0,400;0,600;0,700;0,900;1,200;1,300;1,400;1,600;1,700&display=swap" rel="stylesheet">
    
    <!-- AGID CSS Framework + Custom -->
    @vite(['resources/css/app.css', 'resources/css/agid.css', 'resources/js/app.js', 'resources/js/agid.js'], 'themes/Sixteen')
    
    <!-- Skip Links for Screen Readers -->
    <style>
        .skip-link {
            position: absolute;
            top: -40px;
            left: 6px;
            background: #0066CC;
            color: white;
            padding: 8px;
            text-decoration: none;
            z-index: 1000;
            border-radius: 0 0 4px 4px;
            font-weight: 600;
        }
        .skip-link:focus {
            top: 0;
        }
        
        /* AGID Typography */
        .font-titillium {
            font-family: 'Titillium Web', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }
        
        /* AGID Color Variables */
        :root {
            --agid-blue-primary: #0066CC;
            --agid-blue-secondary: #004080;
            --agid-blue-light: #E6F2FF;
            --agid-gray-dark: #5C6F82;
            --agid-gray-medium: #A5B3C1;
            --agid-gray-light: #F0F6FC;
            --agid-green: #00A040;
            --agid-red: #D73527;
            --agid-orange: #FF9900;
        }
    </style>
</head>
<body class="font-titillium antialiased bg-gray-50 h-full flex flex-col">
    <!-- Skip Navigation Links -->
    <div class="sr-only focus-within:not-sr-only">
        <a href="#main-content" class="skip-link">Salta al contenuto principale</a>
        <a href="#main-navigation" class="skip-link">Salta alla navigazione</a>
        <a href="#footer" class="skip-link">Salta al footer</a>
    </div>
    
    <!-- AGID Institutional Header -->
    <x-agid.header-institutional />
    
    <!-- AGID Breadcrumb Navigation -->
    @if(isset($breadcrumb) && !empty($breadcrumb))
        <x-agid.breadcrumb :items="$breadcrumb" />
    @endif
    
    <!-- Main Content Area -->
    <main id="main-content" role="main" class="flex-1">
        {{ $slot }}
    </main>
    
    <!-- AGID Institutional Footer -->
    <x-agid.footer-institutional />
    
    <!-- AGID Accessibility Scripts -->
    <script>
        // Focus management and keyboard navigation
        document.addEventListener('DOMContentLoaded', function() {
            // Enhanced focus management for AGID compliance
            const focusableElements = 'button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])';
            const modal = document.querySelector('[role="dialog"]');
            
            if (modal) {
                const focusableContent = modal.querySelectorAll(focusableElements);
                const firstFocusableElement = focusableContent[0];
                const lastFocusableElement = focusableContent[focusableContent.length - 1];
                
                // Trap focus within modal
                modal.addEventListener('keydown', function(e) {
                    if (e.key === 'Tab') {
                        if (e.shiftKey) {
                            if (document.activeElement === firstFocusableElement) {
                                lastFocusableElement.focus();
                                e.preventDefault();
                            }
                        } else {
                            if (document.activeElement === lastFocusableElement) {
                                firstFocusableElement.focus();
                                e.preventDefault();
                            }
                        }
                    }
                    if (e.key === 'Escape') {
                        modal.close();
                    }
                });
            }
            
            // Auto-focus first input in forms
            const firstInput = document.querySelector('input[type="email"], input[type="text"], input[type="password"]');
            if (firstInput && !firstInput.value) {
                firstInput.focus();
            }
        });
    </script>
</body>
</html>
