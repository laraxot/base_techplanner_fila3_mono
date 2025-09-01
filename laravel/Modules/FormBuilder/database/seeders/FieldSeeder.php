<?php

declare(strict_types=1);

namespace Modules\FormBuilder\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\FormBuilder\Models\Field;
use Modules\FormBuilder\Models\Section;

class FieldSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crea alcune sezioni se non esistono
        $sections = Section::factory()->count(5)->create();

        // Crea campi di testo
        Field::factory()
            ->count(20)
            ->text()
            ->create([
                'section_id' => fn () => $sections->random()->id,
            ]);

        // Crea campi email
        Field::factory()
            ->count(15)
            ->email()
            ->required()
            ->create([
                'section_id' => fn () => $sections->random()->id,
            ]);

        // Crea campi select
        Field::factory()
            ->count(12)
            ->select()
            ->create([
                'section_id' => fn () => $sections->random()->id,
            ]);

        // Crea campi file
        Field::factory()
            ->count(8)
            ->file()
            ->optional()
            ->create([
                'section_id' => fn () => $sections->random()->id,
            ]);

        // Crea campi misti (tutti i tipi)
        Field::factory()
            ->count(25)
            ->create([
                'section_id' => fn () => $sections->random()->id,
            ]);

        // Crea campi obbligatori
        Field::factory()
            ->count(30)
            ->required()
            ->create([
                'section_id' => fn () => $sections->random()->id,
            ]);

        // Crea campi opzionali
        Field::factory()
            ->count(20)
            ->optional()
            ->create([
                'section_id' => fn () => $sections->random()->id,
            ]);

        $this->command->info('Campi creati con successo!');
    }
}
