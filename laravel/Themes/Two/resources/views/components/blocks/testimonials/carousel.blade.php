{{-- Testimonials Block - Theme Two --}}
<section class="py-12 bg-white">
    <div class="max-w-6xl mx-auto px-4">
        @if(isset($title))
            <h2 class="text-2xl font-bold text-center text-gray-900 mb-8">{{ $title }}</h2>
        @endif

        @if(isset($testimonials) && is_array($testimonials))
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($testimonials as $testimonial)
                    <div class="bg-gray-50 p-6 rounded">
                        @if(isset($testimonial['rating']))
                            <div class="flex mb-3">
                                @for($i = 1; $i <= 5; $i++)
                                    <span class="{{ $i <= $testimonial['rating'] ? 'text-yellow-400' : 'text-gray-300' }}">★</span>
                                @endfor
                            </div>
                        @endif

                        @if(isset($testimonial['content']))
                            <p class="text-gray-700 mb-4 italic">"{{ $testimonial['content'] }}"</p>
                        @endif

                        @if(isset($testimonial['author']))
                            <div class="font-semibold text-gray-900">{{ $testimonial['author'] }}</div>
                        @endif
                        
                        @if(isset($testimonial['role']) || isset($testimonial['company']))
                            <div class="text-sm text-gray-600">
                                {{ $testimonial['role'] ?? '' }}{{ isset($testimonial['role']) && isset($testimonial['company']) ? ' - ' : '' }}{{ $testimonial['company'] ?? '' }}
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>
