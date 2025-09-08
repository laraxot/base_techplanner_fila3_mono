<?php

declare(strict_types=1);

namespace Modules\UI\Models;

use Modules\FormBuilder\Models\FieldOption as BaseFieldOption;

/**
 * @property-read \Modules\Predict\Models\Profile|null $creator
 * @property-read mixed $translations
 * @property-read \Modules\Predict\Models\Profile|null $updater
 *
 * @method static \Modules\UI\Database\Factories\FieldOptionFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FieldOption newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FieldOption newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FieldOption query()
 * @method static Builder<static>|FieldOption whereJsonContainsLocale(string $column, string $locale, ?mixed $value, string $operand = '=')
 * @method static Builder<static>|FieldOption whereJsonContainsLocales(string $column, array $locales, ?mixed $value, string $operand = '=')
 * @method static Builder<static>|FieldOption whereLocale(string $column, string $locale)
 * @method static Builder<static>|FieldOption whereLocales(string $column, array $locales)
 * @method static FieldOption|null first()
 * @method static \Illuminate\Database\Eloquent\Collection<int, FieldOption> get()
 * @method static FieldOption create(array $attributes = [])
 * @method static FieldOption firstOrCreate(array $attributes = [], array $values = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FieldOption where(string|\Closure $column, mixed $operator = null, mixed $value = null, string $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FieldOption whereNotNull(string|\Illuminate\Contracts\Database\Query\Expression $columns)
 * @method static int count(string $columns = '*')
 *
 * @mixin \Eloquent
 */
class FieldOption extends BaseFieldOption
{
    // Proxy alias to satisfy Laravel namespacing within UI module
}
