<?php

namespace Modules\TechPlanner\Actions;

use Modules\Geo\Actions\UpdateCoordinatesAction;
use Modules\TechPlanner\Models\Client;
use Spatie\QueueableAction\QueueableAction;

class UpdateAllClientCoordinatesAction
{
    use QueueableAction;

    public function __construct(
        private readonly UpdateCoordinatesAction $updateCoordinatesAction
    ) {}

    public function execute(): bool
    {
        $clients = Client::whereNull('latitude')
            ->orWhereNull('longitude')
            ->get();

        foreach ($clients as $client) {
            $coordinates = $this->updateCoordinatesAction->execute($client->full_address);

            if ($coordinates) {
                $client->update($coordinates);
            }
        }

        return true;
    }
}
