<?php

declare(strict_types=1);

namespace Modules\Geo\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Modules\Geo\Models\Comune;
use function Safe\json_decode;
use function Safe\json_encode;

class SushiCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sushi:manage {action : L\'azione da eseguire (refresh|clear|status)}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Gestisce il database SQLite di Sushi';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $action = $this->argument('action');

        return match ($action) {
            'refresh' => $this->refresh(),
            'clear' => $this->clear(),
            'status' => $this->status(),
            default => $this->handleUnknownAction(),
        };
    }

    /**
     * Gestisce azioni sconosciute.
     */
    protected function handleUnknownAction(): int
    {
        $this->error('Azione non valida');
        return 1;
    }

    /**
     * Aggiorna il database SQLite di Sushi
     */
    protected function refresh(): int
    {
        $this->info('Aggiornamento del database SQLite di Sushi...');

        try {
            $path = base_path('database/content/comuni.json');
            
            if (!File::exists($path)) {
                $this->error('File comuni.json non trovato');
                return 1;
            }
            
            // Uso Safe\json_decode per evitare false return
            /** @var mixed $rawData */
            $rawData = json_decode(File::get($path), true);
            
            // Validazione tipo per evitare foreach su mixed
            if (!is_array($rawData)) {
                $this->error('Il file JSON non contiene un array valido');
                return 1;
            }
            
            /** @var array<int, mixed> $data */
            $data = $rawData;
            
            DB::table('comuni')->truncate();
            
            foreach ($data as $comune) {
                // Type guard per ogni elemento del foreach
                if (!is_array($comune)) {
                    $this->warn('Elemento non valido saltato: ' . gettype($comune));
                    continue;
                }
                
                /** @var array<mixed, mixed> $arrayComune */
                $arrayComune = $comune;
                
                // Validazione sicura degli offset con type guards
                if (!$this->isValidComuneData($arrayComune)) {
                    $this->warn('Dati comune non validi saltati: ' . json_encode($arrayComune));
                    continue;
                }
                
                /** @var array<string, mixed> $validComune */
                $validComune = $arrayComune;
                
                $regione = \Modules\Xot\Actions\Cast\SafeStringCastAction::cast($validComune['regione']);
                $provincia = \Modules\Xot\Actions\Cast\SafeStringCastAction::cast($validComune['provincia']);
                $comune = \Modules\Xot\Actions\Cast\SafeStringCastAction::cast($validComune['comune']);
                $cap = \Modules\Xot\Actions\Cast\SafeStringCastAction::cast($validComune['cap']);
                
                DB::table('comuni')->insert([
                    'id' => $validComune['id'],
                    'regione' => $regione,
                    'provincia' => $provincia,
                    'comune' => $comune,
                    'cap' => $cap,
                    'lat' => \Modules\Xot\Actions\Cast\SafeFloatCastAction::castWithRange($validComune['lat'], -90.0, 90.0, 0.0),
                    'lng' => \Modules\Xot\Actions\Cast\SafeFloatCastAction::castWithRange($validComune['lng'], -180.0, 180.0, 0.0),
                    'created_at' => $validComune['created_at'] ?? now(),
                    'updated_at' => $validComune['updated_at'] ?? now(),
                ]);
            }
            
            $this->info('Database SQLite di Sushi aggiornato con successo');
            return 0;
        } catch (\Exception $e) {
            $this->error('Errore durante l\'aggiornamento del database: ' . $e->getMessage());
            return 1;
        }
    }

    /**
     * Valida i dati di un comune.
     * 
     * @param array<mixed, mixed> $comune
     * @return bool
     */
    protected function isValidComuneData(array $comune): bool
    {
        $requiredFields = ['id', 'regione', 'provincia', 'comune', 'cap', 'lat', 'lng'];
        
        foreach ($requiredFields as $field) {
            if (!array_key_exists($field, $comune)) {
                return false;
            }
        }
        
        return true;
    }

    /**
     * Pulisce il database SQLite di Sushi
     */
    protected function clear(): int
    {
        $this->info('Pulizia del database SQLite di Sushi...');

        try {
            DB::table('comuni')->truncate();
            $this->info('Database SQLite di Sushi pulito con successo');
            return 0;
        } catch (\Exception $e) {
            $this->error('Errore durante la pulizia del database: ' . $e->getMessage());
            return 1;
        }
    }

    /**
     * Mostra lo stato del database SQLite di Sushi
     */
    protected function status(): int
    {
        $this->info('Stato del database SQLite di Sushi:');

        try {
            $count = DB::table('comuni')->count();
            $this->info("Numero di comuni: {$count}");
            
            $regioni = DB::table('comuni')
                ->select('regione')
                ->distinct()
                ->count();
            $this->info("Numero di regioni: {$regioni}");
            
            $province = DB::table('comuni')
                ->select('provincia')
                ->distinct()
                ->count();
            $this->info("Numero di province: {$province}");
            
            $cap = DB::table('comuni')
                ->select('cap')
                ->distinct()
                ->count();
            $this->info("Numero di CAP: {$cap}");
            
            return 0;
        } catch (\Exception $e) {
            $this->error('Errore durante la verifica dello stato del database: ' . $e->getMessage());
            return 1;
        }
    }
    
   
} 