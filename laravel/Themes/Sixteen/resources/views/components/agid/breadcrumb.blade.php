@props(['items' => []])

@if(!empty($items))
<nav class="bg-gray-100 border-b border-gray-200 py-3" aria-label="Percorso di navigazione">
    <div class="container mx-auto px-4">
        <ol class="flex items-center space-x-2 text-sm" role="list">
            @foreach($items as $index => $item)
                <li role="listitem" class="flex items-center">
                    @if($index > 0)
                        <svg class="w-4 h-4 text-gray-400 mx-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    @endif
                    
                    @if(isset($item['url']) && !$loop->last)
                        <a href="{{ $item['url'] }}" 
                           class="text-blue-600 hover:text-blue-800 hover:underline focus:outline-none focus:underline focus:ring-2 focus:ring-blue-600 focus:ring-offset-1 rounded px-1 transition-colors">
                            @if($index === 0)
                                <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                </svg>
                            @endif
                            {{ $item['label'] }}
                        </a>
                    @else
                        <span class="text-gray-700 font-medium" 
                              @if($loop->last) aria-current="page" @endif>
                            {{ $item['label'] }}
                        </span>
                    @endif
                </li>
            @endforeach
        </ol>
    </div>
</nav>
@endif
