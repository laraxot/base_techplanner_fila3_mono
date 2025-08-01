<footer id="footer" role="contentinfo" class="bg-gray-900 text-white mt-auto">
    <!-- Main Footer -->
    <div class="py-12">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Ente Information -->
                <div>
                    <div class="flex items-center space-x-3 mb-4">
                        <x-pub_theme::ui.logo class="h-10 w-auto text-white" />
                        <div>
                            <h3 class="text-lg font-semibold">{{ config('app.institution_name') }}</h3>
                            <p class="text-sm opacity-80">{{ config('app.tagline') }}</p>
                        </div>
                    </div>
                    
                    @if(config('app.institution_address'))
                        <address class="text-sm opacity-80 not-italic">
                            {{ config('app.institution_address') }}<br>
                            @if(config('app.institution_phone'))
                                Tel: {{ config('app.institution_phone') }}<br>
                            @endif
                            @if(config('app.institution_email'))
                                Email: <a href="mailto:{{ config('app.institution_email') }}" 
                                         class="hover:underline focus:underline focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-900 rounded px-1">
                                    {{ config('app.institution_email') }}
                                </a>
                            @endif
                        </address>
                    @endif
                </div>
                
                <!-- Quick Links -->
                <div>
                    <h4 class="text-lg font-semibold mb-4">Link utili</h4>
                    <ul class="space-y-2 text-sm">
                        <li>
                            <a href="{{ route('pages.view', ['slug' => 'privacy']) }}" 
                               class="opacity-80 hover:opacity-100 hover:underline focus:opacity-100 focus:underline focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-900 rounded px-1 transition-opacity">
                                Informativa Privacy
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('pages.view', ['slug' => 'accessibility']) }}" 
                               class="opacity-80 hover:opacity-100 hover:underline focus:opacity-100 focus:underline focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-900 rounded px-1 transition-opacity">
                                Dichiarazione di Accessibilità
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('pages.view', ['slug' => 'contacts']) }}" 
                               class="opacity-80 hover:opacity-100 hover:underline focus:opacity-100 focus:underline focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-900 rounded px-1 transition-opacity">
                                Contatti
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('pages.view', ['slug' => 'legal-notes']) }}" 
                               class="opacity-80 hover:opacity-100 hover:underline focus:opacity-100 focus:underline focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-900 rounded px-1 transition-opacity">
                                Note Legali
                            </a>
                        </li>
                    </ul>
                </div>
                
                <!-- AGID Compliance -->
                <div>
                    <h4 class="text-lg font-semibold mb-4">Conformità AGID</h4>
                    <div class="space-y-3 text-sm">
                        <div class="flex items-center space-x-2">
                            <svg class="w-5 h-5 text-green-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span class="opacity-80">WCAG 2.1 AA Compliant</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <svg class="w-5 h-5 text-green-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                            </svg>
                            <span class="opacity-80">Sicurezza Certificata</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <svg class="w-5 h-5 text-green-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                            </svg>
                            <span class="opacity-80">Mobile Responsive</span>
                        </div>
                    </div>
                    
                    <div class="mt-4">
                        <a href="https://www.agid.gov.it/" 
                           target="_blank" 
                           rel="noopener noreferrer"
                           class="inline-flex items-center text-sm opacity-80 hover:opacity-100 hover:underline focus:opacity-100 focus:underline focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-900 rounded px-1 transition-opacity">
                            Linee Guida AGID
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Bottom Footer -->
    <div class="bg-gray-800 py-4 border-t border-gray-700">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-between items-center text-sm opacity-80">
                <p>&copy; {{ date('Y') }} {{ config('app.institution_name') }}. Tutti i diritti riservati.</p>
                <p class="mt-2 md:mt-0">
                    Realizzato con ❤️ seguendo le linee guida AGID
                </p>
            </div>
        </div>
    </div>
</footer>
