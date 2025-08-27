<?php
declare(strict_types=1);

<<<<<<< HEAD
return [
    'navigation' => [
        'name' => 'Utenti',
        'plural' => 'Utenti',
        'group' => [
            'name' => 'Gestione Utenti',
            'description' => 'Gestione degli utenti e dei loro permessi',
        ],
        'label' => 'Utenti',
        'sort' => 26,
        'icon' => 'user-main',
    ],
    'fields' => [
        'id' => [
            'label' => 'ID',
            'help' => 'Identificativo univoco dell\'utente',
            'tooltip' => 'ID utente',
            'helper_text' => '',
        ],
        'name' => [
            'label' => 'Nome',
            'placeholder' => 'Inserisci il nome completo',
            'help' => 'Nome completo dell\'utente',
            'tooltip' => 'Nome e cognome dell\'utente',
            'helper_text' => '',
        ],
        'first_name' => [
            'label' => 'Nome',
            'placeholder' => 'Inserisci il nome',
            'help' => 'Nome dell\'utente',
            'tooltip' => 'Nome dell\'utente',
            'helper_text' => '',
        ],
        'last_name' => [
            'label' => 'Cognome',
            'placeholder' => 'Inserisci il cognome',
            'help' => 'Cognome dell\'utente',
            'tooltip' => 'Cognome dell\'utente',
            'helper_text' => '',
        ],
        'email' => [
            'label' => 'Email',
            'placeholder' => 'Inserisci l\'indirizzo email',
            'help' => 'Indirizzo email dell\'utente',
            'tooltip' => 'Email per l\'accesso e le comunicazioni',
            'helper_text' => '',
        ],
        'password' => [
            'label' => 'Password',
            'placeholder' => 'Inserisci la password',
            'help' => 'Password per l\'accesso al sistema',
            'tooltip' => 'Password di accesso',
            'helper_text' => '',
        ],
        'password_confirmation' => [
            'label' => 'Conferma Password',
            'placeholder' => 'Conferma la password',
            'help' => 'Ripeti la password per conferma',
            'tooltip' => 'Conferma della password',
            'helper_text' => '',
        ],
        'current_password' => [
            'label' => 'Password Attuale',
            'placeholder' => 'Inserisci la password attuale',
            'help' => 'Password corrente per la verifica',
            'tooltip' => 'Password attuale',
            'helper_text' => '',
        ],
        'new_password' => [
            'label' => 'Nuova Password',
            'placeholder' => 'Inserisci la nuova password',
            'help' => 'Nuova password desiderata',
            'tooltip' => 'Nuova password',
            'helper_text' => '',
        ],
        'role' => [
            'label' => 'Ruolo',
            'placeholder' => 'Seleziona il ruolo',
            'help' => 'Ruolo dell\'utente nel sistema',
            'tooltip' => 'Ruolo e permessi',
            'helper_text' => '',
        ],
        'roles' => [
            'label' => 'Ruoli',
            'placeholder' => 'Seleziona i ruoli',
            'help' => 'Ruoli assegnati all\'utente',
            'tooltip' => 'Ruoli multipli',
            'helper_text' => '',
        ],
        'permissions' => [
            'label' => 'Permessi',
            'placeholder' => 'Seleziona i permessi',
            'help' => 'Permessi specifici dell\'utente',
            'tooltip' => 'Permessi diretti',
            'helper_text' => '',
        ],
        'status' => [
            'label' => 'Stato',
            'placeholder' => 'Seleziona lo stato',
            'help' => 'Stato dell\'account utente',
            'tooltip' => 'Stato dell\'utente',
            'helper_text' => '',
            'options' => [
                'active' => 'Attivo',
                'inactive' => 'Inattivo',
                'blocked' => 'Bloccato',
                'pending' => 'In Attesa',
                'suspended' => 'Sospeso',
            ],
        ],
        'type' => [
            'label' => 'Tipo',
            'placeholder' => 'Seleziona il tipo',
            'help' => 'Tipo di utente',
            'tooltip' => 'Tipo di account',
            'helper_text' => '',
            'options' => [
                'admin' => 'Amministratore',
                'user' => 'Utente',
                'doctor' => 'Medico',
                'patient' => 'Paziente',
                'staff' => 'Personale',
            ],
        ],
        'last_login' => [
            'label' => 'Ultimo Accesso',
            'help' => 'Data e ora dell\'ultimo accesso',
            'tooltip' => 'Ultimo login',
            'helper_text' => '',
        ],
        'created_at' => [
            'label' => 'Data Creazione',
            'help' => 'Data di creazione dell\'account',
            'tooltip' => 'Quando è stato creato',
            'helper_text' => '',
        ],
        'updated_at' => [
            'label' => 'Ultima Modifica',
            'help' => 'Data dell\'ultimo aggiornamento',
            'tooltip' => 'Ultimo aggiornamento',
            'helper_text' => '',
        ],
        'avatar' => [
            'label' => 'Avatar',
            'placeholder' => 'Carica un\'immagine',
            'help' => 'Immagine del profilo',
            'tooltip' => 'Foto profilo',
            'helper_text' => '',
        ],
        'language' => [
            'label' => 'Lingua',
            'placeholder' => 'Seleziona la lingua',
            'help' => 'Lingua preferita dell\'utente',
            'tooltip' => 'Lingua interfaccia',
            'helper_text' => '',
            'options' => [
                'it' => 'Italiano',
                'en' => 'English',
                'es' => 'Español',
                'fr' => 'Français',
                'de' => 'Deutsch',
            ],
        ],
        'timezone' => [
            'label' => 'Fuso Orario',
            'placeholder' => 'Seleziona il fuso orario',
            'help' => 'Fuso orario dell\'utente',
            'tooltip' => 'Zona oraria',
            'helper_text' => '',
        ],
        'password_expires_at' => [
            'label' => 'Scadenza Password',
            'help' => 'Data di scadenza della password',
            'tooltip' => 'Scadenza password',
            'helper_text' => '',
        ],
        'verified' => [
            'label' => 'Verificato',
            'help' => 'Indica se l\'email è verificata',
            'tooltip' => 'Email verificata',
            'helper_text' => '',
        ],
        'unverified' => [
            'label' => 'Non Verificato',
            'help' => 'Indica se l\'email non è verificata',
            'tooltip' => 'Email non verificata',
            'helper_text' => '',
        ],
        'email_verified_at' => [
            'label' => 'Email Verificata il',
            'help' => 'Data di verifica dell\'email',
            'tooltip' => 'Data verifica email',
            'helper_text' => '',
        ],
        'provider' => [
            'label' => 'Provider',
            'placeholder' => 'Inserisci il nome del provider',
            'help' => 'Provider di autenticazione (es. Google, Facebook)',
            'tooltip' => 'Provider OAuth',
            'helper_text' => '',
        ],
        'provider_id' => [
            'label' => 'ID Provider',
            'placeholder' => 'Inserisci l\'ID del provider',
            'help' => 'ID utente nel provider esterno',
            'tooltip' => 'ID provider esterno',
            'helper_text' => '',
        ],
        'provider_name' => [
            'label' => 'Nome Provider',
            'placeholder' => 'Inserisci il nome associato al provider',
            'help' => 'Nome dell\'utente nel provider',
            'tooltip' => 'Nome nel provider',
            'helper_text' => '',
        ],
        'provider_email' => [
            'label' => 'Email Provider',
            'placeholder' => 'Inserisci l\'email del provider',
            'help' => 'Email associata al provider',
            'tooltip' => 'Email nel provider',
            'helper_text' => '',
        ],
        'provider_avatar' => [
            'label' => 'Avatar Provider',
            'placeholder' => 'URL dell\'avatar',
            'help' => 'URL dell\'immagine profilo del provider',
            'tooltip' => 'Avatar del provider',
            'helper_text' => '',
        ],
        'uuid' => [
            'label' => 'UUID',
            'help' => 'Identificativo univoco universale',
            'tooltip' => 'UUID dispositivo',
            'helper_text' => '',
        ],
        'mobile_id' => [
            'label' => 'Mobile ID',
            'help' => 'Identificativo del dispositivo mobile',
            'tooltip' => 'ID dispositivo mobile',
            'helper_text' => '',
        ],
        'languages' => [
            'label' => 'Lingue',
            'placeholder' => 'Seleziona le lingue',
            'help' => 'Lingue supportate dal dispositivo',
            'tooltip' => 'Lingue dispositivo',
            'helper_text' => '',
        ],
        'guard_name' => [
            'label' => 'Guard Name',
            'help' => 'Nome del guard di autenticazione',
            'tooltip' => 'Guard autenticazione',
            'helper_text' => '',
        ],
        'active' => [
            'label' => 'Attivo',
            'help' => 'Indica se il record è attivo',
            'tooltip' => 'Stato attivo',
            'helper_text' => '',
        ],
        'resetFilters' => [
            'label' => 'resetFilters',
        ],
        'applyFilters' => [
            'label' => 'applyFilters',
        ],
    ],
    'actions' => [
        'create' => [
            'label' => 'Crea Utente',
            'icon' => 'heroicon-o-plus',
            'tooltip' => 'Crea un nuovo utente',
        ],
        'edit' => [
            'label' => 'Modifica Utente',
            'icon' => 'heroicon-o-pencil',
            'tooltip' => 'Modifica l\'utente',
        ],
        'delete' => [
            'label' => 'Elimina Utente',
            'icon' => 'heroicon-o-trash',
            'tooltip' => 'Elimina l\'utente',
        ],
        'view' => [
            'label' => 'Visualizza Utente',
            'icon' => 'heroicon-o-eye',
            'tooltip' => 'Visualizza i dettagli dell\'utente',
        ],
        'impersonate' => [
            'label' => 'Impersona Utente',
            'icon' => 'heroicon-o-user-circle',
            'tooltip' => 'Accedi come questo utente',
        ],
        'stop_impersonating' => [
            'label' => 'Termina Impersonificazione',
            'icon' => 'heroicon-o-arrow-left',
            'tooltip' => 'Torna al tuo account',
        ],
        'block' => [
            'label' => 'Blocca',
            'icon' => 'heroicon-o-lock-closed',
            'tooltip' => 'Blocca l\'utente',
        ],
        'unblock' => [
            'label' => 'Sblocca',
            'icon' => 'heroicon-o-lock-open',
            'tooltip' => 'Sblocca l\'utente',
        ],
        'send_reset_link' => [
            'label' => 'Invia Link Reset Password',
            'icon' => 'heroicon-o-envelope',
            'tooltip' => 'Invia link per reset password',
        ],
        'verify_email' => [
            'label' => 'Verifica Email',
            'icon' => 'heroicon-o-check-circle',
            'tooltip' => 'Verifica l\'email dell\'utente',
        ],
        'attach' => [
            'label' => 'Collega',
            'icon' => 'heroicon-o-link',
            'tooltip' => 'Collega record',
        ],
        'detach' => [
            'label' => 'Scollega',
            'icon' => 'heroicon-o-link-slash',
            'tooltip' => 'Scollega record',
        ],
        'activate' => [
            'label' => 'Attiva',
            'icon' => 'heroicon-o-check',
            'tooltip' => 'Attiva l\'utente',
        ],
        'deactivate' => [
            'label' => 'Disattiva',
            'icon' => 'heroicon-o-x-circle',
            'tooltip' => 'Disattiva l\'utente',
        ],
    ],
    'messages' => [
        'created' => 'Utente creato con successo',
        'updated' => 'Utente aggiornato con successo',
        'deleted' => 'Utente eliminato con successo',
        'blocked' => 'Utente bloccato con successo',
        'unblocked' => 'Utente sbloccato con successo',
        'activated' => 'Utente attivato con successo',
        'deactivated' => 'Utente disattivato con successo',
        'reset_link_sent' => 'Link per il reset della password inviato',
        'email_verified' => 'Email verificata con successo',
        'impersonating' => 'Stai impersonando l\'utente :name',
        'logout_success' => 'Logout effettuato con successo',
        'logout_error' => 'Errore durante il logout',
        'password_changed' => 'Password modificata con successo',
        'password_expired' => 'La password è scaduta',
        'user_not_found' => 'Utente non trovato',
        'password_fields_required' => 'Tutti i campi password sono obbligatori',
        'password_current_incorrect' => 'La password attuale non è corretta',
        'credentials_incorrect' => 'Le credenziali fornite non sono corrette...',
        'login_error' => 'Si è verificato un errore durante il login. Riprova più tardi',
        'logout_error_generic' => 'Errore durante il logout. Riprova.',
        'team_switched' => 'Team cambiato con successo',
        'registration_success' => 'Registrazione completata con successo',
        'registration_error' => 'Si è verificato un errore durante la registrazione',
        'otp_sent' => 'Codice OTP inviato con successo',
        'otp_expired' => 'Il codice OTP è scaduto',
        'password_reset_success' => 'Password reimpostata con successo',
        'password_reset_error' => 'Errore durante il reset della password',
        'email_already_taken' => 'Questa email è già in uso',
    ],
    'validation' => [
        'required' => 'Il campo :attribute è obbligatorio',
        'email' => 'Il campo :attribute deve essere un indirizzo email valido',
        'unique' => 'Il campo :attribute è già in uso',
        'min' => 'Il campo :attribute deve contenere almeno :min caratteri',
        'max' => 'Il campo :attribute non può superare :max caratteri',
        'confirmed' => 'La conferma del campo :attribute non corrisponde',
        'same' => 'Il campo :attribute deve corrispondere a :other',
        'email_unique' => 'Questa email è già in uso',
        'password_min' => 'La password deve essere di almeno :min caratteri',
        'password_confirmed' => 'Le password non coincidono',
        'current_password' => 'La password attuale non è corretta',
        'password_complexity' => 'La password deve contenere almeno 8 caratteri, una lettera maiuscola, una minuscola, un numero e un carattere speciale',
    ],
    'permissions' => [
        'view_users' => 'Visualizza utenti',
        'create_users' => 'Crea utenti',
        'edit_users' => 'Modifica utenti',
        'delete_users' => 'Elimina utenti',
        'impersonate_users' => 'Impersona utenti',
        'manage_roles' => 'Gestisci ruoli',
        'manage_permissions' => 'Gestisci permessi',
        'view_roles' => 'Visualizza ruoli',
        'create_roles' => 'Crea ruoli',
        'edit_roles' => 'Modifica ruoli',
        'delete_roles' => 'Elimina ruoli',
    ],
    'auth' => [
        'login' => [
            'title' => 'Accedi',
            'subtitle' => 'Accedi al tuo account',
            'button' => 'Accedi',
            'fields' => [
                'email' => 'Email',
                'password' => 'Password',
                'remember' => 'Ricordami',
            ],
            'help' => [
                'email' => 'Inserisci la tua email registrata',
                'password' => 'Inserisci la tua password',
            ],
            'validation' => [
                'password' => [
                    'complexity' => 'La password deve contenere almeno 8 caratteri, una lettera maiuscola, una minuscola, un numero e un carattere speciale',
                ],
            ],
        ],
        'register' => [
            'title' => 'Registrati',
            'subtitle' => 'Crea un nuovo account',
            'button' => 'Registrati',
            'fields' => [
                'first_name' => 'Nome',
                'last_name' => 'Cognome',
                'email' => 'Email',
                'password' => 'Password',
                'password_confirmation' => 'Conferma Password',
            ],
            'help' => [
                'email' => 'Inserisci un indirizzo email valido',
                'password' => 'La password deve essere sicura',
            ],
            'success' => 'Registrazione completata con successo',
            'error_occurred' => 'Si è verificato un errore durante la registrazione',
        ],
        'logout' => [
            'title' => 'Logout',
            'button' => 'Esci',
            'success' => 'Logout effettuato con successo',
            'error' => 'Errore durante il logout',
            'confirmation' => 'Sei sicuro di voler uscire?',
        ],
        'password_reset' => [
            'title' => 'Reset Password',
            'subtitle' => 'Reimposta la tua password',
            'button' => 'Invia Link Reset',
            'confirm_button' => 'Reimposta Password',
            'email_sent' => [
                'title' => 'Email inviata',
                'message' => 'Ti abbiamo inviato un link per reimpostare la password',
            ],
            'email_failed' => [
                'title' => 'Errore invio email',
                'message' => 'Impossibile inviare l\'email di reset',
                'generic' => 'Si è verificato un errore',
            ],
            'success' => [
                'title' => 'Password reimpostata',
                'message' => 'La tua password è stata reimpostata con successo',
            ],
            'errors' => [
                'invalid_token' => 'Token non valido',
                'invalid_user' => 'Utente non trovato',
                'generic' => 'Si è verificato un errore',
                'title' => 'Errore reset password',
            ],
        ],
        'user_not_found' => 'Utente non trovato',
        'password_fields_required' => 'Tutti i campi password sono obbligatori',
        'password_current_incorrect' => 'La password attuale non è corretta',
        'logout_success' => 'Logout effettuato con successo',
        'logout_error' => 'Errore durante il logout',
        'logout_title' => 'Conferma Logout',
        'logout_confirmation' => 'Sei sicuro di voler uscire?',
    ],
    'profile' => [
        'profile' => 'Profilo',
        'my_profile' => 'Il Mio Profilo',
        'subheading' => 'Gestisci le informazioni del tuo profilo',
        'edit_profile' => 'Modifica Profilo',
        'change_password' => 'Cambia Password',
        'personal_info' => 'Informazioni Personali',
        'security' => 'Sicurezza',
        'notifications' => 'Notifiche',
        'preferences' => 'Preferenze',
    ],
    'tenancy' => [
        'navigation' => [
            'edit' => 'Modifica Profilo Team',
        ],
    ],
    'otp' => [
        'mail' => [
            'subject' => 'Codice OTP per l\'accesso',
            'greeting' => 'Ciao :name',
            'line1' => 'Il tuo codice OTP è: :code',
            'line2' => 'Questo codice scade tra :minutes minuti',
            'line3' => 'Non condividere questo codice con nessuno',
            'salutation' => 'Cordiali saluti, :app_name',
        ],
        'notifications' => [
            'otp_expired' => [
                'body' => 'Il codice OTP è scaduto',
            ],
        ],
        'actions' => [
            'send_otp_success' => 'Codice OTP inviato con successo',
        ],
    ],
    'reset_password' => [
        'password_reset_subject' => 'Reset Password',
        'password_cause_of_email' => 'Hai ricevuto questa email perché abbiamo ricevuto una richiesta di reset password per il tuo account',
        'reset_password' => 'Reset Password',
        'password_if_not_requested' => 'Se non hai richiesto il reset della password, non è necessaria alcuna azione',
        'thank_you_for_using_app' => 'Grazie per utilizzare la nostra applicazione',
        'regards' => 'Cordiali saluti',
    ],
    'verify_email' => [
        'subject' => 'Verifica Email',
        'greeting' => 'Ciao :name',
        'line1' => 'Clicca sul pulsante qui sotto per verificare il tuo indirizzo email',
        'action' => 'Verifica Email',
        'line2' => 'Se non hai creato un account, non è necessaria alcuna azione',
        'salutation' => 'Cordiali saluti, :app_name',
    ],
    'model' => [
        'label' => 'Utente',
        'plural' => 'Utenti',
        'description' => 'Gestione degli utenti del sistema',
    ],
    'filters' => [
        'status' => [
            'label' => 'Per Stato',
            'tooltip' => 'Filtra per stato utente',
        ],
        'type' => [
            'label' => 'Per Tipo',
            'tooltip' => 'Filtra per tipo utente',
        ],
        'role' => [
            'label' => 'Per Ruolo',
            'tooltip' => 'Filtra per ruolo',
        ],
        'verified' => [
            'label' => 'Email Verificata',
            'tooltip' => 'Mostra solo utenti con email verificata',
        ],
    ],
    'bulk_actions' => [
        'activate_selected' => [
            'label' => 'Attiva Selezionati',
            'icon' => 'heroicon-o-check',
        ],
        'deactivate_selected' => [
            'label' => 'Disattiva Selezionati',
            'icon' => 'heroicon-o-x-circle',
        ],
        'delete_selected' => [
            'label' => 'Elimina Selezionati',
            'icon' => 'heroicon-o-trash',
        ],
        'block_selected' => [
            'label' => 'Blocca Selezionati',
            'icon' => 'heroicon-o-lock-closed',
        ],
        'unblock_selected' => [
            'label' => 'Sblocca Selezionati',
            'icon' => 'heroicon-o-lock-open',
        ],
    ],
    'notifications' => [
        'created' => 'Utente creato con successo',
        'updated' => 'Utente aggiornato con successo',
        'deleted' => 'Utente eliminato con successo',
        'password_changed' => 'Password modificata con successo',
        'email_verified' => 'Email verificata con successo',
        'otp_sent' => 'Codice OTP inviato',
        'error' => 'Si è verificato un errore',
    ],
    'search_placeholder' => 'Cerca per nome, email o ruolo...',
];
=======
return array (
  'navigation' => 
  array (
    'name' => 'Utenti',
    'plural' => 'Utenti',
    'group' => 
    array (
      'name' => 'Gestione Utenti',
      'description' => 'Gestione degli utenti e dei loro permessi',
    ),
    'label' => 'Utenti',
    'sort' => 26,
    'icon' => 'user-main',
  ),
  'fields' => 
  array (
    'id' => 
    array (
      'label' => 'ID',
      'help' => 'Identificativo univoco dell\'utente',
      'tooltip' => 'ID utente',
      'helper_text' => '',
    ),
    'name' => 
    array (
      'label' => 'Nome',
      'placeholder' => 'Inserisci il nome completo',
      'help' => 'Nome completo dell\'utente',
      'tooltip' => 'Nome e cognome dell\'utente',
      'helper_text' => '',
    ),
    'first_name' => 
    array (
      'label' => 'Nome',
      'placeholder' => 'Inserisci il nome',
      'help' => 'Nome dell\'utente',
      'tooltip' => 'Nome dell\'utente',
      'helper_text' => '',
    ),
    'last_name' => 
    array (
      'label' => 'Cognome',
      'placeholder' => 'Inserisci il cognome',
      'help' => 'Cognome dell\'utente',
      'tooltip' => 'Cognome dell\'utente',
      'helper_text' => '',
    ),
    'email' => 
    array (
      'label' => 'Email',
      'placeholder' => 'Inserisci l\'indirizzo email',
      'help' => 'Indirizzo email dell\'utente',
      'tooltip' => 'Email per l\'accesso e le comunicazioni',
      'helper_text' => '',
    ),
    'password' => 
    array (
      'label' => 'Password',
      'placeholder' => 'Inserisci la password',
      'help' => 'Password per l\'accesso al sistema',
      'tooltip' => 'Password di accesso',
      'helper_text' => '',
    ),
    'password_confirmation' => 
    array (
      'label' => 'Conferma Password',
      'placeholder' => 'Conferma la password',
      'help' => 'Ripeti la password per conferma',
      'tooltip' => 'Conferma della password',
      'helper_text' => '',
    ),
    'current_password' => 
    array (
      'label' => 'Password Attuale',
      'placeholder' => 'Inserisci la password attuale',
      'help' => 'Password corrente per la verifica',
      'tooltip' => 'Password attuale',
      'helper_text' => '',
    ),
    'new_password' => 
    array (
      'label' => 'Nuova Password',
      'placeholder' => 'Inserisci la nuova password',
      'help' => 'Nuova password desiderata',
      'tooltip' => 'Nuova password',
      'helper_text' => '',
    ),
    'role' => 
    array (
      'label' => 'Ruolo',
      'placeholder' => 'Seleziona il ruolo',
      'help' => 'Ruolo dell\'utente nel sistema',
      'tooltip' => 'Ruolo e permessi',
      'helper_text' => '',
    ),
    'roles' => 
    array (
      'label' => 'Ruoli',
      'placeholder' => 'Seleziona i ruoli',
      'help' => 'Ruoli assegnati all\'utente',
      'tooltip' => 'Ruoli multipli',
      'helper_text' => '',
    ),
    'permissions' => 
    array (
      'label' => 'Permessi',
      'placeholder' => 'Seleziona i permessi',
      'help' => 'Permessi specifici dell\'utente',
      'tooltip' => 'Permessi diretti',
      'helper_text' => '',
    ),
    'status' => 
    array (
      'label' => 'Stato',
      'placeholder' => 'Seleziona lo stato',
      'help' => 'Stato dell\'account utente',
      'tooltip' => 'Stato dell\'utente',
      'helper_text' => '',
      'options' => 
      array (
        'active' => 'Attivo',
        'inactive' => 'Inattivo',
        'blocked' => 'Bloccato',
        'pending' => 'In Attesa',
        'suspended' => 'Sospeso',
      ),
    ),
    'type' => 
    array (
      'label' => 'Tipo',
      'placeholder' => 'Seleziona il tipo',
      'help' => 'Tipo di utente',
      'tooltip' => 'Tipo di account',
      'helper_text' => '',
      'options' => 
      array (
        'admin' => 'Amministratore',
        'user' => 'Utente',
        'doctor' => 'Medico',
        'patient' => 'Paziente',
        'staff' => 'Personale',
      ),
    ),
    'last_login' => 
    array (
      'label' => 'Ultimo Accesso',
      'help' => 'Data e ora dell\'ultimo accesso',
      'tooltip' => 'Ultimo login',
      'helper_text' => '',
    ),
    'created_at' => 
    array (
      'label' => 'Data Creazione',
      'help' => 'Data di creazione dell\'account',
      'tooltip' => 'Quando è stato creato',
      'helper_text' => '',
    ),
    'updated_at' => 
    array (
      'label' => 'Ultima Modifica',
      'help' => 'Data dell\'ultimo aggiornamento',
      'tooltip' => 'Ultimo aggiornamento',
      'helper_text' => '',
    ),
    'avatar' => 
    array (
      'label' => 'Avatar',
      'placeholder' => 'Carica un\'immagine',
      'help' => 'Immagine del profilo',
      'tooltip' => 'Foto profilo',
      'helper_text' => '',
    ),
    'language' => 
    array (
      'label' => 'Lingua',
      'placeholder' => 'Seleziona la lingua',
      'help' => 'Lingua preferita dell\'utente',
      'tooltip' => 'Lingua interfaccia',
      'helper_text' => '',
      'options' => 
      array (
        'it' => 'Italiano',
        'en' => 'English',
        'es' => 'Español',
        'fr' => 'Français',
        'de' => 'Deutsch',
      ),
    ),
    'timezone' => 
    array (
      'label' => 'Fuso Orario',
      'placeholder' => 'Seleziona il fuso orario',
      'help' => 'Fuso orario dell\'utente',
      'tooltip' => 'Zona oraria',
      'helper_text' => '',
    ),
    'password_expires_at' => 
    array (
      'label' => 'Scadenza Password',
      'help' => 'Data di scadenza della password',
      'tooltip' => 'Scadenza password',
      'helper_text' => '',
    ),
    'verified' => 
    array (
      'label' => 'Verificato',
      'help' => 'Indica se l\'email è verificata',
      'tooltip' => 'Email verificata',
      'helper_text' => '',
    ),
    'unverified' => 
    array (
      'label' => 'Non Verificato',
      'help' => 'Indica se l\'email non è verificata',
      'tooltip' => 'Email non verificata',
      'helper_text' => '',
    ),
    'email_verified_at' => 
    array (
      'label' => 'Email Verificata il',
      'help' => 'Data di verifica dell\'email',
      'tooltip' => 'Data verifica email',
      'helper_text' => '',
    ),
    'provider' => 
    array (
      'label' => 'Provider',
      'placeholder' => 'Inserisci il nome del provider',
      'help' => 'Provider di autenticazione (es. Google, Facebook)',
      'tooltip' => 'Provider OAuth',
      'helper_text' => '',
    ),
    'provider_id' => 
    array (
      'label' => 'ID Provider',
      'placeholder' => 'Inserisci l\'ID del provider',
      'help' => 'ID utente nel provider esterno',
      'tooltip' => 'ID provider esterno',
      'helper_text' => '',
    ),
    'provider_name' => 
    array (
      'label' => 'Nome Provider',
      'placeholder' => 'Inserisci il nome associato al provider',
      'help' => 'Nome dell\'utente nel provider',
      'tooltip' => 'Nome nel provider',
      'helper_text' => '',
    ),
    'provider_email' => 
    array (
      'label' => 'Email Provider',
      'placeholder' => 'Inserisci l\'email del provider',
      'help' => 'Email associata al provider',
      'tooltip' => 'Email nel provider',
      'helper_text' => '',
    ),
    'provider_avatar' => 
    array (
      'label' => 'Avatar Provider',
      'placeholder' => 'URL dell\'avatar',
      'help' => 'URL dell\'immagine profilo del provider',
      'tooltip' => 'Avatar del provider',
      'helper_text' => '',
    ),
    'uuid' => 
    array (
      'label' => 'UUID',
      'help' => 'Identificativo univoco universale',
      'tooltip' => 'UUID dispositivo',
      'helper_text' => '',
    ),
    'mobile_id' => 
    array (
      'label' => 'Mobile ID',
      'help' => 'Identificativo del dispositivo mobile',
      'tooltip' => 'ID dispositivo mobile',
      'helper_text' => '',
    ),
    'languages' => 
    array (
      'label' => 'Lingue',
      'placeholder' => 'Seleziona le lingue',
      'help' => 'Lingue supportate dal dispositivo',
      'tooltip' => 'Lingue dispositivo',
      'helper_text' => '',
    ),
    'guard_name' => 
    array (
      'label' => 'Guard Name',
      'help' => 'Nome del guard di autenticazione',
      'tooltip' => 'Guard autenticazione',
      'helper_text' => '',
    ),
    'active' => 
    array (
      'label' => 'Attivo',
      'help' => 'Indica se il record è attivo',
      'tooltip' => 'Stato attivo',
      'helper_text' => '',
    ),
    'resetFilters' => 
    array (
      'label' => 'resetFilters',
    ),
    'applyFilters' => 
    array (
      'label' => 'applyFilters',
    ),
  ),
  'actions' => 
  array (
    'create' => 
    array (
      'label' => 'Crea Utente',
      'icon' => 'heroicon-o-plus',
      'tooltip' => 'Crea un nuovo utente',
    ),
    'edit' => 
    array (
      'label' => 'Modifica Utente',
      'icon' => 'heroicon-o-pencil',
      'tooltip' => 'Modifica l\'utente',
    ),
    'delete' => 
    array (
      'label' => 'Elimina Utente',
      'icon' => 'heroicon-o-trash',
      'tooltip' => 'Elimina l\'utente',
    ),
    'view' => 
    array (
      'label' => 'Visualizza Utente',
      'icon' => 'heroicon-o-eye',
      'tooltip' => 'Visualizza i dettagli dell\'utente',
    ),
    'impersonate' => 
    array (
      'label' => 'Impersona Utente',
      'icon' => 'heroicon-o-user-circle',
      'tooltip' => 'Accedi come questo utente',
    ),
    'stop_impersonating' => 
    array (
      'label' => 'Termina Impersonificazione',
      'icon' => 'heroicon-o-arrow-left',
      'tooltip' => 'Torna al tuo account',
    ),
    'block' => 
    array (
      'label' => 'Blocca',
      'icon' => 'heroicon-o-lock-closed',
      'tooltip' => 'Blocca l\'utente',
    ),
    'unblock' => 
    array (
      'label' => 'Sblocca',
      'icon' => 'heroicon-o-lock-open',
      'tooltip' => 'Sblocca l\'utente',
    ),
    'send_reset_link' => 
    array (
      'label' => 'Invia Link Reset Password',
      'icon' => 'heroicon-o-envelope',
      'tooltip' => 'Invia link per reset password',
    ),
    'verify_email' => 
    array (
      'label' => 'Verifica Email',
      'icon' => 'heroicon-o-check-circle',
      'tooltip' => 'Verifica l\'email dell\'utente',
    ),
    'attach' => 
    array (
      'label' => 'Collega',
      'icon' => 'heroicon-o-link',
      'tooltip' => 'Collega record',
    ),
    'detach' => 
    array (
      'label' => 'Scollega',
      'icon' => 'heroicon-o-link-slash',
      'tooltip' => 'Scollega record',
    ),
    'activate' => 
    array (
      'label' => 'Attiva',
      'icon' => 'heroicon-o-check',
      'tooltip' => 'Attiva l\'utente',
    ),
    'deactivate' => 
    array (
      'label' => 'Disattiva',
      'icon' => 'heroicon-o-x-circle',
      'tooltip' => 'Disattiva l\'utente',
    ),
  ),
  'messages' => 
  array (
    'created' => 'Utente creato con successo',
    'updated' => 'Utente aggiornato con successo',
    'deleted' => 'Utente eliminato con successo',
    'blocked' => 'Utente bloccato con successo',
    'unblocked' => 'Utente sbloccato con successo',
    'activated' => 'Utente attivato con successo',
    'deactivated' => 'Utente disattivato con successo',
    'reset_link_sent' => 'Link per il reset della password inviato',
    'email_verified' => 'Email verificata con successo',
    'impersonating' => 'Stai impersonando l\'utente :name',
    'logout_success' => 'Logout effettuato con successo',
    'logout_error' => 'Errore durante il logout',
    'password_changed' => 'Password modificata con successo',
    'password_expired' => 'La password è scaduta',
    'user_not_found' => 'Utente non trovato',
    'password_fields_required' => 'Tutti i campi password sono obbligatori',
    'password_current_incorrect' => 'La password attuale non è corretta',
    'credentials_incorrect' => 'Le credenziali fornite non sono corrette...',
    'login_error' => 'Si è verificato un errore durante il login. Riprova più tardi',
    'logout_error_generic' => 'Errore durante il logout. Riprova.',
    'team_switched' => 'Team cambiato con successo',
    'registration_success' => 'Registrazione completata con successo',
    'registration_error' => 'Si è verificato un errore durante la registrazione',
    'otp_sent' => 'Codice OTP inviato con successo',
    'otp_expired' => 'Il codice OTP è scaduto',
    'password_reset_success' => 'Password reimpostata con successo',
    'password_reset_error' => 'Errore durante il reset della password',
    'email_already_taken' => 'Questa email è già in uso',
    // Added keys for LoginWidget
    'login_success' => 'Accesso effettuato con successo',
    'validation_error' => 'Errore di validazione',
  ),
  'validation' => 
  array (
    'required' => 'Il campo :attribute è obbligatorio',
    'email' => 'Il campo :attribute deve essere un indirizzo email valido',
    'unique' => 'Il campo :attribute è già in uso',
    'min' => 'Il campo :attribute deve contenere almeno :min caratteri',
    'max' => 'Il campo :attribute non può superare :max caratteri',
    'confirmed' => 'La conferma del campo :attribute non corrisponde',
    'same' => 'Il campo :attribute deve corrispondere a :other',
    'email_unique' => 'Questa email è già in uso',
    'password_min' => 'La password deve essere di almeno :min caratteri',
    'password_confirmed' => 'Le password non coincidono',
    'current_password' => 'La password attuale non è corretta',
    'password_complexity' => 'La password deve contenere almeno 8 caratteri, una lettera maiuscola, una minuscola, un numero e un carattere speciale',
  ),
  'permissions' => 
  array (
    'view_users' => 'Visualizza utenti',
    'create_users' => 'Crea utenti',
    'edit_users' => 'Modifica utenti',
    'delete_users' => 'Elimina utenti',
    'impersonate_users' => 'Impersona utenti',
    'manage_roles' => 'Gestisci ruoli',
    'manage_permissions' => 'Gestisci permessi',
    'view_roles' => 'Visualizza ruoli',
    'create_roles' => 'Crea ruoli',
    'edit_roles' => 'Modifica ruoli',
    'delete_roles' => 'Elimina ruoli',
  ),
  'auth' => 
  array (
    'login' => 
    array (
      'title' => 'Accedi',
      'subtitle' => 'Accedi al tuo account',
      'button' => 'Accedi',
      'fields' => 
      array (
        'email' => 'Email',
        'password' => 'Password',
        'remember' => 'Ricordami',
      ),
      'help' => 
      array (
        'email' => 'Inserisci la tua email registrata',
        'password' => 'Inserisci la tua password',
      ),
      'validation' => 
      array (
        'password' => 
        array (
          'complexity' => 'La password deve contenere almeno 8 caratteri, una lettera maiuscola, una minuscola, un numero e un carattere speciale',
        ),
      ),
    ),
    'register' => 
    array (
      'title' => 'Registrati',
      'subtitle' => 'Crea un nuovo account',
      'button' => 'Registrati',
      'fields' => 
      array (
        'first_name' => 'Nome',
        'last_name' => 'Cognome',
        'email' => 'Email',
        'password' => 'Password',
        'password_confirmation' => 'Conferma Password',
      ),
      'help' => 
      array (
        'email' => 'Inserisci un indirizzo email valido',
        'password' => 'La password deve essere sicura',
      ),
      'success' => 'Registrazione completata con successo',
      'error_occurred' => 'Si è verificato un errore durante la registrazione',
    ),
    'logout' => 
    array (
      'title' => 'Logout',
      'button' => 'Esci',
      'success' => 'Logout effettuato con successo',
      'error' => 'Errore durante il logout',
      'confirmation' => 'Sei sicuro di voler uscire?',
    ),
    'password_reset' => 
    array (
      'title' => 'Reset Password',
      'subtitle' => 'Reimposta la tua password',
      'button' => 'Invia Link Reset',
      'confirm_button' => 'Reimposta Password',
      'email_sent' => 
      array (
        'title' => 'Email inviata',
        'message' => 'Ti abbiamo inviato un link per reimpostare la password',
      ),
      'email_failed' => 
      array (
        'title' => 'Errore invio email',
        'message' => 'Impossibile inviare l\'email di reset',
        'generic' => 'Si è verificato un errore',
      ),
      'success' => 
      array (
        'title' => 'Password reimpostata',
        'message' => 'La tua password è stata reimpostata con successo',
      ),
      'errors' => 
      array (
        'invalid_token' => 'Token non valido',
        'invalid_user' => 'Utente non trovato',
        'generic' => 'Si è verificato un errore',
        'title' => 'Errore reset password',
      ),
    ),
    'user_not_found' => 'Utente non trovato',
    'password_fields_required' => 'Tutti i campi password sono obbligatori',
    'password_current_incorrect' => 'La password attuale non è corretta',
    'logout_success' => 'Logout effettuato con successo',
    'logout_error' => 'Errore durante il logout',
    'logout_title' => 'Conferma Logout',
    'logout_confirmation' => 'Sei sicuro di voler uscire?',
  ),
  'profile' => 
  array (
    'profile' => 'Profilo',
    'my_profile' => 'Il Mio Profilo',
    'subheading' => 'Gestisci le informazioni del tuo profilo',
    'edit_profile' => 'Modifica Profilo',
    'change_password' => 'Cambia Password',
    'personal_info' => 'Informazioni Personali',
    'security' => 'Sicurezza',
    'notifications' => 'Notifiche',
    'preferences' => 'Preferenze',
  ),
  'tenancy' => 
  array (
    'navigation' => 
    array (
      'edit' => 'Modifica Profilo Team',
    ),
  ),
  'otp' => 
  array (
    'mail' => 
    array (
      'subject' => 'Codice OTP per l\'accesso',
      'greeting' => 'Ciao :name',
      'line1' => 'Il tuo codice OTP è: :code',
      'line2' => 'Questo codice scade tra :minutes minuti',
      'line3' => 'Non condividere questo codice con nessuno',
      'salutation' => 'Cordiali saluti, :app_name',
    ),
    'notifications' => 
    array (
      'otp_expired' => 
      array (
        'body' => 'Il codice OTP è scaduto',
      ),
    ),
    'actions' => 
    array (
      'send_otp_success' => 'Codice OTP inviato con successo',
    ),
  ),
  'reset_password' => 
  array (
    'password_reset_subject' => 'Reset Password',
    'password_cause_of_email' => 'Hai ricevuto questa email perché abbiamo ricevuto una richiesta di reset password per il tuo account',
    'reset_password' => 'Reset Password',
    'password_if_not_requested' => 'Se non hai richiesto il reset della password, non è necessaria alcuna azione',
    'thank_you_for_using_app' => 'Grazie per utilizzare la nostra applicazione',
    'regards' => 'Cordiali saluti',
  ),
  'verify_email' => 
  array (
    'subject' => 'Verifica Email',
    'greeting' => 'Ciao :name',
    'line1' => 'Clicca sul pulsante qui sotto per verificare il tuo indirizzo email',
    'action' => 'Verifica Email',
    'line2' => 'Se non hai creato un account, non è necessaria alcuna azione',
    'salutation' => 'Cordiali saluti, :app_name',
  ),
  'model' => 
  array (
    'label' => 'Utente',
    'plural' => 'Utenti',
    'description' => 'Gestione degli utenti del sistema',
  ),
  'filters' => 
  array (
    'status' => 
    array (
      'label' => 'Per Stato',
      'tooltip' => 'Filtra per stato utente',
    ),
    'type' => 
    array (
      'label' => 'Per Tipo',
      'tooltip' => 'Filtra per tipo utente',
    ),
    'role' => 
    array (
      'label' => 'Per Ruolo',
      'tooltip' => 'Filtra per ruolo',
    ),
    'verified' => 
    array (
      'label' => 'Email Verificata',
      'tooltip' => 'Mostra solo utenti con email verificata',
    ),
  ),
  'bulk_actions' => 
  array (
    'activate_selected' => 
    array (
      'label' => 'Attiva Selezionati',
      'icon' => 'heroicon-o-check',
    ),
    'deactivate_selected' => 
    array (
      'label' => 'Disattiva Selezionati',
      'icon' => 'heroicon-o-x-circle',
    ),
    'delete_selected' => 
    array (
      'label' => 'Elimina Selezionati',
      'icon' => 'heroicon-o-trash',
    ),
    'block_selected' => 
    array (
      'label' => 'Blocca Selezionati',
      'icon' => 'heroicon-o-lock-closed',
    ),
    'unblock_selected' => 
    array (
      'label' => 'Sblocca Selezionati',
      'icon' => 'heroicon-o-lock-open',
    ),
  ),
  'notifications' => 
  array (
    'created' => 'Utente creato con successo',
    'updated' => 'Utente aggiornato con successo',
    'deleted' => 'Utente eliminato con successo',
    'password_changed' => 'Password modificata con successo',
    'email_verified' => 'Email verificata con successo',
    'otp_sent' => 'Codice OTP inviato',
    'error' => 'Si è verificato un errore',
  ),
  'search_placeholder' => 'Cerca per nome, email o ruolo...',
);
>>>>>>> fc93b0f (.)
