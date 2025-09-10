<?php

declare(strict_types=1);

namespace Modules\User\Models\Traits;

use Filament\Panel;
<<<<<<< HEAD
use Modules\Xot\Datas\XotData;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Modules\User\Contracts\TeamContract;
use Modules\Xot\Actions\Panel\ApplyTenancyToPanelAction;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Trait HasTenants
 * 
 * Provides tenant functionality for User models implementing multi-tenancy.
 * 
=======
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Collection;
use Modules\User\Contracts\TeamContract;
use Modules\Xot\Datas\XotData;

/**
 * Trait HasTenants
 *
 * Provides tenant functionality for User models implementing multi-tenancy.
 *
>>>>>>> 9831a351 (.)
 * @property TeamContract $currentTeam
 */
trait HasTenants
{
    /**
     * Check if the user can access a specific tenant.
<<<<<<< HEAD
     *
     * @param \Illuminate\Database\Eloquent\Model $tenant
     * @return bool
=======
>>>>>>> 9831a351 (.)
     */
    public function canAccessTenant(Model $tenant): bool
    {
        return $this->tenants()->whereKey($tenant)->exists();
    }

    /**
     * Get tenants for the given panel.
     *
<<<<<<< HEAD
     * @param \Filament\Panel $panel
=======
>>>>>>> 9831a351 (.)
     * @return array<\Illuminate\Database\Eloquent\Model>|\Illuminate\Support\Collection<int, \Illuminate\Database\Eloquent\Model>
     */
    public function getTenants(Panel $panel): array|Collection
    {
        /** @var \Illuminate\Support\Collection<int, \Illuminate\Database\Eloquent\Model> $tenants */
        $tenants = $this->tenants;
<<<<<<< HEAD
        
=======

>>>>>>> 9831a351 (.)
        return $tenants;
    }

    /**
     * Get all of the tenants the user belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany<\Illuminate\Database\Eloquent\Model, \Illuminate\Database\Eloquent\Relations\Pivot>
     */
    public function tenants(): BelongsToMany
    {
        $xot = XotData::make();
        /** @var class-string<\Illuminate\Database\Eloquent\Model> */
        $tenant_class = $xot->getTenantClass();

        return $this->belongsToManyX($tenant_class);
    }
}
