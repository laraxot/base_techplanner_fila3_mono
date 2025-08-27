<?php

return array (
  'navigation' => 
  array (
    'label' => 'Invio Email (AWS)',
    'group' => 'Notifiche',
    'icon' => 'heroicon-o-envelope',
    'color' => 'primary',
    'sort' => 10,
  ),
  'model' => 
  array (
    'label' => 'Email AWS',
    'plural' => 'Email AWS',
    'description' => 'Gestione invio email tramite servizio Amazon SES',
  ),
  'fields' => 
  array (
    'to' => 
    array (
      'label' => 'Destinatario Email',
      'placeholder' => 'Inserisci indirizzo email destinatario',
      'help' => 'Indirizzo email del destinatario principale del messaggio',
    ),
    'subject' => 
    array (
      'label' => 'Oggetto Email',
      'placeholder' => 'Inserisci l\'oggetto del messaggio',
      'help' => 'Testo che apparirà come oggetto dell\'email ricevuta',
    ),
    'body_html' => 
    array (
      'label' => 'Corpo HTML',
      'placeholder' => 'Inserisci il contenuto HTML dell\'email',
      'help' => 'Contenuto formattato in HTML per email con layout avanzato',
    ),
    'template' => 
    array (
      'label' => 'Template Email',
      'placeholder' => 'Seleziona un template predefinito',
      'help' => 'Template predefinito da utilizzare per la formattazione dell\'email',
    ),
    'add_attachments' => 
    array (
      'label' => 'Allegati Email',
      'placeholder' => 'Carica file da allegare al messaggio',
      'help' => 'File allegati che verranno inviati insieme all\'email',
    ),
  ),
  'actions' => 
  array (
    'send_email' => 
    array (
      'label' => 'Invia Email',
      'icon' => 'heroicon-o-paper-airplane',
      'color' => 'success',
      'modal_heading' => 'Conferma invio email',
      'modal_description' => 'Sei sicuro di voler inviare questa email?',
      'success' => 'Email inviata con successo tramite AWS SES',
      'error' => 'Errore durante l\'invio dell\'email',
      'confirmation' => 'L\'email verrà inviata immediatamente',
    ),
    'sendEmail' => 
    array (
      'label' => 'sendEmail',
    ),
  ),
  'messages' => 
  array (
    'loading' => 'Preparazione email in corso...',
    'sent' => 'Email inviata correttamente',
    'queue' => 'Email aggiunta alla coda di invio',
    'failed' => 'Invio email fallito',
  ),
);
