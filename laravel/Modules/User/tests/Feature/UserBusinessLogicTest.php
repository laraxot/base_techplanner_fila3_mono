<?php

declare(strict_types=1);

<<<<<<< HEAD
namespace Modules\User\Tests\Feature;

use Illuminate\Support\Facades\Hash;
use Modules\User\Models\Permission;
use Modules\User\Models\Profile;
use Modules\User\Models\Role;
use Modules\User\Models\Team;
use Modules\User\Models\User;
=======
use Modules\User\Models\User;
use Modules\User\Models\Team;
use Modules\User\Models\Role;
use Modules\User\Models\Permission;
use Modules\User\Models\Profile;
use Illuminate\Support\Facades\Hash;
>>>>>>> 8055579 (.)

describe('User Business Logic Integration', function () {
    beforeEach(function () {
        $this->user = User::factory()->create();
        $this->admin = User::factory()->create();
        $this->team = Team::factory()->create();
    });

    describe('User Authentication Business Rules', function () {
        it('enforces password complexity requirements', function () {
            $weakPassword = '123456';
            $strongPassword = 'SecurePass123!';
<<<<<<< HEAD

            // Verifica che la password debole non sia accettabile
            $weakHash = Hash::make($weakPassword);
            $weakUser = User::factory()->create(['password' => $weakHash]);

            // Verifica che la password forte sia accettabile
            $strongHash = Hash::make($strongPassword);
            $strongUser = User::factory()->create(['password' => $strongHash]);

            expect($weakUser->password)->not->toBe($weakPassword);
            expect($strongUser->password)->not->toBe($strongPassword);

=======
            
            // Verifica che la password debole non sia accettabile
            $weakHash = Hash::make($weakPassword);
            $weakUser = User::factory()->create(['password' => $weakHash]);
            
            // Verifica che la password forte sia accettabile
            $strongHash = Hash::make($strongPassword);
            $strongUser = User::factory()->create(['password' => $strongHash]);
            
            expect($weakUser->password)->not->toBe($weakPassword);
            expect($strongUser->password)->not->toBe($strongPassword);
            
>>>>>>> 8055579 (.)
            // Verifica che entrambe le password siano hashate
            expect(Hash::check($weakPassword, $weakUser->password))->toBeTrue();
            expect(Hash::check($strongPassword, $strongUser->password))->toBeTrue();
        });

        it('enforces email uniqueness across the system', function () {
            $email = 'test@example.com';
<<<<<<< HEAD

            // Primo utente con email
            $user1 = User::factory()->create(['email' => $email]);

            // Tentativo di creare secondo utente con stessa email
            $this->expectException(Illuminate\Database\QueryException::class);

=======
            
            // Primo utente con email
            $user1 = User::factory()->create(['email' => $email]);
            
            // Tentativo di creare secondo utente con stessa email
            $this->expectException(Illuminate\Database\QueryException::class);
            
>>>>>>> 8055579 (.)
            User::factory()->create(['email' => $email]);
        });

        it('enforces username uniqueness when required', function () {
            $username = 'testuser';
<<<<<<< HEAD

            // Primo utente con username
            $user1 = User::factory()->create(['username' => $username]);

            // Tentativo di creare secondo utente con stesso username
            $this->expectException(Illuminate\Database\QueryException::class);

=======
            
            // Primo utente con username
            $user1 = User::factory()->create(['username' => $username]);
            
            // Tentativo di creare secondo utente con stesso username
            $this->expectException(Illuminate\Database\QueryException::class);
            
>>>>>>> 8055579 (.)
            User::factory()->create(['username' => $username]);
        });
    });

    describe('User Profile Business Rules', function () {
        it('enforces profile completion requirements', function () {
            $user = User::factory()->create([
                'first_name' => null,
<<<<<<< HEAD
                'last_name' => null,
            ]);

            // Verifica che i campi obbligatori siano null
            expect($user->first_name)->toBeNull();
            expect($user->last_name)->toBeNull();

            // Aggiornamento con dati completi
            $user->update([
                'first_name' => 'Mario',
                'last_name' => 'Rossi',
            ]);

=======
                'last_name' => null
            ]);
            
            // Verifica che i campi obbligatori siano null
            expect($user->first_name)->toBeNull();
            expect($user->last_name)->toBeNull();
            
            // Aggiornamento con dati completi
            $user->update([
                'first_name' => 'Mario',
                'last_name' => 'Rossi'
            ]);
            
>>>>>>> 8055579 (.)
            $user->refresh();
            expect($user->first_name)->toBe('Mario');
            expect($user->last_name)->toBe('Rossi');
        });

        it('enforces data validation rules', function () {
            $invalidData = [
                'email' => 'invalid-email',
                'phone' => 'not-a-phone',
<<<<<<< HEAD
                'date_of_birth' => 'invalid-date',
            ];

            // Verifica che i dati non validi non possano essere salvati
            foreach ($invalidData as $field => $value) {
                $this->expectException(Illuminate\Database\QueryException::class);

=======
                'date_of_birth' => 'invalid-date'
            ];
            
            // Verifica che i dati non validi non possano essere salvati
            foreach ($invalidData as $field => $value) {
                $this->expectException(Illuminate\Database\QueryException::class);
                
>>>>>>> 8055579 (.)
                User::factory()->create([$field => $value]);
            }
        });

        it('enforces age restrictions for certain operations', function () {
            $underageUser = User::factory()->create([
<<<<<<< HEAD
                'date_of_birth' => now()->subYears(16),
            ]);

            $adultUser = User::factory()->create([
                'date_of_birth' => now()->subYears(25),
            ]);

            $underageAge = now()->diffInYears($underageUser->date_of_birth);
            $adultAge = now()->diffInYears($adultUser->date_of_birth);

=======
                'date_of_birth' => now()->subYears(16)
            ]);
            
            $adultUser = User::factory()->create([
                'date_of_birth' => now()->subYears(25)
            ]);
            
            $underageAge = now()->diffInYears($underageUser->date_of_birth);
            $adultAge = now()->diffInYears($adultUser->date_of_birth);
            
>>>>>>> 8055579 (.)
            expect($underageAge)->toBeLessThan(18);
            expect($adultAge)->toBeGreaterThanOrEqual(18);
        });
    });

    describe('Team Management Business Rules', function () {
        it('enforces team membership limits', function () {
            $user = User::factory()->create();
            $teams = Team::factory()->count(5)->create();
<<<<<<< HEAD

=======
            
>>>>>>> 8055579 (.)
            // Aggiunta utente a tutti i team
            foreach ($teams as $team) {
                $user->teams()->attach($team->id);
            }
<<<<<<< HEAD

            // Verifica che l'utente sia membro di tutti i team
            expect($user->teams)->toHaveCount(5);

            // Verifica che non possa essere aggiunto a un team già membro
            $existingTeam = $user->teams->first();
            $user->teams()->attach($existingTeam->id);

=======
            
            // Verifica che l'utente sia membro di tutti i team
            expect($user->teams)->toHaveCount(5);
            
            // Verifica che non possa essere aggiunto a un team già membro
            $existingTeam = $user->teams->first();
            $user->teams()->attach($existingTeam->id);
            
>>>>>>> 8055579 (.)
            // Non dovrebbe creare duplicati
            expect($user->teams()->count())->toBe(5);
        });

        it('enforces team role hierarchy', function () {
            $user = User::factory()->create();
            $team = Team::factory()->create();
<<<<<<< HEAD

=======
            
>>>>>>> 8055579 (.)
            // Ruoli con livelli di autorità
            $memberRole = Role::factory()->create(['name' => 'member', 'level' => 1]);
            $moderatorRole = Role::factory()->create(['name' => 'moderator', 'level' => 2]);
            $adminRole = Role::factory()->create(['name' => 'admin', 'level' => 3]);
<<<<<<< HEAD

            // Assegnazione ruolo base
            $user->teams()->attach($team->id, ['role' => 'member']);

=======
            
            // Assegnazione ruolo base
            $user->teams()->attach($team->id, ['role' => 'member']);
            
>>>>>>> 8055579 (.)
            // Verifica che l'utente abbia il ruolo corretto
            $userTeam = $user->teams()->where('team_id', $team->id)->first();
            expect($userTeam->pivot->role)->toBe('member');
        });

        it('enforces team ownership rules', function () {
            $owner = User::factory()->create();
            $member = User::factory()->create();
            $team = Team::factory()->create(['user_id' => $owner->id]);
<<<<<<< HEAD

            // Verifica che solo il proprietario possa eliminare il team
            expect($team->user_id)->toBe($owner->id);

            // Tentativo di eliminazione da parte di un membro
            $member->teams()->attach($team->id);

=======
            
            // Verifica che solo il proprietario possa eliminare il team
            expect($team->user_id)->toBe($owner->id);
            
            // Tentativo di eliminazione da parte di un membro
            $member->teams()->attach($team->id);
            
>>>>>>> 8055579 (.)
            // Il membro non dovrebbe poter eliminare il team
            expect($team->user_id)->toBe($owner->id);
        });
    });

    describe('Permission and Role Business Rules', function () {
        it('enforces permission inheritance', function () {
            $user = User::factory()->create();
            $role = Role::factory()->create(['name' => 'editor']);
            $permission = Permission::factory()->create(['name' => 'edit_posts']);
<<<<<<< HEAD

            // Assegnazione ruolo all'utente
            $user->roles()->attach($role->id);

            // Assegnazione permesso al ruolo
            $role->permissions()->attach($permission->id);

=======
            
            // Assegnazione ruolo all'utente
            $user->roles()->attach($role->id);
            
            // Assegnazione permesso al ruolo
            $role->permissions()->attach($permission->id);
            
>>>>>>> 8055579 (.)
            // Verifica che l'utente erediti il permesso dal ruolo
            $userPermissions = $user->getAllPermissions();
            expect($userPermissions)->toContain($permission);
        });

        it('enforces permission conflicts', function () {
            $user = User::factory()->create();
<<<<<<< HEAD

=======
            
>>>>>>> 8055579 (.)
            // Permessi che si escludono a vicenda
            $readPermission = Permission::factory()->create(['name' => 'read_posts']);
            $writePermission = Permission::factory()->create(['name' => 'write_posts']);
            $deletePermission = Permission::factory()->create(['name' => 'delete_posts']);
<<<<<<< HEAD

=======
            
>>>>>>> 8055579 (.)
            // Assegnazione permessi all'utente
            $user->permissions()->attach([
                $readPermission->id,
                $writePermission->id,
<<<<<<< HEAD
                $deletePermission->id,
            ]);

            // Verifica che tutti i permessi siano assegnati
            expect($user->permissions)->toHaveCount(3);

=======
                $deletePermission->id
            ]);
            
            // Verifica che tutti i permessi siano assegnati
            expect($user->permissions)->toHaveCount(3);
            
>>>>>>> 8055579 (.)
            // Verifica che non ci siano conflitti
            $userPermissions = $user->permissions->pluck('name')->toArray();
            expect($userPermissions)->toContain('read_posts');
            expect($userPermissions)->toContain('write_posts');
            expect($userPermissions)->toContain('delete_posts');
        });

        it('enforces role-based access control', function () {
            $admin = User::factory()->create();
            $moderator = User::factory()->create();
            $user = User::factory()->create();
<<<<<<< HEAD

=======
            
>>>>>>> 8055579 (.)
            // Ruoli con livelli di accesso
            $adminRole = Role::factory()->create(['name' => 'admin', 'level' => 3]);
            $moderatorRole = Role::factory()->create(['name' => 'moderator', 'level' => 2]);
            $userRole = Role::factory()->create(['name' => 'user', 'level' => 1]);
<<<<<<< HEAD

=======
            
>>>>>>> 8055579 (.)
            // Assegnazione ruoli
            $admin->roles()->attach($adminRole->id);
            $moderator->roles()->attach($moderatorRole->id);
            $user->roles()->attach($userRole->id);
<<<<<<< HEAD

=======
            
>>>>>>> 8055579 (.)
            // Verifica livelli di accesso
            expect($adminRole->level)->toBeGreaterThan($moderatorRole->level);
            expect($moderatorRole->level)->toBeGreaterThan($userRole->level);
        });
    });

    describe('Data Integrity Business Rules', function () {
        it('enforces referential integrity for user relationships', function () {
            $user = User::factory()->create();
            $profile = Profile::factory()->create(['user_id' => $user->id]);
            $team = Team::factory()->create();
<<<<<<< HEAD

            // Verifica che le relazioni siano mantenute
            expect($profile->user_id)->toBe($user->id);

            // Tentativo di eliminare utente con relazioni
            $this->expectException(Illuminate\Database\QueryException::class);

=======
            
            // Verifica che le relazioni siano mantenute
            expect($profile->user_id)->toBe($user->id);
            
            // Tentativo di eliminare utente con relazioni
            $this->expectException(Illuminate\Database\QueryException::class);
            
>>>>>>> 8055579 (.)
            $user->delete();
        });

        it('enforces data consistency across user attributes', function () {
            $user = User::factory()->create([
                'first_name' => 'Mario',
                'last_name' => 'Rossi',
<<<<<<< HEAD
                'email' => 'mario.rossi@example.com',
            ]);

            // Verifica coerenza dei dati
            expect($user->full_name)->toBe('Mario Rossi');
            expect($user->email)->toBe('mario.rossi@example.com');

            // Aggiornamento che mantiene la coerenza
            $user->update([
                'first_name' => 'Marco',
                'email' => 'marco.rossi@example.com',
            ]);

=======
                'email' => 'mario.rossi@example.com'
            ]);
            
            // Verifica coerenza dei dati
            expect($user->full_name)->toBe('Mario Rossi');
            expect($user->email)->toBe('mario.rossi@example.com');
            
            // Aggiornamento che mantiene la coerenza
            $user->update([
                'first_name' => 'Marco',
                'email' => 'marco.rossi@example.com'
            ]);
            
>>>>>>> 8055579 (.)
            $user->refresh();
            expect($user->full_name)->toBe('Marco Rossi');
            expect($user->email)->toBe('marco.rossi@example.com');
        });

        it('enforces audit trail for sensitive operations', function () {
            $user = User::factory()->create();
            $originalEmail = $user->email;
<<<<<<< HEAD

            // Modifica email (operazione sensibile)
            $user->update(['email' => 'newemail@example.com']);

            // Verifica che i timestamp siano aggiornati
            expect($user->updated_at)->not->toBe($user->created_at);

=======
            
            // Modifica email (operazione sensibile)
            $user->update(['email' => 'newemail@example.com']);
            
            // Verifica che i timestamp siano aggiornati
            expect($user->updated_at)->not->toBe($user->created_at);
            
>>>>>>> 8055579 (.)
            // Verifica che l'email sia stata modificata
            expect($user->email)->not->toBe($originalEmail);
            expect($user->email)->toBe('newemail@example.com');
        });
    });

    describe('Security Business Rules', function () {
        it('enforces password expiration policies', function () {
            $user = User::factory()->create([
<<<<<<< HEAD
                'password_expires_at' => now()->subDays(1),
            ]);

            // Verifica che la password sia scaduta
            $isExpired = $user->password_expires_at->isPast();
            expect($isExpired)->toBeTrue();

            // Aggiornamento password con nuova scadenza
            $user->update([
                'password' => Hash::make('NewPassword123!'),
                'password_expires_at' => now()->addDays(90),
            ]);

=======
                'password_expires_at' => now()->subDays(1)
            ]);
            
            // Verifica che la password sia scaduta
            $isExpired = $user->password_expires_at->isPast();
            expect($isExpired)->toBeTrue();
            
            // Aggiornamento password con nuova scadenza
            $user->update([
                'password' => Hash::make('NewPassword123!'),
                'password_expires_at' => now()->addDays(90)
            ]);
            
>>>>>>> 8055579 (.)
            $user->refresh();
            $isExpired = $user->password_expires_at->isFuture();
            expect($isExpired)->toBeTrue();
        });

        it('enforces account lockout policies', function () {
            $user = User::factory()->create([
                'failed_login_attempts' => 5,
<<<<<<< HEAD
                'locked_until' => now()->addMinutes(30),
            ]);

            // Verifica che l'account sia bloccato
            $isLocked = $user->locked_until->isFuture();
            expect($isLocked)->toBeTrue();

            // Sblocco account
            $user->update([
                'failed_login_attempts' => 0,
                'locked_until' => null,
            ]);

=======
                'locked_until' => now()->addMinutes(30)
            ]);
            
            // Verifica che l'account sia bloccato
            $isLocked = $user->locked_until->isFuture();
            expect($isLocked)->toBeTrue();
            
            // Sblocco account
            $user->update([
                'failed_login_attempts' => 0,
                'locked_until' => null
            ]);
            
>>>>>>> 8055579 (.)
            $user->refresh();
            expect($user->failed_login_attempts)->toBe(0);
            expect($user->locked_until)->toBeNull();
        });

        it('enforces session management policies', function () {
            $user = User::factory()->create([
                'last_login_at' => now()->subHours(2),
<<<<<<< HEAD
                'last_activity_at' => now()->subMinutes(30),
            ]);

            // Verifica che l'utente abbia fatto login recentemente
            $lastLogin = $user->last_login_at;
            $lastActivity = $user->last_activity_at;

            expect($lastLogin->diffInHours(now()))->toBeLessThan(24);
            expect($lastActivity->diffInMinutes(now()))->toBeLessThan(60);

            // Aggiornamento attività
            $user->update(['last_activity_at' => now()]);

=======
                'last_activity_at' => now()->subMinutes(30)
            ]);
            
            // Verifica che l'utente abbia fatto login recentemente
            $lastLogin = $user->last_login_at;
            $lastActivity = $user->last_activity_at;
            
            expect($lastLogin->diffInHours(now()))->toBeLessThan(24);
            expect($lastActivity->diffInMinutes(now()))->toBeLessThan(60);
            
            // Aggiornamento attività
            $user->update(['last_activity_at' => now()]);
            
>>>>>>> 8055579 (.)
            $user->refresh();
            expect($user->last_activity_at->diffInMinutes(now()))->toBeLessThan(1);
        });
    });
});
