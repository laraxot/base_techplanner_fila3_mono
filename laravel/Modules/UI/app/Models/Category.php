<?php

declare(strict_types=1);

namespace Modules\UI\Models;

use Modules\FormBuilder\Models\Category as BaseCategory;

/**
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \LaraZeus\Bolt\Models\Form> $forms
 * @property-read int|null $forms_count
 * @property-read string $last_updated
 * @property-read mixed $logo_url
 * @property-read mixed $translations
 *
 * @method static \LaraZeus\Bolt\Database\Factories\CategoryFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category whereJsonContainsLocale(string $column, string $locale, ?mixed $value, string $operand = '=')
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category whereJsonContainsLocales(string $column, array $locales, ?mixed $value, string $operand = '=')
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category whereLocale(string $column, string $locale)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category whereLocales(string $column, array $locales)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category withoutTrashed()
 * @method static Category|null first()
 * @method static \Illuminate\Database\Eloquent\Collection<int, Category> get()
 * @method static Category create(array $attributes = [])
 * @method static Category firstOrCreate(array $attributes = [], array $values = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category where(string|\Closure $column, mixed $operator = null, mixed $value = null, string $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category whereNotNull(string|\Illuminate\Contracts\Database\Query\Expression $columns)
 * @method static int count(string $columns = '*')
 *
 * @mixin \Eloquent
 */
class Category extends BaseCategory
{
    // Proxy alias to satisfy Laravel namespacing within UI module
}
