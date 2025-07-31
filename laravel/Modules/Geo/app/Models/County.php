<?php

declare(strict_types=1);

namespace Modules\Geo\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * County model for geographical counties.
 *
 * @method static \Illuminate\Database\Eloquent\Builder|County newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|County newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|County query()
 * @mixin \Eloquent
 */
class County extends Model
{
    /** @var list<string> */
    protected $fillable = [
        'state_id',
        'county',
        'state_index',
    ];
}
