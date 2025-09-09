<?php

declare(strict_types=1);

namespace Modules\Activity\Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class ActivityDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Model::unguard();

        $this->call([
            \Modules\Activity\Database\Seeders\ActivitySeeder::class,
            \Modules\Activity\Database\Seeders\SnapshotSeeder::class,
            \Modules\Activity\Database\Seeders\StoredEventSeeder::class,
        ]);
    }
}
