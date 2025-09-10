<?php

declare(strict_types=1);

namespace Modules\User\Tests\Unit\Models;

<<<<<<< HEAD
use Illuminate\Foundation\Testing\RefreshDatabase;
=======
use Illuminate\Foundation\Testing\DatabaseTransactions;
>>>>>>> 9831a351 (.)
use Modules\User\Models\Device;
use Tests\TestCase;

class DeviceTest extends TestCase
{
<<<<<<< HEAD
    use RefreshDatabase;
=======

>>>>>>> 9831a351 (.)

    public function test_can_create_device_with_minimal_data(): void
    {
        $device = Device::factory()->create([
            'device' => 'iPhone',
            'platform' => 'iOS',
        ]);

        $this->assertDatabaseHas('devices', [
            'id' => $device->id,
            'device' => 'iPhone',
            'platform' => 'iOS',
        ]);
    }

    public function test_can_create_device_with_all_fields(): void
    {
        $deviceData = [
            'uuid' => '550e8400-e29b-41d4-a716-446655440000',
            'mobile_id' => 'mobile123',
            'languages' => ['en', 'it', 'de'],
            'device' => 'iPhone 13',
            'platform' => 'iOS',
            'browser' => 'Safari',
            'version' => '15.0',
            'is_robot' => false,
            'robot' => null,
            'is_desktop' => false,
            'is_mobile' => true,
            'is_tablet' => false,
            'is_phone' => true,
        ];

        $device = Device::factory()->create($deviceData);

        $this->assertDatabaseHas('devices', [
            'id' => $device->id,
            'uuid' => '550e8400-e29b-41d4-a716-446655440000',
            'mobile_id' => 'mobile123',
            'device' => 'iPhone 13',
            'platform' => 'iOS',
            'browser' => 'Safari',
            'version' => '15.0',
            'is_robot' => false,
            'is_desktop' => false,
            'is_mobile' => true,
            'is_tablet' => false,
            'is_phone' => true,
        ]);

        // Verifica campi JSON
<<<<<<< HEAD
        $this->assertEquals(['en', 'it', 'de'], $device->languages);
=======
        expect(['en', 'it', 'de'], $device->languages);
>>>>>>> 9831a351 (.)
    }

    public function test_device_has_soft_deletes(): void
    {
        $device = Device::factory()->create();
        $deviceId = $device->id;

        $device->delete();

        $this->assertSoftDeleted('devices', ['id' => $deviceId]);
        $this->assertDatabaseMissing('devices', ['id' => $deviceId]);
    }

    public function test_can_restore_soft_deleted_device(): void
    {
        $device = Device::factory()->create();
        $deviceId = $device->id;

        $device->delete();
        $this->assertSoftDeleted('devices', ['id' => $deviceId]);

        $restoredDevice = Device::withTrashed()->find($deviceId);
        $restoredDevice->restore();

        $this->assertDatabaseHas('devices', ['id' => $deviceId]);
<<<<<<< HEAD
        $this->assertNull($restoredDevice->deleted_at);
=======
        expect($restoredDevice->deleted_at);
>>>>>>> 9831a351 (.)
    }

    public function test_can_find_device_by_uuid(): void
    {
        $uuid = '550e8400-e29b-41d4-a716-446655440000';
        $device = Device::factory()->create(['uuid' => $uuid]);

        $foundDevice = Device::where('uuid', $uuid)->first();

<<<<<<< HEAD
        $this->assertNotNull($foundDevice);
        $this->assertEquals($device->id, $foundDevice->id);
=======
        expect($foundDevice);
        expect($device->id, $foundDevice->id);
>>>>>>> 9831a351 (.)
    }

    public function test_can_find_device_by_mobile_id(): void
    {
        $device = Device::factory()->create(['mobile_id' => 'unique_mobile_123']);

        $foundDevice = Device::where('mobile_id', 'unique_mobile_123')->first();

<<<<<<< HEAD
        $this->assertNotNull($foundDevice);
        $this->assertEquals($device->id, $foundDevice->id);
=======
        expect($foundDevice);
        expect($device->id, $foundDevice->id);
>>>>>>> 9831a351 (.)
    }

    public function test_can_find_device_by_device_type(): void
    {
        $device = Device::factory()->create(['device' => 'iPhone 13 Pro']);

        $foundDevice = Device::where('device', 'iPhone 13 Pro')->first();

<<<<<<< HEAD
        $this->assertNotNull($foundDevice);
        $this->assertEquals($device->id, $foundDevice->id);
=======
        expect($foundDevice);
        expect($device->id, $foundDevice->id);
>>>>>>> 9831a351 (.)
    }

    public function test_can_find_device_by_platform(): void
    {
        Device::factory()->create(['platform' => 'iOS']);
        Device::factory()->create(['platform' => 'Android']);
        Device::factory()->create(['platform' => 'Windows']);

        $iosDevices = Device::where('platform', 'iOS')->get();

<<<<<<< HEAD
        $this->assertCount(1, $iosDevices);
        $this->assertEquals('iOS', $iosDevices->first()->platform);
=======
        expect(1, $iosDevices);
        expect('iOS', $iosDevices->first()->platform);
>>>>>>> 9831a351 (.)
    }

    public function test_can_find_device_by_browser(): void
    {
        Device::factory()->create(['browser' => 'Safari']);
        Device::factory()->create(['browser' => 'Chrome']);
        Device::factory()->create(['browser' => 'Firefox']);

        $safariDevices = Device::where('browser', 'Safari')->get();

<<<<<<< HEAD
        $this->assertCount(1, $safariDevices);
        $this->assertEquals('Safari', $safariDevices->first()->browser);
=======
        expect(1, $safariDevices);
        expect('Safari', $safariDevices->first()->browser);
>>>>>>> 9831a351 (.)
    }

    public function test_can_find_device_by_version(): void
    {
        $device = Device::factory()->create(['version' => '15.0.1']);

        $foundDevice = Device::where('version', '15.0.1')->first();

<<<<<<< HEAD
        $this->assertNotNull($foundDevice);
        $this->assertEquals($device->id, $foundDevice->id);
=======
        expect($foundDevice);
        expect($device->id, $foundDevice->id);
>>>>>>> 9831a351 (.)
    }

    public function test_can_find_desktop_devices(): void
    {
        Device::factory()->create(['is_desktop' => true]);
        Device::factory()->create(['is_desktop' => false]);
        Device::factory()->create(['is_desktop' => true]);

        $desktopDevices = Device::where('is_desktop', true)->get();

<<<<<<< HEAD
        $this->assertCount(2, $desktopDevices);
        $this->assertTrue($desktopDevices->every(fn ($device) => $device->is_desktop));
=======
        expect(2, $desktopDevices);
        expect($desktopDevices->every(fn ($device) => $device->is_desktop));
>>>>>>> 9831a351 (.)
    }

    public function test_can_find_mobile_devices(): void
    {
        Device::factory()->create(['is_mobile' => true]);
        Device::factory()->create(['is_mobile' => false]);
        Device::factory()->create(['is_mobile' => true]);

        $mobileDevices = Device::where('is_mobile', true)->get();

<<<<<<< HEAD
        $this->assertCount(2, $mobileDevices);
        $this->assertTrue($mobileDevices->every(fn ($device) => $device->is_mobile));
=======
        expect(2, $mobileDevices);
        expect($mobileDevices->every(fn ($device) => $device->is_mobile));
>>>>>>> 9831a351 (.)
    }

    public function test_can_find_tablet_devices(): void
    {
        Device::factory()->create(['is_tablet' => true]);
        Device::factory()->create(['is_tablet' => false]);
        Device::factory()->create(['is_tablet' => true]);

        $tabletDevices = Device::where('is_tablet', true)->get();

<<<<<<< HEAD
        $this->assertCount(2, $tabletDevices);
        $this->assertTrue($tabletDevices->every(fn ($device) => $device->is_tablet));
=======
        expect(2, $tabletDevices);
        expect($tabletDevices->every(fn ($device) => $device->is_tablet));
>>>>>>> 9831a351 (.)
    }

    public function test_can_find_phone_devices(): void
    {
        Device::factory()->create(['is_phone' => true]);
        Device::factory()->create(['is_phone' => false]);
        Device::factory()->create(['is_phone' => true]);

        $phoneDevices = Device::where('is_phone', true)->get();

<<<<<<< HEAD
        $this->assertCount(2, $phoneDevices);
        $this->assertTrue($phoneDevices->every(fn ($device) => $device->is_phone));
=======
        expect(2, $phoneDevices);
        expect($phoneDevices->every(fn ($device) => $device->is_phone));
>>>>>>> 9831a351 (.)
    }

    public function test_can_find_robot_devices(): void
    {
        Device::factory()->create(['is_robot' => true, 'robot' => 'Googlebot']);
        Device::factory()->create(['is_robot' => false, 'robot' => null]);
        Device::factory()->create(['is_robot' => true, 'robot' => 'Bingbot']);

        $robotDevices = Device::where('is_robot', true)->get();

<<<<<<< HEAD
        $this->assertCount(2, $robotDevices);
        $this->assertTrue($robotDevices->every(fn ($device) => $device->is_robot));
=======
        expect(2, $robotDevices);
        expect($robotDevices->every(fn ($device) => $device->is_robot));
>>>>>>> 9831a351 (.)
    }

    public function test_can_find_devices_by_language(): void
    {
        Device::factory()->create(['languages' => ['en', 'it']]);
        Device::factory()->create(['languages' => ['en', 'de']]);
        Device::factory()->create(['languages' => ['fr', 'es']]);

        $englishDevices = Device::whereJsonContains('languages', 'en')->get();

<<<<<<< HEAD
        $this->assertCount(2, $englishDevices);
        $this->assertTrue($englishDevices->every(fn ($device) => in_array('en', $device->languages)));
=======
        expect(2, $englishDevices);
        expect($englishDevices->every(fn ($device) => in_array('en', $device->languages)));
>>>>>>> 9831a351 (.)
    }

    public function test_can_find_devices_by_device_pattern(): void
    {
        Device::factory()->create(['device' => 'iPhone 13']);
        Device::factory()->create(['device' => 'iPhone 14']);
        Device::factory()->create(['device' => 'Samsung Galaxy']);

        $iphoneDevices = Device::where('device', 'like', '%iPhone%')->get();

<<<<<<< HEAD
        $this->assertCount(2, $iphoneDevices);
        $this->assertTrue($iphoneDevices->every(fn ($device) => str_contains($device->device, 'iPhone')));
=======
        expect(2, $iphoneDevices);
        expect($iphoneDevices->every(fn ($device) => str_contains($device->device, 'iPhone')));
>>>>>>> 9831a351 (.)
    }

    public function test_can_update_device(): void
    {
        $device = Device::factory()->create(['device' => 'Old Device']);

        $device->update(['device' => 'New Device']);

        $this->assertDatabaseHas('devices', [
            'id' => $device->id,
            'device' => 'New Device',
        ]);
    }

    public function test_can_handle_null_values(): void
    {
        $device = Device::factory()->create([
            'device' => 'Test Device',
            'platform' => 'Test Platform',
            'mobile_id' => null,
            'languages' => null,
            'browser' => null,
            'version' => null,
            'robot' => null,
        ]);

        $this->assertDatabaseHas('devices', [
            'id' => $device->id,
            'mobile_id' => null,
            'browser' => null,
            'version' => null,
            'robot' => null,
        ]);
    }

    public function test_can_find_devices_by_multiple_criteria(): void
    {
        Device::factory()->create([
            'platform' => 'iOS',
            'is_mobile' => true,
            'browser' => 'Safari',
        ]);

        Device::factory()->create([
            'platform' => 'Android',
            'is_mobile' => true,
            'browser' => 'Chrome',
        ]);

        Device::factory()->create([
            'platform' => 'Windows',
            'is_mobile' => false,
            'browser' => 'Edge',
        ]);

        $devices = Device::where('is_mobile', true)
            ->where('browser', 'Safari')
            ->get();

<<<<<<< HEAD
        $this->assertCount(1, $devices);
        $this->assertEquals('iOS', $devices->first()->platform);
        $this->assertTrue($devices->first()->is_mobile);
        $this->assertEquals('Safari', $devices->first()->browser);
=======
        expect(1, $devices);
        expect('iOS', $devices->first()->platform);
        expect($devices->first()->is_mobile);
        expect('Safari', $devices->first()->browser);
>>>>>>> 9831a351 (.)
    }

    public function test_device_has_users_relationship(): void
    {
        $device = Device::factory()->create();

<<<<<<< HEAD
        $this->assertTrue(method_exists($device, 'users'));
=======
        expect(method_exists($device, 'users'));
>>>>>>> 9831a351 (.)
    }

    public function test_device_has_factory(): void
    {
        $device = Device::factory()->create();

<<<<<<< HEAD
        $this->assertNotNull($device->id);
        $this->assertInstanceOf(Device::class, $device);
=======
        expect($device->id);
        expect(Device::class, $device);
>>>>>>> 9831a351 (.)
    }

    public function test_device_has_fillable_attributes(): void
    {
<<<<<<< HEAD
        $device = new Device();
=======
        $device = new Device;
>>>>>>> 9831a351 (.)

        $expectedFillable = [
            'id',
            'uuid',
            'mobile_id',
            'languages',
            'device',
            'platform',
            'browser',
            'version',
            'is_robot',
            'robot',
            'is_desktop',
            'is_mobile',
            'is_tablet',
            'is_phone',
        ];

<<<<<<< HEAD
        $this->assertEquals($expectedFillable, $device->getFillable());
=======
        expect($expectedFillable, $device->getFillable());
>>>>>>> 9831a351 (.)
    }

    public function test_device_has_casts(): void
    {
<<<<<<< HEAD
        $device = new Device();
=======
        $device = new Device;
>>>>>>> 9831a351 (.)

        $expectedCasts = [
            'id' => 'string',
            'uuid' => 'string',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
            'deleted_at' => 'datetime',
            'updated_by' => 'string',
            'created_by' => 'string',
            'deleted_by' => 'string',
            'languages' => 'array',
            'is_robot' => 'boolean',
            'is_desktop' => 'boolean',
            'is_mobile' => 'boolean',
            'is_tablet' => 'boolean',
            'is_phone' => 'boolean',
        ];

<<<<<<< HEAD
        $this->assertEquals($expectedCasts, $device->getCasts());
    }
}







=======
        expect($expectedCasts, $device->getCasts());
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
