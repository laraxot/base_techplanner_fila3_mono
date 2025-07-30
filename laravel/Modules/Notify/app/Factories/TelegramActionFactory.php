<?php

declare(strict_types=1);

namespace Modules\Notify\Factories;

use Exception;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use Modules\Notify\Actions\Telegram\SendNutgramTelegramAction;
use Modules\Notify\Actions\Telegram\SendOfficialTelegramAction;
use Modules\Notify\Contracts\TelegramProviderActionInterface;
use Modules\Xot\Actions\String\NormalizeDriverNameAction;

/**
 * Factory per la creazione di azioni Telegram.
 *
 * Questa factory centralizza la logica di selezione del driver Telegram
 * e la creazione dell'azione corrispondente, seguendo il pattern di risoluzione dinamica
 * delle classi basato su convenzioni di naming.
 */
final class TelegramActionFactory
{
    private array $supportedDrivers = ['botman', 'nutgram', 'official'];

    /**
     * Crea un'azione Telegram basata sul driver specificato o su quello predefinito.
     * Utilizza una risoluzione dinamica delle classi basata sulla convenzione di naming
     * per istanziare l'action corretta.
     *
     * @param string|null $driver Driver Telegram da utilizzare (se null, viene utilizzato quello predefinito)
     * @return TelegramProviderActionInterface Azione Telegram corrispondente al driver
     * @throws Exception In caso di errore se il driver non è supportato o la classe non esiste
     */
    public function create(?string $driver = null): TelegramProviderActionInterface
    {
        $defaultDriver = Config::get('telegram.default', 'official');
        $driver = $driver ?? $defaultDriver;
        // Normalizza il nome del driver e assicura formato camelCase
        $driverString = is_string($driver) ? $driver : '';
        $normalizedDriver = $this->normalizeDriverName($driverString);

        // Avvisa per driver non standard
        if (!in_array($normalizedDriver, $this->supportedDrivers)) {
            Log::warning("Attempting to use non-standard Telegram driver: " . $driverString);
        }

        // Costruisci il nome della classe seguendo la convenzione
        $className = "Modules\\Notify\\Actions\\Telegram\\Send" . ucfirst($normalizedDriver) . "TelegramAction";

        // Verifica se la classe esiste
        if (!class_exists($className)) {
            Log::error("Telegram driver class not found", [
                'driver' => $driver,
                'normalized' => $normalizedDriver,
                'className' => $className
            ]);

            throw new Exception("Unsupported Telegram driver: " . $driverString . ". Class {$className} not found.");
        }

        return app($className);
    }

    /**
     * Normalizza il nome del driver usando l'action centralizzata.
     *
     * @param string $driver Nome del driver da normalizzare
     * @return string Nome normalizzato
     */
    private function normalizeDriverName(string $driver): string
    {
        return app(NormalizeDriverNameAction::class)->execute($driver);
    }
}
