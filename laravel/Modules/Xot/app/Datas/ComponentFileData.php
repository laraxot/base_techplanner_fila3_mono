<?php

declare(strict_types=1);

namespace Modules\Xot\Datas;

use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\Collection;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

/**
 * Undocumented class.
 */
class ComponentFileData extends Data
{
    public string $name;
<<<<<<< HEAD
    public string $class;
    public ?string $module = null;
    public ?string $path = null;
=======

    public string $class;

    public ?string $module = null;

    public ?string $path = null;

>>>>>>> 9d6070e (.)
    public ?string $ns = null;

    public static function collection(EloquentCollection|Collection|array $data): DataCollection
    {
        return self::collect($data, DataCollection::class);
<<<<<<< HEAD
        
=======
>>>>>>> 9d6070e (.)
    }
}
