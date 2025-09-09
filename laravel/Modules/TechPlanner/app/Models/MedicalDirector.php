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
 * @property int|null $client_id
 * @property string|null $last_name
 * @property string|null $first_name
 * @property string|null $residence
 * @property string|null $address
 * @property string|null $street_number
 * @property string|null $province
 * @property string|null $birth_place
 * @property string|null $birth_date
 * @property string|null $start_date
 * @property string|null $end_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $updated_by
 * @property string|null $created_by
 * @property string|null $deleted_at
 * @property string|null $deleted_by
 * @property-read \Modules\TechPlanner\Models\Profile|null $creator
 * @property-read \Modules\TechPlanner\Models\Profile|null $updater
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MedicalDirector newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MedicalDirector newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MedicalDirector query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MedicalDirector whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MedicalDirector whereBirthDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MedicalDirector whereBirthPlace($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MedicalDirector whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MedicalDirector whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MedicalDirector whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MedicalDirector whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MedicalDirector whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MedicalDirector whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MedicalDirector whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MedicalDirector whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MedicalDirector whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MedicalDirector whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MedicalDirector whereLicenseNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MedicalDirector whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MedicalDirector wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MedicalDirector whereProvince($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MedicalDirector whereResidence($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MedicalDirector whereSpecialization($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MedicalDirector whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MedicalDirector whereStreetNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MedicalDirector whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MedicalDirector whereUpdatedBy($value)
 * @mixin \Eloquent
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
