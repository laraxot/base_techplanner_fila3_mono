<?php

declare(strict_types=1);

namespace Modules\TechPlanner\Tests\Unit\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\TechPlanner\Models\Location;
use Tests\TestCase;use Modules\TechPlanner\Models\Location;

/**
 * Test unitario per il modello Location.
 *
 * @covers \Modules\TechPlanner\Models\Location
 */
class LocationTest extends TestCase
{
    use RefreshDatabase;
    private Location $location;

    protected function setUp(): void
    {
        parent::setUp();
        $this->location = Location::factory()->create();
    }

    /** @test */
    public function it_can_create_location(): void
    {
        $this->assertDatabaseHas('locations', [
            'id' => $this->location->id,
        ]);
    }

    /** @test */
    public function it_has_required_fields(): void
    {
        $this->assertDatabaseHas('locations', [
            'id' => $this->location->id,
            'name' => $this->location->name,
            'address' => $this->location->address,
            'city' => $this->location->city,
            'country' => $this->location->country,
        ]);
    }

    /** @test */
    public function it_has_soft_deletes(): void
    {
        $this->location->delete();
        $this->assertSoftDeleted('locations', ['id' => $this->location->id]);
    }

    /** @test */
    public function it_can_be_restored(): void
    {
        $this->location->delete();
        $this->location->restore();
        $this->assertDatabaseHas('locations', ['id' => $this->location->id]);
    }

    /** @test */
    public function it_has_active_scope(): void
    {
        Location::factory()->create(['is_active' => true]);
        Location::factory()->create(['is_active' => false]);

        $activeLocations = Location::active()->get();
        $this->assertEquals(1, $activeLocations->count());
    }

    /** @test */
    public function it_has_city_scope(): void
    {
        Location::factory()->create(['city' => 'Roma']);
        Location::factory()->create(['city' => 'Milano']);

        $romeLocations = Location::inCity('Roma')->get();
        $this->assertEquals(1, $romeLocations->count());
    }

    /** @test */
    public function it_has_country_scope(): void
    {
        Location::factory()->create(['country' => 'Italia']);
        Location::factory()->create(['country' => 'Germania']);

        $italianLocations = Location::inCountry('Italia')->get();
        $this->assertEquals(1, $italianLocations->count());
    }

    /** @test */
    public function it_has_type_scope(): void
    {
        Location::factory()->create(['type' => 'office']);
        Location::factory()->create(['type' => 'warehouse']);

        $officeLocations = Location::ofType('office')->get();
        $this->assertEquals(1, $officeLocations->count());
    }

    /** @test */
    public function it_handles_location_description(): void
    {
        $description = 'Sede principale dell\'azienda';
        $this->location->description = $description;
        $this->location->save();

        $this->assertDatabaseHas('locations', [
            'id' => $this->location->id,
            'description' => $description,
        ]);
    }

    /** @test */
    public function it_handles_location_phone(): void
    {
        $phone = '+39 06 12345678';
        $this->location->phone = $phone;
        $this->location->save();

        $this->assertDatabaseHas('locations', [
            'id' => $this->location->id,
            'phone' => $phone,
        ]);
    }

    /** @test */
    public function it_handles_location_email(): void
    {
        $email = 'info@sede.it';
        $this->location->email = $email;
        $this->location->save();

        $this->assertDatabaseHas('locations', [
            'id' => $this->location->id,
            'email' => $email,
        ]);
    }

    /** @test */
    public function it_handles_location_website(): void
    {
        $website = 'https://www.sede.it';
        $this->location->website = $website;
        $this->location->save();

        $this->assertDatabaseHas('locations', [
            'id' => $this->location->id,
            'website' => $website,
        ]);
    }

    /** @test */
    public function it_handles_location_postal_code(): void
    {
        $postalCode = '00100';
        $this->location->postal_code = $postalCode;
        $this->location->save();

        $this->assertDatabaseHas('locations', [
            'id' => $this->location->id,
            'postal_code' => $postalCode,
        ]);
    }

    /** @test */
    public function it_handles_location_region(): void
    {
        $region = 'Lazio';
        $this->location->region = $region;
        $this->location->save();

        $this->assertDatabaseHas('locations', [
            'id' => $this->location->id,
            'region' => $region,
        ]);
    }

    /** @test */
    public function it_handles_location_coordinates(): void
    {
        $latitude = 41.9028;
        $longitude = 12.4964;
        $this->location->latitude = $latitude;
        $this->location->longitude = $longitude;
        $this->location->save();

        $this->assertDatabaseHas('locations', [
            'id' => $this->location->id,
            'latitude' => $latitude,
            'longitude' => $longitude,
        ]);
    }

    /** @test */
    public function it_handles_location_capacity(): void
    {
        $capacity = 100;
        $this->location->capacity = $capacity;
        $this->location->save();

        $this->assertDatabaseHas('locations', [
            'id' => $this->location->id,
            'capacity' => $capacity,
        ]);
    }

    /** @test */
    public function it_handles_location_amenities(): void
    {
        $amenities = ['Parcheggio', 'WiFi', 'Sala riunioni', 'Caffetteria'];
        $this->location->amenities = $amenities;
        $this->location->save();

        $this->assertDatabaseHas('locations', [
            'id' => $this->location->id,
            'amenities' => json_encode($amenities),
        ]);
    }

    /** @test */
    public function it_handles_location_working_hours(): void
    {
        $workingHours = [
            'monday' => '09:00-18:00',
            'tuesday' => '09:00-18:00',
            'wednesday' => '09:00-18:00',
            'thursday' => '09:00-18:00',
            'friday' => '09:00-18:00',
        ];
        $this->location->working_hours = $workingHours;
        $this->location->save();

        $this->assertDatabaseHas('locations', [
            'id' => $this->location->id,
            'working_hours' => json_encode($workingHours),
        ]);
    }

    /** @test */
    public function it_handles_location_notes(): void
    {
        $notes = 'Sede storica dell\'azienda, facilmente raggiungibile con i mezzi pubblici';
        $this->location->notes = $notes;
        $this->location->save();

        $this->assertDatabaseHas('locations', [
            'id' => $this->location->id,
            'notes' => $notes,
        ]);
    }

    /** @test */
    public function it_serializes_to_array(): void
    {
        $array = $this->location->toArray();

        $this->assertIsArray($array);
        $this->assertArrayHasKey('id', $array);
        $this->assertArrayHasKey('name', $array);
        $this->assertArrayHasKey('address', $array);
        $this->assertArrayHasKey('city', $array);
        $this->assertArrayHasKey('country', $array);
    }

    /** @test */
    public function it_serializes_to_json(): void
    {
        $json = $this->location->toJson();

        $this->assertIsString($json);
        $this->assertStringContainsString('name', $json);
        $this->assertStringContainsString('address', $json);
    }

    /** @test */
    public function it_handles_location_status(): void
    {
        $this->location->status = 'active';
        $this->location->save();

        $this->assertTrue($this->location->isActive());
    }

    /** @test */
    public function it_handles_location_type(): void
    {
        $this->location->type = 'office';
        $this->location->save();

        $this->assertTrue($this->location->isOffice());
    }

    /** @test */
    public function it_has_full_address_accessor(): void
    {
        $this->location->address = 'Via Roma 123';
        $this->location->postal_code = '00100';
        $this->location->city = 'Roma';
        $this->location->region = 'Lazio';
        $this->location->country = 'Italia';
        $this->location->save();

        $expectedAddress = 'Via Roma 123, 00100 Roma, Lazio, Italia';
        $this->assertEquals($expectedAddress, $this->location->full_address);
    }

    /** @test */
    public function it_has_coordinates_accessor(): void
    {
        $this->location->latitude = 41.9028;
        $this->location->longitude = 12.4964;
        $this->location->save();

        $expectedCoordinates = '41.9028, 12.4964';
        $this->assertEquals($expectedCoordinates, $this->location->coordinates);
    }
}
