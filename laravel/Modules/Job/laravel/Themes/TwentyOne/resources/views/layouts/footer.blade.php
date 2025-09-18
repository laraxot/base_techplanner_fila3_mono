<footer class="py-8 text-white bg-gray-900 xl:py-16">
    <div class="container max-w-6xl mx-auto space-y-6">
        <x-filament-panels::logo  />
        <div class="grid gap-6 lg:grid-cols-2">
            <div class="space-y-6">
                <div class="space-y-2">
                    <h4 class="text-3xl font-semibold">
                        {{-- Make your prediction --}}
                        {{ $_theme->showContent('footer_title') }}
                    </h4>
                    <p class="text-sm text-gray-400">
                        {{-- Lorem ipsum dolor sit amet, consectetur adipisci elit, sed eiusmod tempor incidunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur. Quis aute iure reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint obcaecat cupiditat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum --}}

                        {{ $_theme->showContent('footer') }}
                    </p>
                </div>
                @include('pub_theme::layouts.footer.socials')
                <div class="flex items-center gap-6">
                    <div class="grid text-sm text-gray-900 bg-white rounded place-items-center size-8">
                        <span>18+</span>
                    </div>
                    {{-- @include('pub_theme::layouts.headernav.language') --}}
                </div>
            </div>
            <div>
                @include('pub_theme::layouts.footer.links')
            </div>
        </div>
        {{-- @include('pub_theme::layouts.footer.crypto') --}}
    </div>
</footer>
