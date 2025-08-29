{{--
/**
 * Hero Section Block - Theme Two
 * Versione minimalista e pulita per il tema Two
 */
--}}

<section class="relative bg-gradient-to-br from-slate-900 to-slate-700 text-white py-20">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            @if(isset($title))
                <h1 class="text-4xl md:text-5xl font-bold mb-6 leading-tight">
                    {{ $title }}
                </h1>
            @endif

            @if(isset($subtitle))
                <h2 class="text-xl md:text-2xl font-light mb-6 text-slate-200">
                    {{ $subtitle }}
                </h2>
            @endif

            @if(isset($description))
                <p class="text-lg mb-10 max-w-2xl mx-auto text-slate-300 leading-relaxed">
                    {{ $description }}
                </p>
            @endif

            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                @if(isset($cta_primary))
                    <a href="{{ $cta_primary['url'] ?? '#' }}" 
                       class="bg-white text-slate-900 px-6 py-3 rounded-md font-semibold hover:bg-slate-100 transition">
                        {{ $cta_primary['label'] ?? 'Inizia' }}
                    </a>
                @endif

                @if(isset($cta_secondary))
                    <a href="{{ $cta_secondary['url'] ?? '#' }}" 
                       class="border border-white text-white px-6 py-3 rounded-md font-semibold hover:bg-white hover:text-slate-900 transition">
                        {{ $cta_secondary['label'] ?? 'Scopri' }}
                    </a>
                @endif
            </div>
        </div>
    </div>
</section>
