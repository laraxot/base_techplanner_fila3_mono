<?php

declare(strict_types=1);

namespace Modules\TechPlanner\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Modules\TechPlanner\Models\JobRole;

// * @property Collection|ProductContract[]   $products

/**
 * Modules\TechPlanner\Contracts\PivotContract.
 *
 * @property string|null $title
 * @property string|null $subtitle
 * @property string|null $price
 * @property string|null $price_currency
 * @property int|null $status
 * @property Collection|JobRole[] $jobRoles
 *
 * @method Collection|JobRole[] jobRoles()
 */
interface PivotContract {}
