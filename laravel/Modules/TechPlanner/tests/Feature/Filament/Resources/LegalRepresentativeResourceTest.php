<?php

declare(strict_types=1);

namespace Modules\TechPlanner\Tests\Feature\Filament\Resources;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Modules\TechPlanner\Filament\Resources\LegalRepresentativeResource;
use Modules\TechPlanner\Filament\Resources\LegalRepresentativeResource\Pages\CreateLegalRepresentative;
use Modules\TechPlanner\Filament\Resources\LegalRepresentativeResource\Pages\EditLegalRepresentative;
use Modules\TechPlanner\Filament\Resources\LegalRepresentativeResource\Pages\ListLegalRepresentatives;
use Modules\TechPlanner\Models\LegalRepresentative;
use Modules\TechPlanner\Models\LegalOffice;
use Modules\User\Models\User;
use Tests\TestCase;

class LegalRepresentativeResourceTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected User $admin;
    protected LegalOffice $legalOffice;

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->admin = User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
        ]);

        $this->legalOffice = LegalOffice::factory()->create();
    }

    /** @test */
    public function it_can_list_legal_representatives(): void
    {
        LegalRepresentative::factory()->count(3)->create();

        $this->actingAs($this->admin)
            ->get(LegalRepresentativeResource::getUrl())
            ->assertSuccessful()
            ->assertSeeLivewire(ListLegalRepresentatives::class);
    }

    /** @test */
    public function it_can_create_legal_representative(): void
    {
        $representativeData = [
            'name' => 'Avv. Mario Rossi',
            'surname' => 'Rossi',
            'email' => 'mario.rossi@studio.it',
            'phone' => '+39 02 1234567',
            'mobile' => '+39 333 1234567',
            'legal_office_id' => $this->legalOffice->id,
            'license_number' => 'MI123456',
            'specializations' => json_encode(['civil', 'commercial']),
            'status' => 'active',
        ];

        Livewire::actingAs($this->admin)
            ->test(CreateLegalRepresentative::class)
            ->fillForm($representativeData)
            ->call('create')
            ->assertHasNoFormErrors()
            ->assertRedirect();

        $this->assertDatabaseHas('legal_representatives', [
            'name' => 'Avv. Mario Rossi',
            'license_number' => 'MI123456',
            'legal_office_id' => $this->legalOffice->id,
        ]);
    }

    /** @test */
    public function it_can_edit_legal_representative(): void
    {
        $representative = LegalRepresentative::factory()->create([
            'name' => 'Original Name',
            'status' => 'active',
        ]);

        $updatedData = [
            'name' => 'Updated Name',
            'status' => 'inactive',
        ];

        Livewire::actingAs($this->admin)
            ->test(EditLegalRepresentative::class, ['record' => $representative->id])
            ->fillForm($updatedData)
            ->call('save')
            ->assertHasNoFormErrors()
            ->assertRedirect();

        $this->assertDatabaseHas('legal_representatives', [
            'id' => $representative->id,
            'name' => 'Updated Name',
            'status' => 'inactive',
        ]);
    }

    /** @test */
    public function it_can_delete_legal_representative(): void
    {
        $representative = LegalRepresentative::factory()->create();

        Livewire::actingAs($this->admin)
            ->test(ListLegalRepresentatives::class)
            ->callTableAction('delete', $representative)
            ->assertHasNoTableActionErrors();

        $this->assertSoftDeleted('legal_representatives', ['id' => $representative->id]);
    }

    /** @test */
    public function it_validates_required_fields_on_create(): void
    {
        Livewire::actingAs($this->admin)
            ->test(CreateLegalRepresentative::class)
            ->fillForm([
                'name' => '',
                'surname' => '',
                'email' => '',
                'legal_office_id' => '',
            ])
            ->call('create')
            ->assertHasFormErrors(['name', 'surname', 'email', 'legal_office_id']);
    }

    /** @test */
    public function it_validates_email_format(): void
    {
        Livewire::actingAs($this->admin)
            ->test(CreateLegalRepresentative::class)
            ->fillForm([
                'name' => 'Test Name',
                'surname' => 'Test Surname',
                'email' => 'invalid-email',
                'legal_office_id' => $this->legalOffice->id,
            ])
            ->call('create')
            ->assertHasFormErrors(['email']);
    }

    /** @test */
    public function it_validates_license_number_uniqueness(): void
    {
        LegalRepresentative::factory()->create(['license_number' => 'MI123456']);

        Livewire::actingAs($this->admin)
            ->test(CreateLegalRepresentative::class)
            ->fillForm([
                'name' => 'Test Name',
                'surname' => 'Test Surname',
                'email' => 'test@example.com',
                'legal_office_id' => $this->legalOffice->id,
                'license_number' => 'MI123456',
            ])
            ->call('create')
            ->assertHasFormErrors(['license_number']);
    }

    /** @test */
    public function it_validates_legal_office_exists(): void
    {
        Livewire::actingAs($this->admin)
            ->test(CreateLegalRepresentative::class)
            ->fillForm([
                'name' => 'Test Name',
                'surname' => 'Test Surname',
                'email' => 'test@example.com',
                'legal_office_id' => 99999,
            ])
            ->call('create')
            ->assertHasFormErrors(['legal_office_id']);
    }

    /** @test */
    public function it_can_search_legal_representatives(): void
    {
        LegalRepresentative::factory()->create(['name' => 'Avv. Mario Rossi']);
        LegalRepresentative::factory()->create(['name' => 'Avv. Anna Bianchi']);

        Livewire::actingAs($this->admin)
            ->test(ListLegalRepresentatives::class)
            ->searchTable('Mario')
            ->assertCanSeeTableRecords(['Avv. Mario Rossi'])
            ->assertCanSeeTableRecord('Avv. Mario Rossi')
            ->assertCanNotSeeTableRecord('Avv. Anna Bianchi');
    }

    /** @test */
    public function it_can_filter_legal_representatives_by_status(): void
    {
        LegalRepresentative::factory()->create(['status' => 'active']);
        LegalRepresentative::factory()->create(['status' => 'inactive']);

        Livewire::actingAs($this->admin)
            ->test(ListLegalRepresentatives::class)
            ->filterTable('status', 'active')
            ->assertCanSeeTableRecords(['Active Representative']);
    }

    /** @test */
    public function it_can_filter_legal_representatives_by_legal_office(): void
    {
        $office1 = LegalOffice::factory()->create(['name' => 'Studio A']);
        $office2 = LegalOffice::factory()->create(['name' => 'Studio B']);

        LegalRepresentative::factory()->create(['legal_office_id' => $office1->id]);
        LegalRepresentative::factory()->create(['legal_office_id' => $office2->id]);

        Livewire::actingAs($this->admin)
            ->test(ListLegalRepresentatives::class)
            ->filterTable('legal_office_id', $office1->id)
            ->assertCanSeeTableRecords(['Studio A Representative']);
    }

    /** @test */
    public function it_can_filter_legal_representatives_by_specialization(): void
    {
        LegalRepresentative::factory()->create([
            'specializations' => json_encode(['civil', 'commercial'])
        ]);
        LegalRepresentative::factory()->create([
            'specializations' => json_encode(['criminal', 'family'])
        ]);

        Livewire::actingAs($this->admin)
            ->test(ListLegalRepresentatives::class)
            ->filterTable('specializations', 'civil')
            ->assertCanSeeTableRecords(['Civil Law Representative']);
    }

    /** @test */
    public function it_can_bulk_delete_legal_representatives(): void
    {
        $representatives = LegalRepresentative::factory()->count(3)->create();

        Livewire::actingAs($this->admin)
            ->test(ListLegalRepresentatives::class)
            ->selectTableRecords($representatives->pluck('id')->toArray())
            ->callTableBulkAction('delete')
            ->assertHasNoTableBulkActionErrors();

        foreach ($representatives as $representative) {
            $this->assertSoftDeleted('legal_representatives', ['id' => $representative->id]);
        }
    }

    /** @test */
    public function it_can_export_legal_representatives(): void
    {
        LegalRepresentative::factory()->count(5)->create();

        Livewire::actingAs($this->admin)
            ->test(ListLegalRepresentatives::class)
            ->callTableAction('export')
            ->assertHasNoTableActionErrors();
    }

    /** @test */
    public function it_can_view_legal_representative_details(): void
    {
        $representative = LegalRepresentative::factory()->create([
            'name' => 'Avv. Test',
            'email' => 'test@example.com',
            'license_number' => 'MI123456',
        ]);

        $this->actingAs($this->admin)
            ->get(LegalRepresentativeResource::getUrl('view', ['record' => $representative->id]))
            ->assertSuccessful()
            ->assertSee('Avv. Test')
            ->assertSee('test@example.com')
            ->assertSee('MI123456');
    }

    /** @test */
    public function it_handles_soft_deleted_legal_representatives_correctly(): void
    {
        $representative = LegalRepresentative::factory()->create();
        $representative->delete();

        Livewire::actingAs($this->admin)
            ->test(ListLegalRepresentatives::class)
            ->assertCanNotSeeTableRecord($representative);

        $this->actingAs($this->admin)
            ->patch(LegalRepresentativeResource::getUrl('restore', ['record' => $representative->id]))
            ->assertSuccessful();

        $this->assertDatabaseHas('legal_representatives', [
            'id' => $representative->id,
            'deleted_at' => null,
        ]);
    }

    /** @test */
    public function it_can_duplicate_legal_representative(): void
    {
        $representative = LegalRepresentative::factory()->create([
            'name' => 'Original Representative',
        ]);

        Livewire::actingAs($this->admin)
            ->test(ListLegalRepresentatives::class)
            ->callTableAction('duplicate', $representative)
            ->assertHasNoTableActionErrors();

        $this->assertDatabaseHas('legal_representatives', [
            'name' => 'Original Representative (Copy)',
        ]);
    }

    /** @test */
    public function it_validates_license_number_on_edit_except_self(): void
    {
        $rep1 = LegalRepresentative::factory()->create(['license_number' => 'MI111111']);
        $rep2 = LegalRepresentative::factory()->create(['license_number' => 'MI222222']);

        Livewire::actingAs($this->admin)
            ->test(EditLegalRepresentative::class, ['record' => $rep1->id])
            ->fillForm(['license_number' => 'MI222222'])
            ->call('save')
            ->assertHasFormErrors(['license_number']);

        Livewire::actingAs($this->admin)
            ->test(EditLegalRepresentative::class, ['record' => $rep1->id])
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
            'labor_law',
        ];

        Livewire::actingAs($this->admin)
            ->test(CreateLegalRepresentative::class)
            ->fillForm([
                'name' => 'Test Name',
                'surname' => 'Test Surname',
                'email' => 'test@example.com',
                'legal_office_id' => $this->legalOffice->id,
                'specializations' => json_encode($specializations),
            ])
            ->call('create')
            ->assertHasNoFormErrors()
            ->assertRedirect();

        $this->assertDatabaseHas('legal_representatives', [
            'name' => 'Test Name',
            'specializations' => json_encode($specializations),
        ]);
    }

    /** @test */
    public function it_can_handle_languages_json_field(): void
    {
        $languages = [
            'italian' => 'native',
            'english' => 'fluent',
            'french' => 'intermediate',
            'german' => 'basic',
        ];

        Livewire::actingAs($this->admin)
            ->test(CreateLegalRepresentative::class)
            ->fillForm([
                'name' => 'Test Name',
                'surname' => 'Test Surname',
                'email' => 'test@example.com',
                'legal_office_id' => $this->legalOffice->id,
                'languages' => json_encode($languages),
            ])
            ->call('create')
            ->assertHasNoFormErrors()
            ->assertRedirect();

        $this->assertDatabaseHas('legal_representatives', [
            'name' => 'Test Name',
            'languages' => json_encode($languages),
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
            ->test(CreateLegalRepresentative::class)
            ->fillForm([
                'name' => 'Test Name',
                'surname' => 'Test Surname',
                'email' => 'test@example.com',
                'legal_office_id' => $this->legalOffice->id,
                'working_hours' => json_encode($workingHours),
            ])
            ->call('create')
            ->assertHasNoFormErrors()
            ->assertRedirect();

        $this->assertDatabaseHas('legal_representatives', [
            'name' => 'Test Name',
            'working_hours' => json_encode($workingHours),
        ]);
    }

    /** @test */
    public function it_can_handle_metadata_field(): void
    {
        $metadata = [
            'years_of_experience' => 15,
            'cases_handled' => 500,
            'success_rate' => 0.95,
            'awards' => ['Best Lawyer 2023', 'Excellence in Service'],
            'publications' => ['Legal Journal Article 2022', 'Book Chapter 2021'],
        ];

        Livewire::actingAs($this->admin)
            ->test(CreateLegalRepresentative::class)
            ->fillForm([
                'name' => 'Test Name',
                'surname' => 'Test Surname',
                'email' => 'test@example.com',
                'legal_office_id' => $this->legalOffice->id,
                'metadata' => json_encode($metadata),
            ])
            ->call('create')
            ->assertHasNoFormErrors()
            ->assertRedirect();

        $this->assertDatabaseHas('legal_representatives', [
            'name' => 'Test Name',
            'metadata' => json_encode($metadata),
        ]);
    }

    /** @test */
    public function it_can_handle_contact_preferences(): void
    {
        $contactPreferences = [
            'preferred_contact_method' => 'email',
            'preferred_contact_time' => 'business_hours',
            'emergency_contact' => '+39 333 9999999',
            'assistant_name' => 'Maria Bianchi',
            'assistant_email' => 'assistant@example.com',
        ];

        Livewire::actingAs($this->admin)
            ->test(CreateLegalRepresentative::class)
            ->fillForm([
                'name' => 'Test Name',
                'surname' => 'Test Surname',
                'email' => 'test@example.com',
                'legal_office_id' => $this->legalOffice->id,
                'contact_preferences' => json_encode($contactPreferences),
            ])
            ->call('create')
            ->assertHasNoFormErrors()
            ->assertRedirect();

        $this->assertDatabaseHas('legal_representatives', [
            'name' => 'Test Name',
            'contact_preferences' => json_encode($contactPreferences),
        ]);
    }
}
