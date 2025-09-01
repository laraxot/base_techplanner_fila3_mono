<?php

declare(strict_types=1);

namespace Modules\Notify\Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Modules\Notify\Models\Contact;
use Modules\Notify\Models\ContactGroup;
use Tests\TestCase;

class ContactManagementBusinessLogicTest extends TestCase
{


    /** @test */
    public function it_can_create_contact_with_basic_information(): void
    {
        // Arrange
        $contactData = [
            'name' => 'Mario Rossi',
            'email' => 'mario.rossi@example.com',
            'phone' => '+39 123 456 7890',
            'company' => 'Studio Dentistico Milano',
            'is_active' => true,
        ];

        // Act
        $contact = Contact::create($contactData);

        // Assert
        $this->assertDatabaseHas('contacts', [
            'id' => $contact->id,
            'name' => 'Mario Rossi',
            'email' => 'mario.rossi@example.com',
            'phone' => '+39 123 456 7890',
            'company' => 'Studio Dentistico Milano',
            'is_active' => true,
        ]);

        expect('Mario Rossi', $contact->name);
        expect('mario.rossi@example.com', $contact->email);
        expect($contact->is_active);
    }

    /** @test */
    public function it_can_create_contact_group(): void
    {
        // Arrange
        $groupData = [
            'name' => 'Dottori Specialisti',
            'description' => 'Gruppo per dottori specialisti',
            'is_active' => true,
        ];

        // Act
        $group = ContactGroup::create($groupData);

        // Assert
        $this->assertDatabaseHas('contact_groups', [
            'id' => $group->id,
            'name' => 'Dottori Specialisti',
            'description' => 'Gruppo per dottori specialisti',
            'is_active' => true,
        ]);

        expect('Dottori Specialisti', $group->name);
        expect('Gruppo per dottori specialisti', $group->description);
        expect($group->is_active);
    }

    /** @test */
    public function it_can_manage_contact_notification_preferences(): void
    {
        // Arrange
        $contact = Contact::factory()->create();
        $preferences = [
            'email' => true,
            'sms' => false,
            'push' => true,
            'frequency' => 'daily',
            'quiet_hours' => [
                'start' => '22:00',
                'end' => '08:00',
            ],
            'timezone' => 'Europe/Rome',
        ];

        // Act
        $contact->update(['preferences' => $preferences]);

        // Assert
        $this->assertDatabaseHas('contacts', [
            'id' => $contact->id,
            'preferences' => json_encode($preferences),
        ]);

        expect($contact->fresh()->preferences['email']);
        expect($contact->fresh()->preferences['sms']);
        expect($contact->fresh()->preferences['push']);
        expect('daily', $contact->fresh()->preferences['frequency']);
        expect('22:00', $contact->fresh()->preferences['quiet_hours']['start']);
        expect('08:00', $contact->fresh()->preferences['quiet_hours']['end']);
        expect('Europe/Rome', $contact->fresh()->preferences['timezone']);
    }

    /** @test */
    public function it_can_manage_contact_demographics(): void
    {
        // Arrange
        $contact = Contact::factory()->create();
        $demographics = [
            'age' => 35,
            'gender' => 'M',
            'location' => 'Milano, Italia',
            'language' => 'it',
            'interests' => ['dentistry', 'healthcare', 'technology'],
            'profession' => 'Dentist',
            'experience_years' => 8,
        ];

        // Act
        $contact->update(['demographics' => $demographics]);

        // Assert
        $this->assertDatabaseHas('contacts', [
            'id' => $contact->id,
            'demographics' => json_encode($demographics),
        ]);

        expect(35, $contact->fresh()->demographics['age']);
        expect('M', $contact->fresh()->demographics['gender']);
        expect('Milano, Italia', $contact->fresh()->demographics['location']);
        expect('it', $contact->fresh()->demographics['language']);
        $this->assertContains('dentistry', $contact->fresh()->demographics['interests']);
        expect('Dentist', $contact->fresh()->demographics['profession']);
        expect(8, $contact->fresh()->demographics['experience_years']);
    }

    /** @test */
    public function it_can_manage_contact_communication_history(): void
    {
        // Arrange
        $contact = Contact::factory()->create();
        $communicationHistory = [
            [
                'type' => 'email',
                'subject' => 'Benvenuto su '.config('app.name', 'Our Platform'),
                'sent_at' => now()->subDays(5)->toISOString(),
                'status' => 'delivered',
                'opened' => true,
                'clicked' => false,
            ],
            [
                'type' => 'sms',
                'message' => 'Promemoria appuntamento domani',
                'sent_at' => now()->subDays(2)->toISOString(),
                'status' => 'delivered',
                'opened' => true,
                'clicked' => true,
            ],
        ];

        // Act
        $contact->update(['communication_history' => $communicationHistory]);

        // Assert
        $this->assertDatabaseHas('contacts', [
            'id' => $contact->id,
            'communication_history' => json_encode($communicationHistory),
        ]);

        expect(2, $contact->fresh()->communication_history);
        expect('email', $contact->fresh()->communication_history[0]['type']);
        expect('Benvenuto su '.config('app.name', 'Our Platform'), $contact->fresh()->communication_history[0]['subject']);
        expect('sms', $contact->fresh()->communication_history[1]['type']);
        expect($contact->fresh()->communication_history[1]['clicked']);
    }

    /** @test */
    public function it_can_manage_contact_tags(): void
    {
        // Arrange
        $contact = Contact::factory()->create();
        $tags = [
            'vip' => 'Cliente VIP',
            'new' => 'Nuovo cliente',
            'premium' => 'Piano premium',
            'active' => 'Cliente attivo',
        ];

        // Act
        $contact->update(['tags' => $tags]);

        // Assert
        $this->assertDatabaseHas('contacts', [
            'id' => $contact->id,
            'tags' => json_encode($tags),
        ]);

        expect(4, $contact->fresh()->tags);
        expect('Cliente VIP', $contact->fresh()->tags['vip']);
        expect('Nuovo cliente', $contact->fresh()->tags['new']);
        expect('Piano premium', $contact->fresh()->tags['premium']);
        expect('Cliente attivo', $contact->fresh()->tags['active']);
    }

    /** @test */
    public function it_can_manage_contact_custom_fields(): void
    {
        // Arrange
        $contact = Contact::factory()->create();
        $customFields = [
            'specialization' => 'Ortodonzia',
            'university' => 'Università di Milano',
            'certifications' => ['Invisalign', 'Lingual'],
            'preferred_contact_time' => 'mattina',
            'emergency_contact' => '+39 987 654 3210',
            'notes' => 'Cliente molto soddisfatto del servizio',
        ];

        // Act
        $contact->update(['custom_fields' => $customFields]);

        // Assert
        $this->assertDatabaseHas('contacts', [
            'id' => $contact->id,
            'custom_fields' => json_encode($customFields),
        ]);

        expect('Ortodonzia', $contact->fresh()->custom_fields['specialization']);
        expect('Università di Milano', $contact->fresh()->custom_fields['university']);
        $this->assertContains('Invisalign', $contact->fresh()->custom_fields['certifications']);
        expect('mattina', $contact->fresh()->custom_fields['preferred_contact_time']);
        expect('+39 987 654 3210', $contact->fresh()->custom_fields['emergency_contact']);
    }

    /** @test */
    public function it_can_manage_contact_subscription_status(): void
    {
        // Arrange
        $contact = Contact::factory()->create();
        $subscriptionData = [
            'subscribed' => true,
            'subscription_date' => now()->subMonths(3),
            'unsubscribe_date' => null,
            'unsubscribe_reason' => null,
            'subscription_source' => 'website_form',
            'double_optin' => true,
            'last_activity' => now()->subDays(1),
        ];

        // Act
        $contact->update($subscriptionData);

        // Assert
        $this->assertDatabaseHas('contacts', [
            'id' => $contact->id,
            'subscribed' => true,
            'subscription_source' => 'website_form',
            'double_optin' => true,
        ]);

        expect($contact->fresh()->subscribed);
        expect('website_form', $contact->fresh()->subscription_source);
        expect($contact->fresh()->double_optin);
        expect($contact->fresh()->subscription_date);
        expect($contact->fresh()->unsubscribe_date);

        // Act - Unsubscribe
        $contact->update([
            'subscribed' => false,
            'unsubscribe_date' => now(),
            'unsubscribe_reason' => 'Troppe email',
        ]);

        // Assert
        expect($contact->fresh()->subscribed);
        expect($contact->fresh()->unsubscribe_date);
        expect('Troppe email', $contact->fresh()->unsubscribe_reason);
    }

    /** @test */
    public function it_can_manage_contact_engagement_score(): void
    {
        // Arrange
        $contact = Contact::factory()->create();
        $engagementData = [
            'engagement_score' => 85,
            'last_interaction' => now()->subDays(2),
            'interaction_count' => 15,
            'response_rate' => 78.5,
            'preferred_channel' => 'email',
            'engagement_level' => 'high',
            'lifetime_value' => 2500.00,
        ];

        // Act
        $contact->update($engagementData);

        // Assert
        $this->assertDatabaseHas('contacts', [
            'id' => $contact->id,
            'engagement_score' => 85,
            'interaction_count' => 15,
            'response_rate' => 78.5,
            'preferred_channel' => 'email',
            'engagement_level' => 'high',
            'lifetime_value' => 2500.00,
        ]);

        expect(85, $contact->fresh()->engagement_score);
        expect(15, $contact->fresh()->interaction_count);
        expect(78.5, $contact->fresh()->response_rate);
        expect('email', $contact->fresh()->preferred_channel);
        expect('high', $contact->fresh()->engagement_level);
        expect(2500.00, $contact->fresh()->lifetime_value);
    }

    /** @test */
    public function it_can_manage_contact_privacy_settings(): void
    {
        // Arrange
        $contact = Contact::factory()->create();
        $privacySettings = [
            'gdpr_consent' => true,
            'consent_date' => now()->subMonths(6),
            'data_processing_consent' => true,
            'marketing_consent' => true,
            'third_party_sharing' => false,
            'data_retention_preference' => '5_years',
            'right_to_be_forgotten' => false,
            'data_portability' => true,
        ];

        // Act
        $contact->update(['privacy_settings' => $privacySettings]);

        // Assert
        $this->assertDatabaseHas('contacts', [
            'id' => $contact->id,
            'privacy_settings' => json_encode($privacySettings),
        ]);

        expect($contact->fresh()->privacy_settings['gdpr_consent']);
        expect($contact->fresh()->privacy_settings['data_processing_consent']);
        expect($contact->fresh()->privacy_settings['marketing_consent']);
        expect($contact->fresh()->privacy_settings['third_party_sharing']);
        expect('5_years', $contact->fresh()->privacy_settings['data_retention_preference']);
        expect($contact->fresh()->privacy_settings['data_portability']);
    }

    /** @test */
    public function it_can_search_contacts_by_preferences(): void
    {
        // Arrange
        $emailContact = Contact::factory()->create([
            'preferences' => ['email' => true, 'sms' => false],
        ]);
        $smsContact = Contact::factory()->create([
            'preferences' => ['email' => false, 'sms' => true],
        ]);
        $bothContact = Contact::factory()->create([
            'preferences' => ['email' => true, 'sms' => true],
        ]);

        // Act
        $emailOnlyContacts = Contact::whereJsonContains('preferences->email', true)
            ->whereJsonContains('preferences->sms', false)
            ->get();

        $smsOnlyContacts = Contact::whereJsonContains('preferences->sms', true)
            ->whereJsonContains('preferences->email', false)
            ->get();

        // Assert
        expect(1, $emailOnlyContacts);
        expect(1, $smsOnlyContacts);
        expect($emailOnlyContacts->contains($emailContact));
        expect($smsOnlyContacts->contains($smsContact));
    }

    /** @test */
    public function it_can_search_contacts_by_tags(): void
    {
        // Arrange
        $vipContact = Contact::factory()->create([
            'tags' => ['vip' => 'Cliente VIP', 'premium' => 'Piano premium'],
        ]);
        $newContact = Contact::factory()->create([
            'tags' => ['new' => 'Nuovo cliente', 'active' => 'Cliente attivo'],
        ]);

        // Act
        $vipContacts = Contact::whereJsonContains('tags->vip', 'Cliente VIP')->get();
        $newContacts = Contact::whereJsonContains('tags->new', 'Nuovo cliente')->get();

        // Assert
        expect(1, $vipContacts);
        expect(1, $newContacts);
        expect($vipContacts->contains($vipContact));
        expect($newContacts->contains($newContact));
    }

    /** @test */
    public function it_can_search_contacts_by_engagement_level(): void
    {
        // Arrange
        $highEngagementContact = Contact::factory()->create(['engagement_level' => 'high']);
        $mediumEngagementContact = Contact::factory()->create(['engagement_level' => 'medium']);
        $lowEngagementContact = Contact::factory()->create(['engagement_level' => 'low']);

        // Act
        $highEngagementContacts = Contact::where('engagement_level', 'high')->get();
        $mediumEngagementContacts = Contact::where('engagement_level', 'medium')->get();

        // Assert
        expect(1, $highEngagementContacts);
        expect(1, $mediumEngagementContacts);
        expect($highEngagementContacts->contains($highEngagementContact));
        expect($mediumEngagementContacts->contains($mediumEngagementContact));
    }

    /** @test */
    public function it_can_get_contacts_with_related_data(): void
    {
        // Arrange
        $contact = Contact::factory()->create();
        $group = ContactGroup::factory()->create();

        $contact->update(['group_id' => $group->id]);

        // Act
        $contactWithGroup = Contact::with('group')->find($contact->id);

        // Assert
        expect($contactWithGroup);
        expect($contactWithGroup->relationLoaded('group'));
        expect($group->id, $contactWithGroup->group->id);
    }

    /** @test */
    public function it_can_manage_contact_import_export(): void
    {
        // Arrange
        $contact = Contact::factory()->create();
        $importData = [
            'import_source' => 'csv_upload',
            'import_date' => now()->subDays(10),
            'import_batch_id' => 'batch_001',
            'import_notes' => 'Importazione da sistema legacy',
            'export_history' => [
                [
                    'export_date' => now()->subDays(5)->toISOString(),
                    'export_format' => 'csv',
                    'export_reason' => 'Backup mensile',
                    'exported_by' => 'admin_user',
                ],
            ],
        ];

        // Act
        $contact->update($importData);

        // Assert
        $this->assertDatabaseHas('contacts', [
            'id' => $contact->id,
            'import_source' => 'csv_upload',
            'import_batch_id' => 'batch_001',
        ]);

        expect('csv_upload', $contact->fresh()->import_source);
        expect('batch_001', $contact->fresh()->import_batch_id);
        expect('Importazione da sistema legacy', $contact->fresh()->import_notes);
        expect(1, $contact->fresh()->export_history);
        expect('csv', $contact->fresh()->export_history[0]['export_format']);
    }

    /** @test */
    public function it_can_manage_contact_activity_tracking(): void
    {
        // Arrange
        $contact = Contact::factory()->create();
        $activityData = [
            'last_activity' => now()->subHours(2),
            'activity_count' => 25,
            'activity_types' => ['email_open', 'link_click', 'form_submit'],
            'favorite_pages' => ['/dashboard', '/appointments', '/profile'],
            'session_duration' => 1800, // 30 minutes
            'bounce_rate' => 15.5,
            'conversion_rate' => 8.2,
        ];

        // Act
        $contact->update($activityData);

        // Assert
        $this->assertDatabaseHas('contacts', [
            'id' => $contact->id,
            'activity_count' => 25,
            'session_duration' => 1800,
            'bounce_rate' => 15.5,
            'conversion_rate' => 8.2,
        ]);

        expect(25, $contact->fresh()->activity_count);
        expect(3, $contact->fresh()->activity_types);
        $this->assertContains('email_open', $contact->fresh()->activity_types);
        $this->assertContains('/dashboard', $contact->fresh()->favorite_pages);
        expect(1800, $contact->fresh()->session_duration);
        expect(15.5, $contact->fresh()->bounce_rate);
        expect(8.2, $contact->fresh()->conversion_rate);
    }
}
