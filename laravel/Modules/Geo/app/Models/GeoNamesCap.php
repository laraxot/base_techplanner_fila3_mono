<?php

declare(strict_types=1);

namespace Modules\Geo\Models;

use Illuminate\Database\Eloquent\Model;
// //use Laravel\Scout\Searchable;
use Modules\Xot\Traits\Updater;

/**
 * Modules\Geo\Models\GeoNamesCap.
 *
 * @method static \Illuminate\Database\Eloquent\Builder|GeoNamesCap newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GeoNamesCap newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GeoNamesCap query()
<<<<<<< HEAD
 *
 * @property \Modules\Xot\Contracts\ProfileContract|null $creator
 * @property \Modules\Xot\Contracts\ProfileContract|null $updater
 *
=======
 * @property \Modules\Xot\Contracts\ProfileContract|null $creator
 * @property \Modules\Xot\Contracts\ProfileContract|null $updater
>>>>>>> 3c5e1ea (.)
 * @mixin \Eloquent
 */
class GeoNamesCap extends Model
{
    // use Searchable;
    use Updater;

    /** @var string */
    protected $table = 'geonames_cap';
    // protected $connection = 'geo';

    /*
     * { function_description }
     *
     */
    /*
    function __construct(){
<<<<<<< HEAD
        $this->setConnection('liveuser_general');
=======
        $this->setConnection('user');
>>>>>>> 3c5e1ea (.)
        parent::__construct();
    }//end construct
    */
}
