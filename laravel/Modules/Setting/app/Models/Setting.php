<?php

declare(strict_types=1);

namespace Modules\Setting\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * @property int                                                                                                        $id
 * @property string                                                                                                     $group
 * @property string                                                                                                     $name
 * @property int                                                                                                        $locked
 * @property string                                                                                                     $payload
 * @property \Illuminate\Support\Carbon|null                                                                            $created_at
 * @property \Illuminate\Support\Carbon|null                                                                            $updated_at
 * @property \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, \Modules\Media\Models\Media> $media
 * @property int|null                                                                                                   $media_count
 *
 * @method static \Modules\Setting\Database\Factories\SettingFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Setting      newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Setting      newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Setting      query()
 * @method static \Illuminate\Database\Eloquent\Builder|Setting      whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting      whereGroup($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting      whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting      whereLocked($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting      whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting      wherePayload($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting      whereUpdatedAt($value)
 *
 * @property \Modules\Xot\Contracts\ProfileContract|null $creator
 * @property \Modules\Xot\Contracts\ProfileContract|null $updater
 *
 * @mixin \Eloquent
 */
class Setting extends BaseModel implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [''];

    // use HasUuids;
}
