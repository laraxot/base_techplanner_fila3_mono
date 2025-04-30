<?php

/**
 * @see https://github.com/ryangjchandler/filament-user-resource/blob/main/src/resources/UserResource/Pages/EditUser.php
 * Pagina di modifica utente per Filament.
 */

declare(strict_types=1);

namespace Modules\User\Filament\Resources\UserResource\Pages;

use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Hash;
use Modules\User\Filament\Resources\UserResource;
use Modules\User\Models\User;
use Webmozart\Assert\Assert;

use Modules\Xot\Filament\Resources\XotBaseResource\RelationManager\XotBaseRelationManager;

/**
 * Pagina per la modifica degli utenti con particolare gestione della password.
 */
class EditUser extends EditRecord
{
    // //
    protected static string $resource = UserResource::class;

    protected function mutateFormDataBeforeSave(array $data): array
    {
        Assert::isArray($data);
        if (! array_key_exists('new_password', $data) || ! filled($data['new_password'])) {
            return $data;
        }

        // Verifichiamo che record sia un'istanza valida di User
        Assert::notNull($this->record);
        Assert::isInstanceOf($this->record, User::class);
        
        // Gestione sicura del tipo di password per evitare errori di cast
        $newPassword = $data['new_password'];
        
        // Verifichiamo il tipo e convertiamo in modo sicuro
        if (!is_string($newPassword)) {
            if (!is_scalar($newPassword)) {
                throw new \InvalidArgumentException('La password deve essere una stringa');
            }
            $newPassword = (string) $newPassword;
        }
            
        $this->record->update(['password' => Hash::make($newPassword)]);
        return $data;
    }

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
