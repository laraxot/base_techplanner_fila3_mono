<?php

declare(strict_types=1);

namespace Modules\UI\Datas;

use Spatie\LaravelData\Data;

class SliderData extends Data
{
    public function __construct(
        public ?string $desktop_thumbnail,
        public ?string $mobile_thumbnail,
        public ?string $desktop_thumbnail_webp,
        public ?string $mobile_thumbnail_webp,
        public ?string $link,
        public ?string $title,
        public ?string $short_description,
        public ?string $description,
        public ?string $action_text,
    ) {
        $this->short_description = $this->description;
    }

        /**
     * Create from array with type casting.
     *
     * @param array<string,mixed> $data
     */
    public static function fromArray(array $data): self
    {
        // dddx($data);
        return new self(
            desktop_thumbnail: $data['desktop_thumbnail'] ?? null,
            mobile_thumbnail: $data['mobile_thumbnail'] ?? null,
            desktop_thumbnail_webp: $data['desktop_thumbnail_webp'] ?? null,
            mobile_thumbnail_webp: $data['mobile_thumbnail_webp'] ?? null,
            link: $data['link'] ?? null,
            title: $data['title'] ?? null,
            short_description: $data['description'] ?? null, // viene sovrascritto nel costruttore
            description: $data['description'] ?? null,
            action_text: $data['action_text'] ?? null,
        );
    }
}
