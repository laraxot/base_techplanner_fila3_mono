<?php

declare(strict_types=1);

namespace Modules\Xot\Actions\Cast;

/**
 * Action per convertire in modo sicuro un valore mixed in float.
 * 
 * Questa action centralizza la logica di cast sicuro per evitare duplicazioni
 * di codice (principio DRY) e garantire comportamento consistente in tutto il codebase.
 */
class SafeFloatCastAction
{
    /**
     * Converte in modo sicuro un valore mixed in float.
     *
     * @param mixed $value Il valore da convertire
     *
     * @return float Il valore convertito in float
     */
    public function execute(mixed $value): float
    {
        if (is_float($value)) {
            return $value;
        }
        
        if (is_int($value)) {
            return (float) $value;
        }
        
        if (is_string($value)) {
            if (is_numeric($value)) {
                return (float) $value;
            }
            return 0.0;
        }
        
        if (is_bool($value)) {
            return $value ? 1.0 : 0.0;
        }
        
        if (is_null($value)) {
            return 0.0;
        }
        
        // Per array, oggetti e altri tipi, restituisci 0.0
        return 0.0;
    }
    
    /**
     * Metodo statico di convenienza per chiamate dirette.
     *
     * @param mixed $value Il valore da convertire
     *
     * @return float Il valore convertito in float
     */
    public static function cast(mixed $value): float
    {
        return app(self::class)->execute($value);
    }
}
