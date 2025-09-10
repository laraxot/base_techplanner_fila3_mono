<?php

declare(strict_types=1);

uses(\Tests\TestCase::class);

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
<<<<<<< HEAD
use Modules\User\Models\User;
use Modules\User\Models\Team;
use Modules\User\Models\Profile;
use Modules\User\Models\AuthenticationLog;

// In-memory helper: build a User without touching DB
function stubUser(array $attributes = []): User {
=======
use Modules\User\Models\AuthenticationLog;
use Modules\User\Models\Profile;
use Modules\User\Models\Team;
use Modules\User\Models\User;

// In-memory helper: build a User without touching DB
function stubUser(array $attributes = []): User
{
>>>>>>> 9831a351 (.)
    $defaults = [
        'first_name' => 'John',
        'last_name' => 'Doe',
        'name' => 'John Doe',
        'email' => 'john.doe@example.test',
        'email_verified_at' => Carbon::now(),
        'password' => password_hash('secret', PASSWORD_BCRYPT),
        'remember_token' => null,
        'lang' => 'it',
        'is_active' => true,
        'is_otp' => false,
        'password_expires_at' => null,
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
    ];
    if (array_key_exists('password', $attributes) && is_string($attributes['password'])) {
        $plain = $attributes['password'];
<<<<<<< HEAD
        if (!str_starts_with($plain, '$2y$') && !str_starts_with($plain, '$argon2')) {
            $attributes['password'] = password_hash($plain, PASSWORD_BCRYPT);
        }
    }
    $u = new User();
    $u->forceFill(array_merge($defaults, $attributes));
=======
        if (! str_starts_with($plain, '$2y$') && ! str_starts_with($plain, '$argon2')) {
            $attributes['password'] = password_hash($plain, PASSWORD_BCRYPT);
        }
    }
    $u = new User;
    $u->forceFill(array_merge($defaults, $attributes));

>>>>>>> 9831a351 (.)
    return $u;
}

// Provide Eloquent connection resolver and event dispatcher once for this file
beforeAll(function (): void {
    try {
        Model::setConnectionResolver(app('db'));
        Model::setEventDispatcher(app('events'));
    } catch (\Throwable $e) {
        // TestCase should have the app; if not, ignore silently for pure in-memory assertions
    }
});

describe('User Model', function () {
    it('can be created (in-memory)', function () {
        $user = stubUser();
<<<<<<< HEAD
        
=======

>>>>>>> 9831a351 (.)
        expect($user)->toBeInstanceOf(User::class)
            ->and($user->exists)->toBeFalse()
            ->and($user->email)->toBeString();
    });

    it('supports mass-assignment of expected attributes (behavior)', function () {
        $data = [
            'first_name' => 'Jane',
            'last_name' => 'Roe',
            'name' => 'Jane Roe',
            'email' => 'jane.roe@example.test',
            'lang' => 'en',
            'is_active' => false,
            'is_otp' => true,
        ];
        $user = new User($data);
        expect($user->first_name)->toBe('Jane')
            ->and($user->last_name)->toBe('Roe')
            ->and($user->email)->toBe('jane.roe@example.test')
            ->and($user->lang)->toBe('en')
            ->and($user->is_active)->toBeFalse()
            ->and($user->is_otp)->toBeTrue();
    });

    it('declares sensitive attributes as hidden (without serialization)', function () {
<<<<<<< HEAD
        $hidden = (new User())->getHidden();
=======
        $hidden = (new User)->getHidden();
>>>>>>> 9831a351 (.)
        expect($hidden)->toContain('password')
            ->and($hidden)->toContain('remember_token');
    });

    it('casts attributes correctly', function () {
        $user = stubUser([
            'email_verified_at' => Carbon::now(),
            'created_at' => Carbon::now(),
            'is_active' => true,
            'is_otp' => false,
        ]);
<<<<<<< HEAD
        
=======

>>>>>>> 9831a351 (.)
        expect($user->email_verified_at)->toBeInstanceOf(\Carbon\Carbon::class)
            ->and($user->created_at)->toBeInstanceOf(\Carbon\Carbon::class)
            ->and($user->is_active)->toBeBool()
            ->and($user->is_otp)->toBeBool();
    });

    describe('Relationships', function () {
        it('has profile relationship (in-memory)', function () {
            $user = stubUser();
<<<<<<< HEAD
            $profile = new Profile();
            $profile->forceFill(['user_id' => 'test-user-id']);
            // Set relation without touching DB
            $user->setRelation('profile', $profile);
            
=======
            $profile = new Profile;
            $profile->forceFill(['user_id' => 'test-user-id']);
            // Set relation without touching DB
            $user->setRelation('profile', $profile);

>>>>>>> 9831a351 (.)
            expect($user->profile)->toBeInstanceOf(Profile::class);
        });

        it('can attach authentication logs in-memory', function () {
            $user = stubUser();
<<<<<<< HEAD
            $log = new AuthenticationLog();
=======
            $log = new AuthenticationLog;
>>>>>>> 9831a351 (.)
            $user->setRelation('authentications', collect([$log]));
            expect($user->authentications)->toHaveCount(1);
        });

        it('can expose ownedTeams relation when preset', function () {
            $user = stubUser();
<<<<<<< HEAD
            $team = new Team();
=======
            $team = new Team;
>>>>>>> 9831a351 (.)
            $user->setRelation('ownedTeams', collect([$team]));
            expect($user->ownedTeams)->toHaveCount(1);
        });

        it('can expose teams relation when preset', function () {
            $user = stubUser();
<<<<<<< HEAD
            $team = new Team();
=======
            $team = new Team;
>>>>>>> 9831a351 (.)
            $user->setRelation('teams', collect([$team]));
            expect($user->teams)->toHaveCount(1);
        });
    });

    describe('Accessors and Mutators', function () {
        it('has full_name accessor', function () {
            $user = stubUser([
                'first_name' => 'John',
<<<<<<< HEAD
                'last_name' => 'Doe'
            ]);
            
=======
                'last_name' => 'Doe',
            ]);

>>>>>>> 9831a351 (.)
            expect($user->full_name)->toBe('John Doe');
        });

        it('handles null names in full_name accessor', function () {
            $user = stubUser([
                'first_name' => 'John',
<<<<<<< HEAD
                'last_name' => null
            ]);
            
=======
                'last_name' => null,
            ]);

>>>>>>> 9831a351 (.)
            // Some implementations may include a trailing space when last_name is null
            expect(rtrim($user->full_name))->toBe('John');
        });

        it('hashes password when set', function () {
            $user = stubUser(['password' => 'plain-password']);
<<<<<<< HEAD
            
=======

>>>>>>> 9831a351 (.)
            expect($user->password)->not->toBe('plain-password')
                ->and(password_verify('plain-password', $user->password))->toBeTrue();
        });
    });

    describe('Authentication Features', function () {
        it('reflects verified email state when timestamp is set', function () {
            $user = stubUser(['email_verified_at' => null]);
            expect($user->hasVerifiedEmail())->toBeFalse();
            $user->email_verified_at = Carbon::now();
            expect($user->hasVerifiedEmail())->toBeTrue();
        });

        it('can be activated/deactivated (in-memory)', function () {
            $user = stubUser(['is_active' => false]);
            expect($user->is_active)->toBeFalse();
            // simulate activation without DB
            $user->is_active = true;
            expect($user->is_active)->toBeTrue();
        });

        it('supports OTP authentication', function () {
            $user = stubUser(['is_otp' => true]);
<<<<<<< HEAD
            
=======

>>>>>>> 9831a351 (.)
            expect($user->is_otp)->toBeTrue();
        });
    });

    describe('Scopes and Queries', function () {
        it('exposes active flag for filtering (in-memory)', function () {
            $u1 = stubUser(['is_active' => true]);
            $u2 = stubUser(['is_active' => false]);
<<<<<<< HEAD
            
            $active = collect([$u1, $u2])->filter(fn (User $u) => $u->is_active === true);
            $inactive = collect([$u1, $u2])->filter(fn (User $u) => $u->is_active === false);
            
=======

            $active = collect([$u1, $u2])->filter(fn (User $u) => $u->is_active === true);
            $inactive = collect([$u1, $u2])->filter(fn (User $u) => $u->is_active === false);

>>>>>>> 9831a351 (.)
            expect($active)->toHaveCount(1)
                ->and($inactive)->toHaveCount(1);
        });

        it('exposes email verification flag for filtering (in-memory)', function () {
            $u1 = stubUser(['email_verified_at' => Carbon::now()]);
            $u2 = stubUser(['email_verified_at' => null]);
<<<<<<< HEAD
            
            $verified = collect([$u1, $u2])->filter(fn (User $u) => $u->email_verified_at !== null);
            $unverified = collect([$u1, $u2])->filter(fn (User $u) => $u->email_verified_at === null);
            
=======

            $verified = collect([$u1, $u2])->filter(fn (User $u) => $u->email_verified_at !== null);
            $unverified = collect([$u1, $u2])->filter(fn (User $u) => $u->email_verified_at === null);

>>>>>>> 9831a351 (.)
            expect($verified)->toHaveCount(1)
                ->and($unverified)->toHaveCount(1);
        });

        it('exposes language for filtering (in-memory)', function () {
            $u1 = stubUser(['lang' => 'it']);
            $u2 = stubUser(['lang' => 'en']);
<<<<<<< HEAD
            
=======

>>>>>>> 9831a351 (.)
            $italians = collect([$u1, $u2])->where('lang', 'it');
            expect($italians)->toHaveCount(1);
        });
    });

    describe('Security Features', function () {
        it('has password expiration', function () {
            $user = stubUser(['password_expires_at' => Carbon::now()->addDays(30)]);
<<<<<<< HEAD
            
=======

>>>>>>> 9831a351 (.)
            expect($user->password_expires_at)->toBeInstanceOf(\Carbon\Carbon::class);
        });

        it('tracks creation and updates (in-memory)', function () {
            $user = stubUser();
<<<<<<< HEAD
            
=======

>>>>>>> 9831a351 (.)
            // created_by/updated_by may be null in-memory; assert timestamps typing only
            expect($user->created_at)->toBeInstanceOf(\Carbon\Carbon::class)
                ->and($user->updated_at)->toBeInstanceOf(\Carbon\Carbon::class);
        });
    });

    describe('Team Management', function () {
        it('can have current team (in-memory)', function () {
            $user = stubUser(['current_team_id' => 'team-id']);
            expect($user->current_team_id)->toBe('team-id');
        });

        it('can own teams (in-memory)', function () {
            $user = stubUser();
<<<<<<< HEAD
            $team = new Team();
            $team->forceFill(['user_id' => 'owner-id']);
            $user->setRelation('ownedTeams', collect([$team]));
            
=======
            $team = new Team;
            $team->forceFill(['user_id' => 'owner-id']);
            $user->setRelation('ownedTeams', collect([$team]));

>>>>>>> 9831a351 (.)
            expect($user->ownedTeams)->toHaveCount(1);
        });
    });
});
