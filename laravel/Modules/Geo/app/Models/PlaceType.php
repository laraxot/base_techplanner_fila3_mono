<?php

declare(strict_types=1);

namespace Modules\Geo\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * PlaceType model for geographical place types.
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PlaceType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PlaceType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PlaceType query()
 * @mixin \Eloquent
 */
class PlaceType extends Model
{
    /** @var list<string> */
    protected $fillable = [
        'name',
        'description',
    ];

    // Definisci le relazioni e i metodi necessari per la classe PlaceType
}
