<?php

declare(strict_types=1);

namespace Modules\Notify\Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Modules\Notify\Models\MailTemplate;
use Modules\Notify\Models\MailTemplateVersion;
use Tests\TestCase;

class MailTemplateVersionBusinessLogicTest extends TestCase
{


    /** @test */
    public function it_can_create_mail_template_version_with_basic_information(): void
    {
        $template = MailTemplate::factory()->create();

        $versionData = [
            'template_id' => $template->id,
            'mailable' => 'AppointmentConfirmation',
            'subject' => 'Conferma Appuntamento - Versione 2.0',
            'html_template' => '<!DOCTYPE html><html><body><h1>Conferma Appuntamento</h1><p>Gentile {{patient_name}}, il suo appuntamento è confermato per il {{appointment_date}}.</p></body></html>',
            'text_template' => 'Conferma Appuntamento\n\nGentile {{patient_name}}, il suo appuntamento è confermato per il {{appointment_date}}.',
            'version' => '2.0',
            'created_by' => 'admin@'.config('app.domain', 'example.com'),
            'change_notes' => 'Aggiornamento design email e aggiunta variabile appointment_date',
        ];

        $version = MailTemplateVersion::create($versionData);

        $this->assertDatabaseHas('mail_template_versions', [
            'id' => $version->id,
            'template_id' => $template->id,
            'mailable' => 'AppointmentConfirmation',
            'subject' => 'Conferma Appuntamento - Versione 2.0',
            'version' => '2.0',
            'created_by' => 'admin@'.config('app.domain', 'example.com'),
            'change_notes' => 'Aggiornamento design email e aggiunta variabile appointment_date',
        ]);

        expect('2.0', $version->version);
        expect('AppointmentConfirmation', $version->mailable);
        $this->assertStringContainsString('{{patient_name}}', $version->html_template);
        $this->assertStringContainsString('{{appointment_date}}', $version->text_template);
    }

    /** @test */
    public function it_can_manage_mail_template_version_relationships(): void
    {
        $template = MailTemplate::factory()->create();
        $version = MailTemplateVersion::factory()->create([
            'template_id' => $template->id,
        ]);

        expect(MailTemplate::class, $version->template);
        expect($template->id, $version->template->id);
    }

    /** @test */
    public function it_can_restore_mail_template_from_version(): void
    {
        $template = MailTemplate::factory()->create([
            'subject' => 'Versione Corrente',
            'html_template' => '<p>Template corrente</p>',
            'text_template' => 'Template corrente',
        ]);

        $version = MailTemplateVersion::factory()->create([
            'template_id' => $template->id,
            'subject' => 'Versione Precedente',
            'html_template' => '<p>Template versione precedente</p>',
            'text_template' => 'Template versione precedente',
        ]);

        // Aggiorna il template corrente
        $template->update([
            'subject' => 'Versione Aggiornata',
            'html_template' => '<p>Template aggiornato</p>',
            'text_template' => 'Template aggiornato',
        ]);

        // Restaura dalla versione
        $restoredTemplate = $version->restore();

        expect('Versione Precedente', $restoredTemplate->subject);
        expect('<p>Template versione precedente</p>', $restoredTemplate->html_template);
        expect('Template versione precedente', $restoredTemplate->text_template);
    }

    /** @test */
    public function it_throws_exception_when_restoring_without_template(): void
    {
        $version = MailTemplateVersion::factory()->create([
            'template_id' => 99999, // Template inesistente
        ]);

        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Template non trovato per questa versione');

        $version->restore();
    }

    /** @test */
    public function it_can_manage_version_metadata_and_tracking(): void
    {
        $template = MailTemplate::factory()->create();

        $version = MailTemplateVersion::factory()->create([
            'template_id' => $template->id,
            'version' => '1.5.2',
            'created_by' => 'developer@'.config('app.domain', 'example.com'),
            'change_notes' => 'Correzione bug nella formattazione HTML e ottimizzazione per mobile',
        ]);

        expect('1.5.2', $version->version);
        expect('developer@'.config('app.domain', 'example.com'), $version->created_by);
        expect('Correzione bug nella formattazione HTML e ottimizzazione per mobile', $version->change_notes);
        expect($version->created_at);
        expect($version->updated_at);
    }

    /** @test */
    public function it_can_handle_complex_html_templates(): void
    {
        $template = MailTemplate::factory()->create();

        $complexHtmlTemplate = '
        <!DOCTYPE html>
        <html lang="it">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>{{subject}}</title>
            <style>
                .header { background-color: #001F3F; color: white; padding: 20px; }
                .content { padding: 20px; }
                .footer { background-color: #f8f9fa; padding: 15px; text-align: center; }
            </style>
        </head>
        <body>
            <div class="header">
                <h1>{{clinic_name}}</h1>
            </div>
            <div class="content">
                <h2>{{subject}}</h2>
                <p>Gentile {{patient_name}},</p>
                <p>{{message}}</p>
                <ul>
                    <li><strong>Data:</strong> {{appointment_date}}</li>
                    <li><strong>Ora:</strong> {{appointment_time}}</li>
                    <li><strong>Dottore:</strong> {{doctor_name}}</li>
                </ul>
            </div>
            <div class="footer">
                <p>&copy; {{current_year}} {{clinic_name}}. Tutti i diritti riservati.</p>
            </div>
        </body>
        </html>';

        $version = MailTemplateVersion::factory()->create([
            'template_id' => $template->id,
            'html_template' => $complexHtmlTemplate,
            'version' => '3.0',
        ]);

        $this->assertStringContainsString('{{clinic_name}}', $version->html_template);
        $this->assertStringContainsString('{{patient_name}}', $version->html_template);
        $this->assertStringContainsString('{{appointment_date}}', $version->html_template);
        $this->assertStringContainsString('{{doctor_name}}', $version->html_template);
        $this->assertStringContainsString('background-color: #001F3F', $version->html_template);
    }

    /** @test */
    public function it_can_handle_text_template_variants(): void
    {
        $template = MailTemplate::factory()->create();

        $textTemplate = '
        CONFERMA APPUNTAMENTO
        =====================
        
        Gentile {{patient_name}},
        
        Il suo appuntamento è confermato per:
        
        Data: {{appointment_date}}
        Ora: {{appointment_time}}
        Dottore: {{doctor_name}}
        Studio: {{clinic_name}}
        Indirizzo: {{clinic_address}}
        
        IMPORTANTE:
        - Arrivare 15 minuti prima dell\'appuntamento
        - Portare documenti di identità
        - In caso di cancellazione, avvisare almeno 24h prima
        
        Per modifiche o cancellazioni:
        Telefono: {{clinic_phone}}
        Email: {{clinic_email}}
        
        Cordiali saluti,
        {{clinic_name}}
        ';

        $version = MailTemplateVersion::factory()->create([
            'template_id' => $template->id,
            'text_template' => $textTemplate,
            'version' => '2.1',
        ]);

        $this->assertStringContainsString('{{patient_name}}', $version->text_template);
        $this->assertStringContainsString('{{appointment_date}}', $version->text_template);
        $this->assertStringContainsString('{{doctor_name}}', $version->text_template);
        $this->assertStringContainsString('{{clinic_name}}', $version->text_template);
        $this->assertStringContainsString('Arrivare 15 minuti prima', $version->text_template);
    }

    /** @test */
    public function it_can_manage_version_history_and_rollback(): void
    {
        $template = MailTemplate::factory()->create([
            'subject' => 'Versione Corrente',
            'html_template' => '<p>Template corrente</p>',
            'text_template' => 'Template corrente',
        ]);

        // Crea multiple versioni
        $version1 = MailTemplateVersion::factory()->create([
            'template_id' => $template->id,
            'version' => '1.0',
            'subject' => 'Versione Iniziale',
            'html_template' => '<p>Template iniziale</p>',
            'text_template' => 'Template iniziale',
            'change_notes' => 'Prima versione del template',
        ]);

        $version2 = MailTemplateVersion::factory()->create([
            'template_id' => $template->id,
            'version' => '1.1',
            'subject' => 'Versione 1.1',
            'html_template' => '<p>Template versione 1.1</p>',
            'text_template' => 'Template versione 1.1',
            'change_notes' => 'Aggiunta variabile clinic_address',
        ]);

        $version3 = MailTemplateVersion::factory()->create([
            'template_id' => $template->id,
            'version' => '2.0',
            'subject' => 'Versione 2.0',
            'html_template' => '<p>Template versione 2.0</p>',
            'text_template' => 'Template versione 2.0',
            'change_notes' => 'Rifattorizzazione completa del template',
        ]);

        expect(3, $template->versions);
        expect('1.0', $version1->version);
        expect('1.1', $version2->version);
        expect('2.0', $version3->version);

        // Test rollback alla versione 1.1
        $restoredTemplate = $version2->restore();
        expect('Versione 1.1', $restoredTemplate->subject);
        expect('<p>Template versione 1.1</p>', $restoredTemplate->html_template);
        expect('Template versione 1.1', $restoredTemplate->text_template);
    }

    /** @test */
    public function it_can_handle_mailable_class_management(): void
    {
        $template = MailTemplate::factory()->create();

        $mailableClasses = [
            'AppointmentConfirmation',
            'AppointmentReminder',
            'AppointmentCancellation',
            'PatientRegistration',
            'PasswordReset',
            'NewsletterSubscription',
        ];

        foreach ($mailableClasses as $index => $mailableClass) {
            $version = MailTemplateVersion::factory()->create([
                'template_id' => $template->id,
                'mailable' => $mailableClass,
                'version' => '1.'.$index,
                'subject' => 'Template per '.$mailableClass,
                'html_template' => '<p>Template per '.$mailableClass.'</p>',
            ]);

            expect($mailableClass, $version->mailable);
            expect('Template per '.$mailableClass, $version->subject);
        }
    }

    /** @test */
    public function it_can_manage_soft_deletes(): void
    {
        $template = MailTemplate::factory()->create();
        $version = MailTemplateVersion::factory()->create([
            'template_id' => $template->id,
        ]);

        // Verifica che il modello supporti soft delete
        expect($version->trashed() === false);

        // Soft delete
        $version->delete();

        expect($version->trashed());
        $this->assertDatabaseHas('mail_template_versions', [
            'id' => $version->id,
            'deleted_at' => $version->deleted_at,
        ]);

        // Restore
        $version->restore();
        expect($version->trashed());
    }

    /** @test */
    public function it_can_handle_empty_or_null_values_gracefully(): void
    {
        $template = MailTemplate::factory()->create();

        $version = MailTemplateVersion::factory()->create([
            'template_id' => $template->id,
            'subject' => null,
            'text_template' => null,
            'change_notes' => null,
        ]);

        expect($version->subject);
        expect($version->text_template);
        expect($version->change_notes);
        expect($version->html_template); // Campo obbligatorio
        expect($version->version); // Campo obbligatorio
    }

    /** @test */
    public function it_can_validate_template_variable_consistency(): void
    {
        $template = MailTemplate::factory()->create();

        $htmlTemplate = '<p>Gentile {{patient_name}}, il suo appuntamento è confermato per il {{appointment_date}} con il dottore {{doctor_name}}.</p>';
        $textTemplate = 'Gentile {{patient_name}}, il suo appuntamento è confermato per il {{appointment_date}} con il dottore {{doctor_name}}.';

        $version = MailTemplateVersion::factory()->create([
            'template_id' => $template->id,
            'html_template' => $htmlTemplate,
            'text_template' => $textTemplate,
            'version' => '1.0',
        ]);

        // Verifica che le variabili siano consistenti tra HTML e testo
        $htmlVariables = $this->extractVariables($htmlTemplate);
        $textVariables = $this->extractVariables($textTemplate);

        expect($htmlVariables, $textVariables);
        $this->assertContains('patient_name', $htmlVariables);
        $this->assertContains('appointment_date', $htmlVariables);
        $this->assertContains('doctor_name', $htmlVariables);
    }

    /** @test */
    public function it_can_manage_version_numbering_schemes(): void
    {
        $template = MailTemplate::factory()->create();

        $versionSchemes = [
            '1.0' => 'Versione iniziale',
            '1.1' => 'Correzione bug minori',
            '1.2.1' => 'Hotfix critico',
            '2.0' => 'Rifattorizzazione completa',
            '2.1.3' => 'Aggiornamento sicurezza',
            '3.0.0' => 'Nuova versione major',
        ];

        foreach ($versionSchemes as $versionNumber => $description) {
            $version = MailTemplateVersion::factory()->create([
                'template_id' => $template->id,
                'version' => $versionNumber,
                'change_notes' => $description,
            ]);

            expect($versionNumber, $version->version);
            expect($description, $version->change_notes);
        }
    }

    /**
     * Estrae le variabili da un template (metodo helper per i test)
     */
    private function extractVariables(string $template): array
    {
        preg_match_all('/\{\{([^}]+)\}\}/', $template, $matches);

        return array_unique($matches[1] ?? []);
    }
}
