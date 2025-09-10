<?php

declare(strict_types=1);

namespace Modules\User\Contracts;

<<<<<<< HEAD
use Modules\User\Models\Team;
use Modules\User\Contracts\TeamContract;
use Modules\User\Models\Role;
=======
use Modules\User\Models\Role;
use Modules\User\Models\Team;
>>>>>>> 9831a351 (.)
use Modules\Xot\Contracts\UserContract;

/**
 * Interfaccia che combina le funzionalità di HasTeamsContract e UserContract
 */
interface HasTeamsAndUserContract extends HasTeamsContract, UserContract
{
    /**
     * Ottiene il ruolo dell'utente nel team
     */
    public function teamRole(TeamContract $team): ?Role;

    /**
     * Verifica se l'utente può rimuovere un membro dal team
     */
    public function canRemoveTeamMember(Team $team, HasTeamsContract $user): bool;

    /**
     * Verifica se l'utente può aggiornare un membro del team
     */
    public function canUpdateTeamMember(Team $team, HasTeamsContract $user): bool;
}
