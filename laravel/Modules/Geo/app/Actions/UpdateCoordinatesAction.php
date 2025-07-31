<?php

declare(strict_types=1);

namespace Modules\Geo\Actions;

use Modules\Geo\Models\Place;

/**
 * Action per aggiornare le coordinate di un luogo.
 */
class UpdateCoordinatesAction
{
    public function __construct(
        private readonly GetCoordinatesAction $getCoordinates,
    ) {
    }

    /**
     * Aggiorna le coordinate di un luogo usando il suo indirizzo.
     *
     * @throws \RuntimeException Se non è possibile ottenere le coordinate
     */
    public function execute(Place $place): void
    {
        $address = $place->address;
        
        if (!$address || !is_object($address) || !property_exists($address, 'formatted_address')) {
            throw new \RuntimeException('Place address is required');
        }
        
        $formattedAddress = $address->formatted_address;
        
        if (!is_string($formattedAddress) || empty($formattedAddress)) {
            throw new \RuntimeException('Place address formatted_address is required');
        }

        $location = $this->getCoordinates->execute($formattedAddress);

        if (!$location) {
            throw new \RuntimeException('Could not get coordinates for address: '.$formattedAddress);
        }

        $place->update([
            'latitude' => $location->latitude,
            'longitude' => $location->longitude,
        ]);
    }
}
