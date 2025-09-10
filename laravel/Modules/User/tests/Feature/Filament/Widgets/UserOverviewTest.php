<?php

declare(strict_types=1);

<<<<<<< HEAD
use Modules\User\Filament\Resources\UserResource\Widgets\UserOverview;
use Modules\User\Models\User;
use Modules\User\Enums\UserType;
use Illuminate\Database\Eloquent\Model;
=======
use Illuminate\Database\Eloquent\Model;
use Modules\User\Enums\UserType;
use Modules\User\Filament\Resources\UserResource\Widgets\UserOverview;
use Modules\User\Models\User;
>>>>>>> 9831a351 (.)

uses(Tests\TestCase::class);

beforeEach(function (): void {
<<<<<<< HEAD
    $this->widget = new UserOverview();
=======
    $this->widget = new UserOverview;
>>>>>>> 9831a351 (.)
    $this->user = User::factory()->create([
        'type' => UserType::MasterAdmin,
        'email' => 'admin@example.com',
    ]);
});

test('user overview widget extends correct base class', function (): void {
    expect($this->widget)->toBeInstanceOf(\Filament\Widgets\Widget::class);
});

test('user overview widget has correct view', function (): void {
    $reflection = new ReflectionClass(UserOverview::class);
    $viewProperty = $reflection->getProperty('view');
    $viewProperty->setAccessible(true);
<<<<<<< HEAD
    
=======

>>>>>>> 9831a351 (.)
    expect($viewProperty->getValue($this->widget))->toBe('user::filament.resources.user-resource.widgets.user-overview');
});

test('user overview widget has record property', function (): void {
    expect($this->widget)->toHaveProperty('record');
    expect($this->widget->record)->toBeNull();
});

test('user overview widget can set record', function (): void {
    $this->widget->record = $this->user;
<<<<<<< HEAD
    
=======

>>>>>>> 9831a351 (.)
    expect($this->widget->record)->toBe($this->user);
    expect($this->widget->record)->toBeInstanceOf(Model::class);
});

test('user overview widget record property is nullable', function (): void {
    $reflection = new ReflectionClass(UserOverview::class);
    $recordProperty = $reflection->getProperty('record');
<<<<<<< HEAD
    
=======

>>>>>>> 9831a351 (.)
    expect($recordProperty->getType()->allowsNull())->toBeTrue();
});

test('user overview widget has correct namespace', function (): void {
    expect(UserOverview::class)->toContain('Modules\User\Filament\Resources\UserResource\Widgets');
});

test('user overview widget can be instantiated', function (): void {
    expect($this->widget)->toBeInstanceOf(UserOverview::class);
});

test('user overview widget has correct static properties', function (): void {
    $reflection = new ReflectionClass(UserOverview::class);
    $viewProperty = $reflection->getProperty('view');
    $viewProperty->setAccessible(true);
<<<<<<< HEAD
    
=======

>>>>>>> 9831a351 (.)
    expect($viewProperty->isStatic())->toBeTrue();
});

test('user overview widget view path is correct', function (): void {
    $reflection = new ReflectionClass(UserOverview::class);
    $viewProperty = $reflection->getProperty('view');
    $viewProperty->setAccessible(true);
<<<<<<< HEAD
    
=======

>>>>>>> 9831a351 (.)
    $viewPath = $viewProperty->getValue($this->widget);
    expect($viewPath)->toContain('user::');
    expect($viewPath)->toContain('widgets.user-overview');
});
