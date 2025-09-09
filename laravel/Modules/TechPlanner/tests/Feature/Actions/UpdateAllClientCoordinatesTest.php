<?php

namespace Modules\TechPlanner\Tests\Feature\Actions;

use Illuminate\Foundation\Testing\RefreshDatabase;
namespace Modules\TechPlanner\Tests\Feature\Actions;

use Modules\Geo\Actions\UpdateCoordinatesAction;
use Modules\TechPlanner\Actions\UpdateAllClientCoordinatesAction;
use Modules\TechPlanner\Models\Client;
use Tests\TestCase;

class UpdateAllClientCoordinatesTest extends TestCase
{
    use RefreshDatabase;
    public function test_it_updates_all_client_coordinates(): void
    {
        // Arrange
        $client1 = Client::factory()->create([
            'full_address' => 'Via Roma 1, Milano, Italy',
            'latitude' => null,
            'longitude' => null,
        ]);

        $client2 = Client::factory()->create([
            'full_address' => 'Via Venezia 2, Roma, Italy',
            'latitude' => null,
            'longitude' => null,
        ]);

        $this->mock(UpdateCoordinatesAction::class)
            ->shouldReceive('execute')
            ->with('Via Roma 1, Milano, Italy')
            ->andReturn(['latitude' => 45.4642, 'longitude' => 9.1900])
            ->once();

        $this->mock(UpdateCoordinatesAction::class)
            ->shouldReceive('execute')
            ->with('Via Venezia 2, Roma, Italy')
            ->andReturn(['latitude' => 41.9028, 'longitude' => 12.4964])
            ->once();

        // Act
        $action = app(UpdateAllClientCoordinatesAction::class);
        $result = $action->execute();

        // Assert
        $this->assertTrue($result);

        $this->assertDatabaseHas('clients', [
            'id' => $client1->id,
            'latitude' => 45.4642,
            'longitude' => 9.1900,
        ]);

        $this->assertDatabaseHas('clients', [
            'id' => $client2->id,
            'latitude' => 41.9028,
            'longitude' => 12.4964,
        ]);
    }

    public function test_it_skips_clients_with_existing_coordinates(): void
    {
        // Arrange
        $client = Client::factory()->create([
            'full_address' => 'Via Roma 1, Milano, Italy',
            'latitude' => 45.4642,
            'longitude' => 9.1900,
        ]);

        $this->mock(UpdateCoordinatesAction::class)
            ->shouldNotReceive('execute');

        // Act
        $action = app(UpdateAllClientCoordinatesAction::class);
        $result = $action->execute();

        // Assert
        $this->assertTrue($result);

        $this->assertDatabaseHas('clients', [
            'id' => $client->id,
            'latitude' => 45.4642,
            'longitude' => 9.1900,
        ]);
    }

    public function test_it_handles_invalid_addresses(): void
    {
        // Arrange
        $client = Client::factory()->create([
            'full_address' => 'Invalid Address',
            'latitude' => null,
            'longitude' => null,
        ]);

        $this->mock(UpdateCoordinatesAction::class)
            ->shouldReceive('execute')
            ->with('Invalid Address')
            ->andReturn(null)
            ->once();

        // Act
        $action = app(UpdateAllClientCoordinatesAction::class);
        $result = $action->execute();

        // Assert
        $this->assertTrue($result);

        $this->assertDatabaseHas('clients', [
            'id' => $client->id,
            'latitude' => null,
            'longitude' => null,
        ]);
    }
}
