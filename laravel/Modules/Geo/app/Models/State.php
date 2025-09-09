<?php

declare(strict_types=1);

namespace Modules\Geo\Models;

use Illuminate\Database\Eloquent\Model;

use Modules\Xot\Contracts\ProfileContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @method static \Illuminate\Database\Eloquent\Builder|State newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|State newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|State query()
 * @property-read ProfileContract|null $creator
 * @property-read ProfileContract|null $updater
 * @mixin IdeHelperState
 * @method static \Modules\Geo\Database\Factories\StateFactory factory($count = null, $state = [])
 * @mixin \Eloquent
 */
class State extends BaseModel
{
    use HasFactory;

    /**
     * Create a new factory instance for the model.
     *
     * @return \Modules\Geo\Database\Factories\StateFactory
     */
    protected static function newFactory(): \Modules\Geo\Database\Factories\StateFactory
    {
        return \Modules\Geo\Database\Factories\StateFactory::new();
    }

    protected $fillable = [
        'state',
        'state_code',
    ];
}
