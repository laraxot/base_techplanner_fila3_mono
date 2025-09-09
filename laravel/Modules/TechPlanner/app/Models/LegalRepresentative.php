<?php

declare(strict_types=1);

namespace Modules\TechPlanner\Models;

/**
 * Class LegalRepresentative.
 *
 * @property int $id
 * @property string $name
 * @property string|null $identification_number
 * @property string|null $phone
 * @property string|null $email
 * @property int $client_id
 * @property string|null $fiscal_code
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $updated_by
 * @property string|null $created_by
 * @property string|null $deleted_at
 * @property string|null $deleted_by
 * @property-read \Modules\TechPlanner\Models\Profile|null $creator
 * @property-read \Modules\TechPlanner\Models\Profile|null $updater
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LegalRepresentative newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LegalRepresentative newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LegalRepresentative query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LegalRepresentative whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LegalRepresentative whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LegalRepresentative whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LegalRepresentative whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LegalRepresentative whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LegalRepresentative whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LegalRepresentative whereFiscalCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LegalRepresentative whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LegalRepresentative whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LegalRepresentative wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LegalRepresentative whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LegalRepresentative whereUpdatedBy($value)
 * @mixin \Eloquent
 */
class LegalRepresentative extends BaseModel
{
    protected $fillable = [
        'name',
        'identification_number',
        'phone',
        'email',
    ];
}
