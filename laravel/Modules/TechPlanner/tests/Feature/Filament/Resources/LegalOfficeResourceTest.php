<?php

declare(strict_types=1);

namespace Modules\TechPlanner\Tests\Feature\Filament\Resources;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Modules\TechPlanner\Filament\Resources\LegalOfficeResource;
use Modules\TechPlanner\Filament\Resources\LegalOfficeResource\Pages\CreateLegalOffice;
use Modules\TechPlanner\Filament\Resources\LegalOfficeResource\Pages\EditLegalOffice;
use Modules\TechPlanner\Filament\Resources\LegalOfficeResource\Pages\ListLegalOffices;
use Modules\TechPlanner\Models\LegalOffice;
use Modules\User\Models\User;
use Tests\TestCase;

class LegalOfficeResourceTest extends TestCase
{
    use RefreshDatabase, WithFaker;

class LegalOfficeResourceTest extends TestCase
{
    protected User $admin;

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->admin = User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
        ]);
    }

    /** @test */
    public function it_can_list_legal_offices(): void
    {
        LegalOffice::factory()->count(3)->create();

        $this->actingAs($this->admin)
            ->get(LegalOfficeResource::getUrl())
            ->assertSuccessful()
            ->assertSeeLivewire(ListLegalOffices::class);
    }

    /** @test */
    public function it_can_create_legal_office(): void
    {
        $legalOfficeData = [
            'name' => 'Studio Legale Rossi',
            'type' => 'law_firm',
            'address' => 'Via Roma 123',
            'city' => 'Milano',
            'postal_code' => '20100',
            'country' => 'Italia',
            'region' => 'Lombardia',
            'phone' => '+39 02 1234567',
            'email' => 'info@studiorossi.it',
            'website' => 'https://studiorossi.it',
            'license_number' => 'MI123456',
            'specializations' => json_encode(['civil', 'commercial']),
            'status' => 'active',
        ];

        Livewire::actingAs($this->admin)
            ->test(CreateLegalOffice::class)
            ->fillForm($legalOfficeData)
            ->call('create')
            ->assertHasNoFormErrors()
            ->assertRedirect();

        $this->assertDatabaseHas('legal_offices', [
            'name' => 'Studio Legale Rossi',
            'type' => 'law_firm',
            'license_number' => 'MI123456',
        ]);
    }

    /** @test */
    public function it_can_edit_legal_office(): void
    {
        $legalOffice = LegalOffice::factory()->create([
            'name' => 'Original Office',
            'status' => 'active',
        ]);

        $updatedData = [
            'name' => 'Updated Office',
            'status' => 'inactive',
        ];

        Livewire::actingAs($this->admin)
            ->test(EditLegalOffice::class, ['record' => $legalOffice->id])
            ->fillForm($updatedData)
            ->call('save')
            ->assertHasNoFormErrors()
            ->assertRedirect();

        $this->assertDatabaseHas('legal_offices', [
            'id' => $legalOffice->id,
            'name' => 'Updated Office',
            'status' => 'inactive',
        ]);
    }

    /** @test */
    public function it_can_delete_legal_office(): void
    {
        $legalOffice = LegalOffice::factory()->create();

        Livewire::actingAs($this->admin)
            ->test(ListLegalOffices::class)
            ->callTableAction('delete', $legalOffice)
            ->assertHasNoTableActionErrors();

        $this->assertSoftDeleted('legal_offices', ['id' => $legalOffice->id]);
    }

    /** @test */
    public function it_validates_required_fields_on_create(): void
    {
        Livewire::actingAs($this->admin)
            ->test(CreateLegalOffice::class)
            ->fillForm([
                'name' => '',
                'type' => '',
                'address' => '',
            ])
            ->call('create')
            ->assertHasFormErrors(['name', 'type', 'address']);
    }

    /** @test */
    public function it_validates_office_type_values(): void
    {
        Livewire::actingAs($this->admin)
            ->test(CreateLegalOffice::class)
            ->fillForm([
                'name' => 'Test Office',
                'type' => 'invalid_type',
                'address' => 'Test Address',
            ])
            ->call('create')
            ->assertHasFormErrors(['type']);
    }

    /** @test */
    public function it_validates_license_number_uniqueness(): void
    {
        LegalOffice::factory()->create(['license_number' => 'MI123456']);

        Livewire::actingAs($this->admin)
            ->test(CreateLegalOffice::class)
            ->fillForm([
                'name' => 'Test Office',
                'type' => 'law_firm',
                'address' => 'Test Address',
                'license_number' => 'MI123456',
            ])
            ->call('create')
            ->assertHasFormErrors(['license_number']);
    }

    /** @test */
    public function it_can_search_legal_offices(): void
    {
        LegalOffice::factory()->create(['name' => 'Studio Legale Bianchi']);
        LegalOffice::factory()->create(['name' => 'Studio Legale Verdi']);

        Livewire::actingAs($this->admin)
            ->test(ListLegalOffices::class)
            ->searchTable('Bianchi')
            ->assertCanSeeTableRecords(['Studio Legale Bianchi'])
            ->assertCanSeeTableRecord('Studio Legale Bianchi')
            ->assertCanNotSeeTableRecord('Studio Legale Verdi');
    }

    /** @test */
    public function it_can_filter_legal_offices_by_type(): void
    {
        LegalOffice::factory()->create(['type' => 'law_firm']);
        LegalOffice::factory()->create(['type' => 'notary']);

        Livewire::actingAs($this->admin)
            ->test(ListLegalOffices::class)
            ->filterTable('type', 'law_firm')
            ->assertCanSeeTableRecords(['Law Firm Office']);
    }

    /** @test */
    public function it_can_filter_legal_offices_by_status(): void
    {
        LegalOffice::factory()->create(['status' => 'active']);
        LegalOffice::factory()->create(['status' => 'inactive']);

        Livewire::actingAs($this->admin)
            ->test(ListLegalOffices::class)
            ->filterTable('status', 'active')
            ->assertCanSeeTableRecords(['Active Office']);
    }

    /** @test */
    public function it_can_filter_legal_offices_by_city(): void
    {
        LegalOffice::factory()->create(['city' => 'Milano']);
        LegalOffice::factory()->create(['city' => 'Roma']);

        Livewire::actingAs($this->admin)
            ->test(ListLegalOffices::class)
            ->filterTable('city', 'Milano')
            ->assertCanSeeTableRecords(['Milano Office']);
    }

    /** @test */
    public function it_can_bulk_delete_legal_offices(): void
    {
        $legalOffices = LegalOffice::factory()->count(3)->create();

        Livewire::actingAs($this->admin)
            ->test(ListLegalOffices::class)
            ->selectTableRecords($legalOffices->pluck('id')->toArray())
            ->callTableBulkAction('delete')
            ->assertHasNoTableBulkActionErrors();

        foreach ($legalOffices as $legalOffice) {
            $this->assertSoftDeleted('legal_offices', ['id' => $legalOffice->id]);
        }
    }

    /** @test */
    public function it_can_export_legal_offices(): void
    {
        LegalOffice::factory()->count(5)->create();

        Livewire::actingAs($this->admin)
            ->test(ListLegalOffices::class)
            ->callTableAction('export')
            ->assertHasNoTableActionErrors();
    }

    /** @test */
    public function it_can_view_legal_office_details(): void
    {
        $legalOffice = LegalOffice::factory()->create([
            'name' => 'Studio Legale Test',
            'address' => 'Via Test 123',
            'city' => 'Milano',
        ]);

        $this->actingAs($this->admin)
            ->get(LegalOfficeResource::getUrl('view', ['record' => $legalOffice->id]))
            ->assertSuccessful()
            ->assertSee('Studio Legale Test')
            ->assertSee('Via Test 123')
            ->assertSee('Milano');
    }

    /** @test */
    public function it_handles_soft_deleted_legal_offices_correctly(): void
    {
        $legalOffice = LegalOffice::factory()->create();
        $legalOffice->delete();

        Livewire::actingAs($this->admin)
            ->test(ListLegalOffices::class)
            ->assertCanNotSeeTableRecord($legalOffice);

        $this->actingAs($this->admin)
            ->patch(LegalOfficeResource::getUrl('restore', ['record' => $legalOffice->id]))
            ->assertSuccessful();

        $this->assertDatabaseHas('legal_offices', [
            'id' => $legalOffice->id,
            'deleted_at' => null,
        ]);
    }

    /** @test */
    public function it_can_duplicate_legal_office(): void
    {
        $legalOffice = LegalOffice::factory()->create([
            'name' => 'Original Office',
        ]);

        Livewire::actingAs($this->admin)
            ->test(ListLegalOffices::class)
            ->callTableAction('duplicate', $legalOffice)
            ->assertHasNoTableActionErrors();

        $this->assertDatabaseHas('legal_offices', [
            'name' => 'Original Office (Copy)',
        ]);
    }

    /** @test */
    public function it_validates_license_number_on_edit_except_self(): void
    {
        $office1 = LegalOffice::factory()->create(['license_number' => 'MI111111']);
        $office2 = LegalOffice::factory()->create(['license_number' => 'MI222222']);

        Livewire::actingAs($this->admin)
            ->test(EditLegalOffice::class, ['record' => $office1->id])
            ->fillForm(['license_number' => 'MI222222'])
            ->call('save')
            ->assertHasFormErrors(['license_number']);

        Livewire::actingAs($this->admin)
            ->test(EditLegalOffice::class, ['record' => $office1->id])
            ->fillForm(['license_number' => 'MI111111'])
            ->call('save')
            ->assertHasNoFormErrors();
    }

    /** @test */
    public function it_can_handle_specializations_json_field(): void
    {
        $specializations = [
            'civil_law',
            'commercial_law',
            'criminal_law',
            'family_law',
        ];

        Livewire::actingAs($this->admin)
            ->test(CreateLegalOffice::class)
            ->fillForm([
                'name' => 'Test Office',
                'type' => 'law_firm',
                'address' => 'Test Address',
                'specializations' => json_encode($specializations),
            ])
            ->call('create')
            ->assertHasNoFormErrors()
            ->assertRedirect();

        $this->assertDatabaseHas('legal_offices', [
            'name' => 'Test Office',
            'specializations' => json_encode($specializations),
        ]);
    }

    /** @test */
    public function it_can_handle_working_hours_json_field(): void
    {
        $workingHours = [
            'monday' => ['09:00', '18:00'],
            'tuesday' => ['09:00', '18:00'],
            'wednesday' => ['09:00', '18:00'],
            'thursday' => ['09:00', '18:00'],
            'friday' => ['09:00', '17:00'],
            'saturday' => ['09:00', '12:00'],
            'sunday' => ['closed'],
        ];

        Livewire::actingAs($this->admin)
            ->test(CreateLegalOffice::class)
            ->fillForm([
                'name' => 'Test Office',
                'type' => 'law_firm',
                'address' => 'Test Address',
                'working_hours' => json_encode($workingHours),
            ])
            ->call('create')
            ->assertHasNoFormErrors()
            ->assertRedirect();

        $this->assertDatabaseHas('legal_offices', [
            'name' => 'Test Office',
            'working_hours' => json_encode($workingHours),
        ]);
    }

    /** @test */
    public function it_can_handle_metadata_field(): void
    {
        $metadata = [
            'founded_year' => 1995,
            'partners_count' => 5,
            'associates_count' => 15,
            'practice_areas' => ['litigation', 'corporate', 'real_estate'],
            'awards' => ['Best Law Firm 2023', 'Excellence in Service'],
        ];

        Livewire::actingAs($this->admin)
            ->test(CreateLegalOffice::class)
            ->fillForm([
                'name' => 'Test Office',
                'type' => 'law_firm',
                'address' => 'Test Address',
                'metadata' => json_encode($metadata),
            ])
            ->call('create')
            ->assertHasNoFormErrors()
            ->assertRedirect();

        $this->assertDatabaseHas('legal_offices', [
            'name' => 'Test Office',
            'metadata' => json_encode($metadata),
        ]);
    }

    /** @test */
    public function it_can_handle_contact_persons(): void
    {
        $contactPersons = [
            [
                'name' => 'Avv. Mario Rossi',
                'role' => 'Senior Partner',
                'email' => 'mario.rossi@studio.it',
                'phone' => '+39 02 1234567',
            ],
            [
                'name' => 'Avv. Anna Bianchi',
                'role' => 'Associate',
                'email' => 'anna.bianchi@studio.it',
                'phone' => '+39 02 1234568',
            ],
        ];

        Livewire::actingAs($this->admin)
            ->test(CreateLegalOffice::class)
            ->fillForm([
                'name' => 'Test Office',
                'type' => 'law_firm',
                'address' => 'Test Address',
                'contact_persons' => json_encode($contactPersons),
            ])
            ->call('create')
            ->assertHasNoFormErrors()
            ->assertRedirect();

        $this->assertDatabaseHas('legal_offices', [
            'name' => 'Test Office',
            'contact_persons' => json_encode($contactPersons),
        ]);
    }
}
