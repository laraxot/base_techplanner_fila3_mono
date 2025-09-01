<?php

declare(strict_types=1);

namespace Modules\TechPlanner\Tests\Unit\Models;

use Modules\TechPlanner\Models\LegalRepresentative;

/**
 * Test unitario per il modello LegalRepresentative.
 *
 * @covers \Modules\TechPlanner\Models\LegalRepresentative
 */
class LegalRepresentativeTest extends TestCase
{
    private LegalRepresentative $legalRepresentative;

    protected function setUp(): void
    {
        parent::setUp();
        $this->legalRepresentative = LegalRepresentative::factory()->create();
    }

    /** @test */
    public function it_can_create_legal_representative(): void
    {
        $this->assertDatabaseHas('legal_representatives', [
            'id' => $this->legalRepresentative->id,
        ]);
    }

    /** @test */
    public function it_has_required_fields(): void
    {
        $this->assertDatabaseHas('legal_representatives', [
            'id' => $this->legalRepresentative->id,
            'first_name' => $this->legalRepresentative->first_name,
            'last_name' => $this->legalRepresentative->last_name,
            'email' => $this->legalRepresentative->email,
        ]);
    }

    /** @test */
    public function it_has_soft_deletes(): void
    {
        $this->legalRepresentative->delete();
        $this->assertSoftDeleted('legal_representatives', ['id' => $this->legalRepresentative->id]);
    }

    /** @test */
    public function it_can_be_restored(): void
    {
        $this->legalRepresentative->delete();
        $this->legalRepresentative->restore();
        $this->assertDatabaseHas('legal_representatives', ['id' => $this->legalRepresentative->id]);
    }

    /** @test */
    public function it_has_full_name_accessor(): void
    {
        $this->legalRepresentative->first_name = 'Mario';
        $this->legalRepresentative->last_name = 'Rossi';
        $this->legalRepresentative->save();

        $this->assertEquals('Mario Rossi', $this->legalRepresentative->full_name);
    }

    /** @test */
    public function it_has_active_scope(): void
    {
        LegalRepresentative::factory()->create(['is_active' => true]);
        LegalRepresentative::factory()->create(['is_active' => false]);

        $activeRepresentatives = LegalRepresentative::active()->get();
        $this->assertEquals(1, $activeRepresentatives->count());
    }

    /** @test */
    public function it_has_specialization_scope(): void
    {
        LegalRepresentative::factory()->create(['specialization' => 'Diritto Commerciale']);
        LegalRepresentative::factory()->create(['specialization' => 'Diritto del Lavoro']);

        $commercialLawyers = LegalRepresentative::specializedIn('Diritto Commerciale')->get();
        $this->assertEquals(1, $commercialLawyers->count());
    }

    /** @test */
    public function it_has_city_scope(): void
    {
        LegalRepresentative::factory()->create(['city' => 'Roma']);
        LegalRepresentative::factory()->create(['city' => 'Milano']);

        $romeLawyers = LegalRepresentative::inCity('Roma')->get();
        $this->assertEquals(1, $romeLawyers->count());
    }

    /** @test */
    public function it_handles_representative_phone(): void
    {
        $phone = '+39 333 1234567';
        $this->legalRepresentative->phone = $phone;
        $this->legalRepresentative->save();

        $this->assertDatabaseHas('legal_representatives', [
            'id' => $this->legalRepresentative->id,
            'phone' => $phone,
        ]);
    }

    /** @test */
    public function it_handles_representative_mobile(): void
    {
        $mobile = '+39 333 7654321';
        $this->legalRepresentative->mobile = $mobile;
        $this->legalRepresentative->save();

        $this->assertDatabaseHas('legal_representatives', [
            'id' => $this->legalRepresentative->id,
            'mobile' => $mobile,
        ]);
    }

    /** @test */
    public function it_handles_representative_address(): void
    {
        $address = 'Via Roma 123, 00100 Roma';
        $this->legalRepresentative->address = $address;
        $this->legalRepresentative->save();

        $this->assertDatabaseHas('legal_representatives', [
            'id' => $this->legalRepresentative->id,
            'address' => $address,
        ]);
    }

    /** @test */
    public function it_handles_representative_city(): void
    {
        $city = 'Milano';
        $this->legalRepresentative->city = $city;
        $this->legalRepresentative->save();

        $this->assertDatabaseHas('legal_representatives', [
            'id' => $this->legalRepresentative->id,
            'city' => $city,
        ]);
    }

    /** @test */
    public function it_handles_representative_postal_code(): void
    {
        $postalCode = '20100';
        $this->legalRepresentative->postal_code = $postalCode;
        $this->legalRepresentative->save();

        $this->assertDatabaseHas('legal_representatives', [
            'id' => $this->legalRepresentative->id,
            'postal_code' => $postalCode,
        ]);
    }

    /** @test */
    public function it_handles_representative_country(): void
    {
        $country = 'Italia';
        $this->legalRepresentative->country = $country;
        $this->legalRepresentative->save();

        $this->assertDatabaseHas('legal_representatives', [
            'id' => $this->legalRepresentative->id,
            'country' => $country,
        ]);
    }

    /** @test */
    public function it_handles_representative_region(): void
    {
        $region = 'Lombardia';
        $this->legalRepresentative->region = $region;
        $this->legalRepresentative->save();

        $this->assertDatabaseHas('legal_representatives', [
            'id' => $this->legalRepresentative->id,
            'region' => $region,
        ]);
    }

    /** @test */
    public function it_handles_representative_birth_date(): void
    {
        $birthDate = '1980-05-15';
        $this->legalRepresentative->birth_date = $birthDate;
        $this->legalRepresentative->save();

        $this->assertDatabaseHas('legal_representatives', [
            'id' => $this->legalRepresentative->id,
            'birth_date' => $birthDate,
        ]);
    }

    /** @test */
    public function it_handles_representative_fiscal_code(): void
    {
        $fiscalCode = 'RSSMRA80E15H501X';
        $this->legalRepresentative->fiscal_code = $fiscalCode;
        $this->legalRepresentative->save();

        $this->assertDatabaseHas('legal_representatives', [
            'id' => $this->legalRepresentative->id,
            'fiscal_code' => $fiscalCode,
        ]);
    }

    /** @test */
    public function it_handles_representative_license_number(): void
    {
        $licenseNumber = '12345A';
        $this->legalRepresentative->license_number = $licenseNumber;
        $this->legalRepresentative->save();

        $this->assertDatabaseHas('legal_representatives', [
            'id' => $this->legalRepresentative->id,
            'license_number' => $licenseNumber,
        ]);
    }

    /** @test */
    public function it_handles_representative_specializations(): void
    {
        $specializations = ['Diritto Commerciale', 'Diritto Societario', 'Contratti'];
        $this->legalRepresentative->specializations = $specializations;
        $this->legalRepresentative->save();

        $this->assertDatabaseHas('legal_representatives', [
            'id' => $this->legalRepresentative->id,
            'specializations' => json_encode($specializations),
        ]);
    }

    /** @test */
    public function it_handles_representative_languages(): void
    {
        $languages = ['Italiano', 'Inglese', 'Francese'];
        $this->legalRepresentative->languages = $languages;
        $this->legalRepresentative->save();

        $this->assertDatabaseHas('legal_representatives', [
            'id' => $this->legalRepresentative->id,
            'languages' => json_encode($languages),
        ]);
    }

    /** @test */
    public function it_handles_representative_notes(): void
    {
        $notes = 'Avvocato con oltre 15 anni di esperienza in diritto commerciale';
        $this->legalRepresentative->notes = $notes;
        $this->legalRepresentative->save();

        $this->assertDatabaseHas('legal_representatives', [
            'id' => $this->legalRepresentative->id,
            'notes' => $notes,
        ]);
    }

    /** @test */
    public function it_serializes_to_array(): void
    {
        $array = $this->legalRepresentative->toArray();

        $this->assertIsArray($array);
        $this->assertArrayHasKey('id', $array);
        $this->assertArrayHasKey('first_name', $array);
        $this->assertArrayHasKey('last_name', $array);
        $this->assertArrayHasKey('email', $array);
    }

    /** @test */
    public function it_serializes_to_json(): void
    {
        $json = $this->legalRepresentative->toJson();

        $this->assertIsString($json);
        $this->assertStringContainsString('first_name', $json);
        $this->assertStringContainsString('last_name', $json);
    }

    /** @test */
    public function it_handles_representative_status(): void
    {
        $this->legalRepresentative->status = 'active';
        $this->legalRepresentative->save();

        $this->assertTrue($this->legalRepresentative->isActive());
    }

    /** @test */
    public function it_handles_representative_type(): void
    {
        $this->legalRepresentative->representative_type = 'lawyer';
        $this->legalRepresentative->save();

        $this->assertTrue($this->legalRepresentative->isLawyer());
    }
}
