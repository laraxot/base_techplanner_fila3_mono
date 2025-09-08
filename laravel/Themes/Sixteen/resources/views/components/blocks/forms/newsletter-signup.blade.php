{{-- Newsletter Signup (AGID) --}}
@props([
    'action' => '#',
    'method' => 'POST',
    'title' => __('Iscriviti alla newsletter'),
    'description' => __('Rimani aggiornato su notizie, eventi e servizi.'),
    'privacyLabel' => __('Ho letto e accetto l’informativa privacy'),
])

<section class="bg-gray-50 rounded-lg border border-gray-200 p-6">
    <h2 class="text-xl font-semibold text-gray-900 mb-2">{{ $title }}</h2>
    <p class="text-gray-700 mb-4">{{ $description }}</p>
    <form action="{{ $action }}" method="{{ strtoupper($method) === 'GET' ? 'GET' : 'POST' }}" class="space-y-3">
        @if (strtoupper($method) !== 'GET')
            @csrf
        @endif
        <label for="newsletter-email" class="sr-only">{{ __('Email') }}</label>
        <input id="newsletter-email" name="email" type="email" required autocomplete="email"
               placeholder="nome@esempio.it"
               class="w-full border-2 border-gray-300 rounded-md px-4 py-3 focus:outline-none focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500">

        <div class="flex items-start gap-2">
            <input id="newsletter-privacy" name="privacy" type="checkbox" required class="mt-1">
            <label for="newsletter-privacy" class="text-gray-700">{{ $privacyLabel }}</label>
        </div>

        <button type="submit" class="inline-flex items-center gap-2 bg-italia-blue-500 hover:bg-italia-blue-600 text-white font-semibold rounded-md px-5 py-3">
            {{ __('Iscriviti') }}
        </button>
    </form>
</section>
