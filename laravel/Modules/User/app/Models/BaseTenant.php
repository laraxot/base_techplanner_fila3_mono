<?php

declare(strict_types=1);

namespace Modules\User\Models;

use Filament\Models\Contracts\HasAvatar;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;
use Modules\User\Contracts\TenantContract;
use Modules\Xot\Contracts\UserContract;
use Modules\Xot\Datas\XotData;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

/**
 * Modules\User\Models\Tenant.
 *
 * @method static \Modules\User\Database\Factories\TenantFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Tenant newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tenant newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tenant query()
 *
 * @property EloquentCollection<int, Model&UserContract> $members
 * @property int|null $members_count
 * @property \Modules\Xot\Contracts\ProfileContract|null $creator
 * @property \Modules\Xot\Contracts\ProfileContract|null $updater
 *
 * @mixin \Eloquent
 */
abstract class BaseTenant extends BaseModel implements HasAvatar, HasMedia, TenantContract
{
    use HasSlug;
    use InteractsWithMedia;

    /** @var list<string> */
    protected $fillable = [
        'id',
        'name',
        'slug',
        'email_address',
        'phone',
        'mobile',
        'address',
        'primary_color',
        'secondary_color',
    ];

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    /**
     * Ottiene tutti i membri associati al tenant.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany<\Illuminate\Database\Eloquent\Model, \Modules\User\Models\BaseTenant>
     */
    public function members(): BelongsToMany
    {
        /** @var class-string<\Illuminate\Database\Eloquent\Model> $user_class */
        $user_class = XotData::make()->getUserClass();

        return $this->belongsToManyX($user_class);
    }

    /**
     * Ottiene tutti gli utenti associati al tenant.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany<\Illuminate\Database\Eloquent\Model, \Modules\User\Models\BaseTenant>
     */
    public function users(): BelongsToMany
    {
        $xot = XotData::make();
        /** @var class-string<\Illuminate\Database\Eloquent\Model> $userClass */
        $userClass = $xot->getUserClass();

        // $this->setConnection('mysql');
        return $this->belongsToManyX($userClass, null, 'tenant_id', 'user_id');
        // ->as('membership')
    }

    /**
     * Ottiene l'URL dell'avatar del tenant per Filament.
     *
     * @return string|null URL dell'avatar o null se non presente
     */
    public function getFilamentAvatarUrl(): ?string
    {
        // return $this->avatar_url;
        return $this->getFirstMediaUrl('avatar');
    }

    // public function getSlugAttribute(?string $value): ?string
    // {
    //     if(is_string($value) || $this->getKey() == null) {
    //         return $value;
    //     }
    //     $slug = Str::slug($this->name);
    //     $this->slug = $slug;
    //     $this->save();

    //     return $slug;
    // }
}
