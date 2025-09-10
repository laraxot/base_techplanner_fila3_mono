<?php

declare(strict_types=1);

namespace Modules\TechPlanner\Tests\Unit\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\TechPlanner\Models\Client;
use Modules\TechPlanner\Models\Worker;
use Modules\TechPlanner\Models\Device;
use Modules\TechPlanner\Models\Location;
use Modules\TechPlanner\Models\LegalOffice;
use Modules\TechPlanner\Models\LegalRepresentative;
use Modules\TechPlanner\Models\MedicalDirector;
use Modules\TechPlanner\Models\Appointment;
use Modules\TechPlanner\Models\PhoneCall;
use Tests\TestCase;

/**
 * Test unitario per il modello Client.
 *
 * @covers \Modules\TechPlanner\Models\Client
 */
class ClientTest extends TestCase
{
    use RefreshDatabase;

    private Client $client;

    protected function setUp(): void
    {
        parent::setUp();
        

        $this->client = Client::factory()->create();
    }

    /** @test */
    public function it_has_correct_table_name(): void
    {
        $this->assertEquals('clients', $this->client->getTable());
    }

    /** @test */
    public function it_has_correct_fillable_fields(): void
    {
        $expectedFillable = [
            'name',
            'email',
            'phone',
            'address',
            'city',
            'postal_code',
            'country',
            'tax_code',
            'vat_number',
            'notes',
            'status',
            'priority',
            'source',
            'assigned_worker_id',
            'legal_office_id',
            'legal_representative_id',
            'medical_director_id',
            'location_id',
        ];

        $this->assertEquals($expectedFillable, $this->client->getFillable());
    }

    /** @test */
    public function it_has_correct_hidden_fields(): void
    {
        $expectedHidden = [
            'password',
            'remember_token',
        ];

        $this->assertEquals($expectedHidden, $this->client->getHidden());
    }

    /** @test */
    public function it_has_correct_dates(): void
    {
        $expectedDates = [
            'created_at',
            'updated_at',
            'deleted_at',
        ];

        $this->assertEquals($expectedDates, $this->client->getDates());
    }

    /** @test */
    public function it_has_correct_casts(): void
    {
        $expectedCasts = [
            'id' => 'int',
            'assigned_worker_id' => 'int',
            'legal_office_id' => 'int',
            'legal_representative_id' => 'int',
            'medical_director_id' => 'int',
            'location_id' => 'int',
            'priority' => 'int',
            'status' => 'string',
            'source' => 'string',
            'is_active' => 'boolean',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
            'deleted_at' => 'datetime',
        ];

        $this->assertEquals($expectedCasts, $this->client->getCasts());
    }

    /** @test */
    public function it_belongs_to_assigned_worker(): void
    {
        $worker = Worker::factory()->create();
        $this->client->update(['assigned_worker_id' => $worker->id]);

        $this->assertInstanceOf(Worker::class, $this->client->assignedWorker);
        $this->assertEquals($worker->id, $this->client->assignedWorker->id);
    }

    /** @test */
    public function it_belongs_to_legal_office(): void
    {
        $legalOffice = LegalOffice::factory()->create();
        $this->client->update(['legal_office_id' => $legalOffice->id]);

        $this->assertInstanceOf(LegalOffice::class, $this->client->legalOffice);
        $this->assertEquals($legalOffice->id, $this->client->legalOffice->id);
    }

    /** @test */
    public function it_belongs_to_legal_representative(): void
    {
        $legalRepresentative = LegalRepresentative::factory()->create();
        $this->client->update(['legal_representative_id' => $legalRepresentative->id]);

        $this->assertInstanceOf(LegalRepresentative::class, $this->client->legalRepresentative);
        $this->assertEquals($legalRepresentative->id, $this->client->legalRepresentative->id);
    }

    /** @test */
    public function it_belongs_to_medical_director(): void
    {
        $medicalDirector = MedicalDirector::factory()->create();
        $this->client->update(['medical_director_id' => $medicalDirector->id]);

        $this->assertInstanceOf(MedicalDirector::class, $this->client->medicalDirector);
        $this->assertEquals($medicalDirector->id, $this->client->medicalDirector->id);
    }

    /** @test */
    public function it_belongs_to_location(): void
    {
        $location = Location::factory()->create();
        $this->client->update(['location_id' => $location->id]);

        $this->assertInstanceOf(Location::class, $this->client->location);
        $this->assertEquals($location->id, $this->client->location->id);
    }

    /** @test */
    public function it_has_many_devices(): void
    {
        $devices = Device::factory()->count(3)->create([
            'client_id' => $this->client->id,
        ]);

        $this->assertCount(3, $this->client->devices);
        $this->assertInstanceOf(Device::class, $this->client->devices->first());
    }

    /** @test */
    public function it_has_many_appointments(): void
    {
        $appointments = Appointment::factory()->count(2)->create([
            'client_id' => $this->client->id,
        ]);

        $this->assertCount(2, $this->client->appointments);
        $this->assertInstanceOf(Appointment::class, $this->client->appointments->first());
    }

    /** @test */
    public function it_has_many_phone_calls(): void
    {
        $phoneCalls = PhoneCall::factory()->count(2)->create([
            'client_id' => $this->client->id,
        ]);

        $this->assertCount(2, $this->client->phoneCalls);
        $this->assertInstanceOf(PhoneCall::class, $this->client->phoneCalls->first());
    }

    /** @test */
    public function it_can_be_soft_deleted(): void
    {
        $clientId = $this->client->id;
        

        $this->client->delete();
        

        $this->client->delete();

        
        $this->client->delete();
        
        $this->assertSoftDeleted('clients', ['id' => $clientId]);
        $this->assertDatabaseMissing('clients', ['id' => $clientId]);
    }

    /** @test */
    public function it_can_be_restored(): void
    {
        $clientId = $this->client->id;
        
        $this->client->delete();
        $this->assertSoftDeleted('clients', ['id' => $clientId]);
        

        $this->client->delete();
        $this->assertSoftDeleted('clients', ['id' => $clientId]);

        $restoredClient = Client::withTrashed()->find($clientId);
        $restoredClient->restore();
        

        
        $this->client->delete();
        $this->assertSoftDeleted('clients', ['id' => $clientId]);
        
        $restoredClient = Client::withTrashed()->find($clientId);
        $restoredClient->restore();

        
        $this->assertDatabaseHas('clients', ['id' => $clientId]);
        $this->assertNull($restoredClient->deleted_at);
    }

    /** @test */
    public function it_has_full_name_attribute(): void
    {
        $this->client->update([
            'name' => 'Mario',
            'surname' => 'Rossi',
        ]);

        $this->assertEquals('Mario Rossi', $this->client->full_name);
    }

    /** @test */
    public function it_has_full_address_attribute(): void
    {
        $this->client->update([
            'address' => 'Via Roma 123',
            'city' => 'Milano',
            'postal_code' => '20100',
            'country' => 'Italia',
        ]);

        $expectedAddress = 'Via Roma 123, 20100 Milano, Italia';
        $this->assertEquals($expectedAddress, $this->client->full_address);
    }

    /** @test */
    public function it_has_is_active_scope(): void
    {
        $activeClient = Client::factory()->create(['is_active' => true]);
        $inactiveClient = Client::factory()->create(['is_active' => false]);

        $activeClients = Client::active()->get();

        $this->assertTrue($activeClients->contains($activeClient));
        $this->assertFalse($activeClients->contains($inactiveClient));
    }

    /** @test */
    public function it_has_by_priority_scope(): void
    {
        $highPriorityClient = Client::factory()->create(['priority' => 3]);
        $mediumPriorityClient = Client::factory()->create(['priority' => 2]);
        $lowPriorityClient = Client::factory()->create(['priority' => 1]);

        $highPriorityClients = Client::byPriority(3)->get();

        $this->assertTrue($highPriorityClients->contains($highPriorityClient));
        $this->assertFalse($highPriorityClients->contains($mediumPriorityClient));
        $this->assertFalse($highPriorityClients->contains($lowPriorityClient));
    }

    /** @test */
    public function it_has_by_status_scope(): void
    {
        $activeClient = Client::factory()->create(['status' => 'active']);
        $inactiveClient = Client::factory()->create(['status' => 'inactive']);

        $activeClients = Client::byStatus('active')->get();

        $this->assertTrue($activeClients->contains($activeClient));
        $this->assertFalse($activeClients->contains($inactiveClient));
    }

    /** @test */
    public function it_has_by_source_scope(): void
    {
        $websiteClient = Client::factory()->create(['source' => 'website']);
        $referralClient = Client::factory()->create(['source' => 'referral']);

        $websiteClients = Client::bySource('website')->get();

        $this->assertTrue($websiteClients->contains($websiteClient));
        $this->assertFalse($websiteClients->contains($referralClient));
    }

    /** @test */
    public function it_has_by_worker_scope(): void
    {
        $worker = Worker::factory()->create();
        $assignedClient = Client::factory()->create(['assigned_worker_id' => $worker->id]);
        $unassignedClient = Client::factory()->create(['assigned_worker_id' => null]);

        $assignedClients = Client::byWorker($worker->id)->get();

        $this->assertTrue($assignedClients->contains($assignedClient));
        $this->assertFalse($assignedClients->contains($unassignedClient));
    }

    /** @test */
    public function it_has_search_scope(): void
    {
        $marioClient = Client::factory()->create(['name' => 'Mario Rossi']);
        $giuliaClient = Client::factory()->create(['name' => 'Giulia Bianchi']);

        $searchResults = Client::search('Mario')->get();

        $this->assertTrue($searchResults->contains($marioClient));
        $this->assertFalse($searchResults->contains($giuliaClient));
    }

    /** @test */
    public function it_validates_required_fields(): void
    {
        $this->expectException(\Illuminate\Database\QueryException::class);

        Client::create([]);
    }

    /** @test */
    public function it_validates_email_format(): void
    {
        $this->expectException(\Illuminate\Database\QueryException::class);

        Client::create([
            'name' => 'Test Client',
            'email' => 'invalid-email',
        ]);
    }

    /** @test */
    public function it_has_correct_mutators(): void
    {
        $this->client->update([
            'name' => '  mario  ',
            'email' => '  MARIO@EXAMPLE.COM  ',
        ]);

        $this->assertEquals('mario', $this->client->name);
        $this->assertEquals('mario@example.com', $this->client->email);
    }

    /** @test */
    public function it_has_correct_accessors(): void
    {
        $this->client->update([
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->assertInstanceOf(\Carbon\Carbon::class, $this->client->created_at);
        $this->assertInstanceOf(\Carbon\Carbon::class, $this->client->updated_at);
    }

    /** @test */
    public function it_can_be_serialized_to_array(): void
    {
        $array = $this->client->toArray();

        $this->assertIsArray($array);
        $this->assertArrayHasKey('id', $array);
        $this->assertArrayHasKey('name', $array);
        $this->assertArrayHasKey('email', $array);
    }

    /** @test */
    public function it_can_be_serialized_to_json(): void
    {
        $json = $this->client->toJson();

        $this->assertIsString($json);
        $this->assertJson($json);
    }
}
