<?php

declare(strict_types=1);

namespace Modules\User\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Modules\User\Models\Permission;
use Modules\User\Models\Profile;
use Modules\User\Models\Role;
use Modules\User\Models\User;
use Tests\TestCase;

class UserManagementBusinessLogicTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_user_with_profile(): void
    {
        // Arrange
        $userData = [
            'name' => 'Mario Rossi',
            'email' => 'mario.rossi@example.com',
            'password' => Hash::make('password123'),
            'email_verified_at' => now(),
        ];

        $profileData = [
            'phone' => '+39 123 456 7890',
            'address' => 'Via Roma 123, Milano',
            'birth_date' => '1990-05-15',
            'gender' => 'M',
        ];

        // Act
        $user = User::create($userData);
        $profile = $user->profile()->create($profileData);

        // Assert
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => 'Mario Rossi',
            'email' => 'mario.rossi@example.com',
        ]);

        $this->assertDatabaseHas('profiles', [
            'id' => $profile->id,
            'user_id' => $user->id,
            'phone' => '+39 123 456 7890',
            'address' => 'Via Roma 123, Milano',
        ]);

        $this->assertInstanceOf(Profile::class, $user->profile);
        $this->assertEquals($user->id, $profile->user_id);
    }

    /** @test */
    public function it_can_assign_role_to_user(): void
    {
        // Arrange
        $user = User::factory()->create();
        $role = Role::factory()->create(['name' => 'doctor']);

        // Act
        $user->assignRole($role);

        // Assert
        $this->assertTrue($user->hasRole('doctor'));
        $this->assertTrue($user->hasRole($role));
        $this->assertContains($role->name, $user->getRoleNames()->toArray());
    }

    /** @test */
    public function it_can_assign_multiple_roles_to_user(): void
    {
        // Arrange
        $user = User::factory()->create();
        $role1 = Role::factory()->create(['name' => 'doctor']);
        $role2 = Role::factory()->create(['name' => 'admin']);

        // Act
        $user->assignRole([$role1, $role2]);

        // Assert
        $this->assertTrue($user->hasRole('doctor'));
        $this->assertTrue($user->hasRole('admin'));
        $this->assertTrue($user->hasRole($role1));
        $this->assertTrue($user->hasRole($role2));
        $this->assertCount(2, $user->getRoleNames());
    }

    /** @test */
    public function it_can_remove_role_from_user(): void
    {
        // Arrange
        $user = User::factory()->create();
        $role = Role::factory()->create(['name' => 'doctor']);
        $user->assignRole($role);

        // Act
        $user->removeRole($role);

        // Assert
        $this->assertFalse($user->hasRole('doctor'));
        $this->assertFalse($user->hasRole($role));
        $this->assertCount(0, $user->getRoleNames());
    }

    /** @test */
    public function it_can_sync_user_roles(): void
    {
        // Arrange
        $user = User::factory()->create();
        $role1 = Role::factory()->create(['name' => 'doctor']);
        $role2 = Role::factory()->create(['name' => 'admin']);
        $role3 = Role::factory()->create(['name' => 'nurse']);

        $user->assignRole([$role1, $role2]);

        // Act
        $user->syncRoles([$role2, $role3]);

        // Assert
        $this->assertFalse($user->hasRole('doctor'));
        $this->assertTrue($user->hasRole('admin'));
        $this->assertTrue($user->hasRole('nurse'));
        $this->assertCount(2, $user->getRoleNames());
    }

    /** @test */
    public function it_can_check_user_permissions(): void
    {
        // Arrange
        $user = User::factory()->create();
        $role = Role::factory()->create(['name' => 'doctor']);
        $permission = Permission::factory()->create(['name' => 'patients.read']);

        $role->givePermissionTo($permission);
        $user->assignRole($role);

        // Act & Assert
        $this->assertTrue($user->hasPermissionTo('patients.read'));
        $this->assertTrue($user->hasPermissionTo($permission));
        $this->assertTrue($user->can('patients.read'));
    }

    /** @test */
    public function it_can_assign_direct_permission_to_user(): void
    {
        // Arrange
        $user = User::factory()->create();
        $permission = Permission::factory()->create(['name' => 'special.permission']);

        // Act
        $user->givePermissionTo($permission);

        // Assert
        $this->assertTrue($user->hasPermissionTo('special.permission'));
        $this->assertTrue($user->hasPermissionTo($permission));
        $this->assertTrue($user->can('special.permission'));
    }

    /** @test */
    public function it_can_revoke_direct_permission_from_user(): void
    {
        // Arrange
        $user = User::factory()->create();
        $permission = Permission::factory()->create(['name' => 'special.permission']);
        $user->givePermissionTo($permission);

        // Act
        $user->revokePermissionTo($permission);

        // Assert
        $this->assertFalse($user->hasPermissionTo('special.permission'));
        $this->assertFalse($user->hasPermissionTo($permission));
        $this->assertFalse($user->can('special.permission'));
    }

    /** @test */
    public function it_can_check_user_has_any_role(): void
    {
        // Arrange
        $user = User::factory()->create();
        $role1 = Role::factory()->create(['name' => 'doctor']);
        $role2 = Role::factory()->create(['name' => 'nurse']);

        $user->assignRole($role1);

        // Act & Assert
        $this->assertTrue($user->hasAnyRole(['doctor', 'nurse']));
        $this->assertTrue($user->hasAnyRole(['nurse', 'admin']));
        $this->assertFalse($user->hasAnyRole(['nurse', 'admin']));
    }

    /** @test */
    public function it_can_check_user_has_all_roles(): void
    {
        // Arrange
        $user = User::factory()->create();
        $role1 = Role::factory()->create(['name' => 'doctor']);
        $role2 = Role::factory()->create(['name' => 'admin']);

        $user->assignRole([$role1, $role2]);

        // Act & Assert
        $this->assertTrue($user->hasAllRoles(['doctor', 'admin']));
        $this->assertFalse($user->hasAllRoles(['doctor', 'nurse']));
    }

    /** @test */
    public function it_can_get_user_permissions(): void
    {
        // Arrange
        $user = User::factory()->create();
        $role = Role::factory()->create(['name' => 'doctor']);
        $permission1 = Permission::factory()->create(['name' => 'patients.read']);
        $permission2 = Permission::factory()->create(['name' => 'patients.write']);

        $role->givePermissionTo([$permission1, $permission2]);
        $user->assignRole($role);

        // Act
        $permissions = $user->getAllPermissions();

        // Assert
        $this->assertCount(2, $permissions);
        $this->assertTrue($permissions->contains($permission1));
        $this->assertTrue($permissions->contains($permission2));
    }

    /** @test */
    public function it_can_get_user_roles(): void
    {
        // Arrange
        $user = User::factory()->create();
        $role1 = Role::factory()->create(['name' => 'doctor']);
        $role2 = Role::factory()->create(['name' => 'admin']);

        $user->assignRole([$role1, $role2]);

        // Act
        $roles = $user->getRoleNames();

        // Assert
        $this->assertCount(2, $roles);
        $this->assertContains('doctor', $roles);
        $this->assertContains('admin', $roles);
    }

    /** @test */
    public function it_can_check_user_is_super_admin(): void
    {
        // Arrange
        $user = User::factory()->create();
        $superAdminRole = Role::factory()->create(['name' => 'super-admin']);

        $user->assignRole($superAdminRole);

        // Act & Assert
        $this->assertTrue($user->hasRole('super-admin'));
        $this->assertTrue($user->isSuperAdmin());
    }

    /** @test */
    public function it_can_check_user_is_admin(): void
    {
        // Arrange
        $user = User::factory()->create();
        $adminRole = Role::factory()->create(['name' => 'admin']);

        $user->assignRole($adminRole);

        // Act & Assert
        $this->assertTrue($user->hasRole('admin'));
        $this->assertTrue($user->isAdmin());
    }

    /** @test */
    public function it_can_check_user_is_doctor(): void
    {
        // Arrange
        $user = User::factory()->create();
        $doctorRole = Role::factory()->create(['name' => 'doctor']);

        $user->assignRole($doctorRole);

        // Act & Assert
        $this->assertTrue($user->hasRole('doctor'));
        $this->assertTrue($user->isDoctor());
    }

    /** @test */
    public function it_can_check_user_is_patient(): void
    {
        // Arrange
        $user = User::factory()->create();
        $patientRole = Role::factory()->create(['name' => 'patient']);

        $user->assignRole($patientRole);

        // Act & Assert
        $this->assertTrue($user->hasRole('patient'));
        $this->assertTrue($user->isPatient());
    }

    /** @test */
    public function it_can_update_user_profile(): void
    {
        // Arrange
        $user = User::factory()->create();
        $profile = $user->profile()->create([
            'phone' => '+39 123 456 7890',
            'address' => 'Via Roma 123, Milano',
        ]);

        $updatedData = [
            'phone' => '+39 987 654 3210',
            'address' => 'Via Milano 456, Roma',
            'birth_date' => '1985-10-20',
        ];

        // Act
        $profile->update($updatedData);

        // Assert
        $this->assertDatabaseHas('profiles', [
            'id' => $profile->id,
            'phone' => '+39 987 654 3210',
            'address' => 'Via Milano 456, Roma',
            'birth_date' => '1985-10-20',
        ]);
    }

    /** @test */
    public function it_can_delete_user_with_profile(): void
    {
        // Arrange
        $user = User::factory()->create();
        $profile = $user->profile()->create([
            'phone' => '+39 123 456 7890',
        ]);

        // Act
        $user->delete();

        // Assert
        $this->assertDatabaseMissing('users', ['id' => $user->id]);
        $this->assertDatabaseMissing('profiles', ['id' => $profile->id]);
    }

    /** @test */
    public function it_can_soft_delete_user(): void
    {
        // Arrange
        $user = User::factory()->create();

        // Act
        $user->delete();

        // Assert
        $this->assertSoftDeleted('users', ['id' => $user->id]);
        $this->assertDatabaseHas('users', ['id' => $user->id]);
    }

    /** @test */
    public function it_can_restore_soft_deleted_user(): void
    {
        // Arrange
        $user = User::factory()->create();
        $user->delete();

        // Act
        $user->restore();

        // Assert
        $this->assertNotSoftDeleted('users', ['id' => $user->id]);
        $this->assertDatabaseHas('users', ['id' => $user->id]);
    }

    /** @test */
    public function it_can_force_delete_user(): void
    {
        // Arrange
        $user = User::factory()->create();
        $profile = $user->profile()->create([
            'phone' => '+39 123 456 7890',
        ]);

        // Act
        $user->forceDelete();

        // Assert
        $this->assertDatabaseMissing('users', ['id' => $user->id]);
        $this->assertDatabaseMissing('profiles', ['id' => $profile->id]);
    }

    /** @test */
    public function it_can_search_users_by_name(): void
    {
        // Arrange
        $user1 = User::factory()->create(['name' => 'Mario Rossi']);
        $user2 = User::factory()->create(['name' => 'Giulia Bianchi']);
        $user3 = User::factory()->create(['name' => 'Marco Rossi']);

        // Act
        $results = User::where('name', 'like', '%Rossi%')->get();

        // Assert
        $this->assertCount(2, $results);
        $this->assertTrue($results->contains($user1));
        $this->assertTrue($results->contains($user3));
        $this->assertFalse($results->contains($user2));
    }

    /** @test */
    public function it_can_search_users_by_email(): void
    {
        // Arrange
        $user1 = User::factory()->create(['email' => 'mario@example.com']);
        $user2 = User::factory()->create(['email' => 'giulia@test.com']);
        $user3 = User::factory()->create(['email' => 'marco@example.org']);

        // Act
        $results = User::where('email', 'like', '%@example%')->get();

        // Assert
        $this->assertCount(2, $results);
        $this->assertTrue($results->contains($user1));
        $this->assertTrue($results->contains($user3));
        $this->assertFalse($results->contains($user2));
    }

    /** @test */
    public function it_can_filter_users_by_role(): void
    {
        // Arrange
        $doctorRole = Role::factory()->create(['name' => 'doctor']);
        $nurseRole = Role::factory()->create(['name' => 'nurse']);

        $user1 = User::factory()->create();
        $user2 = User::factory()->create();
        $user3 = User::factory()->create();

        $user1->assignRole($doctorRole);
        $user2->assignRole($nurseRole);
        $user3->assignRole($doctorRole);

        // Act
        $doctors = User::role('doctor')->get();

        // Assert
        $this->assertCount(2, $doctors);
        $this->assertTrue($doctors->contains($user1));
        $this->assertTrue($doctors->contains($user3));
        $this->assertFalse($doctors->contains($user2));
    }

    /** @test */
    public function it_can_filter_users_by_permission(): void
    {
        // Arrange
        $role = Role::factory()->create(['name' => 'doctor']);
        $permission = Permission::factory()->create(['name' => 'patients.read']);

        $role->givePermissionTo($permission);

        $user1 = User::factory()->create();
        $user2 = User::factory()->create();

        $user1->assignRole($role);

        // Act
        $usersWithPermission = User::permission('patients.read')->get();

        // Assert
        $this->assertCount(1, $usersWithPermission);
        $this->assertTrue($usersWithPermission->contains($user1));
        $this->assertFalse($usersWithPermission->contains($user2));
    }

    /** @test */
    public function it_can_get_users_with_roles_and_permissions(): void
    {
        // Arrange
        $role = Role::factory()->create(['name' => 'doctor']);
        $permission = Permission::factory()->create(['name' => 'patients.read']);

        $role->givePermissionTo($permission);

        $user = User::factory()->create();
        $user->assignRole($role);

        // Act
        $userWithRelations = User::with(['roles', 'permissions'])->find($user->id);

        // Assert
        $this->assertNotNull($userWithRelations);
        $this->assertTrue($userWithRelations->relationLoaded('roles'));
        $this->assertTrue($userWithRelations->relationLoaded('permissions'));
        $this->assertCount(1, $userWithRelations->roles);
        $this->assertCount(1, $userWithRelations->permissions);
    }

    /** @test */
    public function it_can_validate_user_email_uniqueness(): void
    {
        // Arrange
        User::factory()->create(['email' => 'test@example.com']);

        // Act & Assert
        $this->expectException(\Illuminate\Database\QueryException::class);

        User::create([
            'name' => 'Another User',
            'email' => 'test@example.com', // Same email
            'password' => Hash::make('password123'),
        ]);
    }

    /** @test */
    public function it_can_validate_user_password_strength(): void
    {
        // Arrange
        $userData = [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'weak', // Weak password
        ];

        // Act & Assert
        $this->expectException(\Illuminate\Validation\ValidationException::class);

        $this->post('/register', $userData);
    }

    /** @test */
    public function it_can_handle_user_password_reset(): void
    {
        // Arrange
        $user = User::factory()->create();
        $token = 'reset-token-123';

        // Act
        $user->update(['password_reset_token' => $token]);

        // Assert
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'password_reset_token' => $token,
        ]);
    }

    /** @test */
    public function it_can_handle_user_email_verification(): void
    {
        // Arrange
        $user = User::factory()->create(['email_verified_at' => null]);

        // Act
        $user->markEmailAsVerified();

        // Assert
        $this->assertNotNull($user->email_verified_at);
        $this->assertTrue($user->hasVerifiedEmail());
    }

    /** @test */
    public function it_can_handle_user_last_login(): void
    {
        // Arrange
        $user = User::factory()->create();
        $lastLogin = now();

        // Act
        $user->update(['last_login_at' => $lastLogin]);

        // Assert
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'last_login_at' => $lastLogin,
        ]);
    }

    /** @test */
    public function it_can_handle_user_status_changes(): void
    {
        // Arrange
        $user = User::factory()->create(['status' => 'active']);

        // Act - Deactivate user
        $user->update(['status' => 'inactive']);

        // Assert
        $this->assertEquals('inactive', $user->fresh()->status);

        // Act - Activate user
        $user->update(['status' => 'active']);

        // Assert
        $this->assertEquals('active', $user->fresh()->status);
    }

    /** @test */
    public function it_can_handle_user_preferences(): void
    {
        // Arrange
        $user = User::factory()->create();
        $preferences = [
            'language' => 'it',
            'timezone' => 'Europe/Rome',
            'notifications' => true,
            'theme' => 'dark',
        ];

        // Act
        $user->update(['preferences' => $preferences]);

        // Assert
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'preferences' => json_encode($preferences),
        ]);

        $this->assertEquals('it', $user->fresh()->preferences['language']);
        $this->assertEquals('Europe/Rome', $user->fresh()->preferences['timezone']);
        $this->assertTrue($user->fresh()->preferences['notifications']);
        $this->assertEquals('dark', $user->fresh()->preferences['theme']);
    }
}
