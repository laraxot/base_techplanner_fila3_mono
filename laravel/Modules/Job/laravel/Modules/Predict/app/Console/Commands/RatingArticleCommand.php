<?php

declare(strict_types=1);

namespace Modules\Predict\Console\Commands;

use Illuminate\Console\Command;
use Modules\Predict\Aggregates\ArticleAggregate;
use Modules\Predict\Datas\RatingArticleData;
use Modules\Predict\Error\RatingClosedArticleError;
use Webmozart\Assert\Assert;

class RatingArticleCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'predict:rating-article {userId} {articleId} {ratingId} {credit}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Un utente scommette su un articolo';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        Assert::string($userId = $this->argument('userId'));
        Assert::string($articleId = $this->argument('articleId'));
        Assert::string($ratingId = $this->argument('ratingId'));
        $credit = (int) $this->argument('credit');

        $command = RatingArticleData::from([
            'userId' => $userId,
            'articleId' => $articleId,
            'ratingId' => $ratingId,
            'credit' => $credit,
        ]);

        try {
            ArticleAggregate::retrieve($command->articleId)
                ->rating($command);

            $this->newLine();
            $this->info("✓ Rating on article <fg=yellow>{$articleId}</> done");
            $this->newLine();
        } catch (RatingClosedArticleError $error) {
            $this->newLine();
            $this->line("<bg=red;fg=black>✗ Rating not allowed:</> {$error->getMessage()}");
            $this->newLine();
        } catch (\Exception $error) {
            $this->newLine();
            $this->line("<bg=red;fg=black>✗ Error:</> {$error->getMessage()}");
            $this->newLine();
        }
    }
}
