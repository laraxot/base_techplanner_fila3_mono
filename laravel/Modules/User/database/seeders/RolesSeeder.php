<?php

declare(strict_types=1);

namespace Modules\User\Database\Seeders;

use Illuminate\Database\Seeder;
<<<<<<< HEAD
use Illuminate\Support\Collection;
use Modules\User\Enums\UserTypeEnum;
=======
>>>>>>> 9831a351 (.)
use Modules\User\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Table headers for output display.
     *
     * @var array<int, string>
     */
    private static array $OUTPUT_TABLE_HEADERS = [
        '#',
        'Name',
        'Guard',
    ];

<<<<<<< HEAD
    

=======
>>>>>>> 9831a351 (.)
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [];

<<<<<<< HEAD


=======
>>>>>>> 9831a351 (.)
        // Display results in a table format
        $this->displayResults($roles);
    }

    /**
     * Display the seeding results in a table format.
     *
<<<<<<< HEAD
     * @param array<int, Role> $roles
=======
     * @param  array<int, Role>  $roles
>>>>>>> 9831a351 (.)
     */
    private function displayResults(array $roles): void
    {
        $this->command->info('Roles seeded successfully:');
        $this->command->table(self::$OUTPUT_TABLE_HEADERS, collect($roles)->map(function (Role $role, int $index) {
            return [
                $index + 1,
                $role->name,
                $role->guard_name,
            ];
        })->toArray());
    }
}
