<header role="banner" class="bg-white border-b-4 border-blue-600">
    <!-- Slim Header (Ente di appartenenza) -->
    <div class="bg-blue-600 text-white py-2">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center text-sm">
                <div class="flex items-center space-x-2">
                    <span>Un servizio a cura di</span>
                    <a href="{{ config('app.institution_url') }}" 
                       class="font-semibold hover:underline focus:underline focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-blue-600 rounded px-1"
                       target="_blank" 
                       rel="noopener noreferrer">
                        {{ config('app.institution_name', 'Nome Ente') }}
                    </a>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="{{ config('app.institution_url') }}" 
                       class="hover:underline focus:underline focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-blue-600 rounded px-1"
                       target="_blank" 
                       rel="noopener noreferrer">
                        Vai al sito dell'ente
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Main Header -->
    <div class="bg-white py-4">
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-between">
                <!-- Logo e denominazione servizio -->
                <div class="flex items-center space-x-4">
                    <a href="{{ route('home') }}" 
                       class="flex items-center space-x-3 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-offset-2 rounded-lg p-2"
                       aria-label="Torna alla homepage di {{ config('app.name') }}">
                        <x-pub_theme::ui.logo class="h-12 w-auto" />
                        <div>
                            <h1 class="text-xl font-bold text-gray-900 leading-tight">
                                {{ config('app.name') }}
                            </h1>
                            <p class="text-sm text-gray-600">
                                {{ config('app.tagline', 'Servizi digitali per i cittadini') }}
                            </p>
                        </div>
                    </a>
                </div>
                
                <!-- Navigation Actions -->
                <nav id="main-navigation" role="navigation" aria-label="Navigazione principale">
                    <div class="flex items-center space-x-4">
                        @guest
                            <a href="{{ route('login') }}" 
                               class="inline-flex items-center px-4 py-2 border border-blue-600 text-blue-600 rounded-md hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-offset-2 transition-colors"
                               @if(request()->routeIs('login')) aria-current="page" @endif>
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                                </svg>
                                Accedi
                            </a>
                        @else
                            <div class="flex items-center space-x-2">
                                <span class="text-sm text-gray-600">Benvenuto,</span>
                                <span class="font-semibold text-gray-900">{{ auth()->user()->name }}</span>
                                <form method="POST" action="{{ route('logout') }}" class="inline">
                                    @csrf
                                    <button type="submit" 
                                            class="ml-2 text-sm text-blue-600 hover:text-blue-800 focus:outline-none focus:underline focus:ring-2 focus:ring-blue-600 focus:ring-offset-1 rounded px-1">
                                        Esci
                                    </button>
                                </form>
                            </div>
                        @endguest
                    </div>
                </nav>
            </div>
        </div>
    </div>
</header>
