<?php

declare(strict_types=1);

namespace Modules\UI\Models;

use Modules\FormBuilder\Models\Collection as BaseCollection;

/**
 * @property-read string $last_updated
 * @property-read string|null $values_list
 * @property-read \Modules\User\Models\User|null $user
 *
 * @method static \LaraZeus\Bolt\Database\Factories\CollectionFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Collection newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Collection newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Collection onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Collection query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Collection withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Collection withoutTrashed()
 * @method static Collection|null first()
 * @method static \Illuminate\Database\Eloquent\Collection<int, Collection> get()
 * @method static Collection create(array $attributes = [])
 * @method static Collection firstOrCreate(array $attributes = [], array $values = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Collection where(string|\Closure $column, mixed $operator = null, mixed $value = null, string $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Collection whereNotNull(string|\Illuminate\Contracts\Database\Query\Expression $columns)
 * @method static int count(string $columns = '*')
 *
 * @mixin \Eloquent
 */
class Collection extends BaseCollection
{
    // Proxy alias to satisfy Laravel namespacing within UI module
}
