<?php

declare(strict_types=1);




namespace Modules\TechPlanner\Tests\Feature\Filament\Resources;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Modules\TechPlanner\Filament\Resources\MedicalDirectorResource;
use Modules\TechPlanner\Filament\Resources\MedicalDirectorResource\Pages\CreateMedicalDirector;
use Modules\TechPlanner\Filament\Resources\MedicalDirectorResource\Pages\EditMedicalDirector;
use Modules\TechPlanner\Filament\Resources\MedicalDirectorResource\Pages\ListMedicalDirectors;
use Modules\TechPlanner\Models\MedicalDirector;
use Modules\User\Models\User;
use Modules\TechPlanner\Tests\Feature\Filament\Resources\TestCase;

class MedicalDirectorResourceTest extends TestCase
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
    public function it_can_list_medical_directors(): void
    {
        MedicalDirector::factory()->count(3)->create();

        $this->actingAs($this->admin)
            ->get(MedicalDirectorResource::getUrl())
            ->assertSuccessful()
            ->assertSeeLivewire(ListMedicalDirectors::class);
    }

    /** @test */
    public function it_can_create_medical_director(): void
    {
        $directorData = [
            'name' => 'Dr. Mario Rossi',
            'surname' => 'Rossi',
            'email' => 'mario.rossi@hospital.it',
            'phone' => '+39 02 1234567',
            'mobile' => '+39 333 1234567',
            'license_number' => 'MI123456',
            'specializations' => json_encode(['cardiology', 'internal_medicine']),
            'status' => 'active',
        ];

        Livewire::actingAs($this->admin)
            ->test(CreateMedicalDirector::class)
            ->fillForm($directorData)
            ->call('create')
            ->assertHasNoFormErrors()
            ->assertRedirect();

        $this->assertDatabaseHas('medical_directors', [
            'name' => 'Dr. Mario Rossi',
            'license_number' => 'MI123456',
        ]);
    }

    /** @test */
    public function it_can_edit_medical_director(): void
    {
        $director = MedicalDirector::factory()->create([
            'name' => 'Original Name',
            'status' => 'active',
        ]);

        $updatedData = [
            'name' => 'Updated Name',
            'status' => 'inactive',
        ];

        Livewire::actingAs($this->admin)
            ->test(EditMedicalDirector::class, ['record' => $director->id])
            ->fillForm($updatedData)
            ->call('save')
            ->assertHasNoFormErrors()
            ->assertRedirect();

        $this->assertDatabaseHas('medical_directors', [
            'id' => $director->id,
            'name' => 'Updated Name',
            'status' => 'inactive',
        ]);
    }

    /** @test */
    public function it_can_delete_medical_director(): void
    {
        $director = MedicalDirector::factory()->create();

        Livewire::actingAs($this->admin)
            ->test(ListMedicalDirectors::class)
            ->callTableAction('delete', $director)
            ->assertHasNoTableActionErrors();

        $this->assertSoftDeleted('medical_directors', ['id' => $director->id]);
    }

    /** @test */
    public function it_validates_required_fields_on_create(): void
    {
        Livewire::actingAs($this->admin)
            ->test(CreateMedicalDirector::class)
            ->fillForm([
                'name' => '',
                'surname' => '',
                'email' => '',
                'license_number' => '',
            ])
            ->call('create')
            ->assertHasFormErrors(['name', 'surname', 'email', 'license_number']);
    }

    /** @test */
    public function it_validates_email_format(): void
    {
        Livewire::actingAs($this->admin)
            ->test(CreateMedicalDirector::class)
            ->fillForm([
                'name' => 'Test Name',
                'surname' => 'Test Surname',
                'email' => 'invalid-email',
                'license_number' => 'MI123456',
            ])
            ->call('create')
            ->assertHasFormErrors(['email']);
    }

    /** @test */
    public function it_validates_license_number_uniqueness(): void
    {
        MedicalDirector::factory()->create(['license_number' => 'MI123456']);

        Livewire::actingAs($this->admin)
            ->test(CreateMedicalDirector::class)
            ->fillForm([
                'name' => 'Test Name',
                'surname' => 'Test Surname',
                'email' => 'test@example.com',
                'license_number' => 'MI123456',
            ])
            ->call('create')
            ->assertHasFormErrors(['license_number']);
    }

    /** @test */
    public function it_can_search_medical_directors(): void
    {
        MedicalDirector::factory()->create(['name' => 'Dr. Mario Rossi']);
        MedicalDirector::factory()->create(['name' => 'Dr. Anna Bianchi']);

        Livewire::actingAs($this->admin)
            ->test(ListMedicalDirectors::class)
            ->searchTable('Mario')
            ->assertCanSeeTableRecords(['Dr. Mario Rossi'])
            ->assertCanSeeTableRecord('Dr. Mario Rossi')
            ->assertCanNotSeeTableRecord('Dr. Anna Bianchi');
    }

    /** @test */
    public function it_can_filter_medical_directors_by_status(): void
    {
        MedicalDirector::factory()->create(['status' => 'active']);
        MedicalDirector::factory()->create(['status' => 'inactive']);

        Livewire::actingAs($this->admin)
            ->test(ListMedicalDirectors::class)
            ->filterTable('status', 'active')
            ->assertCanSeeTableRecords(['Active Director']);
    }

    /** @test */
    public function it_can_filter_medical_directors_by_specialization(): void
    {
        MedicalDirector::factory()->create([
            'specializations' => json_encode(['cardiology', 'internal_medicine'])
        ]);
        MedicalDirector::factory()->create([
            'specializations' => json_encode(['surgery', 'pediatrics'])
        ]);

        Livewire::actingAs($this->admin)
            ->test(ListMedicalDirectors::class)
            ->filterTable('specializations', 'cardiology')
            ->assertCanSeeTableRecords(['Cardiology Director']);
    }

    /** @test */
    public function it_can_filter_medical_directors_by_city(): void
    {
        MedicalDirector::factory()->create(['city' => 'Milano']);
        MedicalDirector::factory()->create(['city' => 'Roma']);

        Livewire::actingAs($this->admin)
            ->test(ListMedicalDirectors::class)
            ->filterTable('city', 'Milano')
            ->assertCanSeeTableRecords(['Milano Director']);
    }

    /** @test */
    public function it_can_bulk_delete_medical_directors(): void
    {
        $directors = MedicalDirector::factory()->count(3)->create();

        Livewire::actingAs($this->admin)
            ->test(ListMedicalDirectors::class)
            ->selectTableRecords($directors->pluck('id')->toArray())
            ->callTableBulkAction('delete')
            ->assertHasNoTableBulkActionErrors();

        foreach ($directors as $director) {
            $this->assertSoftDeleted('medical_directors', ['id' => $director->id]);
        }
    }

    /** @test */
    public function it_can_export_medical_directors(): void
    {
        MedicalDirector::factory()->count(5)->create();

        Livewire::actingAs($this->admin)
            ->test(ListMedicalDirectors::class)
            ->callTableAction('export')
            ->assertHasNoTableActionErrors();
    }

    /** @test */
    public function it_can_view_medical_director_details(): void
    {
        $director = MedicalDirector::factory()->create([
            'name' => 'Dr. Test',
            'email' => 'test@example.com',
            'license_number' => 'MI123456',
        ]);

        $this->actingAs($this->admin)
            ->get(MedicalDirectorResource::getUrl('view', ['record' => $director->id]))
            ->assertSuccessful()
            ->assertSee('Dr. Test')
            ->assertSee('test@example.com')
            ->assertSee('MI123456');
    }

    /** @test */
    public function it_handles_soft_deleted_medical_directors_correctly(): void
    {
        $director = MedicalDirector::factory()->create();
        $director->delete();

        Livewire::actingAs($this->admin)
            ->test(ListMedicalDirectors::class)
            ->assertCanNotSeeTableRecord($director);

        $this->actingAs($this->admin)
            ->patch(MedicalDirectorResource::getUrl('restore', ['record' => $director->id]))
            ->assertSuccessful();

        $this->assertDatabaseHas('medical_directors', [
            'id' => $director->id,
            'deleted_at' => null,
        ]);
    }

    /** @test */
    public function it_can_duplicate_medical_director(): void
    {
        $director = MedicalDirector::factory()->create([
            'name' => 'Original Director',
        ]);

        Livewire::actingAs($this->admin)
            ->test(ListMedicalDirectors::class)
            ->callTableAction('duplicate', $director)
            ->assertHasNoTableActionErrors();

        $this->assertDatabaseHas('medical_directors', [
            'name' => 'Original Director (Copy)',
        ]);
    }

    /** @test */
    public function it_validates_license_number_on_edit_except_self(): void
    {
        $dir1 = MedicalDirector::factory()->create(['license_number' => 'MI111111']);
        $dir2 = MedicalDirector::factory()->create(['license_number' => 'MI222222']);

        Livewire::actingAs($this->admin)
            ->test(EditMedicalDirector::class, ['record' => $dir1->id])
            ->fillForm(['license_number' => 'MI222222'])
            ->call('save')
            ->assertHasFormErrors(['license_number']);

        Livewire::actingAs($this->admin)
            ->test(EditMedicalDirector::class, ['record' => $dir1->id])
            ->fillForm(['license_number' => 'MI111111'])
            ->call('save')
            ->assertHasNoFormErrors();
    }

    /** @test */
    public function it_can_handle_specializations_json_field(): void
    {
        $specializations = [
            'cardiology',
            'internal_medicine',
            'surgery',
            'pediatrics',
            'neurology',
        ];

        Livewire::actingAs($this->admin)
            ->test(CreateMedicalDirector::class)
            ->fillForm([
                'name' => 'Test Name',
                'surname' => 'Test Surname',
                'email' => 'test@example.com',
                'license_number' => 'MI123456',
                'specializations' => json_encode($specializations),
            ])
            ->call('create')
            ->assertHasNoFormErrors()
            ->assertRedirect();

        $this->assertDatabaseHas('medical_directors', [
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
            ->test(CreateMedicalDirector::class)
            ->fillForm([
                'name' => 'Test Name',
                'surname' => 'Test Surname',
                'email' => 'test@example.com',
                'license_number' => 'MI123456',
                'languages' => json_encode($languages),
            ])
            ->call('create')
            ->assertHasNoFormErrors()
            ->assertRedirect();

        $this->assertDatabaseHas('medical_directors', [
            'name' => 'Test Name',
            'languages' => json_encode($languages),
        ]);
    }

    /** @test */
    public function it_can_handle_working_hours_json_field(): void
    {
        $workingHours = [
            'monday' => ['08:00', '18:00'],
            'tuesday' => ['08:00', '18:00'],
            'wednesday' => ['08:00', '18:00'],
            'thursday' => ['08:00', '18:00'],
            'friday' => ['08:00', '17:00'],
            'saturday' => ['08:00', '12:00'],
            'sunday' => ['emergency_only'],
        ];

        Livewire::actingAs($this->admin)
            ->test(CreateMedicalDirector::class)
            ->fillForm([
                'name' => 'Test Name',
                'surname' => 'Test Surname',
                'email' => 'test@example.com',
                'license_number' => 'MI123456',
                'working_hours' => json_encode($workingHours),
            ])
            ->call('create')
            ->assertHasNoFormErrors()
            ->assertRedirect();

        $this->assertDatabaseHas('medical_directors', [
            'name' => 'Test Name',
            'working_hours' => json_encode($workingHours),
        ]);
    }

    /** @test */
    public function it_can_handle_metadata_field(): void
    {
        $metadata = [
            'years_of_experience' => 20,
            'patients_handled' => 10000,
            'success_rate' => 0.98,
            'awards' => ['Best Doctor 2023', 'Excellence in Medicine'],
            'publications' => ['Medical Journal Article 2022', 'Research Paper 2021'],
            'certifications' => ['Board Certified', 'Fellowship in Cardiology'],
        ];

        Livewire::actingAs($this->admin)
            ->test(CreateMedicalDirector::class)
            ->fillForm([
                'name' => 'Test Name',
                'surname' => 'Test Surname',
                'email' => 'test@example.com',
                'license_number' => 'MI123456',
                'metadata' => json_encode($metadata),
            ])
            ->call('create')
            ->assertHasNoFormErrors()
            ->assertRedirect();

        $this->assertDatabaseHas('medical_directors', [
            'name' => 'Test Name',
            'metadata' => json_encode($metadata),
        ]);
    }

    /** @test */
    public function it_can_handle_emergency_contact(): void
    {
        $emergencyContact = [
            'emergency_phone' => '+39 333 9999999',
            'emergency_email' => 'emergency@hospital.it',
            'on_call_schedule' => '24/7',
            'backup_contact' => 'Dr. Anna Bianchi',
            'backup_phone' => '+39 333 8888888',
        ];

        Livewire::actingAs($this->admin)
            ->test(CreateMedicalDirector::class)
            ->fillForm([
                'name' => 'Test Name',
                'surname' => 'Test Surname',
                'email' => 'test@example.com',
                'license_number' => 'MI123456',
                'emergency_contact' => json_encode($emergencyContact),
            ])
            ->call('create')
            ->assertHasNoFormErrors()
            ->assertRedirect();

        $this->assertDatabaseHas('medical_directors', [
            'name' => 'Test Name',
            'emergency_contact' => json_encode($emergencyContact),
        ]);
    }
}
