<?php

declare(strict_types=1);

namespace Modules\Predict\Actions\Stocks;

// funzione 3 preso da laravel\Modules\Predict\docs\demo.md
// Funzione che calcola il costo di transazione per l'acquisto o la vendita di un titolo
// outstanding == somma totale crediti scommessi di tutti gli utenti di un'opzione
// liq == parametro di liquidità (b) impostato all'inizio
// utilizzata dentro Modules\Predict\Actions\Stocks\GetCurrentRatingsPrice.php
class GetCostOfTrans
{
    /**
     * @param string|float $liq
     */
    public function execute(array $outstanding, int $idx, int $nShares, $liq): float
    {
        $after = $outstanding;

        // Aggiorna il vettore "after"
        $after[$idx] += $nShares;

        return $this->cost($after, $liq) - $this->cost($outstanding, $liq);
    }

    // funzione 2 preso da laravel\Modules\Predict\docs\demo.md
    /**
     * @param string|float $liq
     */
    public function cost(array $outstanding, $liq): float
    {
        $sum = 0.0;

        // Calcola la somma esponenziale
        // for ($i = 0; $i < 2; ++$i) {
        //     $sum += exp($outstanding[$i] / $liq);
        // }
        foreach ($outstanding as $os) {
            $sum += exp($os / $liq);
        }

        return (float) $liq * log($sum);
    }
}
