<?php

namespace Modules\TechPlanner\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class TechPlannerDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mdbFile = '/var/www/html/_bases/sottana.com/Sorvegli.mdb';
        $sqlDumpFile = __DIR__.'/sql/techplanner_dump.sql';

        // Estrai i dati dal MDB
        $extractor = new MdbDataExtractor($mdbFile, $sqlDumpFile);
        $extractor->extract();

        // Esegui il dump SQL
        if (File::exists($sqlDumpFile)) {
            DB::unprepared(File::get($sqlDumpFile));
            $this->command->info('Dati importati con successo dal file MDB.');
        } else {
            $this->command->error('File di dump SQL non trovato.');
        }
    }
}
