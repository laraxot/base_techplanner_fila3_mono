{{--
/**
 * Features Grid Block - Theme Two
 * Design minimalista con focus sulla leggibilità
 */
--}}

<section class="py-16 bg-white">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        @if(isset($title))
            <h2 class="text-3xl font-bold text-center text-gray-900 mb-4">{{ $title }}</h2>
        @endif
        
        @if(isset($description))
            <p class="text-lg text-center text-gray-600 mb-12 max-w-2xl mx-auto">{{ $description }}</p>
        @endif

        @if(isset($features) && is_array($features))
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($features as $feature)
                    <div class="text-center p-6 rounded-lg border border-gray-200 hover:border-gray-300 hover:shadow-md transition">
                        @if(isset($feature['icon']))
                            <div class="w-12 h-12 mx-auto mb-4 text-{{ $feature['color'] ?? 'blue' }}-600">
                                <x-dynamic-component :component="$feature['icon']" class="w-full h-full" />
                            </div>
                        @endif

                        @if(isset($feature['title']))
                            <h3 class="text-lg font-semibold text-gray-900 mb-3">{{ $feature['title'] }}</h3>
                        @endif

                        @if(isset($feature['description']))
                            <p class="text-gray-600 mb-4">{{ $feature['description'] }}</p>
                        @endif

                        @if(isset($feature['url']))
                            <a href="{{ $feature['url'] }}" 
                               class="text-{{ $feature['color'] ?? 'blue' }}-600 hover:text-{{ $feature['color'] ?? 'blue' }}-700 font-medium">
                                Scopri di più →
                            </a>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>
