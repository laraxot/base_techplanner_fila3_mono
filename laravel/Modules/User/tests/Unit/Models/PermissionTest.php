<?php

declare(strict_types=1);

namespace Modules\User\Tests\Unit\Models;

<<<<<<< HEAD
use Illuminate\Foundation\Testing\RefreshDatabase;
=======
use Illuminate\Foundation\Testing\DatabaseTransactions;
>>>>>>> 9831a351 (.)
use Modules\User\Models\Permission;
use Tests\TestCase;

class PermissionTest extends TestCase
{
<<<<<<< HEAD
    use RefreshDatabase;
=======

>>>>>>> 9831a351 (.)

    public function test_can_create_permission_with_minimal_data(): void
    {
        $permission = Permission::factory()->create([
            'name' => 'test.permission',
            'guard_name' => 'web',
        ]);

        $this->assertDatabaseHas('permissions', [
            'id' => $permission->id,
            'name' => 'test.permission',
            'guard_name' => 'web',
        ]);
    }

    public function test_can_create_permission_with_all_fields(): void
    {
        $permissionData = [
            'name' => 'full.permission',
            'guard_name' => 'web',
            'created_by' => 'user123',
            'updated_by' => 'user456',
        ];

        $permission = Permission::factory()->create($permissionData);

        $this->assertDatabaseHas('permissions', [
            'id' => $permission->id,
            'name' => 'full.permission',
            'guard_name' => 'web',
            'created_by' => 'user123',
            'updated_by' => 'user456',
        ]);
    }

    public function test_permission_has_connection_attribute(): void
    {
<<<<<<< HEAD
        $permission = new Permission();

        $this->assertEquals('user', $permission->connection);
=======
        $permission = new Permission;

        expect('user', $permission->connection);
>>>>>>> 9831a351 (.)
    }

    public function test_permission_has_key_type_attribute(): void
    {
<<<<<<< HEAD
        $permission = new Permission();

        $this->assertEquals('string', $permission->keyType);
=======
        $permission = new Permission;

        expect('string', $permission->keyType);
>>>>>>> 9831a351 (.)
    }

    public function test_permission_has_fillable_attributes(): void
    {
<<<<<<< HEAD
        $permission = new Permission();
=======
        $permission = new Permission;
>>>>>>> 9831a351 (.)

        $expectedFillable = [
            'id',
            'name',
            'guard_name',
            'created_at',
            'updated_at',
            'created_by',
            'updated_by',
        ];

<<<<<<< HEAD
        $this->assertEquals($expectedFillable, $permission->getFillable());
=======
        expect($expectedFillable, $permission->getFillable());
>>>>>>> 9831a351 (.)
    }

    public function test_permission_has_casts(): void
    {
<<<<<<< HEAD
        $permission = new Permission();
=======
        $permission = new Permission;
>>>>>>> 9831a351 (.)

        $expectedCasts = [
            'id' => 'string',
            'uuid' => 'string',
            'name' => 'string',
            'guard_name' => 'string',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];

<<<<<<< HEAD
        $this->assertEquals($expectedCasts, $permission->getCasts());
=======
        expect($expectedCasts, $permission->getCasts());
>>>>>>> 9831a351 (.)
    }

    public function test_can_find_permission_by_name(): void
    {
        $permission = Permission::factory()->create(['name' => 'unique.permission']);

        $foundPermission = Permission::where('name', 'unique.permission')->first();

<<<<<<< HEAD
        $this->assertNotNull($foundPermission);
        $this->assertEquals($permission->id, $foundPermission->id);
=======
        expect($foundPermission);
        expect($permission->id, $foundPermission->id);
>>>>>>> 9831a351 (.)
    }

    public function test_can_find_permission_by_guard_name(): void
    {
        Permission::factory()->create(['guard_name' => 'web']);
        Permission::factory()->create(['guard_name' => 'api']);
        Permission::factory()->create(['guard_name' => 'web']);

        $webPermissions = Permission::where('guard_name', 'web')->get();

<<<<<<< HEAD
        $this->assertCount(2, $webPermissions);
        $this->assertTrue($webPermissions->every(fn ($permission) => $permission->guard_name === 'web'));
=======
        expect(2, $webPermissions);
        expect($webPermissions->every(fn ($permission) => $permission->guard_name === 'web'));
>>>>>>> 9831a351 (.)
    }

    public function test_can_find_permission_by_created_by(): void
    {
        $permission = Permission::factory()->create(['created_by' => 'user123']);

        $foundPermission = Permission::where('created_by', 'user123')->first();

<<<<<<< HEAD
        $this->assertNotNull($foundPermission);
        $this->assertEquals($permission->id, $foundPermission->id);
=======
        expect($foundPermission);
        expect($permission->id, $foundPermission->id);
>>>>>>> 9831a351 (.)
    }

    public function test_can_find_permission_by_updated_by(): void
    {
        $permission = Permission::factory()->create(['updated_by' => 'user456']);

        $foundPermission = Permission::where('updated_by', 'user456')->first();

<<<<<<< HEAD
        $this->assertNotNull($foundPermission);
        $this->assertEquals($permission->id, $foundPermission->id);
=======
        expect($foundPermission);
        expect($permission->id, $foundPermission->id);
>>>>>>> 9831a351 (.)
    }

    public function test_can_find_permissions_by_name_pattern(): void
    {
        Permission::factory()->create(['name' => 'user.create']);
        Permission::factory()->create(['name' => 'user.update']);
        Permission::factory()->create(['name' => 'user.delete']);
        Permission::factory()->create(['name' => 'post.read']);

        $userPermissions = Permission::where('name', 'like', 'user.%')->get();

<<<<<<< HEAD
        $this->assertCount(3, $userPermissions);
        $this->assertTrue($userPermissions->every(fn ($permission) => str_starts_with($permission->name, 'user.')));
=======
        expect(3, $userPermissions);
        expect($userPermissions->every(fn ($permission) => str_starts_with($permission->name, 'user.')));
>>>>>>> 9831a351 (.)
    }

    public function test_can_update_permission(): void
    {
        $permission = Permission::factory()->create(['name' => 'old.permission']);

        $permission->update(['name' => 'new.permission']);

        $this->assertDatabaseHas('permissions', [
            'id' => $permission->id,
            'name' => 'new.permission',
        ]);
    }

    public function test_can_handle_null_values(): void
    {
        $permission = Permission::factory()->create([
            'name' => 'test.permission',
            'guard_name' => 'web',
            'created_by' => null,
            'updated_by' => null,
        ]);

        $this->assertDatabaseHas('permissions', [
            'id' => $permission->id,
            'created_by' => null,
            'updated_by' => null,
        ]);
    }

    public function test_can_find_permissions_by_multiple_criteria(): void
    {
        Permission::factory()->create([
            'name' => 'admin.user.create',
            'guard_name' => 'web',
            'created_by' => 'admin',
        ]);

        Permission::factory()->create([
            'name' => 'admin.user.update',
            'guard_name' => 'api',
            'created_by' => 'admin',
        ]);

        $permissions = Permission::where('name', 'like', 'admin.user.%')
            ->where('created_by', 'admin')
            ->get();

<<<<<<< HEAD
        $this->assertCount(2, $permissions);
        $this->assertTrue($permissions->every(fn ($permission) => 
            str_starts_with($permission->name, 'admin.user.') && $permission->created_by === 'admin'
=======
        expect(2, $permissions);
        expect($permissions->every(fn ($permission) => str_starts_with($permission->name, 'admin.user.') && $permission->created_by === 'admin'
>>>>>>> 9831a351 (.)
        ));
    }

    public function test_permission_has_roles_relationship(): void
    {
        $permission = Permission::factory()->create();

<<<<<<< HEAD
        $this->assertTrue(method_exists($permission, 'roles'));
=======
        expect(method_exists($permission, 'roles'));
>>>>>>> 9831a351 (.)
    }

    public function test_permission_has_users_relationship(): void
    {
        $permission = Permission::factory()->create();

<<<<<<< HEAD
        $this->assertTrue(method_exists($permission, 'users'));
=======
        expect(method_exists($permission, 'users'));
>>>>>>> 9831a351 (.)
    }

    public function test_permission_can_use_role_scopes(): void
    {
        $permission = Permission::factory()->create();

<<<<<<< HEAD
        $this->assertTrue(method_exists($permission, 'role'));
=======
        expect(method_exists($permission, 'role'));
>>>>>>> 9831a351 (.)
    }

    public function test_permission_can_use_permission_scopes(): void
    {
        $permission = Permission::factory()->create();

<<<<<<< HEAD
        $this->assertTrue(method_exists($permission, 'permission'));
        $this->assertTrue(method_exists($permission, 'withoutPermission'));
=======
        expect(method_exists($permission, 'permission'));
        expect(method_exists($permission, 'withoutPermission'));
>>>>>>> 9831a351 (.)
    }

    public function test_permission_can_use_without_role_scopes(): void
    {
        $permission = Permission::factory()->create();

<<<<<<< HEAD
        $this->assertTrue(method_exists($permission, 'withoutRole'));
=======
        expect(method_exists($permission, 'withoutRole'));
>>>>>>> 9831a351 (.)
    }

    public function test_permission_has_factory_method(): void
    {
<<<<<<< HEAD
        $permission = new Permission();

        $this->assertTrue(method_exists($permission, 'newFactory'));
=======
        $permission = new Permission;

        expect(method_exists($permission, 'newFactory'));
>>>>>>> 9831a351 (.)
    }

    public function test_permission_has_get_table_method(): void
    {
<<<<<<< HEAD
        $permission = new Permission();

        $this->assertTrue(method_exists($permission, 'getTable'));
    }
}







=======
        $permission = new Permission;

        expect(method_exists($permission, 'getTable'));
    }
}
<<<<<<< HEAD



<<<<<<< HEAD
<<<<<<< HEAD
=======

>>>>>>> 8a21b63 (.)
=======

=======
>>>>>>> a0c18bc (.)
>>>>>>> 8055579 (.)
=======
>>>>>>> d51888e (.)
>>>>>>> 9831a351 (.)
