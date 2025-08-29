{{-- Stats Overview Block - Theme Two --}}
<section class="py-12 {{ $background_color ?? 'bg-gray-50' }}">
    <div class="max-w-6xl mx-auto px-4">
        @if(isset($title))
            <h2 class="text-2xl font-bold text-center text-gray-900 mb-8">{{ $title }}</h2>
        @endif

        @if(isset($stats) && is_array($stats))
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                @foreach($stats as $stat)
                    <div class="text-center">
                        @if(isset($stat['number']))
                            <div class="text-3xl font-bold text-blue-600 mb-1">{{ $stat['number'] }}</div>
                        @endif
                        @if(isset($stat['label']))
                            <div class="font-semibold text-gray-900">{{ $stat['label'] }}</div>
                        @endif
                        @if(isset($stat['description']))
                            <div class="text-sm text-gray-600">{{ $stat['description'] }}</div>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>
