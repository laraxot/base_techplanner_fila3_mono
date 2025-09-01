<?php

declare(strict_types=1);

namespace Modules\Notify\Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Modules\Notify\Models\NotificationTemplate;
use Modules\Notify\Models\NotificationTemplateVersion;
use Tests\TestCase;

class NotificationTemplateVersionBusinessLogicTest extends TestCase
{


    /** @test */
    public function it_can_create_template_version_with_basic_information(): void
    {
        $template = NotificationTemplate::factory()->create();

        $versionData = [
            'template_id' => $template->id,
            'subject' => 'Versione 2.0 - Conferma Appuntamento',
            'body_html' => '<h1>Conferma Appuntamento</h1><p>Gentile {{patient_name}}, il suo appuntamento è confermato.</p>',
            'body_text' => 'Conferma Appuntamento\n\nGentile {{patient_name}}, il suo appuntamento è confermato.',
            'channels' => ['email', 'sms'],
            'variables' => ['patient_name', 'appointment_date', 'doctor_name'],
            'conditions' => ['is_confirmed' => true],
            'version' => '2.0',
            'change_notes' => 'Aggiornamento design e aggiunta variabile doctor_name',
        ];

        $version = NotificationTemplateVersion::create($versionData);

        $this->assertDatabaseHas('notification_template_versions', [
            'id' => $version->id,
            'template_id' => $template->id,
            'subject' => 'Versione 2.0 - Conferma Appuntamento',
            'version' => '2.0',
            'change_notes' => 'Aggiornamento design e aggiunta variabile doctor_name',
        ]);

        expect('2.0', $version->version);
        expect(['email', 'sms'], $version->channels);
        expect(['patient_name', 'appointment_date', 'doctor_name'], $version->variables);
        expect(['is_confirmed' => true], $version->conditions);
    }

    /** @test */
    public function it_can_manage_template_version_relationships(): void
    {
        $template = NotificationTemplate::factory()->create();
        $version = NotificationTemplateVersion::factory()->create([
            'template_id' => $template->id,
        ]);

        expect(NotificationTemplate::class, $version->template);
        expect($template->id, $version->template->id);
    }

    /** @test */
    public function it_can_restore_template_from_version(): void
    {
        $template = NotificationTemplate::factory()->create([
            'subject' => 'Versione Originale',
            'body_html' => '<p>Contenuto originale</p>',
        ]);

        $version = NotificationTemplateVersion::factory()->create([
            'template_id' => $template->id,
            'subject' => 'Versione Precedente',
            'body_html' => '<p>Contenuto versione precedente</p>',
            'body_text' => 'Contenuto versione precedente',
            'channels' => ['email'],
            'variables' => ['patient_name'],
            'conditions' => ['is_active' => true],
        ]);

        // Aggiorna il template corrente
        $template->update([
            'subject' => 'Versione Corrente',
            'body_html' => '<p>Contenuto corrente</p>',
        ]);

        // Restaura dalla versione
        $restoredTemplate = $version->restore();

        expect('Versione Precedente', $restoredTemplate->subject);
        expect('<p>Contenuto versione precedente</p>', $restoredTemplate->body_html);
        expect('Contenuto versione precedente', $restoredTemplate->body_text);
        expect(['email'], $restoredTemplate->channels);
        expect(['patient_name'], $restoredTemplate->variables);
        expect(['is_active' => true], $restoredTemplate->conditions);
    }

    /** @test */
    public function it_throws_exception_when_restoring_without_template(): void
    {
        $version = NotificationTemplateVersion::factory()->create([
            'template_id' => 99999, // Template inesistente
        ]);

        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Template not found for version '.$version->id);

        $version->restore();
    }

    /** @test */
    public function it_can_manage_version_metadata(): void
    {
        $template = NotificationTemplate::factory()->create();

        $version = NotificationTemplateVersion::factory()->create([
            'template_id' => $template->id,
            'version' => '1.5',
            'change_notes' => 'Correzione bug nella formattazione email',
        ]);

        expect('1.5', $version->version);
        expect('Correzione bug nella formattazione email', $version->change_notes);
    }

    /** @test */
    public function it_can_handle_complex_channel_configurations(): void
    {
        $template = NotificationTemplate::factory()->create();

        $complexChannels = [
            'email' => [
                'enabled' => true,
                'priority' => 'high',
                'template' => 'email.confirmation',
            ],
            'sms' => [
                'enabled' => true,
                'priority' => 'normal',
                'max_length' => 160,
            ],
            'push' => [
                'enabled' => false,
                'priority' => 'low',
            ],
        ];

        $version = NotificationTemplateVersion::factory()->create([
            'template_id' => $template->id,
            'channels' => $complexChannels,
        ]);

        expect($complexChannels, $version->channels);
        expect($version->channels['email']['enabled']);
        expect($version->channels['push']['enabled']);
    }

    /** @test */
    public function it_can_manage_conditional_logic(): void
    {
        $template = NotificationTemplate::factory()->create();

        $conditions = [
            'user_type' => ['patient', 'doctor'],
            'appointment_status' => 'confirmed',
            'notification_preference' => 'all',
            'time_zone' => 'Europe/Rome',
            'language' => ['it', 'en'],
        ];

        $version = NotificationTemplateVersion::factory()->create([
            'template_id' => $template->id,
            'conditions' => $conditions,
        ]);

        expect($conditions, $version->conditions);
        $this->assertContains('patient', $version->conditions['user_type']);
        expect('confirmed', $version->conditions['appointment_status']);
    }

    /** @test */
    public function it_can_handle_template_variables_validation(): void
    {
        $template = NotificationTemplate::factory()->create();

        $variables = [
            'required' => ['patient_name', 'appointment_date', 'doctor_name'],
            'optional' => ['clinic_address', 'phone_number'],
            'conditional' => ['emergency_contact', 'insurance_info'],
            'formatting' => [
                'date_format' => 'd/m/Y H:i',
                'currency' => 'EUR',
                'timezone' => 'Europe/Rome',
            ],
        ];

        $version = NotificationTemplateVersion::factory()->create([
            'template_id' => $template->id,
            'variables' => $variables,
        ]);

        expect($variables, $version->variables);
        $this->assertContains('patient_name', $version->variables['required']);
        expect('d/m/Y H:i', $version->variables['formatting']['date_format']);
    }

    /** @test */
    public function it_can_manage_version_history(): void
    {
        $template = NotificationTemplate::factory()->create();

        // Crea multiple versioni
        $version1 = NotificationTemplateVersion::factory()->create([
            'template_id' => $template->id,
            'version' => '1.0',
            'change_notes' => 'Versione iniziale',
        ]);

        $version2 = NotificationTemplateVersion::factory()->create([
            'template_id' => $template->id,
            'version' => '1.1',
            'change_notes' => 'Aggiunta variabile clinic_address',
        ]);

        $version3 = NotificationTemplateVersion::factory()->create([
            'template_id' => $template->id,
            'version' => '2.0',
            'change_notes' => 'Rifattorizzazione completa del template',
        ]);

        expect(3, $template->versions);
        expect('1.0', $version1->version);
        expect('1.1', $version2->version);
        expect('2.0', $version3->version);
    }

    /** @test */
    public function it_can_handle_version_rollback_scenarios(): void
    {
        $template = NotificationTemplate::factory()->create([
            'subject' => 'Versione Corrente',
            'body_html' => '<p>Contenuto corrente</p>',
        ]);

        $stableVersion = NotificationTemplateVersion::factory()->create([
            'template_id' => $template->id,
            'version' => '1.0',
            'subject' => 'Versione Stabile',
            'body_html' => '<p>Contenuto stabile</p>',
            'body_text' => 'Contenuto stabile',
            'channels' => ['email'],
            'variables' => ['patient_name'],
            'conditions' => ['is_active' => true],
        ]);

        // Simula un aggiornamento problematico
        $template->update([
            'subject' => 'Versione Problematica',
            'body_html' => '<p>Contenuto con bug</p>',
        ]);

        // Rollback alla versione stabile
        $restoredTemplate = $stableVersion->restore();

        expect('Versione Stabile', $restoredTemplate->subject);
        expect('<p>Contenuto stabile</p>', $restoredTemplate->body_html);
        expect('Contenuto stabile', $restoredTemplate->body_text);
        expect(['email'], $restoredTemplate->channels);
        expect(['patient_name'], $restoredTemplate->variables);
        expect(['is_active' => true], $restoredTemplate->conditions);
    }

    /** @test */
    public function it_can_manage_version_metadata_and_tracking(): void
    {
        $template = NotificationTemplate::factory()->create();

        $version = NotificationTemplateVersion::factory()->create([
            'template_id' => $template->id,
            'version' => '1.2.3',
            'change_notes' => 'Hotfix per problema di formattazione SMS',
        ]);

        // Verifica che i metadati siano preservati
        expect('1.2.3', $version->version);
        expect('Hotfix per problema di formattazione SMS', $version->change_notes);
        expect($version->created_at);
        expect($version->updated_at);
    }

    /** @test */
    public function it_can_handle_empty_or_null_values_gracefully(): void
    {
        $template = NotificationTemplate::factory()->create();

        $version = NotificationTemplateVersion::factory()->create([
            'template_id' => $template->id,
            'subject' => null,
            'body_html' => null,
            'body_text' => null,
            'channels' => null,
            'variables' => null,
            'conditions' => null,
            'change_notes' => null,
        ]);

        expect($version->subject);
        expect($version->body_html);
        expect($version->body_text);
        expect($version->channels);
        expect($version->variables);
        expect($version->conditions);
        expect($version->change_notes);
    }
}
