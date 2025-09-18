<?php

declare(strict_types=1);

namespace Modules\Predict\Console\Commands;

use Illuminate\Console\Command;
use Modules\Predict\Actions\Stocks\GetCurrentRatingsPrice;
use Webmozart\Assert\Assert;

class GetCurrentRatingsPriceCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'predict:current-price {liq} {articleId}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calcola il costo di ogni opzione di un articolo';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        Assert::string($articleId = $this->argument('articleId'));
        // dddx(app(GetCurrentRatingsPrice::class)->execute($this->argument('liq'), $this->argument('articleId')));
        $props = app(GetCurrentRatingsPrice::class)->execute($this->argument('liq'), $this->argument('articleId'));

        $header = ['rating_id', 'prop'];
        $rows = [];
        foreach ($props as $key => $prop) {
            // dddx([$key, $prop]);
            $rows[] = [$key, $prop];
        }

        // $rows[] = ['testo di prova'];

        if (\count($rows) > 0) {
            // $headers = array_keys($rows[0] ?? []);
            $headers = array_keys($rows[0]);

            $this->newLine();
            $this->table($headers, $rows);
            $this->newLine();
        } else {
            $this->newLine();
            $this->warn('⚡ Something wrongs');
            $this->newLine();
        }
    }
}
