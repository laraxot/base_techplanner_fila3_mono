<?php

declare(strict_types=1);

namespace Modules\User\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
<<<<<<< HEAD
use Modules\User\Models\PermissionRole;
use Modules\User\Models\Permission;
=======
use Modules\User\Models\Permission;
use Modules\User\Models\PermissionRole;
>>>>>>> 9831a351 (.)
use Modules\User\Models\Role;

/**
 * PermissionRole Factory
<<<<<<< HEAD
 * 
 * Factory for creating PermissionRole model instances for testing and seeding.
 * 
=======
 *
 * Factory for creating PermissionRole model instances for testing and seeding.
 *
>>>>>>> 9831a351 (.)
 * @extends Factory<PermissionRole>
 */
class PermissionRoleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
<<<<<<< HEAD
     * 
=======
     *
>>>>>>> 9831a351 (.)
     * @var class-string<PermissionRole>
     */
    protected $model = PermissionRole::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'permission_id' => Permission::factory(),
            'role_id' => Role::factory(),
        ];
    }

    /**
     * Create permission-role relationship for a specific permission.
<<<<<<< HEAD
     *
     * @param Permission $permission
     * @return static
=======
>>>>>>> 9831a351 (.)
     */
    public function forPermission(Permission $permission): static
    {
        return $this->state(fn (array $attributes): array => [
            'permission_id' => $permission->id,
        ]);
    }

    /**
     * Create permission-role relationship for a specific role.
<<<<<<< HEAD
     *
     * @param Role $role
     * @return static
=======
>>>>>>> 9831a351 (.)
     */
    public function forRole(Role $role): static
    {
        return $this->state(fn (array $attributes): array => [
            'role_id' => $role->id,
        ]);
    }
<<<<<<< HEAD
}
=======
}
>>>>>>> 9831a351 (.)
