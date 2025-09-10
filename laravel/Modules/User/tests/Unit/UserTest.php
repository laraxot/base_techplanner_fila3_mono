<?php

declare(strict_types=1);

<<<<<<< HEAD
use Modules\User\Models\User;
use Modules\User\Enums\UserType;
use Illuminate\Support\Facades\Hash;
=======
use Illuminate\Support\Facades\Hash;
use Modules\User\Enums\UserType;
use Modules\User\Models\User;
>>>>>>> 9831a351 (.)

uses(Tests\TestCase::class);

beforeEach(function (): void {
    $this->user = User::factory()->create([
        'type' => UserType::MasterAdmin,
        'email' => fake()->unique()->safeEmail(),
        'password' => Hash::make('password123'),
    ]);
});

test('user can be created', function (): void {
    expect($this->user)->toBeInstanceOf(User::class);
    expect($this->user->email)->toBeString()->not->toBeEmpty();
    expect($this->user->type)->toBe(UserType::MasterAdmin);
});

test('user has correct type casting', function (): void {
    expect($this->user->type)->toBeInstanceOf(UserType::class);
    expect($this->user->type->value)->toBe('master_admin');
});

test('user password is hashed', function (): void {
    expect(Hash::check('password123', $this->user->password))->toBeTrue();
    expect(Hash::check('wrongpassword', $this->user->password))->toBeFalse();
});

test('user can change password', function (): void {
    $this->user->update(['password' => Hash::make('newpassword123')]);
<<<<<<< HEAD
    
=======

>>>>>>> 9831a351 (.)
    expect(Hash::check('newpassword123', $this->user->fresh()->password))->toBeTrue();
    expect(Hash::check('password123', $this->user->fresh()->password))->toBeFalse();
});

test('user can be updated', function (): void {
    $this->user->update([
        'email' => 'updated@example.com',
        'type' => UserType::BoUser,
    ]);
<<<<<<< HEAD
    
    $this->user->refresh();
    
=======

    $this->user->refresh();

>>>>>>> 9831a351 (.)
    expect($this->user->email)->toBe('updated@example.com');
    expect($this->user->type)->toBe(UserType::BoUser);
});

test('user can be deleted', function (): void {
    $userId = $this->user->id;
<<<<<<< HEAD
    
    $this->user->delete();
    
=======

    $this->user->delete();

>>>>>>> 9831a351 (.)
    expect(User::find($userId))->toBeNull();
});

test('user has fillable attributes', function (): void {
    $fillable = $this->user->getFillable();
<<<<<<< HEAD
    
=======

>>>>>>> 9831a351 (.)
    expect($fillable)->toContain('email');
    expect($fillable)->toContain('password');
    expect($fillable)->toContain('type');
});

test('user has hidden attributes', function (): void {
    $hidden = $this->user->getHidden();
<<<<<<< HEAD
    
=======

>>>>>>> 9831a351 (.)
    expect($hidden)->toContain('password');
    expect($hidden)->toContain('remember_token');
});

test('user can be found by email', function (): void {
    $foundUser = User::where('email', 'admin@example.com')->first();
<<<<<<< HEAD
    
=======

>>>>>>> 9831a351 (.)
    expect($foundUser)->toBeInstanceOf(User::class);
    expect($foundUser->id)->toBe($this->user->id);
});

test('user can be found by type', function (): void {
    $admins = User::where('type', UserType::MasterAdmin)->get();
<<<<<<< HEAD
    
=======

>>>>>>> 9831a351 (.)
    expect($admins)->toHaveCount(1);
    expect($admins->first()->id)->toBe($this->user->id);
});

test('user can be created with different types', function (): void {
    $boUser = User::factory()->create(['type' => UserType::BoUser]);
    $customerUser = User::factory()->create(['type' => UserType::CustomerUser]);
<<<<<<< HEAD
    
=======

>>>>>>> 9831a351 (.)
    expect($boUser->type)->toBe(UserType::BoUser);
    expect($customerUser->type)->toBe(UserType::CustomerUser);
});

test('user has timestamps', function (): void {
    expect($this->user->created_at)->not->toBeNull();
    expect($this->user->updated_at)->not->toBeNull();
});

test('user can be soft deleted if trait is present', function (): void {
    if (method_exists($this->user, 'trashed')) {
        $this->user->delete();
<<<<<<< HEAD
        
=======

>>>>>>> 9831a351 (.)
        expect($this->user->trashed())->toBeTrue();
        expect(User::withTrashed()->find($this->user->id))->not->toBeNull();
    } else {
        $this->markTestSkipped('SoftDeletes trait not present');
    }
});
