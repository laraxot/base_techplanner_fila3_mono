<?php

declare(strict_types=1);

namespace Modules\Comment\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Comment\Models\Comment;
use Modules\User\Models\User;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crea alcuni utenti se non esistono
        $users = User::factory()->count(5)->create();

        // Crea commenti principali
        $mainComments = Comment::factory()
            ->count(20)
            ->approved()
            ->create([
                'commentator_id' => fn () => $users->random()->id,
            ]);

        // Crea risposte ai commenti principali
        foreach ($mainComments->take(10) as $mainComment) {
            Comment::factory()
                ->count(fake()->numberBetween(1, 3))
                ->approved()
                ->asReply($mainComment)
                ->create([
                    'commentator_id' => fn () => $users->random()->id,
                ]);
        }

        // Crea alcuni commenti in attesa di approvazione
        Comment::factory()
            ->count(5)
            ->pending()
            ->create([
                'commentator_id' => fn () => $users->random()->id,
            ]);

        $this->command->info('Commenti creati con successo!');
    }
}
