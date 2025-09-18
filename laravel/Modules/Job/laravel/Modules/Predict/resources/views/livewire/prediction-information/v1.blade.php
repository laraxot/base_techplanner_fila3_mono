<div class="px-4 mb-3">
    <div class="flex items-center justify-between py-2 text-base text-neutral-4">
        <span>
            {{ __('predict::article.quote-stock') }}
            {{-- Av. price / share --}}
        </span>
        <span class="font-bold text-black">
            {{-- {{ round($this->current_prices[$this->rating_id], 2) }} --}}
            {{ $this->price }}
        <span> / Share</span></span>
    </div>
    <div class="flex items-center justify-between py-2 text-base text-neutral-4">
        <span>{{ __('predict::article.your_stocks') }}</span>
        {{-- <span class="font-bold text-black">100<span class="ml-1">Ooms</span></span> --}}
        <span class="font-bold text-black flex items-center">
            {{-- 100 --}}
            {{ $this->stock }}
            <div class="ml-1 flex items-center">
                @include('ui::svg.credit')
            </div>
        </span>
    </div>
    @php
    /*
    <div class="flex items-center justify-between py-2 text-base text-neutral-4">
        <span>{{ __('predict::article.if_win') }}</span>
        {{-- <span class="font-bold text-green-400">0<span class="ml-1">Ooms</span></span> --}}
        <span class="font-bold text-black flex items-center">
            {{-- 0 --}}
            {{-- $this->if_win --}}
            <div class="ml-1 flex items-center">
                @include('ui::svg.credit')
            </div>
        </span>
    </div>
    */
    @endphp
</div>