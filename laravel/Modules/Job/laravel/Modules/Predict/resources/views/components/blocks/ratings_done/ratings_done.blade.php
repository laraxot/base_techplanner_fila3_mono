@props([
    'tpl',
    'version' => 'v1',
])
<div>
    @if(Auth::check())
        @php
            $article = $_theme->mapArticle($model);
            $art = $article->toArray();
            // dddx($art);
        @endphp
        <livewire:article.ratings-done :article_uuid="$article->uuid" :article_data="$art" wire:key="$article->uuid"/>
    @endif
</div>
