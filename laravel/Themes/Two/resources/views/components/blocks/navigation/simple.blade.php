{{--
/**
 * Simple Navigation Component - Theme Two
 *
 * Componente di navigazione semplice per il tema Two.
 * Utilizzato per blocchi CMS di navigazione base.
 *
 * @var array $data Dati di configurazione del blocco
 */
--}}

<nav class="simple-navigation" role="navigation" aria-label="@lang('pub_theme::navigation.main')">
    <div class="container mx-auto px-4">
        <div class="flex items-center justify-between py-4">
            {{-- Logo o titolo --}}
            @if(isset($data['title']) || isset($data['brand']))
                <div class="flex items-center">
                    <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200">
                        {{ $data['brand'] ?? $data['title'] ?? @lang('pub_theme::navigation.site_title') }}
                    </h2>
                </div>
            @endif

            {{-- Menu di navigazione --}}
            @if(isset($data['menu_items']) && is_array($data['menu_items']))
                <ul class="flex space-x-6">
                    @foreach($data['menu_items'] as $item)
                        <li>
                            <a 
                                href="{{ $item['url'] ?? '#' }}" 
                                class="text-gray-600 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white transition-colors duration-200"
                                @if($item['external'] ?? false) target="_blank" rel="noopener noreferrer" @endif
                            >
                                {{ $item['label'] ?? $item['title'] ?? 'Menu Item' }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</nav>