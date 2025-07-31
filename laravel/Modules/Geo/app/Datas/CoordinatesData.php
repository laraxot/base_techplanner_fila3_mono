<?php

declare(strict_types=1);

namespace Modules\Geo\Datas;

use Spatie\LaravelData\Data;

/**
 * DTO per le coordinate geografiche.
 */
class CoordinatesData extends Data
{
    public function __construct(
        public readonly float $latitude,
        public readonly float $longitude,
    ) {
    }
}
