<?php

declare(strict_types=1);

namespace Modules\Geo\Datas;

use Spatie\LaravelData\Data;

class CoordinatesData extends Data
{
<<<<<<< HEAD
    public float $latitude;

    public float $longitude;
=======
    public function __construct(
        public readonly float $latitude,
        public readonly float $longitude,
    ) {
    }
>>>>>>> 3c5e1ea (.)
}
