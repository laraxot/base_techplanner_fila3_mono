<?php

declare(strict_types=1);

namespace Modules\Comment\Models;

use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Factories\Factory;
// ---------- traits
use Illuminate\Database\Eloquent\Factories\HasFactory;
// //use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Modules\Xot\Actions\Factory\GetFactoryAction;
use Modules\Xot\Traits\Updater;

/**
 * Class BaseModel.
 */
abstract class BaseModel extends Model
{
    use HasFactory;

    // use Searchable;
    // use Cachable;
    use Updater;

    /**
     * Indicates whether attributes are snake cased on arrays.
     *
     * @see  https://laravel-news.com/6-eloquent-secrets
     *
     * @var bool
     */
    public static $snakeAttributes = true;

    /**
     * @var int
     */
    protected $perPage = 30;

    /** @var string */
    protected $connection = 'comment';

    /** @return array<string, string> */
    protected function casts(): array
    {
        return [
            'published_at' => 'datetime', 'created_at' => 'datetime', 'updated_at' => 'datetime',
        ];
    }

    /** @var string */
    protected $primaryKey = 'id';

    /** @var bool */
    public $incrementing = true;

    /** @var list<string> */
    protected $hidden = [
        // 'password'
    ];

    /** @var bool */
    public $timestamps = true;

    /**
     * Create a new factory instance for the model.
     *
     * @return Factory
     */
    protected static function newFactory()
    {
        return app(GetFactoryAction::class)->execute(static::class);
    }
}
