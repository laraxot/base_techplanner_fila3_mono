<?php

declare(strict_types=1);

namespace Modules\Lang\Models;

// //use Laravel\Scout\Searchable;
// ---------- traits
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Lang\Models\Traits\LinkedTrait;
use Modules\Xot\Actions\Factory\GetFactoryAction;
use Modules\Xot\Traits\Updater;

/**
 * Class BaseModelLang.
 *
 * @property string $id
 * @property string|null $uuid
 * @property \Illuminate\Support\Carbon|null $published_at
 * @property \Illuminate\Support\Carbon|null $verified_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property string|null $updated_by
 * @property string|null $created_by
 * @property string|null $deleted_by
 * @property string|null $post_type
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModelLang newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModelLang newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModelLang query()
 * @mixin \Eloquent
 */
abstract class BaseModelLang extends Model
{
    use HasFactory;

    // use Searchable;
    use LinkedTrait;
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

    /** @var string */
    protected $connection = 'lang';

    /** @var list<string> */
    protected $fillable = ['id'];

    /** @var string */
    protected $primaryKey = 'id';

    /** @var string */
    protected $keyType = 'string';

    /** @var list<string> */
    protected $hidden = [
        // 'password'
    ];

    // -----------
    /*
    protected $id;
    protected $post;
    protected $lang;
    */
    /**
     * Create a new factory instance for the model.
     *
     * @return Factory
     */
    protected static function newFactory(): Factory
    {
        return app(GetFactoryAction::class)->execute(static::class);
    }

    /**
     * @return array<string, string> */
    protected function casts(): array
    {
        return [
            'id' => 'string',
            'uuid' => 'string', 'published_at' => 'datetime', 'created_at' => 'datetime', 'updated_at' => 'datetime'];
    }
}
