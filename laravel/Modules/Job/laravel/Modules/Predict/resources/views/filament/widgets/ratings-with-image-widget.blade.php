<div>
    <article class="bg-white p-6 lg:p-[18px] rounded-lg lg:border flex flex-col xot-modal-place-bet">
        <div>
            <!-- Grid dei ratings -->
            <div class="grid grid-cols-2 gap-4 lg:grid-cols-3">
                @foreach($ratings as $rating)
                    <button
                        wire:click="openBetModal('{{ $rating['id'] }}')"
                        class="relative block w-full overflow-hidden rounded-lg aspect-[4/3] 
                        {{ $rating_title == $rating['title'] ? 'border-[3px] border-blue-600 shadow-lg shadow-blue-300' : '' }}"
                        wire:loading.class="opacity-50"
                        wire:target="openBetModal('{{ $rating['id'] }}')">
                        
                        <!-- Loading indicator -->
                        <div class="absolute inset-0 z-10 grid pointer-events-none place-items-center">
                            <x-filament::loading-indicator 
                                class="w-5 h-5" 
                                wire:loading 
                                wire:target="openBetModal('{{ $rating['id'] }}')"
                            />
                        </div>

                        <!-- Immagine e overlay -->
                        <div class="absolute inset-0">
                            <figure>
                                <img 
                                    class="absolute inset-0 object-cover w-full h-full" 
                                    alt="{{ $rating['title'] }}" 
                                    title="{{ $rating['title'] }}" 
                                    src="{{ $rating['image'] }}" 
                                    loading="lazy"
                                />
                            </figure>
                            <div class="absolute inset-0 transition bg-transparent hover:bg-blue-500/30"></div>
                        </div>

                        <!-- Percentuale e titolo -->
                        <div class="p-1.5 absolute inset-0 flex flex-col text-start justify-between pointer-events-none">
                            <div @class([
                                'flex items-center justify-center h-8 rounded-sm bg-neutral-5 w-11',
                                'text-white' => !$rating_title || $rating_title == $rating['title'],
                                'text-gray-400' => $rating_title && $rating_title != $rating['title']
                            ])>
                                <span>{{ $ratings_percentage[$rating['id']] }}%</span>
                            </div>
                            <p class="text-sm font-medium text-white leading-[1.1]">
                                {{ $rating['title'] }}
                            </p>
                        </div>
                    </button>
                @endforeach
            </div>
        </div>
    </article>

    <!-- Modals per ogni rating -->
    @foreach($ratings as $rating)
        <x-filament::modal 
            id="modal-rating-{{ $rating['id'] }}"
            :close-button="true"
            :close-by-clicking-away="true"
        >
            <x-slot name="heading">
                {{ $article->title }}
            </x-slot>

            <!-- Error message -->
            @error('bet')
                <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg">
                    {{ $message }}
                </div>
            @enderror

            @if(Auth::guest())
                @include('predict::filament.widgets.ratings-with-image-widget.guest')    
            @elseif(Auth::check() && 'expired' === $article->getTimeLeftForHumans())
                @include('predict::filament.widgets.ratings-with-image-widget.check_expired')    
            @else
                @include('predict::filament.widgets.ratings-with-image-widget.check', [
                    'rating' => $rating,
                    'currentPrice' => $current_prices[$rating['id']] ?? null
                ])    
            @endif
        </x-filament::modal>
    @endforeach
</div>
