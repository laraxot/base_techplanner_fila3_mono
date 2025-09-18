<?php

declare(strict_types=1);

namespace Modules\Predict\Actions\Stocks;

use Modules\Predict\Models\Predict;
use Modules\Rating\Models\RatingMorph;
use Webmozart\Assert\Assert;

// funzione 1 preso da laravel\Modules\Predict\docs\demo.md
// Funzione che calcola la probabilità di vittoria di ciascun evento
// outstanding == somma totale crediti scommessi di tutti gli utenti di un'opzione
// liq == parametro di liquidità (b) impostato all'inizio
class GetProbabilityOfRatingsVictory
{
    // public function execute(array $outstanding, float $liq, int $article_id): array
    /**
     * @param string|float $liq
     */
    public function execute($liq, string $article_id): array
    {
        $result = [];
        $outstanding = [];
        Assert::notNull($article = Predict::find($article_id));
        // results ha tanti elementi a 0.0 quante sono le opzioni
        $opzioni = $article->ratings()->where('user_id', null)
            ->get()
            ->pluck('id')
            // ->take(2)
        ;
        $ratings_morph = RatingMorph::where('model_type', 'article')->get();
        foreach ($opzioni as $index) {
            $result[$index] = 0.0;
            // $tmp = RatingMorph::where('model_type', 'article')
            $tmp = $ratings_morph
                    ->where('rating_id', $index)
                    ->sum('value');
            $outstanding[$index] = $tmp;
        }
        // $result = array(0.0, 0.0);
        $denom = 0.0;

        // Calcola il denominatore
        // for ($i = 0; $i < 2; ++$i) {
        //     $denom += exp($outstanding[$i] / $liq);
        // }

        foreach ($outstanding as $os) {
            $denom += exp((float) $os / (float) $liq);
        }

        // Calcola le probabilità
        // for ($i = 0; $i < 2; ++$i) {
        //     $result[$i] = exp($outstanding[$i] / $liq) / $denom;
        // }
        foreach ($outstanding as $key => $os) {
            $result[$key] = exp((float) $os / (float) $liq) / $denom;
        }
        // dddx([$opzioni, $result, $denom]);

        return $result;
    }
}
