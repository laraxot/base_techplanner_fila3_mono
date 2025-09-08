{{-- Menu Megafono AGID Compliant --}}
<div class="agid-megamenu" x-data="{
    open: false,
    activeMenu: null,
    isMobile: window.innerWidth < 1024,
    init() {
        this.$watch('open', value => {
            if (value && this.isMobile) {
                document.body.style.overflow = 'hidden';
            } else {
                document.body.style.overflow = '';
            }
        });
        
        window.addEventListener('resize', () => {
            this.isMobile = window.innerWidth < 1024;
            if (!this.isMobile && this.open) {
                this.open = false;
            }
        });
    },
    toggleMenu(menu = null) {
        if (this.isMobile) {
            if (menu && this.activeMenu === menu) {
                this.activeMenu = null;
            } else if (menu) {
                this.activeMenu = menu;
            }
        } else {
            this.activeMenu = this.activeMenu === menu ? null : menu;
        }
    },
    closeAll() {
        this.activeMenu = null;
        this.open = false;
    }
}" @keydown.escape="closeAll()" @click.away="!isMobile && closeAll()">
    
    {{-- Menu Trigger Button --}}
    <button 
        @click="open = !open" 
        :aria-expanded="open.toString()"
        aria-controls="megamenu-content"
        class="agid-menu-trigger flex items-center space-x-2 px-4 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
        :class="{ 'bg-blue-700': open }"
    >
        <span class="font-semibold">Menu</span>
        <svg class="w-4 h-4 transition-transform" :class="{ 'rotate-180': open }" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
        </svg>
    </button>

    {{-- Overlay for Mobile --}}
    <div 
        x-show="open && isMobile" 
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 bg-black bg-opacity-50 z-40"
        @click="closeAll()"
    ></div>

    {{-- Mega Menu Content --}}
    <div 
        id="megamenu-content"
        x-show="open"
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0 transform -translate-y-4"
        x-transition:enter-end="opacity-100 transform translate-y-0"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100 transform translate-y-0"
        x-transition:leave-end="opacity-0 transform -translate-y-4"
        class="agid-megamenu-content absolute top-full left-0 right-0 bg-white shadow-2xl rounded-b-lg z-50 mt-1"
        :class="{ 'fixed inset-x-0 top-0 bottom-0 rounded-none overflow-y-auto': isMobile }"
        role="navigation"
        aria-label="Menu principale"
    >
        {{-- Mobile Header --}}
        <div x-show="isMobile" class="flex items-center justify-between p-4 border-b border-gray-200 bg-blue-600 text-white">
            <h2 class="text-lg font-semibold">Menu</h2>
            <button @click="closeAll()" class="p-2 hover:bg-blue-700 rounded" aria-label="Chiudi menu">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <div class="container mx-auto px-4 py-6" :class="{ 'py-4': isMobile }">
            {{-- Main Navigation Grid --}}
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8" :class="{ 'gap-4': isMobile }">
                
                {{-- Amministrazione --}}
                <div class="agid-menu-section">
                    <button 
                        @click="toggleMenu('amministrazione')" 
                        class="agid-menu-header w-full text-left flex items-center justify-between py-3 px-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500"
                        :aria-expanded="(activeMenu === 'amministrazione').toString()"
                    >
                        <span class="font-semibold text-gray-900">Amministrazione</span>
                        <svg class="w-4 h-4 transition-transform" :class="{ 'rotate-180': activeMenu === 'amministrazione' }" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                    
                    <div 
                        x-show="!isMobile || activeMenu === 'amministrazione'"
                        x-collapse
                        class="agid-menu-items mt-2 space-y-1"
                    >
                        <a href="{{ route('pages.view', ['slug' => 'organizzazione']) }}" class="block py-2 px-4 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded transition-colors">Organizzazione</a>
                        <a href="{{ route('pages.view', ['slug' => 'uffici']) }}" class="block py-2 px-4 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded transition-colors">Uffici e Servizi</a>
                        <a href="{{ route('pages.view', ['slug' => 'documenti']) }}" class="block py-2 px-4 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded transition-colors">Documenti e Dati</a>
                        <a href="{{ route('pages.view', ['slug' => 'bandi']) }}" class="block py-2 px-4 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded transition-colors">Bandi e Gare</a>
                    </div>
                </div>

                {{-- Servizi --}}
                <div class="agid-menu-section">
                    <button 
                        @click="toggleMenu('servizi')" 
                        class="agid-menu-header w-full text-left flex items-center justify-between py-3 px-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500"
                        :aria-expanded="(activeMenu === 'servizi').toString()"
                    >
                        <span class="font-semibold text-gray-900">Servizi</span>
                        <svg class="w-4 h-4 transition-transform" :class="{ 'rotate-180': activeMenu === 'servizi' }" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                    
                    <div 
                        x-show="!isMobile || activeMenu === 'servizi'"
                        x-collapse
                        class="agid-menu-items mt-2 space-y-1"
                    >
                        <a href="{{ route('suap.index') }}" class="block py-2 px-4 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded transition-colors">SUAP - Sportello Unico</a>
                        <a href="{{ route('anagrafe.index') }}" class="block py-2 px-4 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded transition-colors">Anagrafe e Stato Civile</a>
                        <a href="{{ route('tributi.index') }}" class="block py-2 px-4 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded transition-colors">Tributi e Imposte</a>
                        <a href="{{ route('servizi.sociali') }}" class="block py-2 px-4 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded transition-colors">Servizi Sociali</a>
                    </div>
                </div>

                {{-- Città e Territorio --}}
                <div class="agid-menu-section">
                    <button 
                        @click="toggleMenu('citta')" 
                        class="agid-menu-header w-full text-left flex items-center justify-between py-3 px-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500"
                        :aria-expanded="(activeMenu === 'citta').toString()"
                    >
                        <span class="font-semibold text-gray-900">Città e Territorio</span>
                        <svg class="w-4 h-4 transition-transform" :class="{ 'rotate-180': activeMenu === 'citta' }" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                    
                    <div 
                        x-show="!isMobile || activeMenu === 'citta'"
                        x-collapse
                        class="agid-menu-items mt-2 space-y-1"
                    >
                        <a href="{{ route('pages.view', ['slug' => 'urbanistica']) }}" class="block py-2 px-4 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded transition-colors">Urbanistica e Edilizia</a>
                        <a href="{{ route('pages.view', ['slug' => 'ambiente']) }}" class="block py-2 px-4 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded transition-colors">Ambiente e Verde</a>
                        <a href="{{ route('pages.view', ['slug' => 'mobilita']) }}" class="block py-2 px-4 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded transition-colors">Mobilità e Trasporti</a>
                        <a href="{{ route('pages.view', ['slug' => 'turismo']) }}" class="block py-2 px-4 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded transition-colors">Turismo e Cultura</a>
                    </div>
                </div>

                {{-- Novità e Eventi --}}
                <div class="agid-menu-section">
                    <button 
                        @click="toggleMenu('novita')" 
                        class="agid-menu-header w-full text-left flex items-center justify-between py-3 px-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500"
                        :aria-expanded="(activeMenu === 'novita').toString()"
                    >
                        <span class="font-semibold text-gray-900">Novità e Eventi</span>
                        <svg class="w-4 h-4 transition-transform" :class="{ 'rotate-180': activeMenu === 'novita' }" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                    
                    <div 
                        x-show="!isMobile || activeMenu === 'novita'"
                        x-collapse
                        class="agid-menu-items mt-2 space-y-1"
                    >
                        <a href="{{ route('news.index') }}" class="block py-2 px-4 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded transition-colors">Notizie e Comunicati</a>
                        <a href="{{ route('events.index') }}" class="block py-2 px-4 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded transition-colors">Eventi e Manifestazioni</a>
                        <a href="{{ route('pages.view', ['slug' => 'bandi-avvisi']) }}" class="block py-2 px-4 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded transition-colors">Bandi e Avvisi</a>
                        <a href="{{ route('pages.view', ['slug' => 'lavori-pubblici']) }}" class="block py-2 px-4 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded transition-colors">Lavori Pubblici</a>
                    </div>
                </div>
            </div>

            {{-- Quick Links Row --}}
            <div class="mt-8 pt-6 border-t border-gray-200">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <a href="{{ route('pages.view', ['slug' => 'contatti']) }}" class="text-center p-3 bg-gray-50 rounded-lg hover:bg-blue-50 transition-colors">
                        <div class="text-blue-600 mb-2">
                            <svg class="w-6 h-6 mx-auto" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                            </svg>
                        </div>
                        <span class="text-sm font-medium text-gray-700">Contatti</span>
                    </a>
                    
                    <a href="{{ route('pages.view', ['slug' => 'urp']) }}" class="text-center p-3 bg-gray-50 rounded-lg hover:bg-blue-50 transition-colors">
                        <div class="text-blue-600 mb-2">
                            <svg class="w-6 h-6 mx-auto" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-2 0c0 .993-.241 1.929-.668 2.754l-1.524-1.525a3.997 3.997 0 00.078-2.183l1.562-1.562C15.802 8.249 16 9.1 16 10zm-5.165 3.913l1.58 1.58A5.98 5.98 0 0110 16a5.976 5.976 0 01-2.516-.552l1.562-1.562a4.006 4.006 0 001.789.027zm-4.677-2.796a4.002 4.002 0 01-.041-2.08l-.08.08-1.53-1.533A5.98 5.98 0 004 10c0 .954.223 1.856.619 2.657l1.54-1.54zm1.088-6.45A5.974 5.974 0 0110 4c.954 0 1.856.223 2.657.619l-1.54 1.54a4.002 4.002 0 00-2.346.033L7.246 4.668zM12 10a2 2 0 11-4 0 2 2 0 014 0z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <span class="text-sm font-medium text-gray-700">URP</span>
                    </a>
                    
                    <a href="{{ route('pages.view', ['slug' => 'appuntamenti']) }}" class="text-center p-3 bg-gray-50 rounded-lg hover:bg-blue-50 transition-colors">
                        <div class="text-blue-600 mb-2">
                            <svg class="w-6 h-6 mx-auto" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <span class="text-sm font-medium text-gray-700">Appuntamenti</span>
                    </a>
                    
                    <a href="{{ route('pages.view', ['slug' => 'accessibilita']) }}" class="text-center p-3 bg-gray-50 rounded-lg hover:bg-blue-50 transition-colors">
                        <div class="text-blue-600 mb-2">
                            <svg class="w-6 h-6 mx-auto" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M3 5a2 2 0 012-2h10a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V5zm11 1H6v8l4-2 4 2V6z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <span class="text-sm font-medium text-gray-700">Accessibilità</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.agid-megamenu {
    position: relative;
    display: inline-block;
}

.agid-menu-trigger {
    font-size: 16px;
    min-height: 44px;
    min-width: 44px;
}

.agid-megamenu-content {
    min-width: 300px;
    max-height: calc(100vh - 100px);
}

@media (max-width: 1023px) {
    .agid-megamenu-content {
        max-height: 100vh;
    }
}

.agid-menu-header {
    font-size: 16px;
    min-height: 44px;
}

.agid-menu-items a {
    font-size: 14px;
    min-height: 40px;
    display: flex;
    align-items: center;
}

/* Focus styles for accessibility */
.agid-menu-trigger:focus,
.agid-menu-header:focus,
.agid-menu-items a:focus {
    outline: 2px solid #0066CC;
    outline-offset: 2px;
}

/* High contrast mode support */
@media (prefers-contrast: high) {
    .agid-menu-trigger,
    .agid-menu-header,
    .agid-menu-items a {
        border: 2px solid currentColor;
    }
}

/* Reduced motion support */
@media (prefers-reduced-motion: reduce) {
    .agid-megamenu-content,
    .agid-menu-trigger,
    .agid-menu-items a {
        transition: none;
    }
}
</style>