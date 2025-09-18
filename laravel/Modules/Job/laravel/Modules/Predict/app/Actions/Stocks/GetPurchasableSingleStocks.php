<?php

declare(strict_types=1);

namespace Modules\Predict\Actions\Stocks;

// funzione 5 preso da laravel\Modules\Predict\docs\demo.md
// Funzione per calcolare il numero di azioni acquistabili di una opzione specifica dando l'importo che si intende scommettere (param $amount)
// outstanding == somma totale crediti scommessi di tutti gli utenti di un'opzione
// liq == parametro di liquidità (b) impostato all'inizio
// idx == indice dell'opzione su cui l'utente vuole scommettere
// amout == somma che si vuole scommettere in quel momento
class GetPurchasableSingleStocks
{
    /**
     * @param string|float $liq
     *
     * @return array|int<0, max>
     */
    public function execute(array $outstanding, string $idx, float $amount, $liq)
    {
        $shares = 0;
        while (true) {
            $cost = app(GetCostOfTrans::class)->execute($outstanding, (int) $idx, $shares + 1, $liq);
            if ($cost > $amount) {
                break;
            }
            ++$shares;
        }

        return $shares;
    }
}
