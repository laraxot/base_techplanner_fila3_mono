<?php

declare(strict_types=1);

namespace Modules\User\Actions\User;

<<<<<<< HEAD
use Modules\User\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
=======
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Modules\User\Models\User;
>>>>>>> 9831a351 (.)
use Spatie\QueueableAction\QueueableAction;

class DeleteUserAction
{
    use QueueableAction;
<<<<<<< HEAD
    /**
     * Elimina l'utente dopo aver verificato la password.
     *
     * @param User $user L'utente da eliminare
     * @param string $confirmPassword La password di conferma
     *
=======

    /**
     * Elimina l'utente dopo aver verificato la password.
     *
     * @param  User  $user  L'utente da eliminare
     * @param  string  $confirmPassword  La password di conferma
>>>>>>> 9831a351 (.)
     * @return array{success: bool, message: string} Risultato dell'operazione
     */
    public function execute(User $user, string $confirmPassword): array
    {
<<<<<<< HEAD
        if (!Hash::check($confirmPassword, $user->password)) {
            return [
                'success' => false,
                'message' => 'La password inserita non è corretta'
=======
        if (! Hash::check($confirmPassword, $user->password)) {
            return [
                'success' => false,
                'message' => 'La password inserita non è corretta',
>>>>>>> 9831a351 (.)
            ];
        }

        try {
            Auth::logout();
            $user->delete();

            return [
                'success' => true,
<<<<<<< HEAD
                'message' => 'Account eliminato con successo'
=======
                'message' => 'Account eliminato con successo',
>>>>>>> 9831a351 (.)
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
<<<<<<< HEAD
                'message' => 'Si è verificato un errore durante l\'eliminazione dell\'account'
=======
                'message' => 'Si è verificato un errore durante l\'eliminazione dell\'account',
>>>>>>> 9831a351 (.)
            ];
        }
    }
}
