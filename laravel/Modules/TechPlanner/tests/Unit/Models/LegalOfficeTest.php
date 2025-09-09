<?php

declare(strict_types=1);

namespace Modules\TechPlanner\Tests\Unit\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\TechPlanner\Models\LegalOffice;
use Tests\TestCase;
=======
use Modules\TechPlanner\Models\LegalOffice;

/**
 * Test unitario per il modello LegalOffice.
 *
 * @covers \Modules\TechPlanner\Models\LegalOffice
 */
class LegalOfficeTest extends TestCase
{
    use RefreshDatabase;

=======
    private LegalOffice $legalOffice;

    protected function setUp(): void
    {
        parent::setUp();
        $this->legalOffice = LegalOffice::factory()->create();
    }

    /** @test */
    public function it_can_create_legal_office(): void
    {
        $this->assertDatabaseHas('legal_offices', [
            'id' => $this->legalOffice->id,
        ]);
    }

    /** @test */
    public function it_has_required_fields(): void
    {
        $this->assertDatabaseHas('legal_offices', [
            'id' => $this->legalOffice->id,
            'name' => $this->legalOffice->name,
            'address' => $this->legalOffice->address,
            'city' => $this->legalOffice->city,
            'country' => $this->legalOffice->country,
        ]);
    }

    /** @test */
    public function it_has_soft_deletes(): void
    {
        $this->legalOffice->delete();
        $this->assertSoftDeleted('legal_offices', ['id' => $this->legalOffice->id]);
    }

    /** @test */
    public function it_can_be_restored(): void
    {
        $this->legalOffice->delete();
        $this->legalOffice->restore();
        $this->assertDatabaseHas('legal_offices', ['id' => $this->legalOffice->id]);
    }

    /** @test */
    public function it_has_active_scope(): void
    {
        LegalOffice::factory()->create(['is_active' => true]);
        LegalOffice::factory()->create(['is_active' => false]);

        $activeOffices = LegalOffice::active()->get();
        $this->assertEquals(1, $activeOffices->count());
    }

    /** @test */
    public function it_has_city_scope(): void
    {
        LegalOffice::factory()->create(['city' => 'Roma']);
        LegalOffice::factory()->create(['city' => 'Milano']);

        $romeOffices = LegalOffice::inCity('Roma')->get();
        $this->assertEquals(1, $romeOffices->count());
    }

    /** @test */
    public function it_has_country_scope(): void
    {
        LegalOffice::factory()->create(['country' => 'Italia']);
        LegalOffice::factory()->create(['country' => 'Germania']);

        $italianOffices = LegalOffice::inCountry('Italia')->get();
        $this->assertEquals(1, $italianOffices->count());
    }

    /** @test */
    public function it_handles_office_description(): void
    {
        $description = 'Studio legale specializzato in diritto commerciale';
        $this->legalOffice->description = $description;
        $this->legalOffice->save();

        $this->assertDatabaseHas('legal_offices', [
            'id' => $this->legalOffice->id,
            'description' => $description,
        ]);
    }

    /** @test */
    public function it_serializes_to_array(): void
    {
        $array = $this->legalOffice->toArray();

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
        $json = $this->legalOffice->toJson();

        $this->assertIsString($json);
        $this->assertStringContainsString('name', $json);
        $this->assertStringContainsString('address', $json);
    }

    /** @test */
    public function it_handles_office_phone(): void
    {
        $phone = '+39 06 12345678';
        $this->legalOffice->phone = $phone;
        $this->legalOffice->save();

        $this->assertDatabaseHas('legal_offices', [
            'id' => $this->legalOffice->id,
            'phone' => $phone,
        ]);
    }

    /** @test */
    public function it_handles_office_email(): void
    {
        $email = 'info@studiolegale.it';
        $this->legalOffice->email = $email;
        $this->legalOffice->save();

        $this->assertDatabaseHas('legal_offices', [
            'id' => $this->legalOffice->id,
            'email' => $email,
        ]);
    }

    /** @test */
    public function it_handles_office_website(): void
    {
        $website = 'https://www.studiolegale.it';
        $this->legalOffice->website = $website;
        $this->legalOffice->save();

        $this->assertDatabaseHas('legal_offices', [
            'id' => $this->legalOffice->id,
            'website' => $website,
        ]);
    }

    /** @test */
    public function it_handles_office_fax(): void
    {
        $fax = '+39 06 87654321';
        $this->legalOffice->fax = $fax;
        $this->legalOffice->save();

        $this->assertDatabaseHas('legal_offices', [
            'id' => $this->legalOffice->id,
            'fax' => $fax,
        ]);
    }

    /** @test */
    public function it_handles_office_postal_code(): void
    {
        $postalCode = '00100';
        $this->legalOffice->postal_code = $postalCode;
        $this->legalOffice->save();

        $this->assertDatabaseHas('legal_offices', [
            'id' => $this->legalOffice->id,
            'postal_code' => $postalCode,
        ]);
    }

    /** @test */
    public function it_handles_office_region(): void
    {
        $region = 'Lazio';
        $this->legalOffice->region = $region;
        $this->legalOffice->save();

        $this->assertDatabaseHas('legal_offices', [
            'id' => $this->legalOffice->id,
            'region' => $region,
        ]);
    }

    /** @test */
    public function it_handles_office_specializations(): void
    {
        $specializations = ['Diritto Commerciale', 'Diritto del Lavoro', 'Diritto Civile'];
        $this->legalOffice->specializations = $specializations;
        $this->legalOffice->save();

        $this->assertDatabaseHas('legal_offices', [
            'id' => $this->legalOffice->id,
            'specializations' => json_encode($specializations),
        ]);
    }

    /** @test */
    public function it_handles_office_working_hours(): void
    {
        $workingHours = [
            'monday' => '09:00-18:00',
            'tuesday' => '09:00-18:00',
            'wednesday' => '09:00-18:00',
            'thursday' => '09:00-18:00',
            'friday' => '09:00-18:00',
        ];
        $this->legalOffice->working_hours = $workingHours;
        $this->legalOffice->save();

        $this->assertDatabaseHas('legal_offices', [
            'id' => $this->legalOffice->id,
            'working_hours' => json_encode($workingHours),
        ]);
    }

    /** @test */
    public function it_handles_office_notes(): void
    {
        $notes = 'Studio legale con oltre 20 anni di esperienza';
        $this->legalOffice->notes = $notes;
        $this->legalOffice->save();

        $this->assertDatabaseHas('legal_offices', [
            'id' => $this->legalOffice->id,
            'notes' => $notes,
        ]);
    }

    /** @test */
    public function it_handles_office_status(): void
    {
        $this->legalOffice->status = 'active';
        $this->legalOffice->save();

        $this->assertTrue($this->legalOffice->isActive());
    }

    /** @test */
    public function it_handles_office_type(): void
    {
        $this->legalOffice->office_type = 'partnership';
        $this->legalOffice->save();

        $this->assertTrue($this->legalOffice->isPartnership());
    }
}
