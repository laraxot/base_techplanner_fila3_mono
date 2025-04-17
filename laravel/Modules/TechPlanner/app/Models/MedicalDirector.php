<?php

declare(strict_types=1);

namespace Modules\TechPlanner\Models;

/**
 * Class MedicalDirector.
 *
 * @property int $id
 * @property string $name
 * @property string|null $license_number
 * @property string|null $specialization
 * @property string|null $phone
 * @property string|null $email
 */
class MedicalDirector extends BaseModel
{
    protected $fillable = [
        'client_id',        // IDCliente
        'last_name',        // Cognome
        'first_name',       // Nome
        'residence',        // Residenza
        'address',          // Indirizzo
        'street_number',    // N° civico
        'province',         // Prov
        'birth_place',      // nato a
        'birth_date',       // Data nascita
        'start_date',       // Data inizio
        'end_date',         // Data fine
    ];
}
