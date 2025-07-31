<?php

declare(strict_types=1);

namespace Modules\Notify\Factories;

use Exception;
use Illuminate\Support\Facades\Config;
use Modules\Notify\Actions\WhatsApp\Send360dialogWhatsAppAction;
use Modules\Notify\Actions\WhatsApp\SendFacebookWhatsAppAction;
use Modules\Notify\Actions\WhatsApp\SendTwilioWhatsAppAction;
use Modules\Notify\Actions\WhatsApp\SendVonageWhatsAppAction;
use Modules\Notify\Contracts\WhatsAppProviderActionInterface;
use function Safe\preg_replace;
use Illuminate\Support\Facades\Log;

/**
 * Factory per la creazione di azioni WhatsApp.
 * 
 * Questa factory centralizza la logica di selezione del driver WhatsApp
 * e la creazione dell'azione corrispondente, seguendo il pattern Factory.
 */
final class WhatsAppActionFactory
{
    /**
     * Lista dei provider WhatsApp supportati ufficialmente.
     *
     * @var array<string>
     */
    protected array $supportedDrivers = [
        'twilio',
        'vonage',
        '360dialog',
        'messagebird',
    ];

    /**
     * Crea un'azione WhatsApp basata sul driver specificato o su quello predefinito.
     * Utilizza una risoluzione dinamica delle classi basata sulla convenzione di naming
     * per istanziare l'action corretta.
     *
     * @param string|null $driver Driver WhatsApp da utilizzare (se null, viene utilizzato quello predefinito)
     * @return WhatsAppProviderActionInterface Azione WhatsApp corrispondente al driver
     * @throws Exception Se il driver specificato non è supportato o la classe non esiste
     */
    public function create(?string $driver = null): WhatsAppProviderActionInterface
    {
        $defaultDriver = Config::get('whatsapp.default', 'twilio');
        $driver = $driver ?? $defaultDriver;
        
        // Normalizza il nome del driver e assicura formato camelCase
        $driverString = is_string($driver) ? $driver : '';
        $normalizedDriver = $this->normalizeDriverName($driverString);

        // Avvisa per driver non standard
        if (!in_array($normalizedDriver, $this->supportedDrivers)) {
            Log::warning("Attempting to use non-standard WhatsApp driver: " . $driverString);
        }

        // Costruisci il nome della classe seguendo la convenzione
        $className = "Modules\\Notify\\Actions\\WhatsApp\\Send" . ucfirst($normalizedDriver) . "WhatsAppAction";

        // Verifica se la classe esiste
        if (!class_exists($className)) {
            Log::error("WhatsApp driver class not found", [
                'driver' => $driver,
                'normalized' => $normalizedDriver,
                'className' => $className
            ]);

            throw new Exception("Unsupported WhatsApp driver: " . $driverString . ". Class {$className} not found.");
        }
        
        $instance = app($className);
        
        // Verifica che l'istanza implementi l'interfaccia corretta
        if (!($instance instanceof WhatsAppProviderActionInterface)) {
            throw new Exception("Class {$className} does not implement WhatsAppProviderActionInterface.");
        }
        
        return $instance;
    }

    /**
     * Normalizza il nome del driver usando l'action centralizzata.
     *
     * @param string $driver Nome del driver da normalizzare
     * @return string Nome normalizzato
     */
    private function normalizeDriverName(string $driver): string
    {
        return app(\Modules\Xot\Actions\String\NormalizeDriverNameAction::class)->execute($driver);
    }
}
