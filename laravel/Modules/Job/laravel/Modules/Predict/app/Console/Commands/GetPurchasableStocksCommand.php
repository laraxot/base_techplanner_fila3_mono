<?php

declare(strict_types=1);

namespace Modules\Predict\Console\Commands;

use Illuminate\Console\Command;
use Modules\Predict\Actions\Stocks\GetPurchasableStocks;
use Modules\Predict\Models\Predict;
use Modules\Rating\Models\RatingMorph;
use Webmozart\Assert\Assert;

class GetPurchasableStocksCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'predict:purchasable-stocks {amount} {liq} {articleId}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calcola la Probabilità iniziali di vittoria di ogni opzione di un articolo';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $data = [];
        Assert::notNull($article = Predict::find($this->argument('articleId')));
        $opzioni = $article->ratings()->where('user_id', null)
            ->get()
            ->pluck('id')
            // ->take(2)
        ;
        $outstanding = [];
        foreach ($opzioni as $index) {
            $result[$index] = 0.0;
            $tmp = RatingMorph::where('model_type', 'article')
                    ->where('rating_id', $index)
                    ->sum('value');
            $outstanding[$index] = $tmp;
        }
        // dddx([$opzioni, $outstanding]);

        foreach ($opzioni as $index) {
            // dddx(app(GetPurchasableStocks::class)->execute($outstanding, $index, (float) $this->argument('amount'), $this->argument('liq')));
            Assert::string($index);
            $data[$index] = app(GetPurchasableStocks::class)->execute($outstanding, $index, (float) $this->argument('amount'), $this->argument('liq'));
        }

        dddx($data);

        // dddx(app(GetPurchasableStocks::class)->execute($this->argument('liq'), $this->argument('articleId')));

        // $rows[] = ['testo di prova'];

        // if (\count($rows) > 0) {
        //     // $headers = array_keys($rows[0] ?? []);
        //     $headers = array_keys($rows[0]);

        //     $this->newLine();
        //     $this->table($headers, $rows);
        //     $this->newLine();
        // } else {
        //     $this->newLine();
        //     $this->warn('⚡ Something wrongs');
        //     $this->newLine();
        // }
    }
}
