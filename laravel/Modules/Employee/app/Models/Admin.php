<?php

declare(strict_types=1);

namespace Modules\Employee\Models;

use Parental\HasParent;

/**
 * Employee Module Admin Model
 *
 * Admin user type using Single Table Inheritance with Parental package.
 * Child class of User model for administrative users.
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
 * @property string|null $phone
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 */
class Admin extends User
{
    use HasParent;

    /**
     * Gli attributi che sono mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'date_of_birth',
        'gender',
        'address',
        'phone',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return array_merge(parent::casts(), [
            // 'certifications' => 'array',
            // 'availability' => 'array',
        ]);
    }
}
