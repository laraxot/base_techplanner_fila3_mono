<?php

declare(strict_types=1);

namespace Modules\User\Actions\User;

<<<<<<< HEAD
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;
use Spatie\QueueableAction\QueueableAction;
use Illuminate\Validation\ValidationException;
use Modules\Xot\Actions\Cast\SafeStringCastAction;

/**
 * UpdateUserAction: Action generica per l'aggiornamento dei dati utente.
 * 
=======
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Modules\Xot\Actions\Cast\SafeStringCastAction;
use Spatie\QueueableAction\QueueableAction;

/**
 * UpdateUserAction: Action generica per l'aggiornamento dei dati utente.
 *
>>>>>>> 9831a351 (.)
 * Questa action gestisce l'aggiornamento dei dati di base dell'utente.
 * Può essere estesa dai moduli specifici per aggiungere logica personalizzata.
 */
class UpdateUserAction
{
    use QueueableAction;
<<<<<<< HEAD
    /**
     * Esegue l'aggiornamento dell'utente.
     * 
     * @param Model $user L'utente da aggiornare
     * @param array<string, mixed> $data I dati da aggiornare
     * @return Model L'utente aggiornato
     * 
=======

    /**
     * Esegue l'aggiornamento dell'utente.
     *
     * @param  Model  $user  L'utente da aggiornare
     * @param  array<string, mixed>  $data  I dati da aggiornare
     * @return Model L'utente aggiornato
     *
>>>>>>> 9831a351 (.)
     * @throws \Exception Se l'aggiornamento fallisce
     */
    public function execute(Model $user, array $data): Model
    {
        try {
            DB::beginTransaction();
<<<<<<< HEAD
            
            // Prepara i dati per l'aggiornamento
            $updateData = $this->prepareUpdateData($data);
            
            // Valida i dati specifici per l'aggiornamento
            $this->validateUpdateData($user, $updateData);
            
            // Aggiorna l'utente
            $user->fill($updateData);
            $user->save();
            
            // Esegue operazioni post-aggiornamento se necessarie
            $this->afterUpdate($user, $updateData);
            
            DB::commit();
            
            Log::info("Utente aggiornato con successo", [
                'user_id' => $user->getKey(),
                'updated_fields' => array_keys($updateData)
            ]);
            
            $updatedUser = $user->fresh();
            if (!$updatedUser instanceof Model) {
                throw new \Exception('Failed to refresh user model after update');
            }
            
            return $updatedUser;
            
        } catch (\Exception $e) {
            DB::rollBack();
            
            Log::error("Errore nell'aggiornamento utente", [
                'user_id' => $user->getKey(),
                'error' => $e->getMessage(),
                'data' => $updateData ?? []
            ]);
            
            throw $e;
        }
    }
    
    /**
     * Prepara i dati per l'aggiornamento rimuovendo campi non aggiornabili.
     * 
     * @param array<string, mixed> $data
=======

            // Prepara i dati per l'aggiornamento
            $updateData = $this->prepareUpdateData($data);

            // Valida i dati specifici per l'aggiornamento
            $this->validateUpdateData($user, $updateData);

            // Aggiorna l'utente
            $user->fill($updateData);
            $user->save();

            // Esegue operazioni post-aggiornamento se necessarie
            $this->afterUpdate($user, $updateData);

            DB::commit();

            Log::info('Utente aggiornato con successo', [
                'user_id' => $user->getKey(),
                'updated_fields' => array_keys($updateData),
            ]);

            $updatedUser = $user->fresh();
            if (! $updatedUser instanceof Model) {
                throw new \Exception('Failed to refresh user model after update');
            }

            return $updatedUser;

        } catch (\Exception $e) {
            DB::rollBack();

            Log::error("Errore nell'aggiornamento utente", [
                'user_id' => $user->getKey(),
                'error' => $e->getMessage(),
                'data' => $updateData ?? [],
            ]);

            throw $e;
        }
    }

    /**
     * Prepara i dati per l'aggiornamento rimuovendo campi non aggiornabili.
     *
     * @param  array<string, mixed>  $data
>>>>>>> 9831a351 (.)
     * @return array<string, mixed>
     */
    protected function prepareUpdateData(array $data): array
    {
        // Rimuovi campi che non dovrebbero essere aggiornati direttamente
        $excludeFields = [
            'id',
            'email_verified_at',
            'remember_token',
            'created_at',
            'updated_at',
        ];
<<<<<<< HEAD
        
        $updateData = array_diff_key($data, array_flip($excludeFields));
        
=======

        $updateData = array_diff_key($data, array_flip($excludeFields));

>>>>>>> 9831a351 (.)
        // Gestione speciale per la password
        if (isset($updateData['password'])) {
            if (empty($updateData['password'])) {
                // Se la password è vuota, rimuovila dai dati di aggiornamento
                unset($updateData['password']);
            } else {
                // Hash della password se presente
                $updateData['password'] = Hash::make(SafeStringCastAction::cast($updateData['password']));
            }
        }
<<<<<<< HEAD
        
=======

>>>>>>> 9831a351 (.)
        // Gestione dell'email per evitare duplicati
        if (isset($updateData['email'])) {
            $email = SafeStringCastAction::cast($updateData['email']);
            $updateData['email'] = strtolower($email);
        }
<<<<<<< HEAD
        
        return $updateData;
    }
    
    /**
     * Valida i dati di aggiornamento.
     * 
     * @param Model $user
     * @param array<string, mixed> $data
     * @return void
     * 
=======

        return $updateData;
    }

    /**
     * Valida i dati di aggiornamento.
     *
     * @param  array<string, mixed>  $data
     *
>>>>>>> 9831a351 (.)
     * @throws ValidationException
     */
    protected function validateUpdateData(Model $user, array $data): void
    {
        // Validazione email univoca
        if (isset($data['email'])) {
            $existingUser = $user->newQuery()
                ->where('email', $data['email'])
                ->where('id', '!=', $user->getKey())
                ->first();
<<<<<<< HEAD
                
            if ($existingUser) {
                throw ValidationException::withMessages([
                    'email' => __('user::validation.email_already_taken')
                ]);
            }
        }
        
        // Validazioni aggiuntive possono essere aggiunte qui
        // o nelle classi che estendono questa action
    }
    
    /**
     * Operazioni da eseguire dopo l'aggiornamento.
     * Può essere sovrascritto dalle classi che estendono questa action.
     * 
     * @param Model $user
     * @param array<string, mixed> $data
     * @return void
=======

            if ($existingUser) {
                throw ValidationException::withMessages([
                    'email' => __('user::validation.email_already_taken'),
                ]);
            }
        }

        // Validazioni aggiuntive possono essere aggiunte qui
        // o nelle classi che estendono questa action
    }

    /**
     * Operazioni da eseguire dopo l'aggiornamento.
     * Può essere sovrascritto dalle classi che estendono questa action.
     *
     * @param  array<string, mixed>  $data
>>>>>>> 9831a351 (.)
     */
    protected function afterUpdate(Model $user, array $data): void
    {
        // Implementazione di default vuota
        // Le classi derivate possono sovrascrivere questo metodo per:
        // - Inviare notifiche
        // - Aggiornare cache
        // - Registrare log di audit
        // - Gestire relazioni
    }
<<<<<<< HEAD
} 
=======
}
>>>>>>> 9831a351 (.)
