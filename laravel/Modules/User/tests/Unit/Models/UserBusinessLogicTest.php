<?php

declare(strict_types=1);

use Modules\User\Models\User;

describe('User Business Logic', function () {
    test('user extends base user', function () {
        expect(User::class)->toBeSubclassOf(\Modules\User\Models\BaseUser::class);
    });

    test('user has authentication capabilities', function () {
<<<<<<< HEAD
        $user = new User();
        $user->email = 'test@example.com';
        $user->password = 'hashed-password';
        
=======
        $user = new User;
        $user->email = 'test@example.com';
        $user->password = 'hashed-password';

>>>>>>> 9831a351 (.)
        expect($user->email)->toBe('test@example.com');
        expect($user->password)->toBe('hashed-password');
    });

    test('user can have name components', function () {
<<<<<<< HEAD
        $user = new User();
        $user->first_name = 'Mario';
        $user->last_name = 'Rossi';
        $user->name = 'Mario Rossi';
        
=======
        $user = new User;
        $user->first_name = 'Mario';
        $user->last_name = 'Rossi';
        $user->name = 'Mario Rossi';

>>>>>>> 9831a351 (.)
        expect($user->first_name)->toBe('Mario');
        expect($user->last_name)->toBe('Rossi');
        expect($user->name)->toBe('Mario Rossi');
    });

    test('user has activation status', function () {
<<<<<<< HEAD
        $user = new User();
        $user->is_active = true;
        
=======
        $user = new User;
        $user->is_active = true;

>>>>>>> 9831a351 (.)
        expect($user->is_active)->toBe(true);
    });

    test('user has otp capability', function () {
<<<<<<< HEAD
        $user = new User();
        $user->is_otp = true;
        
=======
        $user = new User;
        $user->is_otp = true;

>>>>>>> 9831a351 (.)
        expect($user->is_otp)->toBe(true);
    });

    test('user can have language preference', function () {
<<<<<<< HEAD
        $user = new User();
        $user->lang = 'it';
        
=======
        $user = new User;
        $user->lang = 'it';

>>>>>>> 9831a351 (.)
        expect($user->lang)->toBe('it');
    });

    test('user has email verification tracking', function () {
<<<<<<< HEAD
        $user = new User();
        $user->email_verified_at = '2023-01-01 12:00:00';
        
=======
        $user = new User;
        $user->email_verified_at = '2023-01-01 12:00:00';

>>>>>>> 9831a351 (.)
        expect($user->email_verified_at)->toBe('2023-01-01 12:00:00');
    });

    test('user has password expiry tracking', function () {
<<<<<<< HEAD
        $user = new User();
        $user->password_expires_at = '2023-12-31 23:59:59';
        
=======
        $user = new User;
        $user->password_expires_at = '2023-12-31 23:59:59';

>>>>>>> 9831a351 (.)
        expect($user->password_expires_at)->toBe('2023-12-31 23:59:59');
    });

    test('user can have current team', function () {
<<<<<<< HEAD
        $user = new User();
        $user->current_team_id = 1;
        
=======
        $user = new User;
        $user->current_team_id = 1;

>>>>>>> 9831a351 (.)
        expect($user->current_team_id)->toBe(1);
    });

    test('user can have profile photo', function () {
<<<<<<< HEAD
        $user = new User();
        $user->profile_photo_path = '/storage/profile-photos/user.jpg';
        
=======
        $user = new User;
        $user->profile_photo_path = '/storage/profile-photos/user.jpg';

>>>>>>> 9831a351 (.)
        expect($user->profile_photo_path)->toBe('/storage/profile-photos/user.jpg');
    });

    test('user can have remember token', function () {
<<<<<<< HEAD
        $user = new User();
        $user->remember_token = 'abc123def456';
        
=======
        $user = new User;
        $user->remember_token = 'abc123def456';

>>>>>>> 9831a351 (.)
        expect($user->remember_token)->toBe('abc123def456');
    });
});
