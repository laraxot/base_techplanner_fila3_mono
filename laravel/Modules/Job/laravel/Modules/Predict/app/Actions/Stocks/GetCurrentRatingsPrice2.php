<?php

declare(strict_types=1);

namespace Modules\Predict\Actions\Stocks;

use Modules\Predict\Models\Predict;
use Modules\Rating\Models\RatingMorph;
use Webmozart\Assert\Assert;

// funzione 4 preso da laravel\Modules\Predict\docs\demo.md
// Funzione che calcola il costo corrente di ogni ratings
// outstanding == somma totale crediti scommessi di tutti gli utenti di un'opzione
// liq == parametro di liquidità (b) impostato all'inizio
class GetCurrentRatingsPrice2
{
    /**
     * @param string|float $liq
     */
    public function execute(array $rating_opts, array $outstanding, $liq): array
    {
        // dddx([
        //     $rating_opts,
        //     $outstanding,
        //     $liq
        // ]);
        // $result = [];
        // $outstanding = [];
        // results ha tanti elementi a 0.0 quante sono le opzioni
        // $result = array(0.0, 0.0);
        // Assert::notNull($article = Predict::find($article_id));
        // $opzioni = $article->ratings()->where('user_id', null)
        //     ->get()
        //     ->pluck('id')
        //     // ->take(2)

        // $ratings_morph = RatingMorph::where('model_type', 'article')->get();
        // foreach ($rating_opts as $index) {
        //     // dddx($index);
        //     $result[$index] = 0.0;
        //     // $tmp = RatingMorph::where('model_type', 'article')
        //     $tmp = $ratings_morph
        //             ->where('rating_id', $index)
        //             ->sum('value');
        //     $outstanding[$index] = $tmp;
        // }
        // dddx([$opzioni, $outstanding]);
        // Calcola il costo per un'azione per entrambi gli indici
        // $result[0] = costOfTrans($outstanding, 0, 1, $liq);
        // $result[1] = costOfTrans($outstanding, 1, 1, $liq);
        // ...    =    ...
        // $result[n] = costOfTrans($outstanding, n, 1, $liq);
        foreach ($rating_opts as $index) {
            $result[$index] = app(GetCostOfTrans::class)->execute($outstanding, (int) $index, 1, (float) $liq);
        }

        return $result;
    }
}
