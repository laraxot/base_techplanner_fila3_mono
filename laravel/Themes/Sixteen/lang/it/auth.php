<?php

declare(strict_types=1);

return [
    /*
    |--------------------------------------------------------------------------
    | Authentication Language Lines - Tema Sixteen
    |--------------------------------------------------------------------------
    |
    | Le seguenti righe di lingua sono utilizzate durante l'autenticazione
    | per vari messaggi che dobbiamo mostrare all'utente. Puoi modificare
    | liberamente queste righe di lingua in base alle esigenze della tua applicazione.
    |
    */

    // Messaggi generali di autenticazione
    'failed' => 'Le credenziali fornite non sono corrette.',
    'password' => 'La password inserita non è corretta.',
    'throttle' => 'Troppi tentativi di accesso. Riprova fra :seconds secondi.',
    'general_error' => 'Si è verificato un errore. Riprova più tardi.',
    'unauthorized' => 'Non hai i permessi necessari per questa operazione.',

    // Login
    'login' => [
        'title' => 'Accedi',
        'email' => 'Email',
        'password' => 'Password',
        'remember_me' => 'Ricordami',
        'forgot_password' => 'Password dimenticata?',
        'submit' => 'Accedi',
        'or' => 'oppure',
        'create_account' => 'crea un account',
        'link' => 'Accedi',
        'success' => 'Accesso effettuato con successo',
        'error' => 'Errore durante il login',
        'error_message' => 'Si è verificato un errore durante il login. Riprova più tardi.',
        'validation_error' => 'Errore di validazione',
        'invalid_credentials' => 'Le credenziali fornite non sono corrette.',
    ],

    // Registrazione
    'register' => [
        'title' => 'Registrati',
        'name' => 'Nome',
        'email' => 'Email',
        'password' => 'Password',
        'password_confirmation' => 'Conferma Password',
        'submit' => 'Registrati',
        'already_registered' => 'Hai già un account?',
        'link' => 'Registrati',
    ],

    // Logout
    'logout' => [
        'title' => 'Logout',
        'confirm_message' => 'Sei sicuro di voler effettuare il logout?',
        'confirm_button' => 'Conferma Logout',
        'cancel_button' => 'Annulla',
        'success_title' => 'Logout effettuato',
        'success_message' => 'Sei stato disconnesso con successo.',
        'error_title' => 'Errore durante il logout',
        'error_message' => 'Si è verificato un errore durante il logout.',
        'try_again' => 'Riprova',
        'back_to_home' => 'Torna alla Home',
    ],

    // Profilo
    'profile' => [
        'title' => 'Profilo',
        'settings' => 'Impostazioni',
        'information' => 'Informazioni Profilo',
        'update_password' => 'Aggiorna Password',
        'current_password' => 'Password Attuale',
        'new_password' => 'Nuova Password',
        'confirm_password' => 'Conferma Password',
        'save' => 'Salva',
        'update' => 'Aggiorna',
    ],

    // Reset Password
    'reset' => [
        'title' => 'Reimposta Password',
        'email' => 'Email',
        'password' => 'Nuova Password',
        'password_confirmation' => 'Conferma Password',
        'submit' => 'Reimposta Password',
        'link_sent' => 'Abbiamo inviato il link per il reset della password via email!',
        'reset_link' => 'Reimposta Password',
    ],

    // Verifica Email
    'verify' => [
        'title' => 'Verifica Email',
        'message' => 'Grazie per esserti registrato! Prima di iniziare, potresti verificare il tuo indirizzo email cliccando sul link che ti abbiamo appena inviato?',
        'resend' => 'Se non hai ricevuto l\'email, possiamo reinviarla.',
        'submit' => 'Reinvia email di verifica',
    ],

    // Navigazione
    'navigation' => [
        'open_menu' => 'Apri menu principale',
        'close_menu' => 'Chiudi menu principale',
        'home' => 'Home',
        'dashboard' => 'Dashboard',
        'profile' => 'Profilo',
        'settings' => 'Impostazioni',
    ],

    // Dropdown utente
    'user_dropdown' => [
        'manage_account' => 'Gestione Account',
        'profile' => 'Profilo',
        'settings' => 'Impostazioni',
        'logout' => 'Logout',
        'login_link' => 'Accedi',
        'register_link' => 'Registrati',
    ],

    // Messaggi di notifica
    'notifications' => [
        'login_success' => 'Accesso effettuato con successo',
        'login_error' => 'Errore durante il login',
        'logout_success' => 'Logout effettuato con successo',
        'logout_error' => 'Errore durante il logout',
        'validation_error' => 'Errore di validazione',
        'general_error' => 'Si è verificato un errore. Riprova più tardi.',
    ],
]; 