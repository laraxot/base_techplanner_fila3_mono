<?php

declare(strict_types=1);

namespace Modules\Predict\Models;

use Modules\Blog\Models\Banner as BaseBanner;

/**
 * @property string                                                                                                     $id
 * @property string|null                                                                                                $link
 * @property string|null                                                                                                $title
 * @property string|null                                                                                                $description
 * @property string|null                                                                                                $action_text
 * @property string|null                                                                                                $category_id
 * @property \Illuminate\Support\Carbon|null                                                                            $start_date
 * @property \Illuminate\Support\Carbon|null                                                                            $end_date
 * @property bool                                                                                                       $hot_topic
 * @property int|null                                                                                                   $open_markets_count
 * @property bool                                                                                                       $landing_banner
 * @property \Illuminate\Support\Carbon|null                                                                            $created_at
 * @property \Illuminate\Support\Carbon|null                                                                            $updated_at
 * @property string|null                                                                                                $updated_by
 * @property string|null                                                                                                $created_by
 * @property \Illuminate\Support\Carbon|null                                                                            $deleted_at
 * @property string|null                                                                                                $deleted_by
 * @property int|null                                                                                                   $pos
 * @property \Modules\Blog\Models\Category|null                                                                         $category
 * @property \Modules\Blog\Models\Profile|null                                                                          $creator
 * @property string                                                                                                     $desktop_thumbnail
 * @property string                                                                                                     $desktop_thumbnail_webp
 * @property string                                                                                                     $mobile_thumbnail
 * @property string                                                                                                     $mobile_thumbnail_webp
 * @property \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, \Modules\Media\Models\Media> $media
 * @property int|null                                                                                                   $media_count
 * @property \Modules\Blog\Models\Profile|null                                                                          $updater
 *
 * @method static \Modules\Predict\Database\Factories\BannerFactory    factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Banner newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Banner newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Banner onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Banner query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Banner whereActionText($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Banner whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Banner whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Banner whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Banner whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Banner whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Banner whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Banner whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Banner whereHotTopic($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Banner whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Banner whereLandingBanner($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Banner whereLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Banner whereOpenMarketsCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Banner wherePos($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Banner whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Banner whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Banner whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Banner whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Banner withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Banner withoutTrashed()
 *
 * @mixin \Eloquent
 */
class Banner extends BaseBanner
{
    /** @var string */
    protected $connection = 'predict'; // this will use the specified database connection
}
