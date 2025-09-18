<?php

declare(strict_types=1);

namespace Modules\Predict\View\Composers;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Modules\Blog\Models\Banner;
use Modules\Blog\Models\Tag;
use Modules\Predict\Datas\ArticleData;
use Modules\Predict\Models\Category;
use Modules\Predict\Models\Predict;
use Modules\Predict\Models\Profile;
use Modules\UI\Datas\SliderData;
use Webmozart\Assert\Assert;

class ThemeComposer
{
    /**
     * Show recent categories with their latest .
     *
     * @return Collection<int, Category>
     */
    public function categories()
    {
        return Category::tree()->get()->toTree();
    }

    /**
     * Show recent categories with their latest .
     *
     * @return Collection<int, Category>
     */
    public function getCategoriesArticles()
    {
        return $this->categories();
    }

    public function getArticles(): EloquentCollection
    {
        return Predict::all()
            ->sortBy(['created_at', 'desc']);
    }

    public function getArticlesType(string $type, int $number = 6): Collection
    {
        $fun = 'get'.Str::studly($type).'Articles';

        return $this->{$fun}($number);
    }

    public function getFeaturedArticles(int $number = 6): Collection
    {
        $rows = Predict::published()
            ->showHomepage()
            ->publishedUntilToday()
            ->take($number)
            ->orderBy('published_at', 'desc')
            ->get();
        if (0 === $rows->count()) {
            $rows = Predict::get();
            Predict::whereRaw('1=1')->update(['show_on_homepage' => true]);
        }

        return $rows;
    }

    public function getLatestArticles(int $number = 6): Collection
    {
        return Predict::published()
            ->publishedUntilToday()
            ->orderBy('published_at', 'desc')
            ->take($number)
            ->get();
    }

    public function getArticlesByCategory(string $category_id, int $number = 6): array
    {
        $rows = Predict::where('category_id', $category_id)
            ->orderBy('published_at', 'desc')
            ->take($number)
            ->get();

        return $this->getArticleDataArray($rows);
    }

    public function paginateArticlesByCategory(string $category_id, int $limit = 6): Paginator
    {
        return Predict::where('category_id', $category_id)
            ->orderBy('published_at', 'desc')
            ->simplePaginate($limit);
    }

    /*
    public function getAuthors(): Collection
    {
        $rows = Profile::ProfileIsAuthor()
            ->take(4)
            ->get();

        return $rows;
    }
    */

    public function getNavCategories(): Collection
    {
        return Category::has('articles', '>', 0)
            ->take(8)
            ->get();
    }

    public function getFooterCategories(): Collection
    {
        return Category::has('articles', '>', 0)
            ->take(8)
            ->get();
    }

    // --- da fare con parental
    public function getFooterAuthors(): Collection
    {
        // $footerAuthors = Profile::profileIsAuthor()
        // ->take(8)
        $footerAuthors = Profile::inRandomOrder()
            ->limit(8)
            ->get();

        return $footerAuthors;
    }

    public function getTags(): Collection
    {
        return Tag::all();
    }

    public function getFooterTags(): Collection
    {
        return Tag::take(15)->get();
    }

    /**
     * @return Collection<(int|string), mixed>
     */
    public function getMoreArticles(Model $model)
    {
        return collect([]);
    }

    /**
     * @return \Illuminate\Pagination\LengthAwarePaginator<Predict>
     */
    public function getPaginatedArticles(int $num = 15)
    {
        return Predict::paginate($num);
    }

    public function showArticleSidebarContent(string $slug): \Illuminate\Contracts\Support\Renderable
    {
        Assert::isInstanceOf($article = Predict::firstOrCreate(['slug' => $slug], ['sidebar_blocks' => []]), Predict::class, '['.__LINE__.']['.__FILE__.']');
        // $page = Page::firstOrCreate(['slug' => $slug], ['content_blocks' => []]);

        $article = new \Modules\UI\View\Components\Render\Blocks(blocks: $article->sidebar_blocks, model: $article);

        return $article->render();
    }

    public function rankingProfilesByCredits(): Collection
    {
        return Profile::all()->sortByDesc('credits');
    }

    public function rankingArticlesByBets(): Collection
    {
        return Predict::withCount([
            'ratings' => function (Builder $builder): void {
                $builder->where('user_id', '!=', null);
            },
        ])
            ->get()
            ->sortByDesc('ratings_count');
    }

    public function getMethodData(string $method, int $number = 6): Paginator|array
    {
        return $this->{$method}($number);
    }

    public function getBanner(): array
    {
        $results = Banner::all()->sortBy('pos');
        $tmp = [];
        foreach ($results as $content) {
            $slider_data = $content->toArray();
            $slider_data['link'] = $content->getUrlCategoryPage();
            $tmp[] = SliderData::from($slider_data);
        }

        return $tmp;
    }

    public function getSingleBanner(Banner $banner): SliderData
    {
        return SliderData::from($banner->toArray());
    }

    public function getArticlesFeatured(int $number = 6): Collection
    {
        dddx('wip con article data');

        return $this->getFeaturedArticles($number);
    }

    public function getArticlesLatest(int $number = 6): array
    {
        $results = $this->getLatestArticles($number); // ->toArray();

        return $this->getArticleDataArray($results);
    }

    public function paginatedArticlesLatest(int $limit = 6): Paginator
    {
        return Predict::published()
            ->publishedUntilToday()
            ->orderBy('published_at', 'desc')
            ->simplePaginate($limit);
    }

    public function paginatedArticlesComingSoon(int $limit = 6): Paginator
    {
        return Predict::published()
            ->where('event_start_date', '>', now())
            ->orderBy('event_start_date')
            ->simplePaginate($limit);
    }

    public function paginatedArticlesOrderByNumberOfBets(int $limit = 6): Paginator
    {
        return Predict::published()
            ->publishedUntilToday()
            ->orderBy('wagers_count', 'desc')
            ->simplePaginate($limit);
    }

    public function paginatedArticlesOrderByVolumes(int $limit = 6): Paginator
    {
        return Predict::published()
            ->publishedUntilToday()
            ->orderBy('volume_play_money', 'desc')
            ->simplePaginate($limit);
    }

    /**
     * --.
     */
    public function mapArticle(Predict|ArticleData $article): ArticleData
    {
        if ($article instanceof ArticleData) {
            return $article;
        }

        $article = $article->toArray();

        if (is_array($article['title'])) {
            $lang = app()->getLocale();
            $article['title'] = $article['title'][$lang] ?? last($article['title']);
        }

        return ArticleData::from($article);
    }

    public function getArticlesComingSoon(int $number = 6): array
    {
        $results = Predict::published()
            ->where('event_start_date', '>', now())
            ->orderBy('event_start_date')
            ->take($number)
            ->get();

        return $this->getArticleDataArray($results);
    }

    public function getArticlesOrderByNumberOfBets(int $number = 6): array
    {
        $results = Predict::published()
            ->publishedUntilToday()
            ->orderBy('wagers_count', 'desc')
            ->take($number)
            ->get();

        return $this->getArticleDataArray($results);
    }

    public function getArticlesOrderByVolumes(int $number = 6): array
    {
        $results = Predict::published()
            ->publishedUntilToday()
            ->orderBy('volume_play_money', 'desc')
            ->take($number)
            ->get();

        return $this->getArticleDataArray($results);
    }

    public function getAllArticles(): array
    {
        $results = Predict::orderBy('created_at', 'desc')->get();

        return $this->getArticleDataArray($results);
    }

    public function getArticleDataArray(Collection $rows): array
    {
        $tmp = [];
        foreach ($rows->toArray() as $content) {
            // @phpstan-ignore-next-line
            if (is_array($content['title'])) {
                $lang = app()->getLocale();
                $content['title'] = $content['title'][$lang] ?? last($content['title']);
            }
            $tmp[] = ArticleData::from($content);
        }

        // dddx($tmp);
        return $tmp;
    }

    public function getArticleModel(string $slug): ?Predict
    {
        return Predict::where('slug', $slug)->first();
    }

    public function getCategoryModel(string $slug): ?Category
    {
        return Category::where('slug', $slug)->first();
    }

    public function getHotTopics(): array
    {
        return $categories = Category::with([
            'categoryArticles' => fn ($article) => $article->withCount('ratings'),
            // 'banner'
        ])
            ->get()
            ->map(fn ($category): array => [
                'image' => $category->getFirstMediaUrl('category'), // ?? 'https://placehold.co/300x200',
                'slug' => $category->slug,
                'title' => $category->title,
                'ratings_sum' => $category->categoryArticles->sum('ratings_count'),
            ])
            ->sortByDesc('ratings_sum')
            ->take(3)
            ->toArray();
    }
}
