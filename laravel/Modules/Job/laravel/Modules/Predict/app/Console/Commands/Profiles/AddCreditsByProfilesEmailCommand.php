<?php

declare(strict_types=1);

namespace Modules\Predict\Console\Commands\Profiles;

use Illuminate\Console\Command;
use Modules\Predict\Aggregates\ProfileAggregate;
use Modules\Predict\Datas\AddedCreditsData;
use Modules\Predict\Models\Profile;
use Webmozart\Assert\Assert;

class AddCreditsByProfilesEmailCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'predict:add-credits-profiles {email} {credit}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Aggiunge crediti al profilo indicato tramite email';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        Assert::string($email = $this->argument('email'));
        Assert::notNull($profile = Profile::firstWhere(['email' => $email]));
        $credit = (int) $this->argument('credit');

        $command = AddedCreditsData::from([
            'profileId' => (string) $profile->id,
            'userId' => $profile->user_id,
            'credit' => $credit,
        ]);

        try {
            ProfileAggregate::retrieve($command->userId)
                ->creditAdded($command);

            $this->newLine();
            $this->info("✓ Credit added to profile id <fg=yellow>{$profile->id}</>");
            $this->newLine();
        } catch (\Exception $error) {
            $this->newLine();
            $this->line("<bg=red;fg=black>✗ Error:</> {$error->getMessage()}");
            $this->newLine();
        }
    }
}
