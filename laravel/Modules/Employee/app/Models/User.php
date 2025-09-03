<?php

declare(strict_types=1);

namespace Modules\Employee\Models;

use Modules\Gdpr\Models\Traits\HasGdpr;
use Modules\SaluteOra\Enums\UserTypeEnum;
use Modules\User\Models\BaseUser;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\ModelStates\HasStates;
use Spatie\ModelStates\HasStatesContract;

/**
 * Employee Module User Model
 *
 * Extends BaseUser with Single Table Inheritance for Employee module.
 * Parent class for Admin and Employee models using Parental STI.
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $type
 * @property string|null $first_name
 * @property string|null $last_name
 * @property \Carbon\Carbon|null $date_of_birth
 * @property string|null $gender
 * @property string|null $address
 * @property string|null $city
 * @property string|null $phone
 * @property string|null $lang
 * @property int|null $current_team_id
 * @property bool $is_active
 * @property bool $is_otp
 * @property \Carbon\Carbon|null $password_expires_at
 * @property \Carbon\Carbon|null $email_verified_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class User extends BaseUser implements HasMedia, HasStatesContract
{
    use HasGdpr;
    use HasStates;
    use InteractsWithMedia;
    use LogsActivity;

    /** @var string */
    protected $connection = 'employee';

    /**
     * Mappatura dei tipi di utente con le relative classi
     * Utilizziamo l'enum UserTypeEnum per una gestione tipizzata e sicura
     */
    protected $childTypes = [
        'admin' => Admin::class,
        'employee' => Employee::class,
    ];

    /** @var array<string, mixed> */
    protected $attributes = [
        // 'state' => Pending::class,
        // 'state' => 'pending',
        'is_otp' => false,
        'is_active' => true,
        'type' => 'patient',  // Valore di default secondo la best practice dell'enum
    ];

    /** @var list<string> */
    protected $fillable = [
        'name',
        'email',
        'password',
        'type',
        'state',
        'first_name',
        'last_name',
        'date_of_birth',
        'gender',
        'address',
        'city',
        'phone',
        'lang',
        'current_team_id',
        // 'is_active',
        'is_otp',
        'password_expires_at',
        // 'studio_id',
        // 'continuation_token',
        // 'certifications'
    ];

    /**
     * Cast custom per il campo type:
     * - Va dichiarato solo nel modello User del modulo SaluteOra, mai nella base User generica.
     * - Motivazione: evitare di sporcare il modulo User condiviso tra più progetti.
     * - Filosofia: ogni modulo è autonomo, nessun lock-in, rispetto della modularità.
     * - Politica: type safety, DRY, serenità del codice, nessun errore di cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return array_merge(parent::casts(), [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            // 'type' => UserTypeEnum::class, // Sintassi corretta per Laravel 12
            // 'state' => UserState::class,
            // 'certifications' => 'array',
            // 'certification' => 'array',  // ESSENZIALE: Evita "foreach() argument must be of type array|object, string given"
            // 'moderation_data' => 'array',
        ]);

    }

    /**
     * Configurazione per il logging delle attività.
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            // ->logOnly(['name', 'email', 'type', 'state'])
            ->logOnlyDirty();
    }
}
