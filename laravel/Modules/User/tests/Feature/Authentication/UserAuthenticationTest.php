<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\Passport;
use Modules\User\Models\Permission;
use Modules\User\Models\Role;
use Modules\User\Models\User;

beforeEach(function () {
    $this->user = User::factory()->create([
        'password' => Hash::make('password123'),
        'is_active' => true,
        'email_verified_at' => now(),
    ]);
});

describe('User Authentication', function () {
    it('can authenticate with valid credentials', function () {
        $result = Auth::attempt([
            'email' => $this->user->email,
            'password' => 'password123',
        ]);

        expect($result)->toBe(true);
        expect(Auth::user()?->id)->toBe($this->user->id);
    });

    it('cannot authenticate with invalid password', function () {
        $result = Auth::attempt([
            'email' => $this->user->email,
            'password' => 'wrongpassword',
        ]);

        expect($result)->toBe(false);
        expect(Auth::user())->toBeNull();
    });

    it('cannot authenticate with non-existent email', function () {
        $result = Auth::attempt([
            'email' => 'nonexistent@example.com',
            'password' => 'password123',
        ]);

        expect($result)->toBe(false);
        expect(Auth::user())->toBeNull();
    });

    it('cannot authenticate inactive user', function () {
        $inactiveUser = User::factory()->create([
            'password' => Hash::make('password123'),
            'is_active' => false,
        ]);

        $result = Auth::attempt([
            'email' => $inactiveUser->email,
            'password' => 'password123',
        ]);

        expect($result)->toBe(false);
    });

    it('can logout user', function () {
        Auth::login($this->user);
        expect(Auth::check())->toBe(true);

        Auth::logout();
        expect(Auth::check())->toBe(false);
    });
});

describe('User Password Management', function () {
    it('can hash password on creation', function () {
        $user = User::factory()->create([
            'password' => Hash::make('testpassword'),
        ]);

        expect(Hash::check('testpassword', $user->password))->toBe(true);
    });

    it('can change password', function () {
        $newPassword = 'newpassword123';
        $this->user->update([
            'password' => Hash::make($newPassword),
        ]);

        expect(Hash::check($newPassword, $this->user->fresh()->password))->toBe(true);
        expect(Hash::check('password123', $this->user->fresh()->password))->toBe(false);
    });

    it('can check password expiration', function () {
        $user = User::factory()->create([
            'password_expires_at' => now()->subDays(1),
        ]);

        expect($user->password_expires_at->isPast())->toBe(true);
    });

    it('can set password expiration', function () {
        $expirationDate = now()->addDays(90);
        $this->user->update([
            'password_expires_at' => $expirationDate,
        ]);

        expect(
            $this
                ->user->fresh()
                ->password_expires_at->toDateString(),
        )
            ->toBe($expirationDate->toDateString());
    });
});

describe('User Remember Token', function () {
    it('can generate remember token', function () {
        $token = Str::random(60);
        $this->user->update(['remember_token' => $token]);

        expect($this->user->fresh()->remember_token)->toBe($token);
    });

    it('can authenticate using remember token', function () {
        $token = Str::random(60);
        $this->user->update(['remember_token' => $token]);

        $user = User::where('email', $this->user->email)->where('remember_token', $token)->first();

        expect($user)->not->toBeNull();
        expect($user->id)->toBe($this->user->id);
    });
});

describe('User Email Verification', function () {
    it('can mark email as verified', function () {
        $user = User::factory()->create([
            'email_verified_at' => null,
        ]);

        expect($user->email_verified_at)->toBeNull();

        $user->markEmailAsVerified();

        expect($user->fresh()->email_verified_at)->not->toBeNull();
    });

    it('can check if email is verified', function () {
        $verifiedUser = User::factory()->create([
            'email_verified_at' => now(),
        ]);

        $unverifiedUser = User::factory()->create([
            'email_verified_at' => null,
        ]);

        expect($verifiedUser->hasVerifiedEmail())->toBe(true);
        expect($unverifiedUser->hasVerifiedEmail())->toBe(false);
    });

    it('can send email verification notification', function () {
        $user = User::factory()->create([
            'email_verified_at' => null,
        ]);

        Notification::fake();

        $user->sendEmailVerificationNotification();

        Notification::assertSentTo($user, \Illuminate\Auth\Notifications\VerifyEmail::class);
    });
});

describe('User Authorization', function () {
    it('can assign and check roles', function () {
        $adminRole = Role::factory()->create(['name' => 'admin']);
        $editorRole = Role::factory()->create(['name' => 'editor']);

        $this->user->assignRole($adminRole);

        expect($this->user->hasRole('admin'))->toBe(true);
        expect($this->user->hasRole('editor'))->toBe(false);
        expect($this->user->hasRole($adminRole))->toBe(true);
    });

    it('can assign and check permissions', function () {
        $editPermission = Permission::factory()->create(['name' => 'edit posts']);
        $deletePermission = Permission::factory()->create(['name' => 'delete posts']);

        $this->user->givePermissionTo($editPermission);

        expect($this->user->hasPermissionTo('edit posts'))->toBe(true);
        expect($this->user->hasPermissionTo('delete posts'))->toBe(false);
        expect($this->user->hasPermissionTo($editPermission))->toBe(true);
    });

    it('can inherit permissions from roles', function () {
        $role = Role::factory()->create(['name' => 'editor']);
        $permission = Permission::factory()->create(['name' => 'edit posts']);

        $role->givePermissionTo($permission);
        $this->user->assignRole($role);

        expect($this->user->hasPermissionTo('edit posts'))->toBe(true);
    });

    it('can check multiple permissions', function () {
        $permission1 = Permission::factory()->create(['name' => 'edit posts']);
        $permission2 = Permission::factory()->create(['name' => 'delete posts']);

        $this->user->givePermissionTo([$permission1, $permission2]);

        expect($this->user->hasAllPermissions(['edit posts', 'delete posts']))->toBe(true);
        expect($this->user->hasAnyPermission(['edit posts', 'publish posts']))->toBe(true);
    });

    it('can remove roles and permissions', function () {
        $role = Role::factory()->create(['name' => 'editor']);
        $permission = Permission::factory()->create(['name' => 'edit posts']);

        $this->user->assignRole($role);
        $this->user->givePermissionTo($permission);

        expect($this->user->hasRole('editor'))->toBe(true);
        expect($this->user->hasPermissionTo('edit posts'))->toBe(true);

        $this->user->removeRole($role);
        $this->user->revokePermissionTo($permission);

        expect($this->user->hasRole('editor'))->toBe(false);
        expect($this->user->hasPermissionTo('edit posts'))->toBe(false);
    });
});

describe('User OAuth Authentication', function () {
    it('can have oauth clients', function () {
        Passport::actingAs($this->user);

        expect($this->user->clients())->toBeInstanceOf(\Illuminate\Database\Eloquent\Relations\HasMany::class);
    });

    it('can have oauth tokens', function () {
        Passport::actingAs($this->user);

        expect($this->user->tokens())->toBeInstanceOf(\Illuminate\Database\Eloquent\Relations\HasMany::class);
    });

    it('can find user for passport', function () {
        $user = User::findForPassport($this->user->email);

        expect($user)->not->toBeNull();
        expect($user->id)->toBe($this->user->id);
    });

    it('can validate password for passport', function () {
        $isValid = $this->user->validateForPassportPasswordGrant('password123');

        expect($isValid)->toBe(true);
    });
});

describe('User Authentication Logging', function () {
    it('can log authentication attempts', function () {
        expect($this->user->authentications())->toBeInstanceOf(\Illuminate\Database\Eloquent\Relations\HasMany::class);
    });

    it('can get latest authentication log', function () {
        expect($this->user->latestAuthentication())
            ->toBeInstanceOf(\Illuminate\Database\Eloquent\Relations\HasOne::class);
    });
});

describe('User Session Management', function () {
    it('can store user in session', function () {
        Auth::login($this->user);

        expect(session()->has('login_user_id'))->toBe(true);
        expect(session('login_user_id'))->toBe($this->user->id);
    });

    it('can remember user across sessions', function () {
        Auth::login($this->user, true);

        expect($this->user->fresh()->remember_token)->not->toBeNull();
    });

    it('can clear user session on logout', function () {
        Auth::login($this->user);
        expect(Auth::check())->toBe(true);

        Auth::logout();
        expect(Auth::check())->toBe(false);
        expect(session()->has('login_user_id'))->toBe(false);
    });
});

describe('User Two Factor Authentication', function () {
    it('can enable two factor authentication', function () {
        $this->user->update(['is_otp' => true]);

        expect($this->user->fresh()->is_otp)->toBe(true);
    });

    it('can disable two factor authentication', function () {
        $this->user->update(['is_otp' => false]);

        expect($this->user->fresh()->is_otp)->toBe(false);
    });

    it('handles otp authentication workflow', function () {
        $user = User::factory()->create([
            'is_otp' => true,
            'password' => Hash::make('password123'),
        ]);

        // First step: password authentication
        $result = Auth::attempt([
            'email' => $user->email,
            'password' => 'password123',
        ]);

        // Should handle OTP requirement
        expect($user->is_otp)->toBe(true);
    });
});
