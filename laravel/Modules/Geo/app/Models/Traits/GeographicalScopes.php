<?php

declare(strict_types=1);

namespace Modules\Geo\Models\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\Expression;
use Modules\Xot\Actions\Geo\GetDistanceExpressionAction;

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

    /**
     * Genera l'espressione SQL per il calcolo della distanza usando l'action centralizzata.
     *
     * @param float $latitude Latitudine del punto di riferimento
     * @param float $longitude Longitudine del punto di riferimento
     * @param string|null $alias Alias per l'espressione (opzionale)
     * @return \Illuminate\Contracts\Database\Query\Expression Espressione SQL per il calcolo della distanza
     */
    public function getDistanceExpression(float $latitude, float $longitude, ?string $alias = null): \Illuminate\Contracts\Database\Query\Expression
    {
<<<<<<< HEAD
<<<<<<< HEAD
        $sql = "
            (6371 * acos(
                cos(radians($latitude)) *
                cos(radians(latitude)) *
                cos(radians(longitude) - radians($longitude)) +
                sin(radians($latitude)) *
                sin(radians(latitude))
<<<<<<< HEAD
<<<<<<< HEAD
            ))
=======
            )) 
>>>>>>> 008ac07 (Merge commit 'b61ed6096ef292b50d6f8751d28a19fbee500bc4' as 'laravel/Modules/Geo')
=======
            )) 
=======
            ))
>>>>>>> 3c5e1ea (.)
>>>>>>> 0e7ec50 (.)
        ";
        if (null !== $alias) {
            $sql .= " AS $alias";
        }

        return \DB::raw($sql);
        // AS distance
=======
=======
>>>>>>> 6f0eea5 (.)
        return app(GetDistanceExpressionAction::class)->execute($latitude, $longitude, $alias);
    }
}
