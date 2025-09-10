<?php

declare(strict_types=1);

namespace Modules\User\Console\Commands;

use Illuminate\Console\Command;
<<<<<<< HEAD
use Modules\Xot\Contracts\UserContract;
=======
>>>>>>> 9831a351 (.)
use Modules\Xot\Datas\XotData;
use Symfony\Component\Console\Input\InputOption;

use function Laravel\Prompts\select;
use function Laravel\Prompts\text;

/**
 * Comando per impostare il team corrente per un utente.
 */
class SetCurrentTeamCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'user:set-current-team';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Assign current team to user';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $email = text('email ?');
        if (empty($email)) {
            $this->error('Email non valida!');
<<<<<<< HEAD
=======

>>>>>>> 9831a351 (.)
            return;
        }

        $xot = XotData::make();
        $user = $xot->getUserByEmail($email);

        if (! $user instanceof \Illuminate\Database\Eloquent\Model) {
            $this->error('Utente non trovato o non valido!');
<<<<<<< HEAD
=======

>>>>>>> 9831a351 (.)
            return;
        }

        $teamClass = $xot->getTeamClass();
<<<<<<< HEAD
        if (!class_exists($teamClass)) {
            $this->error('Classe team non trovata!');
=======
        if (! class_exists($teamClass)) {
            $this->error('Classe team non trovata!');

>>>>>>> 9831a351 (.)
            return;
        }

        /** @var array<int|string, string> */
        $opts = $teamClass::pluck('name', 'id')->toArray();

        if (empty($opts)) {
            $this->error('Nessun team disponibile!');
<<<<<<< HEAD
=======

>>>>>>> 9831a351 (.)
            return;
        }

        $team_id = select(
            label: 'Quale team?',
            options: $opts,
            required: true,
            scroll: 10,
        );

<<<<<<< HEAD
        if (!is_numeric($team_id)) {
            $this->error('ID team non valido!');
=======
        if (! is_numeric($team_id)) {
            $this->error('ID team non valido!');

>>>>>>> 9831a351 (.)
            return;
        }

        try {
            $user->current_team_id = (int) $team_id;
            $user->save();
            $this->info('OK');
        } catch (\Exception $e) {
<<<<<<< HEAD
            $this->error('Errore durante il salvataggio: ' . $e->getMessage());
=======
            $this->error('Errore durante il salvataggio: '.$e->getMessage());
>>>>>>> 9831a351 (.)
        }
    }

    /**
     * Get the console command options.
     */
    protected function getOptions(): array
    {
        return [
            ['example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null],
        ];
    }
}
