<?php

declare(strict_types=1);

namespace Modules\Predict\Console\Commands;

use Illuminate\Console\Command;
use Modules\Predict\Actions\Stocks\GetProbabilityOfRatingsVictory;
use Webmozart\Assert\Assert;

class GetProbabilityOfRatingsVictoryCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'predict:prop-victory {liq} {articleId}';

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
        Assert::string($articleId = $this->argument('articleId'));
        $props = app(GetProbabilityOfRatingsVictory::class)->execute($this->argument('liq'), $this->argument('articleId'));

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
