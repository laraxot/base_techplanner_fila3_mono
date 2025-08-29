{{-- CTA Banner Block - Theme Two --}}
<section class="py-12 {{ $background_color ?? 'bg-slate-800' }}">
    <div class="max-w-4xl mx-auto px-4 text-center {{ $text_color ?? 'text-white' }}">
        @if(isset($title))
            <h2 class="text-3xl font-bold mb-4">{{ $title }}</h2>
        @endif

        @if(isset($description))
            <p class="text-lg mb-8 opacity-90">{{ $description }}</p>
        @endif

        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            @if(isset($cta_primary))
                <a href="{{ $cta_primary['url'] ?? '#' }}" 
                   class="bg-white text-slate-900 px-6 py-3 rounded font-semibold hover:bg-gray-100 transition">
                    {{ $cta_primary['label'] ?? 'Inizia' }}
                </a>
            @endif

            @if(isset($cta_secondary))
                <a href="{{ $cta_secondary['url'] ?? '#' }}" 
                   class="border border-white text-white px-6 py-3 rounded font-semibold hover:bg-white hover:text-slate-900 transition">
                    {{ $cta_secondary['label'] ?? 'Scopri' }}
                </a>
            @endif
        </div>
    </div>
</section>
