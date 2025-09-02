<?php

declare(strict_types=1);

namespace Modules\Geo\Models\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\Expression;
use Modules\Geo\Actions\GetDistanceExpressionAction;

trait GeographicalScopes
{
    /**
     * Scope per calcolare la distanza tra due punti.
     */
    public function scopeWithDistance(Builder $query, float $latitude, float $longitude): Builder
    {
        return $query->select('*', $this->getDistanceExpression($latitude, $longitude, 'distance'));
    }

    /**
     * Scope per ordinare i risultati per distanza.
     */
    public function scopeOrderByDistance(Builder $query, float $latitude, float $longitude): Builder
    {
        return $query->orderBy($this->getDistanceExpression($latitude, $longitude));
    }

    public function getDistanceExpression(float $latitude, float $longitude, ?string $alias = null): Expression
    {
        return app(GetDistanceExpressionAction::class)->execute($latitude, $longitude, $alias);
    }
}
