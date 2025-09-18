<?php

declare(strict_types=1);

namespace Modules\Predict\Console\Commands;

use Illuminate\Console\Command;
use Modules\Predict\Aggregates\ArticleAggregate;
use Modules\Predict\Datas\RatingArticleWinnerData;
use Webmozart\Assert\Assert;

class RatingArticleWinnerCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'predict:rating-article-winnner {articleId} {ratingId}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Su un articolo chiuso alle scommesse viene selezionata la risposta vincente';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        Assert::string($articleId = $this->argument('articleId'));
        Assert::string($ratingId = $this->argument('ratingId'));

        $command = RatingArticleWinnerData::from([
            'ratingId' => $ratingId,
            'articleId' => $articleId,
        ]);

        try {
            ArticleAggregate::retrieve($command->articleId)
                ->winner($command);

            $this->newLine();
            $this->info("✓ Rating <fg=yellow>{$ratingId}</> on article <fg=yellow>{$articleId}</> set winning");
            $this->newLine();
        } catch (\Exception $error) {
            $this->newLine();
            $this->line("<bg=red;fg=black>✗ Error:</> {$error->getMessage()}");
            $this->newLine();
        } /*catch (\NullArticleError $error) {
            $this->newLine();
            $this->line("<bg=red;fg=black>✗ Error:</> {$error->getMessage()}");
            $this->newLine();
        }*/
    }
}
