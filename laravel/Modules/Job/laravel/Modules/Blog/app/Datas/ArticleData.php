<?php

declare(strict_types=1);

namespace Modules\Blog\Datas;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Modules\Blog\Actions\Category\GetBloodline;
use Modules\Blog\Models\Article;
use Modules\Blog\Models\Category;
use Spatie\LaravelData\Data;
use Webmozart\Assert\Assert;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\DateTimeInterfaceCast;
use Spatie\LaravelData\Optional;
use Modules\Blog\Enums\ArticleStatus;
use DateTimeImmutable;

class ArticleData extends Data implements \Stringable
{
    public string $title = '';

    public function __construct(
        public string $id,
        public string $uuid,
        array|string $title,
        public string $slug,
        public ?int $category_id,
        public ?string $status,
        public bool $show_on_homepage,
        public ?string $published_at,
        public ?array $content_blocks,
        public ?array $sidebar_blocks,
        public ?array $footer_blocks,
        public ?Collection $categories,
        public ?string $url,
        public ?array $ratings,
        public ?string $closed_at,
        public ?string $closed_at_date,
        // public ?int $betting_users,
        public ?string $time_left_for_humans,
        // public ?float $volume_credit,
        public ?Collection $tags,
        // public string $class,
        // public string $articleId;
        // public string $ratingId;
        // public int $credit;
        #[WithCast(DateTimeInterfaceCast::class)]
        public readonly ?Carbon $bet_end_date = null,
        
        #[WithCast(DateTimeInterfaceCast::class)]
        public readonly ?Carbon $event_start_date = null,
        
        #[WithCast(DateTimeInterfaceCast::class)]
        public readonly ?Carbon $event_end_date = null,
        
        /** @var array<int,array<string,mixed>> */
        public readonly array $category = [],
        
        public readonly string $status_display = '',
        public readonly bool $is_wagerable = false,
        public readonly float $brier_score = 0.0,
        public readonly float $brier_score_play_money = 0.0,
        public readonly float $brier_score_real_money = 0.0,
        public readonly int $wagers_count = 0,
        public readonly int $wagers_count_canonical = 0,
        public readonly int $wagers_count_total = 0,
        
        /** @var array<int,array<string,mixed>> */
        public readonly array $wagers = [],
        
        public readonly float $volume_play_money = 0.0,
        public readonly float $volume_real_money = 0.0,
        
        /** @var array<int,array<string,mixed>> */
        public readonly array $outcomes = [],
        
        public readonly ?string $thumbnail_2x = null,
    ) {
        if (is_array($title)) {
            $lang = app()->getLocale();
            $title = $title[$lang] ?? last($title);
        }
        if (is_string($title)) {
            $this->title = $title;
        }
        // $this->url = $this->getUrl();
        $this->categories = $this->getCategories();

        $this->closed_at_date = Carbon::parse($this->closed_at)->format('Y-m-d');

        Assert::notNull($article = Article::where('uuid', $this->uuid)->first(), '['.__LINE__.']['.__FILE__.']');
        // $this->betting_users = $article->getBettingUsers();
        $this->ratings = $article->getArrayRatingsWithImage();
        $this->time_left_for_humans = $article->getTimeLeftForHumans();
        // $this->volume_credit = $article->getVolumeCredit();
        $this->tags = $article->tags->map(fn ($tag) => $tag->name);
    }

    // public function getClosedAt(): string
    // {
    //     return $carbonDate = Carbon::parse($this->closed_at)->format('Y-m-d');
    // }

    // public function getTimeLeftForHumans(): string
    // {
    //     dddx('a');
    //     return $this->getArticle()->getTimeLeftForHumans();
    // }
    public function __toString(): string
    {
        return '['.__LINE__.']['.__FILE__.']';
    }

    public function getCategories(): Collection
    {
        return app(GetBloodline::class)->execute($this->category_id);

        // Assert::notNull($category = Category::find($this->category_id),'['.__LINE__.']['.__FILE__.']');

        // return $category->bloodline()->get()->reverse();
    }

    // public function getArticle(): Article
    // {
    //     Assert::notNull($article = Article::where('uuid', $this->uuid)->first(),'['.__LINE__.']['.__FILE__.']');

    //     return $article;
    // }

    // public function getRatings(): array
    // {
    //     return $this->getArticle()->getArrayRatingsWithImage();
    // }

    // public function getBettingUsers(): int
    // {
    //     return $this->getArticle()->getBettingUsers();
    // }

    public function url(string $type): string
    {
        $lang = app()->getLocale();
        if ('show' === $type) {
            return '/'.$lang.'/article/'.$this->slug;
        }

        // if ('edit' == $type) { // NON ESISTE EDIT NEL FRONTEND !!!
        //    return '/'.$lang.'/article/'.$this->slug.'/edit';
        // }

        return '#';
    }

    /**
     * Create from array with type casting.
     *
     * @param array<string,mixed> $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            id: (string)($data['id'] ?? ''),
            uuid: (string)($data['uuid'] ?? ''),
            title: $data['title'] ?? '',
            slug: (string)($data['slug'] ?? ''),
            category_id: isset($data['category_id']) ? (int)$data['category_id'] : null,
            status: (string)($data['status'] ?? 'draft'),
            show_on_homepage: (bool)($data['show_on_homepage'] ?? false),
    
            // ✅ Cast Carbon -> string se necessario
            published_at: isset($data['published_at']) && $data['published_at'] instanceof Carbon
                ? $data['published_at']->toDateTimeString()
                : ($data['published_at'] ?? null),
    
            content_blocks: $data['content_blocks'] ?? null,
            sidebar_blocks: $data['sidebar_blocks'] ?? null,
            footer_blocks: $data['footer_blocks'] ?? null,
            categories: isset($data['categories']) ? collect($data['categories']) : null,
            url: $data['url'] ?? null,
            ratings: $data['ratings'] ?? null,
    
            closed_at: isset($data['closed_at']) && $data['closed_at'] instanceof Carbon
                ? $data['closed_at']->toDateTimeString()
                : ($data['closed_at'] ?? null),
    
            closed_at_date: $data['closed_at_date'] ?? null,
            time_left_for_humans: $data['time_left_for_humans'] ?? null,
            tags: isset($data['tags']) ? collect($data['tags']) : null,
    
            bet_end_date: isset($data['bet_end_date']) ? Carbon::parse($data['bet_end_date']) : null,
            event_start_date: isset($data['event_start_date']) ? Carbon::parse($data['event_start_date']) : null,
            event_end_date: isset($data['event_end_date']) ? Carbon::parse($data['event_end_date']) : null,
    
            category: $data['category'] ?? [],
            status_display: (string)($data['status_display'] ?? ''),
            is_wagerable: (bool)($data['is_wagerable'] ?? false),
            brier_score: (float)($data['brier_score'] ?? 0.0),
            brier_score_play_money: (float)($data['brier_score_play_money'] ?? 0.0),
            brier_score_real_money: (float)($data['brier_score_real_money'] ?? 0.0),
            wagers_count: (int)($data['wagers_count'] ?? 0),
            wagers_count_canonical: (int)($data['wagers_count_canonical'] ?? 0),
            wagers_count_total: (int)($data['wagers_count_total'] ?? 0),
            wagers: $data['wagers'] ?? [],
            volume_play_money: (float)($data['volume_play_money'] ?? 0.0),
            volume_real_money: (float)($data['volume_real_money'] ?? 0.0),
            outcomes: $data['outcomes'] ?? [],
            thumbnail_2x: $data['thumbnail_2x'] ?? null,
        );
    }
    
}