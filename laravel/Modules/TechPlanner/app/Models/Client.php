<?php

declare(strict_types=1);

namespace Modules\TechPlanner\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Geo\Models\Traits\GeographicalScopes;

/**
 * Class Client.
 *
 * @property int         $id
 * @property string      $name
 * @property string|null $vat_number
 * @property string|null $fiscal_code
 * @property string|null $address
 * @property string|null $city
 * @property string|null $postal_code
 * @property string|null $province
 * @property string|null $country
 * @property string|null $phone
 * @property string|null $email
 */
class Client extends BaseModel
{
    use GeographicalScopes;

    protected $fillable = [
        'name',
        'vat_number',
        'fiscal_code',
        'address',
        'city',
        'postal_code',
        'province',
        'country',
        'phone',
        'email',
        // ----------
        'business_closed',                // cessato
        'company_name',               // ditta
        'competent_health_unit', // az_ulss_competente
        'tax_code',              // cf
        'vat_number',            // partita_iva
        'company_office',        // sede_ditta
        'address',               // indirizzo
        'street_number',         // numero_civico
        'province',              // provincia
        'postal_code',           // cap
        'phone',                 // telefono
        'fax',                   // fax
        'mobile',                // cellulare
        'email',                 // email
        'notes',                 // note
        'activity',              // attivita
        'longitude',
        'latitude',
    ];

    public function getFullAddressAttribute(?string $value): string
    {
        if (null !== $value) {
            return $value;
        }
        $address = sprintf(
            '%s %s, %s, %s (%s)',
            $this->address,
            $this->street_number,
            $this->postal_code,
            $this->company_office,
            $this->province
        );

        return $address;
    }

    /**
     * Relazione con le chiamate telefoniche.
     */
    public function phoneCalls(): HasMany
    {
        return $this->hasMany(PhoneCall::class);
    }

    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }

    /**
     * Relazione con le chiamate telefoniche.
     */
    public function devices(): HasMany
    {
        return $this->hasMany(Device::class);
    }

    public function legalRepresentatives(): HasMany
    {
        return $this->hasMany(LegalRepresentative::class);
    }

    public function legalOffices(): HasMany
    {
        return $this->hasMany(LegalOffice::class);
    }

    public function medicalDirectors(): HasMany
    {
        return $this->hasMany(MedicalDirector::class);
    }
}
