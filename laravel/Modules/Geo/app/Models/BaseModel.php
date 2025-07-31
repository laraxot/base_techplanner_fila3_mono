<?php

declare(strict_types=1);

namespace Modules\Geo\Models;

// use GeneaLabs\LaravelModelCaching\Traits\Cachable;
// //use Laravel\Scout\Searchable;

use Illuminate\Database\Eloquent\Model;
use Modules\Xot\Traits\Updater;

/**
 * Class BaseModel.
 */
abstract class BaseModel extends Model
{
    use Updater;

    /**
     * Indicates whether attributes are snake cased on arrays.
     *
     * @see  https://laravel-news.com/6-eloquent-secrets
     *
     * @var bool
     */
    public static $snakeAttributes = true;

    /** @var bool */
    public $incrementing = true;

    /** @var bool */
    public $timestamps = true;

    /** @var int */
    protected $perPage = 30;

    // use Searchable;
    // use Cachable;

    /** @var list<string> */
    protected $fillable = ['id'];

    /** @var array<string, string> */
    protected $casts = ['published_at' => 'datetime', 'created_at' => 'datetime', 'updated_at' => 'datetime'];

    /** @var string */
    protected $primaryKey = 'id';

    /** @var list<string> */
    protected $hidden = [
        // 'password'
    ];

    protected $connection = 'geo';
}
