<?php

declare(strict_types=1);

namespace Modules\Predict\Models;

use Modules\Blog\Models\Transaction as BaseTransaction;

/**
 * @property string                                                                                                     $id
 * @property string|null                                                                                                $model_type
 * @property int|null                                                                                                   $model_id
 * @property string                                                                                                     $credits
 * @property string|null                                                                                                $user_id
 * @property string|null                                                                                                $note
 * @property string|null                                                                                                $date
 * @property float|null                                                                                                 $stocks_count
 * @property float|null                                                                                                 $stocks_value
 * @property \Illuminate\Support\Carbon|null                                                                            $created_at
 * @property \Illuminate\Support\Carbon|null                                                                            $updated_at
 * @property string|null                                                                                                $updated_by
 * @property string|null                                                                                                $created_by
 * @property \Illuminate\Support\Carbon|null                                                                            $deleted_at
 * @property string|null                                                                                                $deleted_by
 * @property \Modules\Blog\Models\Profile|null                                                                          $creator
 * @property \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, \Modules\Media\Models\Media> $media
 * @property int|null                                                                                                   $media_count
 * @property \Modules\Blog\Models\Profile|null                                                                          $updater
 *
 * @method static \Modules\Predict\Database\Factories\TransactionFactory    factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transaction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transaction newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transaction onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transaction query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transaction whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transaction whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transaction whereCredits($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transaction whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transaction whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transaction whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transaction whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transaction whereModelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transaction whereModelType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transaction whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transaction whereStocksCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transaction whereStocksValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transaction whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transaction whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transaction whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transaction withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transaction withoutTrashed()
 *
 * @mixin \Eloquent
 */
class Transaction extends BaseTransaction
{
    /** @var string */
    protected $connection = 'predict'; // this will use the specified database connection
}
