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
