{{--
/**
 * Login Page AGID-Compliant - Login4 Sistemato
 * 
 * CORREZIONI APPLICATE:
 * - Rimosso @volt (VIETATO per autenticazione)
 * - Aggiunto componente Livewire obbligatorio
 * - Implementato header/footer istituzionali AGID
 * - Rispettate tutte le regole critiche del progetto
 * 
 * @see /Themes/Sixteen/docs/critical-rules.md
 * @see /Themes/Sixteen/docs/sixteen-theme-naming-conventions.md
 */
--}}

<x-layouts.guest>
    {{-- Skip Links per Accessibilità WCAG 2.1 AA --}}
    <x-slot name="skipLinks">
        <a href="#main-content" class="sr-only focus:not-sr-only focus:absolute focus:top-4 focus:left-4 bg-blue-600 text-white px-4 py-2 rounded z-50">
            Salta al contenuto principale
        </a>
        <a href="#login-form" class="sr-only focus:not-sr-only focus:absolute focus:top-4 focus:left-32 bg-blue-600 text-white px-4 py-2 rounded z-50">
            Salta al form di accesso
        </a>
    </x-slot>

    {{-- Header Istituzionale AGID-Compliant --}}
    <x-slot name="header">
        {{-- Header Slim (Ente + Link Istituzionali) --}}
        <x-pub_theme::blocks.navigation.header-slim 
            :enteName="config('app.name', 'Ente Pubblico')"
            :enteUrl="route('home')"
            :showLinks="true"
        />

        {{-- Header Main (Logo + Nome Ente + Tagline) --}}
        <x-pub_theme::blocks.navigation.header-main 
            :logoSrc="asset('themes/Sixteen/images/logo-pa.svg')"
            :enteName="config('app.name', 'Ente Pubblico')"
            :serviceTagline="config('app.tagline', 'Servizi digitali per i cittadini')"
            :homeUrl="route('home')"
        />

        {{-- Breadcrumb Navigation Semantica --}}
        <x-pub_theme::blocks.navigation.breadcrumb 
            :items="[
                ['url' => route('home'), 'title' => 'Home'],
                ['title' => 'Accesso al sistema']
            ]"
        />
    </x-slot>

    {{-- Main Content Area con Struttura Semantica --}}
    <main id="main-content" class="min-h-screen bg-gray-50" role="main">
        <div class="container mx-auto px-4 py-12">
            <div class="max-w-2xl mx-auto">
                
                {{-- Intestazione Pagina AGID --}}
                <header class="text-center mb-12">
                    <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4" style="font-family: 'Titillium Web', sans-serif;">
                        Accesso al Sistema
                    </h1>
                    <p class="text-xl text-gray-600 leading-relaxed max-w-3xl mx-auto">
                        Accedi ai servizi digitali di {{ config('app.name', 'Ente Pubblico') }}
                        utilizzando le tue credenziali
                    </p>
                </header>

                {{-- Login Card AGID-Compliant con Livewire Integration --}}
                <section id="login-form" aria-labelledby="login-heading" class="bg-white rounded-lg shadow-xl overflow-hidden border border-gray-200">
                    
                    {{-- Card Header con Branding Istituzionale --}}
                    <div class="bg-blue-600 px-8 py-6 text-white">
                        <h2 id="login-heading" class="text-2xl font-semibold" style="font-family: 'Titillium Web', sans-serif;">
                            <i class="fas fa-sign-in-alt mr-3" aria-hidden="true"></i>
                            Accesso Riservato
                        </h2>
                        <p class="text-blue-100 text-base mt-2">
                            Area riservata agli utenti autorizzati
                        </p>
                    </div>

                    {{-- Card Body con Form Livewire --}}
                    <div class="px-8 py-10">
                        {{-- 
                            REGOLA CRITICA: Utilizzare SEMPRE il componente Livewire per l'autenticazione
                            NON usare mai @volt - è VIETATO per l'autenticazione
                            @see /Themes/Sixteen/docs/critical-rules.md
                        --}}
                        @livewire(\Modules\User\Http\Livewire\Auth\Login::class)
                    </div>

                    {{-- Card Footer con Info e Link di Supporto --}}
                    <div class="bg-gray-50 px-8 py-6 border-t">
                        <div class="text-center">
                            <p class="text-sm text-gray-600 mb-3">
                                <i class="fas fa-info-circle mr-1 text-blue-500" aria-hidden="true"></i>
                                Hai problemi di accesso?
                            </p>
                            <div class="flex flex-col sm:flex-row gap-2 justify-center text-sm">
                                <a href="{{ route('pages.view', ['slug' => 'help']) }}" 
                                   class="text-blue-600 hover:text-blue-800 underline font-medium">
                                    <i class="fas fa-question-circle mr-1" aria-hidden="true"></i>
                                    Guida all'accesso
                                </a>
                                <span class="hidden sm:inline text-gray-400">|</span>
                                <a href="{{ route('pages.view', ['slug' => 'contacts']) }}" 
                                   class="text-blue-600 hover:text-blue-800 underline font-medium">
                                    <i class="fas fa-envelope mr-1" aria-hidden="true"></i>
                                    Assistenza tecnica
                                </a>
                            </div>
                        </div>
                    </div>

                </section>

                {{-- Sezione Accessibilità e Informazioni Legali --}}
                <aside class="mt-12 text-center" aria-labelledby="accessibility-heading">
                    <h3 id="accessibility-heading" class="sr-only">Informazioni sull'accessibilità</h3>
                    <div class="bg-blue-50 rounded-lg p-6 border border-blue-200">
                        <p class="text-sm text-blue-800 mb-2">
                            <i class="fas fa-universal-access mr-1" aria-hidden="true"></i>
                            <strong>Accessibilità:</strong> Questo sito rispetta le linee guida WCAG 2.1 AA
                        </p>
                        <div class="flex flex-wrap gap-2 justify-center text-xs">
                            <a href="{{ route('pages.view', ['slug' => 'accessibility']) }}" 
                               class="text-blue-600 hover:text-blue-800 underline">
                                Dichiarazione di accessibilità
                            </a>
                            <span class="text-blue-400">•</span>
                            <a href="{{ route('pages.view', ['slug' => 'privacy']) }}" 
                               class="text-blue-600 hover:text-blue-800 underline">
                                Privacy Policy
                            </a>
                            <span class="text-blue-400">•</span>
                            <a href="{{ route('pages.view', ['slug' => 'legal-notes']) }}" 
                               class="text-blue-600 hover:text-blue-800 underline">
                                Note legali
                            </a>
                        </div>
                    </div>
                </aside>

                {{-- Registration Link (se abilitato) --}}
                @if (Route::has('register'))
                    <div class="text-center mt-8">
                        <p class="text-base text-gray-600">
                            Non hai ancora un account?
                            <a href="{{ route('register') }}" 
                               class="text-blue-600 hover:text-blue-800 underline font-medium ml-1 text-lg">
                                Richiedi l'accesso
                            </a>
                        </p>
                    </div>
                @endif

            </div>
        </div>
    </main>

    {{-- Footer Istituzionale AGID-Compliant --}}
    <x-slot name="footer">
        <x-pub_theme::blocks.navigation.footer-institutional 
            :enteName="config('app.name', 'Ente Pubblico')"
            :enteDescription="config('app.tagline', 'Servizi digitali per i cittadini')"
            :logoSrc="asset('themes/Sixteen/images/logo-white.svg')"
            :showLinks="true"
            :customLinks="[
                ['title' => 'Privacy', 'url' => route('pages.view', ['slug' => 'privacy'])],
                ['title' => 'Note legali', 'url' => route('pages.view', ['slug' => 'legal-notes'])],
                ['title' => 'Dichiarazione di accessibilità', 'url' => route('pages.view', ['slug' => 'accessibility'])],
                ['title' => 'Mappa del sito', 'url' => route('pages.view', ['slug' => 'sitemap'])]
            ]"
        />
    </x-slot>

    {{-- Custom Styles per AGID Compliance --}}
    <x-slot name="styles">
        <style>
            /* Import Titillium Web Font (AGID Standard) */
            @import url('https://fonts.googleapis.com/css2?family=Titillium+Web:wght@300;400;600;700&display=swap');
            
            /* AGID Color Palette */
            :root {
                --agid-primary-blue: #0066CC;
                --agid-primary-dark: #004080;
                --agid-primary-light: #CCE6FF;
                --agid-secondary-grey: #5A6772;
                --agid-light-grey: #F5F5F5;
                --agid-success: #008758;
                --agid-warning: #A66300;
                --agid-danger: #D73527;
                --agid-info: #0073E6;
            }
            
            /* Focus Management per Accessibilità */
            *:focus {
                outline: 2px solid var(--agid-primary-blue);
                outline-offset: 2px;
            }
            
            /* Skip Links Styling */
            .sr-only {
                position: absolute;
                width: 1px;
                height: 1px;
                padding: 0;
                margin: -1px;
                overflow: hidden;
                clip: rect(0, 0, 0, 0);
                white-space: nowrap;
                border: 0;
            }
            
            .focus\:not-sr-only:focus {
                position: static;
                width: auto;
                height: auto;
                padding: 0.5rem 1rem;
                margin: 0;
                overflow: visible;
                clip: auto;
                white-space: normal;
            }
            
            /* AGID Typography */
            h1, h2, h3, h4, h5, h6 {
                font-family: 'Titillium Web', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            }
        </style>
    </x-slot>

    {{-- Custom Scripts per Focus Management e Accessibilità --}}
    <x-slot name="scripts">
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Focus Management per Accessibilità
                const skipLinks = document.querySelectorAll('a[href^="#"]');
                skipLinks.forEach(link => {
                    link.addEventListener('click', function(e) {
                        const targetId = this.getAttribute('href').substring(1);
                        const targetElement = document.getElementById(targetId);
                        if (targetElement) {
                            e.preventDefault();
                            targetElement.focus();
                            targetElement.scrollIntoView({ behavior: 'smooth' });
                        }
                    });
                });
                
                // Enhanced Form Validation Feedback
                const form = document.querySelector('#login-form form');
                if (form) {
                    form.addEventListener('submit', function() {
                        const submitButton = form.querySelector('button[type="submit"]');
                        if (submitButton) {
                            submitButton.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Accesso in corso...';
                            submitButton.disabled = true;
                        }
                    });
                }
                
                // Keyboard Navigation Enhancement
                document.addEventListener('keydown', function(e) {
                    // ESC key to close any open modals or return to main content
                    if (e.key === 'Escape') {
                        const mainContent = document.getElementById('main-content');
                        if (mainContent) {
                            mainContent.focus();
                        }
                    }
                });
                
                // Announce page load for screen readers
                const announcement = document.createElement('div');
                announcement.setAttribute('aria-live', 'polite');
                announcement.setAttribute('aria-atomic', 'true');
                announcement.className = 'sr-only';
                announcement.textContent = 'Pagina di accesso caricata. Utilizzare TAB per navigare tra gli elementi.';
                document.body.appendChild(announcement);
                
                // Remove announcement after 3 seconds
                setTimeout(() => {
                    if (announcement.parentNode) {
                        announcement.parentNode.removeChild(announcement);
                    }
                }, 3000);
            });
        </script>
    </x-slot>

</x-layouts.guest> 