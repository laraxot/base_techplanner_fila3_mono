<?php

declare(strict_types=1);


namespace Modules\TechPlanner\Actions;

use Modules\Geo\Actions\GetCoordinatesAction;
use Modules\TechPlanner\Models\Client;
use Spatie\QueueableAction\QueueableAction;

class UpdateAllClientCoordinatesAction
{
    use QueueableAction;

    public function __construct(
        private readonly GetCoordinatesAction $getCoordinatesAction,
    ) {}

    public function execute(): bool
    {
        $clients = Client::whereNull('latitude')->orWhereNull('longitude')->get();

        foreach ($clients as $client) {
            // Usa l'azione per ottenere le coordinate dall'indirizzo
            if ($client->full_address) {
                $coordinates = $this->getCoordinatesAction->execute($client->full_address);

                if ($coordinates) {
                    $client->update([
                        'latitude' => $coordinates->latitude,
                        'longitude' => $coordinates->longitude,
                    ]);
                }
            }
        }

        return true;
    }
}
