<?php

declare(strict_types=1);

namespace Modules\TechPlanner\Tests\Unit\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\TechPlanner\Models\MedicalDirector;
use Tests\TestCase;

/**
 * Test unitario per il modello MedicalDirector.
 *
 * @covers \Modules\TechPlanner\Models\MedicalDirector
 */
class MedicalDirectorTest extends TestCase
{
    use RefreshDatabase;

    private MedicalDirector $medicalDirector;

    protected function setUp(): void
    {
        parent::setUp();
        $this->medicalDirector = MedicalDirector::factory()->create();
    }

    /** @test */
    public function it_can_create_medical_director(): void
    {
        $this->assertDatabaseHas('medical_directors', [
            'id' => $this->medicalDirector->id,
        ]);
    }

    /** @test */
    public function it_has_required_fields(): void
    {
        $this->assertDatabaseHas('medical_directors', [
            'id' => $this->medicalDirector->id,
            'first_name' => $this->medicalDirector->first_name,
            'last_name' => $this->medicalDirector->last_name,
            'email' => $this->medicalDirector->email,
            'license_number' => $this->medicalDirector->license_number,
        ]);
    }

    /** @test */
    public function it_has_soft_deletes(): void
    {
        $this->medicalDirector->delete();
        $this->assertSoftDeleted('medical_directors', ['id' => $this->medicalDirector->id]);
    }

    /** @test */
    public function it_can_be_restored(): void
    {
        $this->medicalDirector->delete();
        $this->medicalDirector->restore();
        $this->assertDatabaseHas('medical_directors', ['id' => $this->medicalDirector->id]);
    }

    /** @test */
    public function it_has_full_name_accessor(): void
    {
        $this->medicalDirector->first_name = 'Dr. Mario';
        $this->medicalDirector->last_name = 'Rossi';
        $this->medicalDirector->save();

        $this->assertEquals('Dr. Mario Rossi', $this->medicalDirector->full_name);
    }

    /** @test */
    public function it_has_active_scope(): void
    {
        MedicalDirector::factory()->create(['is_active' => true]);
        MedicalDirector::factory()->create(['is_active' => false]);

        $activeDirectors = MedicalDirector::active()->get();
        $this->assertEquals(1, $activeDirectors->count());
    }

    /** @test */
    public function it_has_specialization_scope(): void
    {
        MedicalDirector::factory()->create(['specialization' => 'Cardiologia']);
        MedicalDirector::factory()->create(['specialization' => 'Neurologia']);

        $cardiologists = MedicalDirector::specializedIn('Cardiologia')->get();
        $this->assertEquals(1, $cardiologists->count());
    }

    /** @test */
    public function it_has_city_scope(): void
    {
        MedicalDirector::factory()->create(['city' => 'Roma']);
        MedicalDirector::factory()->create(['city' => 'Milano']);

        $romeDirectors = MedicalDirector::inCity('Roma')->get();
        $this->assertEquals(1, $romeDirectors->count());
    }

    /** @test */
    public function it_handles_director_phone(): void
    {
        $phone = '+39 06 12345678';
        $this->medicalDirector->phone = $phone;
        $this->medicalDirector->save();

        $this->assertDatabaseHas('medical_directors', [
            'id' => $this->medicalDirector->id,
            'phone' => $phone,
        ]);
    }

    /** @test */
    public function it_handles_director_mobile(): void
    {
        $mobile = '+39 333 1234567';
        $this->medicalDirector->mobile = $mobile;
        $this->medicalDirector->save();

        $this->assertDatabaseHas('medical_directors', [
            'id' => $this->medicalDirector->id,
            'mobile' => $mobile,
        ]);
    }

    /** @test */
    public function it_handles_director_address(): void
    {
        $address = 'Via Roma 123, 00100 Roma';
        $this->medicalDirector->address = $address;
        $this->medicalDirector->save();

        $this->assertDatabaseHas('medical_directors', [
            'id' => $this->medicalDirector->id,
            'address' => $address,
        ]);
    }

    /** @test */
    public function it_handles_director_city(): void
    {
        $city = 'Milano';
        $this->medicalDirector->city = $city;
        $this->medicalDirector->save();

        $this->assertDatabaseHas('medical_directors', [
            'id' => $this->medicalDirector->id,
            'city' => $city,
        ]);
    }

    /** @test */
    public function it_handles_director_postal_code(): void
    {
        $postalCode = '20100';
        $this->medicalDirector->postal_code = $postalCode;
        $this->medicalDirector->save();

        $this->assertDatabaseHas('medical_directors', [
            'id' => $this->medicalDirector->id,
            'postal_code' => $postalCode,
        ]);
    }

    /** @test */
    public function it_handles_director_country(): void
    {
        $country = 'Italia';
        $this->medicalDirector->country = $country;
        $this->medicalDirector->save();

        $this->assertDatabaseHas('medical_directors', [
            'id' => $this->medicalDirector->id,
            'country' => $country,
        ]);
    }

    /** @test */
    public function it_handles_director_region(): void
    {
        $region = 'Lombardia';
        $this->medicalDirector->region = $region;
        $this->medicalDirector->save();

        $this->assertDatabaseHas('medical_directors', [
            'id' => $this->medicalDirector->id,
            'region' => $region,
        ]);
    }

    /** @test */
    public function it_handles_director_birth_date(): void
    {
        $birthDate = '1975-03-20';
        $this->medicalDirector->birth_date = $birthDate;
        $this->medicalDirector->save();

        $this->assertDatabaseHas('medical_directors', [
            'id' => $this->medicalDirector->id,
            'birth_date' => $birthDate,
        ]);
    }

    /** @test */
    public function it_handles_director_fiscal_code(): void
    {
        $fiscalCode = 'RSSMRA75C20H501X';
        $this->medicalDirector->fiscal_code = $fiscalCode;
        $this->medicalDirector->save();

        $this->assertDatabaseHas('medical_directors', [
            'id' => $this->medicalDirector->id,
            'fiscal_code' => $fiscalCode,
        ]);
    }

    /** @test */
    public function it_handles_director_license_expiry(): void
    {
        $licenseExpiry = '2030-12-31';
        $this->medicalDirector->license_expiry = $licenseExpiry;
        $this->medicalDirector->save();

        $this->assertDatabaseHas('medical_directors', [
            'id' => $this->medicalDirector->id,
            'license_expiry' => $licenseExpiry,
        ]);
    }

    /** @test */
    public function it_handles_director_specializations(): void
    {
        $specializations = ['Cardiologia', 'Elettrofisiologia', 'Ecocardiografia'];
        $this->medicalDirector->specializations = $specializations;
        $this->medicalDirector->save();

        $this->assertDatabaseHas('medical_directors', [
            'id' => $this->medicalDirector->id,
            'specializations' => json_encode($specializations),
        ]);
    }

    /** @test */
    public function it_handles_director_languages(): void
    {
        $languages = ['Italiano', 'Inglese', 'Spagnolo'];
        $this->medicalDirector->languages = $languages;
        $this->medicalDirector->save();

        $this->assertDatabaseHas('medical_directors', [
            'id' => $this->medicalDirector->id,
            'languages' => json_encode($languages),
        ]);
    }

    /** @test */
    public function it_handles_director_working_hours(): void
    {
        $workingHours = [
            'monday' => '09:00-17:00',
            'tuesday' => '09:00-17:00',
            'wednesday' => '09:00-17:00',
            'thursday' => '09:00-17:00',
            'friday' => '09:00-17:00',
        ];
        $this->medicalDirector->working_hours = $workingHours;
        $this->medicalDirector->save();

        $this->assertDatabaseHas('medical_directors', [
            'id' => $this->medicalDirector->id,
            'working_hours' => json_encode($workingHours),
        ]);
    }

    /** @test */
    public function it_handles_director_notes(): void
    {
        $notes = 'Direttore medico con oltre 20 anni di esperienza in cardiologia';
        $this->medicalDirector->notes = $notes;
        $this->medicalDirector->save();

        $this->assertDatabaseHas('medical_directors', [
            'id' => $this->medicalDirector->id,
            'notes' => $notes,
        ]);
    }

    /** @test */
    public function it_serializes_to_array(): void
    {
        $array = $this->medicalDirector->toArray();

        $this->assertIsArray($array);
        $this->assertArrayHasKey('id', $array);
        $this->assertArrayHasKey('first_name', $array);
        $this->assertArrayHasKey('last_name', $array);
        $this->assertArrayHasKey('email', $array);
    }

    /** @test */
    public function it_serializes_to_json(): void
    {
        $json = $this->medicalDirector->toJson();

        $this->assertIsString($json);
        $this->assertStringContainsString('first_name', $json);
        $this->assertStringContainsString('last_name', $json);
    }

    /** @test */
    public function it_handles_director_status(): void
    {
        $this->medicalDirector->status = 'active';
        $this->medicalDirector->save();

        $this->assertTrue($this->medicalDirector->isActive());
    }

    /** @test */
    public function it_handles_director_type(): void
    {
        $this->medicalDirector->director_type = 'chief';
        $this->medicalDirector->save();

        $this->assertTrue($this->medicalDirector->isChiefDirector());
    }

    /** @test */
    public function it_has_license_validity_accessor(): void
    {
        $this->medicalDirector->license_expiry = now()->addDays(30);
        $this->medicalDirector->save();

        $this->assertTrue($this->medicalDirector->hasValidLicense());
    }

    /** @test */
    public function it_has_age_accessor(): void
    {
        $this->medicalDirector->birth_date = now()->subYears(45);
        $this->medicalDirector->save();

        $this->assertEquals(45, $this->medicalDirector->age_years);
    }

    /** @test */
    public function it_has_experience_years_accessor(): void
    {
        $this->medicalDirector->license_issue_date = now()->subYears(15);
        $this->medicalDirector->save();

        $this->assertEquals(15, $this->medicalDirector->experience_years);
    }
}
