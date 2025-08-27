<?php

return array (
  'navigation' => 
  array (
    'label' => 'Invio Email',
    'group' => 
    array (
      'label' => 'Sistema',
      'description' => 'Funzionalità per l\'invio di email attraverso il sistema di notifiche',
    ),
    'icon' => 'heroicon-o-envelope',
    'sort' => 49,
  ),
  'sections' => 
  array (
    'email_details' => 
    array (
      'label' => 'Dettagli Email',
      'description' => 'Informazioni principali dell\'email',
    ),
    'recipients' => 
    array (
      'label' => 'Destinatari',
      'description' => 'Configurazione destinatari e copie',
    ),
    'content' => 
    array (
      'label' => 'Contenuto',
      'description' => 'Contenuto dell\'email e template',
    ),
    'attachments' => 
    array (
      'label' => 'Allegati',
      'description' => 'File da allegare all\'email',
    ),
    'scheduling' => 
    array (
      'label' => 'Programmazione',
      'description' => 'Configurazione invio programmato',
    ),
    'advanced' => 
    array (
      'label' => 'Avanzate',
      'description' => 'Opzioni avanzate per l\'invio',
    ),
    'empty' => 
    array (
      'heading' => 'empty',
      'label' => 'empty',
    ),
  ),
  'fields' => 
  array (
    'subject' => 
    array (
      'label' => 'Oggetto',
      'placeholder' => 'Inserisci l\'oggetto dell\'email',
      'help' => 'Oggetto che apparirà nell\'intestazione dell\'email',
      'description' => 'Oggetto dell\'email da inviare',
      'tooltip' => 'L\'oggetto è la prima cosa che il destinatario vedrà',
      'helper_text' => '',
    ),
    'template_id' => 
    array (
      'label' => 'Template Email',
      'placeholder' => 'Seleziona il template email da utilizzare',
      'help' => 'Template predefinito per l\'email (opzionale)',
      'description' => 'Template email da utilizzare per il contenuto',
      'tooltip' => 'I template permettono di standardizzare il formato delle email',
      'helper_text' => '',
    ),
    'to' => 
    array (
      'label' => 'Destinatario',
      'placeholder' => 'destinatario@esempio.com',
      'help' => 'Indirizzo email del destinatario principale',
      'description' => 'Indirizzo email del destinatario principale',
      'tooltip' => 'Il destinatario principale riceverà l\'email direttamente',
      'helper_text' => '',
    ),
    'cc' => 
    array (
      'label' => 'Copia Conoscenza (CC)',
      'placeholder' => 'cc@esempio.com (opzionale)',
      'help' => 'Indirizzi email in copia conoscenza, separati da virgola',
      'description' => 'Indirizzi email in copia conoscenza',
      'tooltip' => 'I destinatari in CC vedranno tutti gli altri indirizzi',
      'helper_text' => '',
    ),
    'bcc' => 
    array (
      'label' => 'Copia Nascosta (BCC)',
      'placeholder' => 'bcc@esempio.com (opzionale)',
      'help' => 'Indirizzi email in copia nascosta, separati da virgola',
      'description' => 'Indirizzi email in copia nascosta',
      'tooltip' => 'I destinatari in BCC non vedranno gli altri indirizzi',
      'helper_text' => '',
    ),
    'from_email' => 
    array (
      'label' => 'Email Mittente',
      'placeholder' => 'mittente@dominio.com',
      'help' => 'Indirizzo email del mittente (se diverso dal default)',
      'description' => 'Indirizzo email del mittente personalizzato',
      'tooltip' => 'L\'email del mittente apparirà nell\'intestazione',
      'helper_text' => '',
    ),
    'from_name' => 
    array (
      'label' => 'Nome Mittente',
      'placeholder' => 'Nome del mittente',
      'help' => 'Nome visualizzato del mittente (se diverso dal default)',
      'description' => 'Nome visualizzato del mittente personalizzato',
      'tooltip' => 'Il nome del mittente apparirà accanto all\'email',
      'helper_text' => '',
    ),
    'content' => 
    array (
      'label' => 'Contenuto Testo',
      'placeholder' => 'Inserisci il contenuto testuale dell\'email',
      'help' => 'Contenuto testuale dell\'email (versione solo testo)',
      'description' => 'Contenuto testuale dell\'email',
      'tooltip' => 'Il contenuto testuale è la versione plain text dell\'email',
      'helper_text' => '',
    ),
    'body_html' => 
    array (
      'label' => 'Contenuto HTML',
      'placeholder' => '<h1>Titolo</h1><p>Contenuto dell\'email in formato HTML</p>',
      'help' => 'Contenuto HTML formattato dell\'email (opzionale)',
      'description' => 'Contenuto HTML formattato dell\'email',
      'tooltip' => 'Il contenuto HTML permette formattazione avanzata',
      'helper_text' => '',
    ),
    'parameters' => 
    array (
      'label' => 'Parametri Template',
      'placeholder' => '{"nome": "Mario", "cognome": "Rossi"}',
      'help' => 'Parametri in formato JSON per personalizzare il template selezionato',
      'description' => 'Parametri per personalizzare il template',
      'tooltip' => 'I parametri sostituiscono i placeholder nel template',
      'helper_text' => '',
    ),
    'attachments' => 
    array (
      'label' => 'Allegati',
      'placeholder' => 'Seleziona i file da allegare',
      'help' => 'File da allegare all\'email (opzionale, max 10MB per file)',
      'description' => 'File da allegare all\'email',
      'tooltip' => 'Gli allegati verranno inviati insieme all\'email',
      'helper_text' => '',
    ),
    'priority' => 
    array (
      'label' => 'Priorità',
      'placeholder' => 'Seleziona la priorità dell\'email',
      'help' => 'Imposta la priorità di invio dell\'email',
      'description' => 'Livello di priorità per l\'invio dell\'email',
      'tooltip' => 'La priorità influenza l\'ordine di invio delle email',
      'helper_text' => '',
      'options' => 
      array (
        'normal' => 'Normale',
        'high' => 'Alta',
        'urgent' => 'Urgente',
      ),
    ),
    'scheduled_at' => 
    array (
      'label' => 'Data e Ora Programmate',
      'placeholder' => 'Seleziona data e ora per l\'invio programmato',
      'help' => 'Programma l\'invio dell\'email per una data e ora specifiche',
      'description' => 'Data e ora per l\'invio programmato dell\'email',
      'tooltip' => 'L\'email verrà inviata automaticamente all\'orario specificato',
      'helper_text' => '',
    ),
    'category' => 
    array (
      'label' => 'Categoria',
      'placeholder' => 'Seleziona la categoria dell\'email',
      'help' => 'Categoria per organizzare e filtrare le email',
      'description' => 'Categoria dell\'email per organizzazione',
      'tooltip' => 'La categoria aiuta a organizzare e filtrare le email',
      'helper_text' => '',
      'options' => 
      array (
        'marketing' => 'Marketing',
        'transactional' => 'Transazionale',
        'notification' => 'Notifica',
        'newsletter' => 'Newsletter',
        'system' => 'Sistema',
      ),
    ),
    'tracking_enabled' => 
    array (
      'label' => 'Abilita Tracking',
      'placeholder' => 'Abilita il tracking dell\'email',
      'help' => 'Traccia apertura e click dell\'email',
      'description' => 'Abilita il tracking per monitorare l\'engagement',
      'tooltip' => 'Il tracking permette di monitorare l\'apertura e i click',
      'helper_text' => '',
    ),
  ),
  'actions' => 
  array (
    'send' => 
    array (
      'label' => 'Invia Email',
      'success' => 'Email inviata con successo al destinatario',
      'error' => 'Errore nell\'invio dell\'email. Verifica la configurazione.',
      'confirmation' => 'Sei sicuro di voler inviare questa email?',
      'tooltip' => 'Invia l\'email al destinatario specificato',
      'modal' => 
      array (
        'heading' => 'Conferma Invio Email',
        'description' => 'Stai per inviare un\'email. Questa azione non può essere annullata.',
        'confirm' => 'Invia Email',
        'cancel' => 'Annulla',
      ),
    ),
    'preview' => 
    array (
      'label' => 'Anteprima',
      'success' => 'Anteprima dell\'email generata correttamente',
      'error' => 'Errore nella generazione dell\'anteprima',
      'tooltip' => 'Visualizza l\'anteprima dell\'email prima dell\'invio',
      'modal' => 
      array (
        'heading' => 'Anteprima Email',
        'description' => 'Visualizza come apparirà l\'email al destinatario',
        'close' => 'Chiudi',
      ),
    ),
    'save_draft' => 
    array (
      'label' => 'Salva Bozza',
      'success' => 'Bozza salvata correttamente',
      'error' => 'Errore nel salvataggio della bozza',
      'tooltip' => 'Salva l\'email come bozza per inviarla successivamente',
      'modal' => 
      array (
        'heading' => 'Salva Bozza',
        'description' => 'Salva l\'email come bozza per inviarla successivamente',
        'confirm' => 'Salva Bozza',
        'cancel' => 'Annulla',
      ),
    ),
    'schedule' => 
    array (
      'label' => 'Programma Invio',
      'success' => 'Email programmata per l\'invio',
      'error' => 'Errore nella programmazione dell\'invio',
      'tooltip' => 'Programma l\'invio dell\'email per una data e ora specifiche',
      'modal' => 
      array (
        'heading' => 'Programma Invio Email',
        'description' => 'Seleziona la data e l\'ora per l\'invio programmato',
        'datetime_label' => 'Data e ora di invio',
        'timezone' => 'Fuso orario',
        'confirm' => 'Programma Invio',
        'cancel' => 'Annulla',
      ),
    ),
    'test_smtp' => 
    array (
      'label' => 'Test SMTP',
      'success' => 'Test SMTP completato con successo',
      'error' => 'Errore nel test SMTP',
      'tooltip' => 'Testa la configurazione SMTP prima dell\'invio',
      'modal' => 
      array (
        'heading' => 'Test Configurazione SMTP',
        'description' => 'Verifica la configurazione SMTP prima dell\'invio',
        'confirm' => 'Esegui Test',
        'cancel' => 'Annulla',
      ),
    ),
    'emailFormActions' => 
    array (
      'label' => 'emailFormActions',
    ),
  ),
  'messages' => 
  array (
    'success' => 'Email inviata con successo! Controlla la casella email del destinatario.',
    'error' => 'Si è verificato un errore durante l\'invio dell\'email. Verifica la configurazione SMTP.',
    'draft_saved' => 'Bozza salvata correttamente. Puoi recuperarla dalla sezione Bozze.',
    'scheduled' => 'Email programmata per l\'invio. Riceverai una notifica quando verrà inviata.',
    'preview_generated' => 'Anteprima generata correttamente. Controlla l\'aspetto dell\'email.',
    'invalid_template' => 'Template email non valido o non trovato.',
    'invalid_parameters' => 'Parametri del template non validi. Verifica il formato JSON.',
    'no_recipients' => 'Nessun destinatario specificato. Inserisci almeno un indirizzo email.',
    'smtp_error' => 'Errore di configurazione SMTP. Verifica le impostazioni del server.',
    'validation_error' => 'Si sono verificati errori di validazione. Controlla i campi evidenziati.',
    'file_too_large' => 'Il file allegato è troppo grande. Dimensione massima consentita: :max_size',
    'invalid_file_type' => 'Tipo di file non supportato. Tipi consentiti: :allowed_types',
    'attachment_error' => 'Errore durante l\'allegato del file: :filename',
    'sending_in_progress' => 'Invio email in corso...',
    'scheduled_time_passed' => 'L\'orario programmato deve essere successivo all\'orario corrente',
    'test_smtp_success' => 'Test SMTP completato con successo. La configurazione è corretta.',
    'test_smtp_failed' => 'Test SMTP fallito. Verifica la configurazione SMTP.',
  ),
  'validation' => 
  array (
    'subject_required' => 'L\'oggetto dell\'email è obbligatorio',
    'subject_max' => 'L\'oggetto non può superare i 255 caratteri',
    'to_required' => 'Il destinatario è obbligatorio',
    'to_valid' => 'Il destinatario deve essere un indirizzo email valido',
    'to_max' => 'L\'indirizzo email del destinatario è troppo lungo',
    'cc_valid' => 'Gli indirizzi in CC devono essere email valide',
    'cc_max' => 'Uno o più indirizzi in CC sono troppo lunghi',
    'bcc_valid' => 'Gli indirizzi in BCC devono essere email valide',
    'bcc_max' => 'Uno o più indirizzi in BCC sono troppo lunghi',
    'from_email_valid' => 'L\'email del mittente deve essere valida',
    'from_name_max' => 'Il nome del mittente è troppo lungo',
    'content_required' => 'Il contenuto testuale dell\'email è obbligatorio',
    'content_max' => 'Il contenuto testuale è troppo lungo (max 10000 caratteri)',
    'body_html_max' => 'Il contenuto HTML è troppo lungo (max 20000 caratteri)',
    'template_exists' => 'Il template selezionato non esiste',
    'parameters_required' => 'I parametri sono obbligatori quando si utilizza un template',
    'parameters_json' => 'I parametri devono essere in formato JSON valido',
    'parameters_max' => 'I parametri superano la lunghezza massima consentita',
    'priority_required' => 'La priorità è obbligatoria',
    'priority_valid' => 'La priorità deve essere una delle opzioni disponibili',
    'attachments_max' => 'Numero massimo di allegati consentito: :max',
    'attachments_total_size' => 'La dimensione totale degli allegati supera il limite consentito',
    'file_required' => 'Seleziona un file da allegare',
    'file_size_max' => 'Dimensione massima del file: :max_size',
    'file_type_allowed' => 'Tipo di file non consentito. Tipi supportati: :types',
    'scheduled_at_required' => 'Specifica la data e l\'ora per la programmazione',
    'scheduled_at_date' => 'La data di programmazione non è valida',
    'scheduled_at_after' => 'La data di programmazione deve essere futura',
    'category_valid' => 'La categoria deve essere una delle opzioni disponibili',
  ),
  'status' => 
  array (
    'draft' => 'Bozza',
    'scheduled' => 'Programmata',
    'sending' => 'Invio in corso',
    'sent' => 'Inviata',
    'delivered' => 'Consegnata',
    'opened' => 'Letta',
    'failed' => 'Fallita',
    'bounced' => 'Rimbalzata',
    'complained' => 'Segnalata come spam',
    'cancelled' => 'Annullata',
  ),
  'priority_labels' => 
  array (
    'normal' => 'Normale',
    'high' => 'Alta',
    'urgent' => 'Urgente',
  ),
  'email_components' => 
  array (
    'header' => 'Intestazione Email',
    'footer' => 'Piè di pagina Email',
    'greeting' => 'Saluti',
    'signature' => 'Firma',
    'unsubscribe' => 'Annulla iscrizione',
    'view_in_browser' => 'Visualizza nel browser',
  ),
  'tracking' => 
  array (
    'opened' => 'Email aperta',
    'clicked' => 'Link cliccato',
    'device' => 'Dispositivo',
    'ip_address' => 'Indirizzo IP',
    'location' => 'Posizione',
    'last_opened' => 'Ultima apertura',
    'open_count' => 'Volte aperta',
    'click_count' => 'Clic ricevuti',
  ),
  'categories' => 
  array (
    'marketing' => 'Marketing',
    'transactional' => 'Transazionale',
    'notification' => 'Notifica',
    'newsletter' => 'Newsletter',
    'system' => 'Sistema',
  ),
  'placeholders' => 
  array (
    'email_template' => 'Seleziona un template email predefinito',
    'multiple_emails' => 'email1@dominio.com, email2@dominio.com',
    'json_parameters' => '{"nome": "Mario", "cognome": "Rossi", "azienda": "Esempio SRL"}',
    'html_content' => '<h1>Titolo</h1><p>Contenuto dell\'email in formato HTML</p>',
    'text_content' => 'Contenuto testuale dell\'email in formato plain text',
  ),
);
