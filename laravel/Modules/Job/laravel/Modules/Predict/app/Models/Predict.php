<?php

declare(strict_types=1);

namespace Modules\Predict\Models;

use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Arr;
use Modules\Blog\Models\Article;
use Modules\Predict\Actions\Article\GetOutstanding;
use Modules\Predict\Actions\Stocks\GetCurrentRatingsPrice;
use Modules\Rating\Models\RatingMorph;
use Parental\HasParent;

/**
 * @property float                                                                                                      $stocks_value
 * @property string                                                                                                     $id
 * @property array                                                                                                      $title
 * @property string|null                                                                                                $content
 * @property string|null                                                                                                $picture
 * @property int|null                                                                                                   $category_id
 * @property int|null                                                                                                   $author_id
 * @property string|null                                                                                                $status
 * @property int                                                                                                        $show_on_homepage
 * @property int|null                                                                                                   $read_time
 * @property string                                                                                                     $slug
 * @property string|null                                                                                                $excerpt
 * @property \Illuminate\Support\Carbon|null                                                                            $published_at
 * @property \Illuminate\Support\Carbon|null                                                                            $created_at
 * @property \Illuminate\Support\Carbon|null                                                                            $updated_at
 * @property \Illuminate\Support\Carbon|null                                                                            $deleted_at
 * @property array                                                                                                      $content_blocks
 * @property array                                                                                                      $sidebar_blocks
 * @property array                                                                                                      $footer_blocks
 * @property string|null                                                                                                $main_image_url
 * @property string|null                                                                                                $main_image_upload
 * @property int                                                                                                        $is_featured
 * @property string                                                                                                     $description
 * @property string                                                                                                     $uuid
 * @property \Carbon\Carbon                                                                                             $closed_at
 * @property int                                                                                                        $status_display
 * @property string|null                                                                                                $bet_end_date
 * @property string|null                                                                                                $event_start_date
 * @property string|null                                                                                                $event_end_date
 * @property int                                                                                                        $is_wagerable
 * @property int|null                                                                                                   $wagers_count
 * @property int|null                                                                                                   $wagers_count_canonical
 * @property int|null                                                                                                   $wagers_count_total
 * @property int|null                                                                                                   $wagers
 * @property string|null                                                                                                $brier_score
 * @property string|null                                                                                                $brier_score_play_money
 * @property string|null                                                                                                $brier_score_real_money
 * @property float|null                                                                                                 $volume_play_money
 * @property float|null                                                                                                 $volume_real_money
 * @property int                                                                                                        $is_following
 * @property string|null                                                                                                $rewarded_at
 * @property string|null                                                                                                $type
 * @property string|null                                                                                                $updated_by
 * @property string|null                                                                                                $created_by
 * @property string|null                                                                                                $deleted_by
 * @property float|null                                                                                                 $stocks_count
 * @property \Modules\Blog\Models\Profile|null                                                                          $author
 * @property \Modules\Blog\Models\Category|null                                                                         $category
 * @property \Modules\Blog\Models\Profile|null                                                                          $creator
 * @property string                                                                                                     $human_read_time
 * @property string                                                                                                     $main_image
 * @property \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, \Modules\Media\Models\Media> $media
 * @property int|null                                                                                                   $media_count
 * @property \Illuminate\Database\Eloquent\Collection<int, Order>                                                       $orders
 * @property int|null                                                                                                   $orders_count
 * @property RatingMorph|null                                                                                           $pivot
 * @property \Illuminate\Database\Eloquent\Collection<int, \Modules\Rating\Models\Rating>                               $ratings
 * @property int|null                                                                                                   $ratings_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \Modules\Blog\Models\Tag>                                    $tags
 * @property int|null                                                                                                   $tags_count
 * @property mixed                                                                                                      $translations
 * @property \Modules\Blog\Models\Profile|null                                                                          $updater
 *
 * @method static EloquentBuilder<static>|Predict                       article(string $id)
 * @method static EloquentBuilder<static>|Predict                       author(string $profile_id)
 * @method static EloquentBuilder<static>|Predict                       category(string $id)
 * @method static EloquentBuilder<static>|Predict                       differentFromCurrentArticle(string $current_article)
 * @method static \Modules\Predict\Database\Factories\PredictFactory    factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Predict newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Predict newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Predict onlyTrashed()
 * @method static EloquentBuilder<static>|Predict                       published()
 * @method static EloquentBuilder<static>|Predict                       publishedUntilToday()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Predict query()
 * @method static EloquentBuilder<static>|Predict                       search(string $searching)
 * @method static EloquentBuilder<static>|Predict                       showHomepage()
 * @method static EloquentBuilder<static>|Predict                       tag(string $id)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Predict whereAuthorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Predict whereBetEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Predict whereBrierScore($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Predict whereBrierScorePlayMoney($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Predict whereBrierScoreRealMoney($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Predict whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Predict whereClosedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Predict whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Predict whereContentBlocks($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Predict whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Predict whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Predict whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Predict whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Predict whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Predict whereEventEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Predict whereEventStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Predict whereExcerpt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Predict whereFooterBlocks($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Predict whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Predict whereIsFeatured($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Predict whereIsFollowing($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Predict whereIsWagerable($value)
 * @method static EloquentBuilder<static>|Predict                       whereJsonContainsLocale(string $column, string $locale, ?mixed $value, string $operand = '=')
 * @method static EloquentBuilder<static>|Predict                       whereJsonContainsLocales(string $column, array $locales, ?mixed $value, string $operand = '=')
 * @method static EloquentBuilder<static>|Predict                       whereLocale(string $column, string $locale)
 * @method static EloquentBuilder<static>|Predict                       whereLocales(string $column, array $locales)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Predict whereMainImageUpload($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Predict whereMainImageUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Predict wherePicture($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Predict wherePublishedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Predict whereReadTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Predict whereRewardedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Predict whereShowOnHomepage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Predict whereSidebarBlocks($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Predict whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Predict whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Predict whereStatusDisplay($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Predict whereStocksCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Predict whereStocksValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Predict whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Predict whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Predict whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Predict whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Predict whereUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Predict whereVolumePlayMoney($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Predict whereVolumeRealMoney($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Predict whereWagers($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Predict whereWagersCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Predict whereWagersCountCanonical($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Predict whereWagersCountTotal($value)
 * @method static EloquentBuilder<static>|Predict                       withAllTags(\ArrayAccess|\Spatie\Tags\Tag|array|string $tags, ?string $type = null)
 * @method static EloquentBuilder<static>|Predict                       withAllTagsOfAnyType($tags)
 * @method static EloquentBuilder<static>|Predict                       withAnyTags(\ArrayAccess|\Spatie\Tags\Tag|array|string $tags, ?string $type = null)
 * @method static EloquentBuilder<static>|Predict                       withAnyTagsOfAnyType($tags)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Predict withTrashed()
 * @method static EloquentBuilder<static>|Predict                       withoutTags(\ArrayAccess|\Spatie\Tags\Tag|array|string $tags, ?string $type = null)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Predict withoutTrashed()
 *
 * @property \Modules\User\Models\User|null $user
 *
 * @mixin \Eloquent
 */
class Predict extends Article
{
    use HasParent;

    /** @var string */
    protected $connection = 'predict'; // this will use the specified database connection

    protected $fillable = [
        'uuid',
        'user_id',
        'title',
        'slug',
        // 'description',
        'body',
        'images',
        'viewCount',

        'content_blocks',
        'footer_blocks',
        'sidebar_blocks',
        'is_featured',
        'main_image_upload',
        'main_image_url',
        'published_at',
        'closed_at',
        'category_id',
        'type',
        // 'is_closed', => closet_at

        /*
        'title',
        'slug',
        'thumbnail',
        'body',
        'user_id',
        'active',
        'published_at',
        'meta_title',
        'meta_description',

         'author_id',
        'title',
        'slug',
        'content',
        'picture',
        'category_id',
        'status',
        'publish_date',
        'show_on_homepage',
        'author_name',
        'read_time',
        'excerpt',
        */
        'status',
        'status_display',
        'bet_end_date',
        'event_start_date',
        'event_end_date',
        'is_wagerable',
        'brier_score',
        'brier_score_play_money',
        'brier_score_real_money',
        'wagers_count',
        'wagers_count_canonical',
        'wagers_count_total',
        'wagers',
        'volume_play_money',
        'volume_real_money',
        'is_following',
        'rewarded_at',
        'stocks_count', // liquidità iniziale
        'stocks_value', // parametro di liquidità
    ];

    // public function impersonate($article) {
    //     dddx($article);
    // }

    public function orders(): MorphMany
    {
        return $this->morphMany(Order::class, 'model');
    }

    public function getBettingUsers(): int
    {
        return count(RatingMorph::where('model_id', $this->id)
            ->where('user_id', '!=', null)
            ->groupBy('user_id')
            ->get()
            ->toArray());
    }

    public function getVolumeCredit(?int $rating_id = null): float
    {
        $ratings = RatingMorph::where('model_id', $this->id)
            ->where('user_id', '!=', null);

        if (null !== $rating_id) {
            $ratings = $ratings->where('rating_id', $rating_id);
        }

        $ratings = $ratings->get();

        $tmp = 0;

        foreach ($ratings as $rating) {
            $tmp += $rating->value;
        }

        return (int) $tmp;
    }

    public function getRatingsPercentageByVolume(): array
    {
        $ratings_options = $this->getOptionRatingsIdTitle();
        $result = [];

        $total_volume = $this->getVolumeCredit();
        if (0 == $total_volume) {
            $total_volume = 1;
        }

        foreach ($ratings_options as $key => $value) {
            $result[$key] = round(($this->getVolumeCredit($key) * 100) / $total_volume, 0);
        }

        return $result;
    }

    // public function getArrayRatingsWithImage(): array
    // {
    //     $ratings = $this
    //         ->ratings()
    //     // ->with('media')
    //         ->where('user_id', null)
    //         ->get();
    //     // ->toArray()

    //     $ratings_array = [];

    //     foreach ($ratings as $key => $rating) {
    //         $ratings_array[$key] = $rating->toArray();
    //         if (empty($rating->getFirstMediaUrl('rating'))) {
    //             $rating->addMediaFromUrl('https://picsum.photos/id/'.random_int(1, 200).'/300/200')
    //                 ->toMediaCollection('rating');
    //         }
    //         $ratings_array[$key]['image'] = $rating->getFirstMediaUrl('rating');
    //         $ratings_array[$key]['effect'] = false;
    //     }

    //     return $ratings_array;
    // }

    // public function getOptionRatingsIdTitle(): array
    // {
    //     // return $this->ratings()->where('user_id', null)->get();
    //     return Arr::pluck($this->ratings()->where('user_id', null)->get()->toArray(), 'title', 'id');
    // }

    public function getOptionRatingsIdColor(): array
    {
        // return $this->ratings()->where('user_id', null)->get();
        return Arr::pluck($this->ratings()->where('user_id', null)->get()->toArray(), 'color', 'id');
    }

    // public function getRatingsPercentageByUser(): array
    // {
    //     $ratings_options = $this->getOptionRatingsIdTitle();
    //     $result = [];

    //     foreach ($ratings_options as $key => $value) {
    //         $b = RatingMorph::where('model_id', $this->id)
    //             ->where('user_id', '!=', null)
    //             ->count();

    //         if (0 === $b) {
    //             $b = 1;
    //         }

    //         $a = RatingMorph::where('model_id', $this->id)
    //             ->where('user_id', '!=', null)
    //             ->where('rating_id', $key)
    //             ->count();

    //         $result[$key] = round((100 * $a) / $b, 0);
    //     }

    //     return $result;
    // }

    public function getOutstanding(array $rating_opts): array
    {
        // dddx($rating_opts);
        // $rating_opts = array_keys(collect($this->getArrayRatingsWithImage())
        //         ->pluck('title', 'id')->toArray());

        // $ratings_morph = RatingMorph::where('model_type', 'article')->get();
        // $result = [];
        // foreach ($rating_opts as $index) {
        //     // $result[$index] = 0.0;
        //     // $tmp = RatingMorph::where('model_type', 'article')
        //     $tmp = $ratings_morph
        //             ->where('rating_id', $index)
        //             ->sum('value');
        //     $result[$index] = $tmp;
        // }

        // return $result;

        return app(GetOutstanding::class)->execute($rating_opts);
    }

    public function getCurrentPriceRatings(): array
    {
        return app(GetCurrentRatingsPrice::class)->execute($this->stocks_value, $this->id);
    }
}
