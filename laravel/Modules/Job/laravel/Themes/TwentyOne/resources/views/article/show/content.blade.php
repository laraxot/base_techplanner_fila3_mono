<div class="w-full space-y-5 lg:w-2/3">
    {{-- <div class="py-4">
        <template x-if="true">
            <div class="flex flex-col gap-5">
                <article class="bg-white pt-6 lg:pl-6 pb-[18px] lg:pr-[18px] rounded-lg flex flex-col gap-6">
                    <div class="pl-6 lg:pl-0"> --}}

                        @if (is_array($article->content_blocks))
                            <x-render.blocks :blocks="$article->content_blocks" :model="$article" />
                        @endif

                    {{-- </div>
                </article>
            </div>
        </template>
    </div> --}}
</div>
