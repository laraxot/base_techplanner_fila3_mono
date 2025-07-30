<?php

declare(strict_types=1);

namespace Modules\Geo\Models;

use Illuminate\Database\Eloquent\Model;

<<<<<<< HEAD
=======
/**
 * 
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PlaceType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PlaceType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PlaceType query()
 * @mixin \Eloquent
 */
>>>>>>> 3c5e1ea (.)
class PlaceType extends Model
{
    protected $fillable = [
        'name',
        'description',
    ];

    // Definisci le relazioni e i metodi necessari per la classe PlaceType
}
