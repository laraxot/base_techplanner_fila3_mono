<?php

declare(strict_types=1);

namespace Modules\Blog\DataObjects;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\DateTimeInterfaceCast;
use Spatie\LaravelData\Optional;
use Illuminate\Support\Carbon;
use Modules\Blog\Enums\ArticleStatus;

class ArticleData extends Data
{
    public function __construct(
        #[WithCast(DateTimeInterfaceCast::class)]
        public readonly ?Carbon $bet_end_date = null,
        
        #[WithCast(DateTimeInterfaceCast::class)]
        public readonly ?Carbon $event_start_date = null,
        
        #[WithCast(DateTimeInterfaceCast::class)]
        public readonly ?Carbon $event_end_date = null,
        
        /** @var array<int,array<string,mixed>> */
        public readonly array $category = [],
        
        public readonly string $title = '',
        public readonly string $slug = '',
        public readonly ArticleStatus $status = ArticleStatus::DRAFT,
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
    }

    /**
     * Create from array with type casting.
     *
     * @param array<string,mixed> $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            bet_end_date: isset($data['bet_end_date']) ? Carbon::parse($data['bet_end_date']) : null,
            event_start_date: isset($data['event_start_date']) ? Carbon::parse($data['event_start_date']) : null,
            event_end_date: isset($data['event_end_date']) ? Carbon::parse($data['event_end_date']) : null,
            category: $data['category'] ?? [],
            title: (string)($data['title'] ?? ''),
            slug: (string)($data['slug'] ?? ''),
            status: ArticleStatus::fromString((string)($data['status'] ?? 'draft')),
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