<div class="py-4">
    <div>
        @if(count($articles))
            @include('blog::components.blocks.article_list.play_money_markets.list_of_markets.article', ['articles' => $articles])
        @else
            @include('blog::components.blocks.article_list.play_money_markets.list_of_markets.no_articles_found')
        @endif
    </div>
</div>
