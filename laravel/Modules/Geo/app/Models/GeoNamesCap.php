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
<<<<<<< HEAD
<<<<<<< HEAD
 * @property \Modules\Xot\Contracts\ProfileContract|null $creator
 * @property \Modules\Xot\Contracts\ProfileContract|null $updater
=======
=======
>>>>>>> 0e7ec50 (.)
 *
 * @property \Modules\Xot\Contracts\ProfileContract|null $creator
 * @property \Modules\Xot\Contracts\ProfileContract|null $updater
 *
<<<<<<< HEAD
>>>>>>> 008ac07 (Merge commit 'b61ed6096ef292b50d6f8751d28a19fbee500bc4' as 'laravel/Modules/Geo')
=======
=======
 * @property \Modules\Xot\Contracts\ProfileContract|null $creator
 * @property \Modules\Xot\Contracts\ProfileContract|null $updater
>>>>>>> 3c5e1ea (.)
>>>>>>> 0e7ec50 (.)
=======
 * @property \Modules\Xot\Contracts\ProfileContract|null $creator
 * @property \Modules\Xot\Contracts\ProfileContract|null $updater
>>>>>>> 6f0eea5 (.)
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
<<<<<<< HEAD
<<<<<<< HEAD
        $this->setConnection('user');
=======
        $this->setConnection('liveuser_general');
>>>>>>> 008ac07 (Merge commit 'b61ed6096ef292b50d6f8751d28a19fbee500bc4' as 'laravel/Modules/Geo')
=======
        $this->setConnection('liveuser_general');
=======
        $this->setConnection('user');
>>>>>>> 3c5e1ea (.)
>>>>>>> 0e7ec50 (.)
=======
        $this->setConnection('user');
>>>>>>> 6f0eea5 (.)
        parent::__construct();
    }//end construct
    */
}
