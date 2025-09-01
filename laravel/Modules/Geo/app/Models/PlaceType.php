<?php

declare(strict_types=1);

namespace Modules\Geo\Models;

/**
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PlaceType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PlaceType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PlaceType query()
 *
 * @property-read \Modules\SaluteOra\Models\Profile|null $creator
 * @property-read \Modules\SaluteOra\Models\Profile|null $updater
 *
 * @mixin IdeHelperPlaceType
 * @mixin \Eloquent
 */
class PlaceType extends BaseModel
{
    protected $fillable = [
        'name',
        'description',
    ];

    // Definisci le relazioni e i metodi necessari per la classe PlaceType
}
