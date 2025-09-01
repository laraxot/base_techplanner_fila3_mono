<?php

declare(strict_types=1);

namespace Modules\FormBuilder\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\FormBuilder\Models\Form;
use Modules\User\Models\User;

class FormSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crea alcuni utenti se non esistono
        $users = User::factory()->count(5)->create();

        // Crea form attivi
        Form::factory()
            ->count(15)
            ->active()
            ->create([
                'user_id' => fn () => $users->random()->id,
            ]);

        // Crea form inattivi
        Form::factory()
            ->count(5)
            ->inactive()
            ->create([
                'user_id' => fn () => $users->random()->id,
            ]);

        // Crea form che richiedono login
        Form::factory()
            ->count(8)
            ->requiresLogin()
            ->active()
            ->create([
                'user_id' => fn () => $users->random()->id,
            ]);

        // Crea form con date di validità
        Form::factory()
            ->count(10)
            ->withDateRange()
            ->active()
            ->create([
                'user_id' => fn () => $users->random()->id,
            ]);

        // Crea form che permettono multiple submission
        Form::factory()
            ->count(6)
            ->allowsMultipleSubmissions()
            ->active()
            ->create([
                'user_id' => fn () => $users->random()->id,
            ]);

        $this->command->info('Form creati con successo!');
    }
}
