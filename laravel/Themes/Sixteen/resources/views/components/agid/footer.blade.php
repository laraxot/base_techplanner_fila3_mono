{{-- Footer AGID Standardizzato --}}
<footer 
    role="contentinfo" 
    class="agid-footer bg-gray-900 text-white py-12 mt-16"
    aria-labelledby="footer-heading"
>
    <div class="container mx-auto px-4">
        <h2 id="footer-heading" class="sr-only">Piè di pagina</h2>
        
        {{-- Main Footer Content --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-8">
            
            {{-- Institution Info --}}
            <div class="agid-footer-section">
                <h3 class="text-lg font-semibold mb-4 text-blue-300">{{ config('app.institution_name', 'Ente di appartenenza') }}</h3>
                <div class="space-y-2 text-gray-300">
                    <p class="flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                        </svg>
                        {{ config('app.institution_address', 'Indirizzo non configurato') }}
                    </p>
                    <p class="flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                        </svg>
                        {{ config('app.institution_phone', 'Telefono non configurato') }}
                    </p>
                    <p class="flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                        </svg>
                        <a href="mailto:{{ config('app.institution_email', 'info@example.com') }}" class="hover:text-blue-300 transition-colors">
                            {{ config('app.institution_email', 'info@example.com') }}
                        </a>
                    </p>
                    <p class="flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                        </svg>
                        Orari: {{ config('app.institution_hours', 'Lun-Ven 9:00-13:00, 14:30-17:30') }}
                    </p>
                </div>
            </div>

            {{-- Servizi --}}
            <div class="agid-footer-section">
                <h3 class="text-lg font-semibold mb-4 text-blue-300">Servizi</h3>
                <ul class="space-y-2">
                    <li><a href="{{ route('suap.index') }}" class="text-gray-300 hover:text-blue-300 transition-colors">SUAP - Sportello Unico</a></li>
                    <li><a href="{{ route('anagrafe.index') }}" class="text-gray-300 hover:text-blue-300 transition-colors">Anagrafe e Stato Civile</a></li>
                    <li><a href="{{ route('tributi.index') }}" class="text-gray-300 hover:text-blue-300 transition-colors">Tributi e Imposte</a></li>
                    <li><a href="{{ route('servizi.sociali') }}" class="text-gray-300 hover:text-blue-300 transition-colors">Servizi Sociali</a></li>
                    <li><a href="{{ route('urp.index') }}" class="text-gray-300 hover:text-blue-300 transition-colors">URP - Ufficio Relazioni</a></li>
                </ul>
            </div>

            {{-- Amministrazione Trasparente --}}
            <div class="agid-footer-section">
                <h3 class="text-lg font-semibold mb-4 text-blue-300">Amministrazione</h3>
                <ul class="space-y-2">
                    <li><a href="{{ route('pages.view', ['slug' => 'amministrazione-trasparente']) }}" class="text-gray-300 hover:text-blue-300 transition-colors">Amministrazione Trasparente</a></li>
                    <li><a href="{{ route('pages.view', ['slug' => 'bandi-gare']) }}" class="text-gray-300 hover:text-blue-300 transition-colors">Bandi e Gare</a></li>
                    <li><a href="{{ route('pages.view', ['slug' => 'documenti-amministrativi']) }}" class="text-gray-300 hover:text-blue-300 transition-colors">Documenti Amministrativi</a></li>
                    <li><a href="{{ route('pages.view', ['slug' => 'organizzazione']) }}" class="text-gray-300 hover:text-blue-300 transition-colors">Organizzazione</a></li>
                    <li><a href="{{ route('pages.view', ['slug' => 'performance']) }}" class="text-gray-300 hover:text-blue-300 transition-colors">Performance</a></li>
                </ul>
            </div>

            {{-- Contatti e Supporto --}}
            <div class="agid-footer-section">
                <h3 class="text-lg font-semibold mb-4 text-blue-300">Contatti</h3>
                <ul class="space-y-2">
                    <li><a href="{{ route('pages.view', ['slug' => 'contatti']) }}" class="text-gray-300 hover:text-blue-300 transition-colors">Contatti</a></li>
                    <li><a href="{{ route('pages.view', ['slug' => 'urp']) }}" class="text-gray-300 hover:text-blue-300 transition-colors">URP - Ufficio Relazioni</a></li>
                    <li><a href="{{ route('pages.view', ['slug' => 'segnalazioni']) }}" class="text-gray-300 hover:text-blue-300 transition-colors">Segnalazioni</a></li>
                    <li><a href="{{ route('pages.view', ['slug' => 'faq']) }}" class="text-gray-300 hover:text-blue-300 transition-colors">FAQ</a></li>
                    <li><a href="{{ route('pages.view', ['slug' => 'assistenza']) }}" class="text-gray-300 hover:text-blue-300 transition-colors">Assistenza Tecnica</a></li>
                </ul>
            </div>
        </div>

        {{-- Legal and Institutional Links --}}
        <div class="border-t border-gray-700 pt-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
                
                {{-- Legal Links --}}
                <div class="agid-legal-links">
                    <h4 class="font-semibold mb-3 text-blue-300">Informazioni Legali</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('pages.view', ['slug' => 'privacy-policy']) }}" class="text-gray-400 hover:text-blue-300 transition-colors">Privacy Policy</a></li>
                        <li><a href="{{ route('pages.view', ['slug' => 'cookie-policy']) }}" class="text-gray-400 hover:text-blue-300 transition-colors">Cookie Policy</a></li>
                        <li><a href="{{ route('pages.view', ['slug' => 'termini-condizioni']) }}" class="text-gray-400 hover:text-blue-300 transition-colors">Termini e Condizioni</a></li>
                        <li><a href="{{ route('pages.view', ['slug' => 'note-legali']) }}" class="text-gray-400 hover:text-blue-300 transition-colors">Note Legali</a></li>
                    </ul>
                </div>

                {{-- Accessibility Links --}}
                <div class="agid-accessibility-links">
                    <h4 class="font-semibold mb-3 text-blue-300">Accessibilità</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('pages.view', ['slug' => 'dichiarazione-accessibilita']) }}" class="text-gray-400 hover:text-blue-300 transition-colors">Dichiarazione di Accessibilità</a></li>
                        <li><a href="{{ route('pages.view', ['slug' => 'linee-guida-accessibilita']) }}" class="text-gray-400 hover:text-blue-300 transition-colors">Linee Guida Accessibilità</a></li>
                        <li><a href="{{ route('pages.view', ['slug' => 'contrasto-elevato']) }}" class="text-gray-400 hover:text-blue-300 transition-colors">Modalità Alto Contrasto</a></li>
                        <li><a href="{{ route('pages.view', ['slug' => 'dimensione-testo']) }}" class="text-gray-400 hover:text-blue-300 transition-colors">Dimensione Testo</a></li>
                    </ul>
                </div>

                {{-- Institutional Links --}}
                <div class="agid-institutional-links">
                    <h4 class="font-semibold mb-3 text-blue-300">Collegamenti Istituzionali</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="https://www.agid.gov.it" target="_blank" rel="noopener noreferrer" class="text-gray-400 hover:text-blue-300 transition-colors">AgID - Agenzia per l'Italia Digitale</a></li>
                        <li><a href="https://www.italia.it" target="_blank" rel="noopener noreferrer" class="text-gray-400 hover:text-blue-300 transition-colors">Italia.it</a></li>
                        <li><a href="https://www.governo.it" target="_blank" rel="noopener noreferrer" class="text-gray-400 hover:text-blue-300 transition-colors">Governo Italiano</a></li>
                        <li><a href="https://www.gazzettaufficiale.it" target="_blank" rel="noopener noreferrer" class="text-gray-400 hover:text-blue-300 transition-colors">Gazzetta Ufficiale</a></li>
                    </ul>
                </div>
            </div>

            {{-- Social Media --}}
            <div class="border-t border-gray-700 pt-6">
                <h4 class="font-semibold mb-4 text-center text-blue-300">Seguici sui social</h4>
                <div class="flex justify-center space-x-4">
                    <a href="{{ config('app.social_facebook', '#') }}" target="_blank" rel="noopener noreferrer" class="social-link" aria-label="Facebook">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                        </svg>
                    </a>
                    <a href="{{ config('app.social_twitter', '#') }}" target="_blank" rel="noopener noreferrer" class="social-link" aria-label="Twitter">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                        </svg>
                    </a>
                    <a href="{{ config('app.social_instagram', '#') }}" target="_blank" rel="noopener noreferrer" class="social-link" aria-label="Instagram">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 6.618 5.367 11.986 11.988 11.986s11.987-5.368 11.987-11.986C24.014 5.367 18.635.001 12.017.001zM8.449 16.988c-1.297 0-2.448-.49-3.323-1.297C4.198 14.895 3.7 13.679 3.7 12.316s.498-2.579 1.426-3.375c.875-.807 2.026-1.297 3.323-1.297s2.448.49 3.323 1.297c.928.796 1.426 2.012 1.426 3.375s-.498 2.579-1.426 3.375c-.875.807-2.026 1.297-3.323 1.297zm7.718 1.631c-.033.033-.066.066-.099.099-.165.132-.363.198-.562.198-.198 0-.396-.066-.562-.198-.033-.033-.066-.066-.099-.099-.132-.165-.198-.363-.198-.562 0-.198.066-.396.198-.562.033-.033.066-.066.099-.099.165-.132.363-.198.562-.198.198 0 .396.066.562.198.033.033.066.066.099.099.132.165.198.363.198.562 0 .198-.066.396-.198.562zm1.591-4.711c0 .993-.231 1.925-.627 2.744-.396.825-.924 1.518-1.587 2.079-.66.561-1.419.99-2.277 1.254-.825.264-1.716.396-2.646.396s-1.821-.132-2.646-.396c-.858-.264-1.617-.693-2.277-1.254-.663-.561-1.191-1.254-1.587-2.079-.396-.819-.627-1.751-.627-2.744s.231-1.925.627-2.744c.396-.825.924-1.518 1.587-2.079.66-.561 1.419-.99 2.277-1.254.825-.264 1.716-.396 2.646-.396s1.821.132 2.646.396c.858.264 1.617.693 2.277 1.254.663.561 1.191 1.254 1.587 2.079.396.819.627 1.751.627 2.744z"/>
                        </svg>
                    </a>
                    <a href="{{ config('app.social_linkedin', '#') }}" target="_blank" rel="noopener noreferrer" class="social-link" aria-label="LinkedIn">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                        </svg>
                    </a>
                </div>
            </div>

            {{-- Copyright and Credits --}}
            <div class="border-t border-gray-700 pt-6 text-center">
                <p class="text-gray-400 text-sm mb-2">
                    &copy; {{ date('Y') }} {{ config('app.institution_name', 'Ente di appartenenza') }}. 
                    Tutti i diritti riservati.
                </p>
                <p class="text-gray-400 text-xs">
                    P.IVA: {{ config('app.institution_vat', '00000000000') }} | 
                    C.F.: {{ config('app.institution_fiscal_code', '00000000000') }}
                </p>
                <p class="text-gray-400 text-xs mt-2">
                    Questo sito è conforme alle 
                    <a href="https://www.agid.gov.it/it/design-servizi/linee-guida" 
                       target="_blank" 
                       rel="noopener noreferrer"
                       class="text-blue-300 hover:text-white transition-colors">
                        linee guida AGID
                    </a>
                    e realizzato con 
                    <a href="https://laravel.com" 
                       target="_blank" 
                       rel="noopener noreferrer"
                       class="text-blue-300 hover:text-white transition-colors">
                        Laravel
                    </a>
                </p>
            </div>
        </div>
    </div>
</footer>

<style>
.agid-footer {
    font-size: 16px;
    line-height: 1.6;
}

.agid-footer-section h3 {
    font-size: 18px;
    margin-bottom: 1rem;
}

.agid-footer a {
    text-decoration: none;
    min-height: 44px;
    display: inline-flex;
    align-items: center;
}

.agid-footer a:focus {
    outline: 2px solid #0066CC;
    outline-offset: 2px;
}

.social-link {
    padding: 8px;
    border-radius: 6px;
    background: rgba(255, 255, 255, 0.1);
    transition: all 0.3s ease;
}

.social-link:hover {
    background: rgba(255, 255, 255, 0.2);
    transform: translateY(-2px);
}

.social-link:focus {
    outline: 2px solid #0066CC;
    outline-offset: 2px;
}

/* High contrast mode */
@media (prefers-contrast: high) {
    .agid-footer {
        border-top: 3px solid white;
    }
    
    .agid-footer a {
        border-bottom: 1px solid white;
    }
}

/* Reduced motion */
@media (prefers-reduced-motion: reduce) {
    .agid-footer a,
    .social-link {
        transition: none;
    }
    
    .social-link:hover {
        transform: none;
    }
}

/* Mobile optimization */
@media (max-width: 768px) {
    .agid-footer {
        padding: 2rem 1rem;
    }
    
    .agid-footer-section {
        margin-bottom: 2rem;
    }
}
</style>