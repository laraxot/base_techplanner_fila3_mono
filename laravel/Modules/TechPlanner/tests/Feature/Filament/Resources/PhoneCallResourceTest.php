<?php

declare(strict_types=1);

namespace Modules\TechPlanner\Tests\Feature\Filament\Resources;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Modules\TechPlanner\Filament\Resources\PhoneCallResource;
use Modules\TechPlanner\Filament\Resources\PhoneCallResource\Pages\CreatePhoneCall;
use Modules\TechPlanner\Filament\Resources\PhoneCallResource\Pages\EditPhoneCall;
use Modules\TechPlanner\Filament\Resources\PhoneCallResource\Pages\ListPhoneCalls;
use Modules\TechPlanner\Models\PhoneCall;
use Modules\TechPlanner\Models\Client;
use Modules\User\Models\User;
use Tests\TestCase;

class PhoneCallResourceTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected User $admin;
    protected Client $client;

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->admin = User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
        ]);

        $this->client = Client::factory()->create();
    }

    /** @test */
    public function it_can_list_phone_calls(): void
    {
        PhoneCall::factory()->count(3)->create();

        $this->actingAs($this->admin)
            ->get(PhoneCallResource::getUrl())
            ->assertSuccessful()
            ->assertSeeLivewire(ListPhoneCalls::class);
    }

    /** @test */
    public function it_can_create_phone_call(): void
    {
        $phoneCallData = [
            'client_id' => $this->client->id,
            'phone_number' => '+39 123 456 7890',
            'call_type' => 'incoming',
            'status' => 'completed',
            'duration' => 300, // 5 minuti
            'notes' => 'Chiamata di test',
        ];

        Livewire::actingAs($this->admin)
            ->test(CreatePhoneCall::class)
            ->fillForm($phoneCallData)
            ->call('create')
            ->assertHasNoFormErrors()
            ->assertRedirect();

        $this->assertDatabaseHas('phone_calls', [
            'client_id' => $this->client->id,
            'phone_number' => '+39 123 456 7890',
            'call_type' => 'incoming',
        ]);
    }

    /** @test */
    public function it_can_edit_phone_call(): void
    {
        $phoneCall = PhoneCall::factory()->create([
            'status' => 'missed',
        ]);

        $updatedData = [
            'status' => 'completed',
            'notes' => 'Chiamata completata',
        ];

        Livewire::actingAs($this->admin)
            ->test(EditPhoneCall::class, ['record' => $phoneCall->id])
            ->fillForm($updatedData)
            ->call('save')
            ->assertHasNoFormErrors()
            ->assertRedirect();

        $this->assertDatabaseHas('phone_calls', [
            'id' => $phoneCall->id,
            'status' => 'completed',
            'notes' => 'Chiamata completata',
        ]);
    }

    /** @test */
    public function it_can_delete_phone_call(): void
    {
        $phoneCall = PhoneCall::factory()->create();

        Livewire::actingAs($this->admin)
            ->test(ListPhoneCalls::class)
            ->callTableAction('delete', $phoneCall)
            ->assertHasNoTableActionErrors();

        $this->assertSoftDeleted('phone_calls', ['id' => $phoneCall->id]);
    }

    /** @test */
    public function it_validates_required_fields_on_create(): void
    {
        Livewire::actingAs($this->admin)
            ->test(CreatePhoneCall::class)
            ->fillForm([
                'client_id' => '',
                'phone_number' => '',
                'call_type' => '',
            ])
            ->call('create')
            ->assertHasFormErrors(['client_id', 'phone_number', 'call_type']);
    }

    /** @test */
    public function it_validates_call_type_values(): void
    {
        Livewire::actingAs($this->admin)
            ->test(CreatePhoneCall::class)
            ->fillForm([
                'client_id' => $this->client->id,
                'phone_number' => '+39 123 456 7890',
                'call_type' => 'invalid_type',
            ])
            ->call('create')
            ->assertHasFormErrors(['call_type']);
    }

    /** @test */
    public function it_validates_call_status_values(): void
    {
        Livewire::actingAs($this->admin)
            ->test(CreatePhoneCall::class)
            ->fillForm([
                'client_id' => $this->client->id,
                'phone_number' => '+39 123 456 7890',
                'call_type' => 'incoming',
                'status' => 'invalid_status',
            ])
            ->call('create')
            ->assertHasFormErrors(['status']);
    }

    /** @test */
    public function it_can_search_phone_calls(): void
    {
        PhoneCall::factory()->create(['phone_number' => '+39 111 111 1111']);
        PhoneCall::factory()->create(['phone_number' => '+39 222 222 2222']);

        Livewire::actingAs($this->admin)
            ->test(ListPhoneCalls::class)
            ->searchTable('111')
            ->assertCanSeeTableRecords(['+39 111 111 1111'])
            ->assertCanSeeTableRecord('+39 111 111 1111')
            ->assertCanNotSeeTableRecord('+39 222 222 2222');
    }

    /** @test */
    public function it_can_filter_phone_calls_by_type(): void
    {
        PhoneCall::factory()->create(['call_type' => 'incoming']);
        PhoneCall::factory()->create(['call_type' => 'outgoing']);

        Livewire::actingAs($this->admin)
            ->test(ListPhoneCalls::class)
            ->filterTable('call_type', 'incoming')
            ->assertCanSeeTableRecords(['Incoming Call']);
    }

    /** @test */
    public function it_can_filter_phone_calls_by_status(): void
    {
        PhoneCall::factory()->create(['status' => 'completed']);
        PhoneCall::factory()->create(['status' => 'missed']);

        Livewire::actingAs($this->admin)
            ->test(ListPhoneCalls::class)
            ->filterTable('status', 'completed')
            ->assertCanSeeTableRecords(['Completed Call']);
    }

    /** @test */
    public function it_can_filter_phone_calls_by_client(): void
    {
        $client1 = Client::factory()->create(['name' => 'Client A']);
        $client2 = Client::factory()->create(['name' => 'Client B']);

        PhoneCall::factory()->create(['client_id' => $client1->id]);
        PhoneCall::factory()->create(['client_id' => $client2->id]);

        Livewire::actingAs($this->admin)
            ->test(ListPhoneCalls::class)
            ->filterTable('client_id', $client1->id)
            ->assertCanSeeTableRecords(['Client A Call']);
    }

    /** @test */
    public function it_can_bulk_delete_phone_calls(): void
    {
        $phoneCalls = PhoneCall::factory()->count(3)->create();

        Livewire::actingAs($this->admin)
            ->test(ListPhoneCalls::class)
            ->selectTableRecords($phoneCalls->pluck('id')->toArray())
            ->callTableBulkAction('delete')
            ->assertHasNoTableBulkActionErrors();

        foreach ($phoneCalls as $phoneCall) {
            $this->assertSoftDeleted('phone_calls', ['id' => $phoneCall->id]);
        }
    }

    /** @test */
    public function it_can_export_phone_calls(): void
    {
        PhoneCall::factory()->count(5)->create();

        Livewire::actingAs($this->admin)
            ->test(ListPhoneCalls::class)
            ->callTableAction('export')
            ->assertHasNoTableActionErrors();
    }

    /** @test */
    public function it_can_view_phone_call_details(): void
    {
        $phoneCall = PhoneCall::factory()->create([
            'phone_number' => '+39 123 456 7890',
            'call_type' => 'incoming',
            'status' => 'completed',
        ]);

        $this->actingAs($this->admin)
            ->get(PhoneCallResource::getUrl('view', ['record' => $phoneCall->id]))
            ->assertSuccessful()
            ->assertSee('+39 123 456 7890')
            ->assertSee('incoming')
            ->assertSee('completed');
    }

    /** @test */
    public function it_handles_soft_deleted_phone_calls_correctly(): void
    {
        $phoneCall = PhoneCall::factory()->create();
        $phoneCall->delete();

        Livewire::actingAs($this->admin)
            ->test(ListPhoneCalls::class)
            ->assertCanNotSeeTableRecord($phoneCall);

        $this->actingAs($this->admin)
            ->patch(PhoneCallResource::getUrl('restore', ['record' => $phoneCall->id]))
            ->assertSuccessful();

        $this->assertDatabaseHas('phone_calls', [
            'id' => $phoneCall->id,
            'deleted_at' => null,
        ]);
    }

    /** @test */
    public function it_can_handle_call_duration_correctly(): void
    {
        $durationData = [
            'duration' => 1800, // 30 minuti
            'duration_formatted' => '30:00',
        ];

        Livewire::actingAs($this->admin)
            ->test(CreatePhoneCall::class)
            ->fillForm(array_merge([
                'client_id' => $this->client->id,
                'phone_number' => '+39 123 456 7890',
                'call_type' => 'incoming',
            ], $durationData))
            ->call('create')
            ->assertHasNoFormErrors()
            ->assertRedirect();

        $this->assertDatabaseHas('phone_calls', [
            'duration' => 1800,
        ]);
    }

    /** @test */
    public function it_can_handle_call_metadata(): void
    {
        $metadata = [
            'call_quality' => 'excellent',
            'recording_url' => 'https://example.com/recording.mp3',
            'transcript' => 'Conversazione registrata',
            'tags' => ['follow-up', 'urgent', 'sales'],
        ];

        Livewire::actingAs($this->admin)
            ->test(CreatePhoneCall::class)
            ->fillForm([
                'client_id' => $this->client->id,
                'phone_number' => '+39 123 456 7890',
                'call_type' => 'incoming',
                'metadata' => json_encode($metadata),
            ])
            ->call('create')
            ->assertHasNoFormErrors()
            ->assertRedirect();

        $this->assertDatabaseHas('phone_calls', [
            'metadata' => json_encode($metadata),
        ]);
    }

    /** @test */
    public function it_can_handle_call_follow_up(): void
    {
        $followUpData = [
            'requires_follow_up' => true,
            'follow_up_date' => '2024-06-20',
            'follow_up_notes' => 'Richiamare per conferma appuntamento',
            'follow_up_priority' => 'high',
        ];

        Livewire::actingAs($this->admin)
            ->test(CreatePhoneCall::class)
            ->fillForm(array_merge([
                'client_id' => $this->client->id,
                'phone_number' => '+39 123 456 7890',
                'call_type' => 'incoming',
            ], $followUpData))
            ->call('create')
            ->assertHasNoFormErrors()
            ->assertRedirect();

        $this->assertDatabaseHas('phone_calls', $followUpData);
    }

    /** @test */
    public function it_can_handle_call_attachments(): void
    {
        $attachments = [
            'recording_file' => 'path/to/recording.mp3',
            'transcript_file' => 'path/to/transcript.pdf',
            'notes_file' => 'path/to/notes.pdf',
        ];

        Livewire::actingAs($this->admin)
            ->test(CreatePhoneCall::class)
            ->fillForm([
                'client_id' => $this->client->id,
                'phone_number' => '+39 123 456 7890',
                'call_type' => 'incoming',
                'attachments' => json_encode($attachments),
            ])
            ->call('create')
            ->assertHasNoFormErrors()
            ->assertRedirect();

        $this->assertDatabaseHas('phone_calls', [
            'attachments' => json_encode($attachments),
        ]);
    }
}
