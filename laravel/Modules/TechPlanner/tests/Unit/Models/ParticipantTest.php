<?php

declare(strict_types=1);

namespace Modules\TechPlanner\Tests\Unit\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\TechPlanner\Models\Participant;
use Tests\TestCase;
=======
use Modules\TechPlanner\Models\Participant;

/**
 * Test unitario per il modello Participant.
 *
 * @covers \Modules\TechPlanner\Models\Participant
 */
class ParticipantTest extends TestCase
{
    use RefreshDatabase;

=======
    private Participant $participant;

    protected function setUp(): void
    {
        parent::setUp();
        $this->participant = Participant::factory()->create();
    }

    /** @test */
    public function it_can_create_participant(): void
    {
        $this->assertDatabaseHas('participants', [
            'id' => $this->participant->id,
        ]);
    }

    /** @test */
    public function it_has_required_fields(): void
    {
        $this->assertDatabaseHas('participants', [
            'id' => $this->participant->id,
            'first_name' => $this->participant->first_name,
            'last_name' => $this->participant->last_name,
            'email' => $this->participant->email,
        ]);
    }

    /** @test */
    public function it_has_soft_deletes(): void
    {
        $this->participant->delete();
        $this->assertSoftDeleted('participants', ['id' => $this->participant->id]);
    }

    /** @test */
    public function it_can_be_restored(): void
    {
        $this->participant->delete();
        $this->participant->restore();
        $this->assertDatabaseHas('participants', ['id' => $this->participant->id]);
    }

    /** @test */
    public function it_has_full_name_accessor(): void
    {
        $this->participant->first_name = 'Mario';
        $this->participant->last_name = 'Rossi';
        $this->participant->save();

        $this->assertEquals('Mario Rossi', $this->participant->full_name);
    }

    /** @test */
    public function it_has_active_scope(): void
    {
        Participant::factory()->create(['is_active' => true]);
        Participant::factory()->create(['is_active' => false]);

        $activeParticipants = Participant::active()->get();
        $this->assertEquals(1, $activeParticipants->count());
    }

    /** @test */
    public function it_has_role_scope(): void
    {
        Participant::factory()->create(['role' => 'speaker']);
        Participant::factory()->create(['role' => 'attendee']);

        $speakers = Participant::withRole('speaker')->get();
        $this->assertEquals(1, $speakers->count());
    }

    /** @test */
    public function it_has_city_scope(): void
    {
        Participant::factory()->create(['city' => 'Roma']);
        Participant::factory()->create(['city' => 'Milano']);

        $romeParticipants = Participant::inCity('Roma')->get();
        $this->assertEquals(1, $romeParticipants->count());
    }

    /** @test */
    public function it_has_company_scope(): void
    {
        Participant::factory()->create(['company' => 'TechCorp']);
        Participant::factory()->create(['company' => 'InnovationLab']);

        $techCorpParticipants = Participant::fromCompany('TechCorp')->get();
        $this->assertEquals(1, $techCorpParticipants->count());
    }

    /** @test */
    public function it_handles_participant_phone(): void
    {
        $phone = '+39 06 12345678';
        $this->participant->phone = $phone;
        $this->participant->save();

        $this->assertDatabaseHas('participants', [
            'id' => $this->participant->id,
            'phone' => $phone,
        ]);
    }

    /** @test */
    public function it_handles_participant_mobile(): void
    {
        $mobile = '+39 333 1234567';
        $this->participant->mobile = $mobile;
        $this->participant->save();

        $this->assertDatabaseHas('participants', [
            'id' => $this->participant->id,
            'mobile' => $mobile,
        ]);
    }

    /** @test */
    public function it_handles_participant_address(): void
    {
        $address = 'Via Roma 123, 00100 Roma';
        $this->participant->address = $address;
        $this->participant->save();

        $this->assertDatabaseHas('participants', [
            'id' => $this->participant->id,
            'address' => $address,
        ]);
    }

    /** @test */
    public function it_handles_participant_city(): void
    {
        $city = 'Milano';
        $this->participant->city = $city;
        $this->participant->save();

        $this->assertDatabaseHas('participants', [
            'id' => $this->participant->id,
            'city' => $city,
        ]);
    }

    /** @test */
    public function it_handles_participant_postal_code(): void
    {
        $postalCode = '20100';
        $this->participant->postal_code = $postalCode;
        $this->participant->save();

        $this->assertDatabaseHas('participants', [
            'id' => $this->participant->id,
            'postal_code' => $postalCode,
        ]);
    }

    /** @test */
    public function it_handles_participant_country(): void
    {
        $country = 'Italia';
        $this->participant->country = $country;
        $this->participant->save();

        $this->assertDatabaseHas('participants', [
            'id' => $this->participant->id,
            'country' => $country,
        ]);
    }

    /** @test */
    public function it_handles_participant_region(): void
    {
        $region = 'Lombardia';
        $this->participant->region = $region;
        $this->participant->save();

        $this->assertDatabaseHas('participants', [
            'id' => $this->participant->id,
            'region' => $region,
        ]);
    }

    /** @test */
    public function it_handles_participant_birth_date(): void
    {
        $birthDate = '1985-07-15';
        $this->participant->birth_date = $birthDate;
        $this->participant->save();

        $this->assertDatabaseHas('participants', [
            'id' => $this->participant->id,
            'birth_date' => $birthDate,
        ]);
    }

    /** @test */
    public function it_handles_participant_fiscal_code(): void
    {
        $fiscalCode = 'RSSMRA85L15H501X';
        $this->participant->fiscal_code = $fiscalCode;
        $this->participant->save();

        $this->assertDatabaseHas('participants', [
            'id' => $this->participant->id,
            'fiscal_code' => $fiscalCode,
        ]);
    }

    /** @test */
    public function it_handles_participant_job_title(): void
    {
        $jobTitle = 'Senior Software Engineer';
        $this->participant->job_title = $jobTitle;
        $this->participant->save();

        $this->assertDatabaseHas('participants', [
            'id' => $this->participant->id,
            'job_title' => $jobTitle,
        ]);
    }

    /** @test */
    public function it_handles_participant_department(): void
    {
        $department = 'Research & Development';
        $this->participant->department = $department;
        $this->participant->save();

        $this->assertDatabaseHas('participants', [
            'id' => $this->participant->id,
            'department' => $department,
        ]);
    }

    /** @test */
    public function it_handles_participant_specializations(): void
    {
        $specializations = ['Machine Learning', 'Artificial Intelligence', 'Data Science'];
        $this->participant->specializations = $specializations;
        $this->participant->save();

        $this->assertDatabaseHas('participants', [
            'id' => $this->participant->id,
            'specializations' => json_encode($specializations),
        ]);
    }

    /** @test */
    public function it_handles_participant_languages(): void
    {
        $languages = ['Italiano', 'Inglese', 'Francese'];
        $this->participant->languages = $languages;
        $this->participant->save();

        $this->assertDatabaseHas('participants', [
            'id' => $this->participant->id,
            'languages' => json_encode($languages),
        ]);
    }

    /** @test */
    public function it_handles_participant_dietary_restrictions(): void
    {
        $dietaryRestrictions = ['Vegetariano', 'Senza glutine'];
        $this->participant->dietary_restrictions = $dietaryRestrictions;
        $this->participant->save();

        $this->assertDatabaseHas('participants', [
            'id' => $this->participant->id,
            'dietary_restrictions' => json_encode($dietaryRestrictions),
        ]);
    }

    /** @test */
    public function it_handles_participant_accessibility_needs(): void
    {
        $accessibilityNeeds = ['Sedia a rotelle', 'Interprete LIS'];
        $this->participant->accessibility_needs = $accessibilityNeeds;
        $this->participant->save();

        $this->assertDatabaseHas('participants', [
            'id' => $this->participant->id,
            'accessibility_needs' => json_encode($accessibilityNeeds),
        ]);
    }

    /** @test */
    public function it_handles_participant_notes(): void
    {
        $notes = 'Partecipante con esperienza in progetti di ricerca europei';
        $this->participant->notes = $notes;
        $this->participant->save();

        $this->assertDatabaseHas('participants', [
            'id' => $this->participant->id,
            'notes' => $notes,
        ]);
    }

    /** @test */
    public function it_serializes_to_array(): void
    {
        $array = $this->participant->toArray();

        $this->assertIsArray($array);
        $this->assertArrayHasKey('id', $array);
        $this->assertArrayHasKey('first_name', $array);
        $this->assertArrayHasKey('last_name', $array);
        $this->assertArrayHasKey('email', $array);
    }

    /** @test */
    public function it_serializes_to_json(): void
    {
        $json = $this->participant->toJson();

        $this->assertIsString($json);
        $this->assertStringContainsString('first_name', $json);
        $this->assertStringContainsString('last_name', $json);
    }

    /** @test */
    public function it_handles_participant_status(): void
    {
        $this->participant->status = 'confirmed';
        $this->participant->save();

        $this->assertTrue($this->participant->isConfirmed());
    }

    /** @test */
    public function it_handles_participant_role(): void
    {
        $this->participant->role = 'speaker';
        $this->participant->save();

        $this->assertTrue($this->participant->isSpeaker());
    }

    /** @test */
    public function it_has_age_accessor(): void
    {
        $this->participant->birth_date = now()->subYears(35);
        $this->participant->save();

        $this->assertEquals(35, $this->participant->age_years);
    }

    /** @test */
    public function it_has_registration_status_accessor(): void
    {
        $this->participant->registration_date = now()->subDays(5);
        $this->participant->save();

        $this->assertTrue($this->participant->isRegistered());
    }

    /** @test */
    public function it_has_payment_status_accessor(): void
    {
        $this->participant->payment_status = 'paid';
        $this->participant->save();

        $this->assertTrue($this->participant->hasPaid());
    }
}
