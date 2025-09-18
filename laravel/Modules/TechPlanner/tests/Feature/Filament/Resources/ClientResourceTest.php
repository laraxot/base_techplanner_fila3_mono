<?php

declare(strict_types=1);

namespace Modules\TechPlanner\Tests\Feature\Filament\Resources;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Modules\TechPlanner\Filament\Resources\ClientResource;
use Modules\TechPlanner\Filament\Resources\ClientResource\Pages\CreateClient;
use Modules\TechPlanner\Filament\Resources\ClientResource\Pages\EditClient;
use Modules\TechPlanner\Filament\Resources\ClientResource\Pages\ListClients;
use Modules\TechPlanner\Models\Client;
use Modules\User\Models\User;
use Tests\TestCase;

class ClientResourceTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    
    protected User $admin;

    protected function setUp(): void
    {
        parent::setUp();
        

        // Crea un utente admin per i test
        $this->admin = User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
        ]);
    }

    /** @test */
    public function it_can_list_clients(): void
    {
        // Crea alcuni clienti di test
        Client::factory()->count(3)->create();

        $this->actingAs($this->admin)
            ->get(ClientResource::getUrl())
            ->assertSuccessful()
            ->assertSeeLivewire(ListClients::class);
    }

    /** @test */
    public function it_can_create_client(): void
    {
        $clientData = [
            'name' => 'Test Client',
            'email' => 'client@example.com',
            'phone' => '+39 123 456 7890',
            'address' => 'Via Roma 123',
            'city' => 'Milano',
            'postal_code' => '20100',
            'country' => 'Italia',
            'region' => 'Lombardia',
            'fiscal_code' => 'RSSMRA80A01H501U',
            'vat_number' => 'IT12345678901',
            'notes' => 'Cliente di test',
        ];

        Livewire::actingAs($this->admin)
            ->test(CreateClient::class)
            ->fillForm($clientData)
            ->call('create')
            ->assertHasNoFormErrors()
            ->assertRedirect();

        $this->assertDatabaseHas('clients', [
            'name' => 'Test Client',
            'email' => 'client@example.com',
        ]);
    }

    /** @test */
    public function it_can_edit_client(): void
    {
        $client = Client::factory()->create([
            'name' => 'Original Name',
            'email' => 'original@example.com',
        ]);

        $updatedData = [
            'name' => 'Updated Name',
            'email' => 'updated@example.com',
        ];

        Livewire::actingAs($this->admin)
            ->test(EditClient::class, ['record' => $client->id])
            ->fillForm($updatedData)
            ->call('save')
            ->assertHasNoFormErrors()
            ->assertRedirect();

        $this->assertDatabaseHas('clients', [
            'id' => $client->id,
            'name' => 'Updated Name',
            'email' => 'updated@example.com',
        ]);
    }

    /** @test */
    public function it_can_delete_client(): void
    {
        $client = Client::factory()->create();

        Livewire::actingAs($this->admin)
            ->test(ListClients::class)
            ->callTableAction('delete', $client)
            ->assertHasNoTableActionErrors();

        $this->assertSoftDeleted('clients', ['id' => $client->id]);
    }

    /** @test */
    public function it_validates_required_fields_on_create(): void
    {
        Livewire::actingAs($this->admin)
            ->test(CreateClient::class)
            ->fillForm([
                'name' => '', // Campo richiesto vuoto
                'email' => 'invalid-email', // Email non valida
            ])
            ->call('create')
            ->assertHasFormErrors(['name', 'email']);
    }

    /** @test */
    public function it_validates_email_format(): void
    {
        Livewire::actingAs($this->admin)
            ->test(CreateClient::class)
            ->fillForm([
                'name' => 'Test Client',
                'email' => 'invalid-email-format',
            ])
            ->call('create')
            ->assertHasFormErrors(['email']);
    }

    /** @test */
    public function it_validates_fiscal_code_format(): void
    {
        Livewire::actingAs($this->admin)
            ->test(CreateClient::class)
            ->fillForm([
                'name' => 'Test Client',
                'email' => 'client@example.com',
                'fiscal_code' => 'INVALID-FISCAL-CODE',
            ])
            ->call('create')
            ->assertHasFormErrors(['fiscal_code']);
    }

    /** @test */
    public function it_validates_vat_number_format(): void
    {
        Livewire::actingAs($this->admin)
            ->test(CreateClient::class)
            ->fillForm([
                'name' => 'Test Client',
                'email' => 'client@example.com',
                'vat_number' => 'INVALID-VAT',
            ])
            ->call('create')
            ->assertHasFormErrors(['vat_number']);
    }

    /** @test */
    public function it_can_search_clients(): void
    {
        Client::factory()->create(['name' => 'John Doe']);
        Client::factory()->create(['name' => 'Jane Smith']);

        Livewire::actingAs($this->admin)
            ->test(ListClients::class)
            ->searchTable('John')
            ->assertCanSeeTableRecords(['John Doe'])
            ->assertCanSeeTableRecord('John Doe')
            ->assertCanNotSeeTableRecord('Jane Smith');
    }

    /** @test */
    public function it_can_filter_clients_by_status(): void
    {
        Client::factory()->create(['status' => 'active']);
        Client::factory()->create(['status' => 'inactive']);

        Livewire::actingAs($this->admin)
            ->test(ListClients::class)
            ->filterTable('status', 'active')
            ->assertCanSeeTableRecords(['Active Client']);
    }

    /** @test */
    public function it_can_bulk_delete_clients(): void
    {
        $clients = Client::factory()->count(3)->create();

        Livewire::actingAs($this->admin)
            ->test(ListClients::class)
            ->selectTableRecords($clients->pluck('id')->toArray())
            ->callTableBulkAction('delete')
            ->assertHasNoTableBulkActionErrors();

        foreach ($clients as $client) {
            $this->assertSoftDeleted('clients', ['id' => $client->id]);
        }
    }

    /** @test */
    public function it_can_export_clients(): void
    {
        Client::factory()->count(5)->create();

        Livewire::actingAs($this->admin)
            ->test(ListClients::class)
            ->callTableAction('export')
            ->assertHasNoTableActionErrors();
    }

    /** @test */
    public function it_can_view_client_details(): void
    {
        $client = Client::factory()->create([
            'name' => 'Test Client',
            'email' => 'client@example.com',
            'phone' => '+39 123 456 7890',
        ]);

        $this->actingAs($this->admin)
            ->get(ClientResource::getUrl('view', ['record' => $client->id]))
            ->assertSuccessful()
            ->assertSee('Test Client')
            ->assertSee('client@example.com')
            ->assertSee('+39 123 456 7890');
    }

    /** @test */
    public function it_handles_soft_deleted_clients_correctly(): void
    {
        $client = Client::factory()->create();
        $client->delete();

        // Verifica che il cliente soft-deleted non sia visibile nella lista
        Livewire::actingAs($this->admin)
            ->test(ListClients::class)
            ->assertCanNotSeeTableRecord($client);

        // Verifica che sia possibile ripristinare il cliente
        $this->actingAs($this->admin)
            ->patch(ClientResource::getUrl('restore', ['record' => $client->id]))
            ->assertSuccessful();

        $this->assertDatabaseHas('clients', [
            'id' => $client->id,
            'deleted_at' => null,
        ]);
    }

    /** @test */
    public function it_can_duplicate_client(): void
    {
        $client = Client::factory()->create([
            'name' => 'Original Client',
            'email' => 'original@example.com',
        ]);

        Livewire::actingAs($this->admin)
            ->test(ListClients::class)
            ->callTableAction('duplicate', $client)
            ->assertHasNoTableActionErrors();

        // Verifica che sia stato creato un duplicato
        $this->assertDatabaseHas('clients', [
            'name' => 'Original Client (Copy)',
            'email' => 'original@example.com',
        ]);
    }

    /** @test */
    public function it_validates_unique_email_on_create(): void
    {
        Client::factory()->create(['email' => 'existing@example.com']);

        Livewire::actingAs($this->admin)
            ->test(CreateClient::class)
            ->fillForm([
                'name' => 'Test Client',
                'email' => 'existing@example.com', // Email già esistente
            ])
            ->call('create')
            ->assertHasFormErrors(['email']);
    }

    /** @test */
    public function it_validates_unique_email_on_edit_except_self(): void
    {
        $client1 = Client::factory()->create(['email' => 'client1@example.com']);
        $client2 = Client::factory()->create(['email' => 'client2@example.com']);

        // Modifica client1 con email di client2 (dovrebbe fallire)
        Livewire::actingAs($this->admin)
            ->test(EditClient::class, ['record' => $client1->id])
            ->fillForm(['email' => 'client2@example.com'])
            ->call('save')
            ->assertHasFormErrors(['email']);

        // Modifica client1 con la sua stessa email (dovrebbe funzionare)
        Livewire::actingAs($this->admin)
            ->test(EditClient::class, ['record' => $client1->id])
            ->fillForm(['email' => 'client1@example.com'])
            ->call('save')
            ->assertHasNoFormErrors();
    }

    /** @test */
    public function it_can_handle_phone_number_formats(): void
    {
        $phoneNumbers = [
            '+39 123 456 7890',
            '123 456 7890',
            '+1 (555) 123-4567',
            '555-123-4567',
        ];

        foreach ($phoneNumbers as $phone) {
            Livewire::actingAs($this->admin)
                ->test(CreateClient::class)
                ->fillForm([
                    'name' => 'Test Client',
                    'email' => 'client@example.com',
                    'phone' => $phone,
                ])
                ->call('create')
                ->assertHasNoFormErrors();

            $this->assertDatabaseHas('clients', ['phone' => $phone]);
        }
    }

    /** @test */
    public function it_can_handle_address_fields_correctly(): void
    {
        $addressData = [
            'address' => 'Via Roma 123, Scala A',
            'city' => 'Milano',
            'postal_code' => '20100',
            'country' => 'Italia',
            'region' => 'Lombardia',
        ];

        Livewire::actingAs($this->admin)
            ->test(CreateClient::class)
            ->fillForm(array_merge([
                'name' => 'Test Client',
                'email' => 'client@example.com',
            ], $addressData))
            ->call('create')
            ->assertHasNoFormErrors();

        $this->assertDatabaseHas('clients', $addressData);
    }

    /** @test */
    public function it_can_handle_notes_and_metadata(): void
    {
        $metadata = [
            'notes' => 'Cliente importante per il settore healthcare',
            'metadata' => json_encode([
                'source' => 'referral',
                'priority' => 'high',
                'tags' => ['healthcare', 'enterprise'],
            ]),
        ];

        Livewire::actingAs($this->admin)
            ->test(CreateClient::class)
            ->fillForm(array_merge([
                'name' => 'Test Client',
                'email' => 'client@example.com',
            ], $metadata))
            ->call('create')
            ->assertHasNoFormErrors();

        $this->assertDatabaseHas('clients', $metadata);
    }
}
