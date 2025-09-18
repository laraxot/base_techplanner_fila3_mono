<?php

declare(strict_types=1);

namespace Modules\Predict\Console\Commands\Profiles;

use Illuminate\Console\Command;
use Modules\Predict\Aggregates\ProfileAggregate;
use Modules\Predict\Datas\RemovedCreditsData;
use Modules\Predict\Models\Profile;
use Webmozart\Assert\Assert;

class RemoveCreditsByProfilesEmailCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'predict:remove-credits-profiles {email} {credit}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Rimuove crediti al profilo indicato tramite email';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        Assert::string($email = $this->argument('email'));
        Assert::notNull($profile = Profile::firstWhere(['email' => $email]));
        $credit = (int) $this->argument('credit');

        $command = RemovedCreditsData::from([
            'profileId' => (string) $profile->id,
            'userId' => $profile->user_id,
            'credit' => $credit,
        ]);

        try {
            ProfileAggregate::retrieve($command->userId)
                ->creditRemoved($command);

            $this->newLine();
            $this->info("✓ Credit removed to profile id <fg=yellow>{$profile->id}</>");
            $this->newLine();
        } catch (\Exception $error) {
            $this->newLine();
            $this->line("<bg=red;fg=black>✗ Error:</> {$error->getMessage()}");
            $this->newLine();
        }
    }
}
