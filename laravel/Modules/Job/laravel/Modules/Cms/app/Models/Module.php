<?php

declare(strict_types=1);

namespace Modules\Cms\Models;

use Modules\Cms\Database\Factories\ModuleFactory;
use Modules\Xot\Contracts\ProfileContract;
use Nwidart\Modules\Facades\Module as NwModule;
use Nwidart\Modules\Laravel\Module as LaravelModule;
use Sushi\Sushi;
use Webmozart\Assert\Assert;

/**
 * Modules\Cms\Models\Module.
 *
 * @property int                  $id
 * @property string|null          $name
 * @property ProfileContract|null $creator
 * @property ProfileContract|null $updater
 *
 * @method static ModuleFactory                                factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Module newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Module newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Module query()
 * @method static \Illuminate\Database\Eloquent\Builder|Module whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Module whereName($value)
 *
 * @mixin IdeHelperModule
 * @mixin \Eloquent
 */
class Module extends BaseModel
{
    use Sushi;

    /** @var list<string> */
    protected $fillable = [
        'id', 'name',
    ];

    public function getRows(): array
    {
        $modules = NwModule::getByStatus(1);
        $rows = [];
        $i = 1;
        foreach ($modules as $module) {
            Assert::isInstanceOf($module, LaravelModule::class);
            $tmp = [
                'id' => $i++,
                'name' => $module->getName(),
            ];
            $rows[] = $tmp;
        }

        return $rows;
    }

    /**
     * Undocumented function.
     */
    public function getRouteKeyName(): string
    {
        return 'id';
    }
}
