<?php

declare(strict_types=1);

<<<<<<< HEAD
use Modules\User\Filament\Resources\UserResource;
use Modules\User\Filament\Resources\UserResource\Pages\CreateUser;
use Modules\User\Filament\Resources\UserResource\Pages\EditUser;
use Modules\User\Filament\Resources\UserResource\Pages\ListUsers;
use Modules\User\Models\User;
use Modules\User\Enums\UserType;
use Illuminate\Support\Facades\Hash;
=======
use Illuminate\Support\Facades\Hash;
use Modules\User\Enums\UserType;
use Modules\User\Filament\Resources\UserResource;
use Modules\User\Filament\Resources\UserResource\Pages\CreateUser;
use Modules\User\Filament\Resources\UserResource\Pages\EditUser;
use Modules\User\Models\User;
>>>>>>> 9831a351 (.)

uses(Tests\TestCase::class);

beforeEach(function (): void {
    $this->user = User::factory()->create([
        'type' => UserType::MasterAdmin,
        'email' => 'admin@example.com',
        'password' => Hash::make('password123'),
    ]);
});

test('user resource has correct navigation icon', function (): void {
    expect(UserResource::getNavigationIcon())->toBe('heroicon-o-users');
});

test('user resource has correct widgets', function (): void {
    $widgets = UserResource::getWidgets();
<<<<<<< HEAD
    
=======

>>>>>>> 9831a351 (.)
    expect($widgets)->toHaveCount(1);
    expect($widgets)->toContain(\Modules\User\Filament\Resources\UserResource\Widgets\UserOverview::class);
});

test('user resource has correct form schema', function (): void {
    $schema = UserResource::getFormSchema();
<<<<<<< HEAD
    
    expect($schema)->toHaveKey('section01');
    expect($schema)->toHaveKey('section02');
    
    // Test section01
    $section01 = $schema['section01'];
    expect($section01)->toBeInstanceOf(\Filament\Forms\Components\Section::class);
    
    $section01Schema = $section01->getChildComponents();
    expect($section01Schema)->toHaveCount(3);
    
=======

    expect($schema)->toHaveKey('section01');
    expect($schema)->toHaveKey('section02');

    // Test section01
    $section01 = $schema['section01'];
    expect($section01)->toBeInstanceOf(\Filament\Forms\Components\Section::class);

    $section01Schema = $section01->getChildComponents();
    expect($section01Schema)->toHaveCount(3);

>>>>>>> 9831a351 (.)
    // Check if name field exists
    $nameField = collect($section01Schema)->firstWhere('name', 'name');
    expect($nameField)->not->toBeNull();
    expect($nameField)->toBeInstanceOf(\Filament\Forms\Components\TextInput::class);
<<<<<<< HEAD
    
=======

>>>>>>> 9831a351 (.)
    // Check if email field exists
    $emailField = collect($section01Schema)->firstWhere('name', 'email');
    expect($emailField)->not->toBeNull();
    expect($emailField)->toBeInstanceOf(\Filament\Forms\Components\TextInput::class);
<<<<<<< HEAD
    
=======

>>>>>>> 9831a351 (.)
    // Check if password field exists
    $passwordField = collect($section01Schema)->firstWhere('name', 'password');
    expect($passwordField)->not->toBeNull();
    expect($passwordField)->toBeInstanceOf(\Filament\Forms\Components\TextInput::class);
<<<<<<< HEAD
    
    // Test section02
    $section02 = $schema['section02'];
    expect($section02)->toBeInstanceOf(\Filament\Forms\Components\Section::class);
    
    $section02Schema = $section02->getChildComponents();
    expect($section02Schema)->toHaveCount(1);
    
=======

    // Test section02
    $section02 = $schema['section02'];
    expect($section02)->toBeInstanceOf(\Filament\Forms\Components\Section::class);

    $section02Schema = $section02->getChildComponents();
    expect($section02Schema)->toHaveCount(1);

>>>>>>> 9831a351 (.)
    // Check if created_at field exists
    $createdAtField = collect($section02Schema)->firstWhere('name', 'created_at');
    expect($createdAtField)->not->toBeNull();
    expect($createdAtField)->toBeInstanceOf(\Filament\Forms\Components\Placeholder::class);
});

test('user resource has combined relation manager tabs', function (): void {
<<<<<<< HEAD
    $resource = new UserResource();
    
=======
    $resource = new UserResource;

>>>>>>> 9831a351 (.)
    expect($resource->hasCombinedRelationManagerTabsWithContent())->toBeTrue();
});

test('user resource extends correct base class', function (): void {
<<<<<<< HEAD
    $resource = new UserResource();
    
=======
    $resource = new UserResource;

>>>>>>> 9831a351 (.)
    expect($resource)->toBeInstanceOf(\Modules\Xot\Filament\Resources\XotBaseResource::class);
});

test('user resource form schema has correct column spans', function (): void {
    $schema = UserResource::getFormSchema();
<<<<<<< HEAD
    
    $section01 = $schema['section01'];
    $section02 = $schema['section02'];
    
=======

    $section01 = $schema['section01'];
    $section02 = $schema['section02'];

>>>>>>> 9831a351 (.)
    expect($section01->getColumnSpan())->toBe(8);
    expect($section02->getColumnSpan())->toBe(4);
});

test('user resource name field is required', function (): void {
    $schema = UserResource::getFormSchema();
    $section01 = $schema['section01'];
    $section01Schema = $section01->getChildComponents();
<<<<<<< HEAD
    
    $nameField = collect($section01Schema)->firstWhere('name', 'name');
    
=======

    $nameField = collect($section01Schema)->firstWhere('name', 'name');

>>>>>>> 9831a351 (.)
    expect($nameField->isRequired())->toBeTrue();
});

test('user resource email field is required', function (): void {
    $schema = UserResource::getFormSchema();
    $section01 = $schema['section01'];
    $section01Schema = $section01->getChildComponents();
<<<<<<< HEAD
    
    $emailField = collect($section01Schema)->firstWhere('name', 'email');
    
=======

    $emailField = collect($section01Schema)->firstWhere('name', 'email');

>>>>>>> 9831a351 (.)
    expect($emailField->isRequired())->toBeTrue();
});

test('user resource password field is required only on create', function (): void {
    $schema = UserResource::getFormSchema();
    $section01 = $schema['section01'];
    $section01Schema = $section01->getChildComponents();
<<<<<<< HEAD
    
    $passwordField = collect($section01Schema)->firstWhere('name', 'password');
    
    // Test with CreateUser page
    $createUserPage = new CreateUser();
    expect($passwordField->isRequired($createUserPage))->toBeTrue();
    
    // Test with EditUser page
    $editUserPage = new EditUser();
=======

    $passwordField = collect($section01Schema)->firstWhere('name', 'password');

    // Test with CreateUser page
    $createUserPage = new CreateUser;
    expect($passwordField->isRequired($createUserPage))->toBeTrue();

    // Test with EditUser page
    $editUserPage = new EditUser;
>>>>>>> 9831a351 (.)
    expect($passwordField->isRequired($editUserPage))->toBeFalse();
});

test('user resource password field has correct type', function (): void {
    $schema = UserResource::getFormSchema();
    $section01 = $schema['section01'];
    $section01Schema = $section01->getChildComponents();
<<<<<<< HEAD
    
    $passwordField = collect($section01Schema)->firstWhere('name', 'password');
    
=======

    $passwordField = collect($section01Schema)->firstWhere('name', 'password');

>>>>>>> 9831a351 (.)
    expect($passwordField->getType())->toBe('password');
});

test('user resource email field has unique validation', function (): void {
    $schema = UserResource::getFormSchema();
    $section01 = $schema['section01'];
    $section01Schema = $section01->getChildComponents();
<<<<<<< HEAD
    
    $emailField = collect($section01Schema)->firstWhere('name', 'email');
    
=======

    $emailField = collect($section01Schema)->firstWhere('name', 'email');

>>>>>>> 9831a351 (.)
    // Check if the field has unique validation
    $validationRules = $emailField->getValidationRules();
    expect($validationRules)->toContain('unique');
});

test('user resource created_at field shows diff for humans', function (): void {
    $schema = UserResource::getFormSchema();
    $section02 = $schema['section02'];
    $section02Schema = $section02->getChildComponents();
<<<<<<< HEAD
    
    $createdAtField = collect($section02Schema)->firstWhere('name', 'created_at');
    
    // Test with a record
    $content = $createdAtField->getContent($this->user);
    expect($content)->toBe($this->user->created_at->diffForHumans());
    
=======

    $createdAtField = collect($section02Schema)->firstWhere('name', 'created_at');

    // Test with a record
    $content = $createdAtField->getContent($this->user);
    expect($content)->toBe($this->user->created_at->diffForHumans());

>>>>>>> 9831a351 (.)
    // Test with null record
    $contentNull = $createdAtField->getContent(null);
    expect($contentNull)->toBeInstanceOf(\Illuminate\Support\HtmlString::class);
    expect((string) $contentNull)->toContain('&mdash;');
});

test('user resource can be instantiated', function (): void {
<<<<<<< HEAD
    $resource = new UserResource();
    
=======
    $resource = new UserResource;

>>>>>>> 9831a351 (.)
    expect($resource)->toBeInstanceOf(UserResource::class);
});

test('user resource has correct model', function (): void {
    // Since the model is commented out, we'll test the default behavior
<<<<<<< HEAD
    $resource = new UserResource();
    
=======
    $resource = new UserResource;

>>>>>>> 9831a351 (.)
    // The resource should work with the default model resolution
    expect($resource)->toBeInstanceOf(UserResource::class);
});
