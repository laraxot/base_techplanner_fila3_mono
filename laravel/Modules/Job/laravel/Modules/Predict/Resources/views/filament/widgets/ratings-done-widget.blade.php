{{-- <div class="filament-widget"> --}}
<div>
    {{-- <x-filament::card> --}}
        @foreach($user_ratings as $rating)
            <div class="p-4 space-y-2 border rounded-2xl">
                {{-- Line 1 --}}
                <div class="grid grid-cols-4">
                    <div class="flex items-center col-span-2 space-x-4">
                        <div class="relative w-10 h-10 rounded-lg overflow-clip">
                            <img src="{{ asset($rating['image']) }}" class="absolute inset-0 object-cover border-none aspect-square" alt="">
                        </div>
                        <div>
                            <div class="flex items-center space-x-1">
                                <div class="text-sm text-gray-500">{{ __('predict::article.your_bet') }}</div>
                            </div>
                            <div class="font-bold">{{ $rating['title'] }}</div>
                        </div>
                    </div>
                    
                    <div>
                        <div class="text-sm text-gray-500">{{ __('predict::article.your_amount') }}</div>
                        <div class="flex items-center space-x-1">
                            <div class="font-bold">{{ $rating['credit'] }}</div>
                        </div>
                    </div>
            
                    <div>
                        <div>
                            <div class="text-sm text-gray-500">{{ __('predict::article.if_win') }}</div>
                            <div class="flex items-center font-bold text-teal-500">
                                {{ $rating['predict_victory'] }}
                                <div class="ml-2">
                                    @include('ui::svg.credit')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Pulsante sotto le colonne --}}
                <div class="mt-4">
                    <button class="w-full px-4 py-2 text-sm text-white bg-blue-500 rounded hover:bg-blue-600"
                        wire:click="sell('{{ $rating['predict_victory'] }}')">
                        <x-filament::loading-indicator class="w-5 h-5" wire:loading wire:target="sell('{{ $rating['predict_victory'] }}')"/>
                        {{ __('predict::article.sell') }}
                    </button>
                </div>
            </div>
        @endforeach
    {{-- </x-filament::card> --}}

    <x-filament-actions::modals />
</div>

