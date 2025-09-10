<?php

declare(strict_types=1);

use Modules\User\Enums\UserType;

uses(Tests\TestCase::class);

test('user type enum has correct cases', function (): void {
    expect(UserType::cases())->toHaveCount(5);
<<<<<<< HEAD
    
=======

>>>>>>> 9831a351 (.)
    expect(UserType::MasterAdmin->value)->toBe('master_admin');
    expect(UserType::BoUser->value)->toBe('backoffice_user');
    expect(UserType::CustomerUser->value)->toBe('customer_user');
    expect(UserType::System->value)->toBe('system');
    expect(UserType::Technician->value)->toBe('technician');
});

test('user type enum implements required interfaces', function (): void {
    $reflection = new ReflectionClass(UserType::class);
<<<<<<< HEAD
    
=======

>>>>>>> 9831a351 (.)
    expect($reflection->implementsInterface(\Filament\Support\Contracts\HasColor::class))->toBeTrue();
    expect($reflection->implementsInterface(\Filament\Support\Contracts\HasIcon::class))->toBeTrue();
    expect($reflection->implementsInterface(\Filament\Support\Contracts\HasLabel::class))->toBeTrue();
});

test('user type enum getLabel method returns correct labels', function (): void {
    expect(UserType::MasterAdmin->getLabel())->toBe('master_admin');
    expect(UserType::BoUser->getLabel())->toBe('backoffice_user');
    expect(UserType::CustomerUser->getLabel())->toBe('customer_user');
    expect(UserType::System->getLabel())->toBe('system');
    expect(UserType::Technician->getLabel())->toBe('technician');
});

test('user type enum getColor method returns correct colors', function (): void {
    expect(UserType::MasterAdmin->getColor())->toBe('success');
    expect(UserType::BoUser->getColor())->toBe('warning');
    expect(UserType::CustomerUser->getColor())->toBe('gray');
    expect(UserType::System->getColor())->toBe('blue');
    expect(UserType::Technician->getColor())->toBe('green');
});

test('user type enum getIcon method returns correct icons', function (): void {
    expect(UserType::MasterAdmin->getIcon())->toBe('heroicon-m-pencil');
    expect(UserType::BoUser->getIcon())->toBe('heroicon-m-pencil');
    expect(UserType::CustomerUser->getIcon())->toBe('heroicon-m-pencil');
    expect(UserType::System->getIcon())->toBe('heroicon-m-pencil');
    expect(UserType::Technician->getIcon())->toBe('heroicon-m-pencil');
});

test('user type enum getDefaultGuard method returns correct guards', function (): void {
    expect(UserType::MasterAdmin->getDefaultGuard())->toBe('web');
    expect(UserType::BoUser->getDefaultGuard())->toBe('web');
    expect(UserType::CustomerUser->getDefaultGuard())->toBe('web');
    expect(UserType::System->getDefaultGuard())->toBe('web');
    expect(UserType::Technician->getDefaultGuard())->toBe('api');
});

test('user type enum can be used in database queries', function (): void {
    $masterAdmin = UserType::MasterAdmin;
    $boUser = UserType::BoUser;
<<<<<<< HEAD
    
=======

>>>>>>> 9831a351 (.)
    expect($masterAdmin->value)->toBe('master_admin');
    expect($boUser->value)->toBe('backoffice_user');
});

test('user type enum can be compared', function (): void {
    $type1 = UserType::MasterAdmin;
    $type2 = UserType::MasterAdmin;
    $type3 = UserType::BoUser;
<<<<<<< HEAD
    
=======

>>>>>>> 9831a351 (.)
    expect($type1)->toBe($type2);
    expect($type1)->not->toBe($type3);
});

test('user type enum can be used in switch statements', function (): void {
    $type = UserType::MasterAdmin;
<<<<<<< HEAD
    
=======

>>>>>>> 9831a351 (.)
    $result = match ($type) {
        UserType::MasterAdmin => 'admin',
        UserType::BoUser => 'backoffice',
        UserType::CustomerUser => 'customer',
        UserType::System => 'system',
        UserType::Technician => 'technician',
    };
<<<<<<< HEAD
    
=======

>>>>>>> 9831a351 (.)
    expect($result)->toBe('admin');
});

test('user type enum can be serialized', function (): void {
    $type = UserType::MasterAdmin;
<<<<<<< HEAD
    
=======

>>>>>>> 9831a351 (.)
    expect(serialize($type))->toBe('O:32:"Modules\User\Enums\UserType":1:{s:4:"name";s:11:"MasterAdmin";}');
});

test('user type enum can be unserialized', function (): void {
    $serialized = 'O:32:"Modules\User\Enums\UserType":1:{s:4:"name";s:11:"MasterAdmin";}';
    $unserialized = unserialize($serialized);
<<<<<<< HEAD
    
=======

>>>>>>> 9831a351 (.)
    expect($unserialized)->toBe(UserType::MasterAdmin);
});

test('user type enum has correct string representation', function (): void {
    expect((string) UserType::MasterAdmin)->toBe('master_admin');
    expect((string) UserType::BoUser)->toBe('backoffice_user');
    expect((string) UserType::CustomerUser)->toBe('customer_user');
    expect((string) UserType::System)->toBe('system');
    expect((string) UserType::Technician)->toBe('technician');
});
