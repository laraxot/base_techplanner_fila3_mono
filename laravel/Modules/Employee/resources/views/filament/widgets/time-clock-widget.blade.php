<x-filament-widgets::widget>
<<<<<<< HEAD
    <div class="flex items-center gap-6 h-24 w-full" wire:poll.1s="updateData">
        
        {{-- Left Column: Time and Date --}}
        <div class="flex-1 text-center">
            <div class="text-5xl font-mono font-bold text-gray-900 dark:text-gray-100">
                {{ $currentTime }}
            </div>
            <div class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                {{ $todayDate }}
            </div>
        </div>

        {{-- Center Column: Time Entries --}}
        <div class="flex-1 text-center">
            @if($isClockedIn)
                <div class="text-sm font-medium text-green-600 dark:text-green-400 mb-2">
                    Sessione attiva
                </div>
            @else
                 <div class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-2">
                    Nessuna sessione attiva
                </div>
            @endif
            
            <div class="flex flex-wrap gap-1 justify-center">
                @forelse($todayEntries as $entry)
                    <x-filament::badge 
                        :color="$entry['type'] === 'clock_in' ? 'success' : 'danger'"
                        size="sm"
                        class="cursor-pointer hover:scale-105 transition-transform">
                        {{ $entry['type'] === 'clock_in' ? '→' : '←' }} {{ $entry['time'] }}
                    </x-filament::badge>
                @empty
                    <x-filament::badge 
                        color="gray" 
                        size="sm"
                        icon="heroicon-o-clock"
                        class="italic">
                        Nessuna timbratura
                    </x-filament::badge>
                @endforelse
            </div>
        </div>

        {{-- Right Column: Action Button --}}
        <div class="flex-1 text-center">
            @if($isClockedIn)
                <x-filament::button 
                    wire:click="clockOut" 
                    color="danger"
                    size="lg"
                    icon="heroicon-o-arrow-left-on-rectangle">
                    Timbra uscita
                </x-filament::button>
            @else
                <x-filament::button 
                    wire:click="clockIn" 
                    color="success"
                    size="lg"
                    icon="heroicon-o-arrow-right-on-rectangle">
                    Timbra entrata
                </x-filament::button>
            @endif
        </div>
    </div>
</x-filament-widgets::widget>
=======
    <x-filament::section>
        <div class="grid grid-cols-3 gap-8 items-center min-h-[120px]" wire:poll.30s="updateData">
            
            {{-- COLONNA SINISTRA: Orario e Data --}}
            <div class="text-center space-y-2">
                <div class="text-5xl font-mono font-bold text-gray-900 dark:text-gray-100">
                    {{ $currentTime }}
                </div>
                <div class="text-sm text-gray-600 dark:text-gray-400 font-medium">
                    {{ $todayDateFormatted }}
                </div>
            </div>

            {{-- COLONNA CENTRO: Lista Timbrature --}}
            <div class="text-center space-y-4">
                {{-- Stato sessione --}}
                <div class="mb-4">
                    @if($todayStatus === 'active')
                        <div class="flex items-center justify-center space-x-2">
                            <div class="w-3 h-3 bg-green-500 rounded-full animate-pulse"></div>
                            <span class="text-sm font-semibold text-green-700 dark:text-green-400">
                                Sessione Attiva
                            </span>
                        </div>
                    @elseif($todayStatus === 'completed')
                        <div class="flex items-center justify-center space-x-2">
                            <div class="w-3 h-3 bg-blue-500 rounded-full"></div>
                            <span class="text-sm font-semibold text-blue-700 dark:text-blue-400">
                                Giornata Completata
                            </span>
                        </div>
                    @else
                        <div class="text-sm text-gray-500 dark:text-gray-400">
                            Nessuna Timbratura
                        </div>
                    @endif
                </div>

                {{-- Lista timbrature --}}
                <div class="space-y-2 max-h-24 overflow-y-auto">
                    @forelse($todayEntries as $entry)
                        <div class="flex items-center justify-center space-x-3 text-sm">
                            <div class="w-2 h-2 {{ $entry['type'] === 'clock_in' ? 'bg-green-500' : 'bg-red-500' }} rounded-full"></div>
                            <span class="font-mono font-semibold text-gray-800 dark:text-gray-200">
                                {{ $entry['time'] }}
                            </span>
                            <x-filament::badge 
                                :color="$entry['type'] === 'clock_in' ? 'success' : 'danger'" 
                                size="xs"
                            >
                                {{ $entry['type'] === 'clock_in' ? 'IN' : 'OUT' }}
                            </x-filament::badge>
                        </div>
                    @empty
                        <div class="text-xs text-gray-400 italic">
                            Nessuna timbratura oggi
                        </div>
                    @endforelse
                </div>
            </div>

            {{-- COLONNA DESTRA: Bottone Azione Filament --}}
            <div class="text-center">
                @if($isClockedIn)
                    {{-- Bottone Clock Out usando componente Filament --}}
                    <x-filament::button
                        wire:click="performClockOut"
                        color="danger"
                        size="xl"
                        icon="heroicon-o-arrow-left-on-rectangle"
                    >
                        Timbra Uscita
                    </x-filament::button>
                @else
                    {{-- Bottone Clock In usando componente Filament --}}
                    <x-filament::button
                        wire:click="performClockIn"
                        color="success" 
                        size="xl"
                        icon="heroicon-o-arrow-right-on-rectangle"
                    >
                        Timbra Entrata
                    </x-filament::button>
                @endif
            </div>

        </div>
    </x-filament::section>
</x-filament-widgets::widget>
>>>>>>> cda86dd (.)
