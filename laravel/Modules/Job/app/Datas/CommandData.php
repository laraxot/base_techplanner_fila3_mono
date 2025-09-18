<?php

declare(strict_types=1);

namespace Modules\Job\Datas;

use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\Collection;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

class CommandData extends Data
{
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
    public function __construct(): void {}
=======
=======
>>>>>>> 2e199498 (.)
=======
>>>>>>> eaeb6531 (.)
    public function __construct(
        public string $name,
        public string $description,
        public string $signature,
        public string $full_name,
        public array $arguments,
        public array $options,
    ) {}
<<<<<<< HEAD
<<<<<<< HEAD
>>>>>>> de0f89b5 (.)
=======
>>>>>>> 2e199498 (.)
=======
>>>>>>> eaeb6531 (.)

    public static function collection(EloquentCollection|Collection|array $data): DataCollection
    {
        return self::collect($data, DataCollection::class);
    }
}
