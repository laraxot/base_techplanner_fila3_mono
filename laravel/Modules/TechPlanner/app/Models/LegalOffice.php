<?php

declare(strict_types=1);

namespace Modules\TechPlanner\Models;

/**
 * Class LegalOffice.
 *
 * @property int $id
 * @property string $name
 * @property string|null $address
 * @property string|null $phone
 * @property string|null $email
 * @property int $client_id
 * @property string|null $city
 * @property string|null $postal_code
 * @property string|null $province
 * @property string|null $country
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $updated_by
 * @property string|null $created_by
 * @property string|null $deleted_at
 * @property string|null $deleted_by
 * @property-read \Modules\TechPlanner\Models\Profile|null $creator
 * @property-read \Modules\TechPlanner\Models\Profile|null $updater
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LegalOffice newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LegalOffice newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LegalOffice query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LegalOffice whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LegalOffice whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LegalOffice whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LegalOffice whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LegalOffice whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LegalOffice whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LegalOffice whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LegalOffice whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LegalOffice whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LegalOffice whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LegalOffice wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LegalOffice wherePostalCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LegalOffice whereProvince($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LegalOffice whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LegalOffice whereUpdatedBy($value)
 * @mixin \Eloquent
 */
class LegalOffice extends BaseModel
{
    protected $fillable = [
        'name',
        'address',
        'phone',
        'email',
    ];
}
