<?php

declare(strict_types=1);

namespace Modules\Rating\App\DataObjects;

final readonly class RatingData
{
    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            title: $data['title'],
            score: (int) $data['score'],
            description: $data['description'] ?? null,
            userId: $data['user_id'] ?? null
        );
    }

    public function __construct(
        public string $title,
        public int $score,
        public ?string $description = null,
        public ?string $userId = null,
    ) {
        if ($score < 0 || $score > 5) {
            throw new \InvalidArgumentException('Score must be between 0 and 5');
        }
    }
}
