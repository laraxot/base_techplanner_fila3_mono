<?php

/**
 * @see https://github.com/ryangjchandler/filament-user-resource/blob/main/src/resources/UserResource/Pages/EditUser.php
 * Pagina di modifica utente per Filament.
 */

declare(strict_types=1);

namespace Modules\User\Filament\Resources\UserResource\Pages;

use Modules\User\Filament\Resources\UserResource\Pages\BaseEditUser;

/**
 * Pagina per la modifica degli utenti con particolare gestione della password.
 */
class EditUser extends BaseEditUser
{
    // Password handling logic is inherited from BaseEditUser
    // No need to duplicate mutateFormDataBeforeSave method
}
