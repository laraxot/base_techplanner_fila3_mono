<x-filament-widgets::widget>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-center h-24" wire:poll.1s="updateData">
        {{-- Colonna Sinistra: Ora e Data --}}
        <div class="text-center">
            <div class="text-5xl font-mono font-bold text-gray-900 dark:text-gray-100">
                {{ $currentTime }}
            </div>
            <div class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                {{ $todayDate }}
            </div>
        </div>

        {{-- Colonna Centro: Timbrature --}}
        <div class="text-center">
            @if($isClockedIn)
                <div class="text-sm font-medium text-green-600 dark:text-green-400 mb-2">
                    Sessione attiva
                </div>
            @else
                 <div class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-2">
                    Nessuna sessione attiva
                </div>
            @endif
            
            <div class="space-y-1">
                @forelse($todayEntries as $entry)
                    <div class="text-sm text-gray-700 dark:text-gray-300">
                        <span class="inline-block w-2 h-2 {{ $entry['type'] === 'clock_in' ? 'bg-green-500' : 'bg-red-500' }} rounded-full mr-2"></span>
                        {{ $entry['time'] }}
                    </div>
                @empty
                    <div class="text-xs text-gray-400 italic">
                        Nessuna timbratura per oggi.
                    </div>
                @endforelse
            </div>
        </div>

        {{-- Colonna Destra: Pulsante Filament --}}
        <div class="text-center">
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
