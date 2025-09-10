<?php
declare(strict_types=1);

return array (
  'actions' => 
  array (
    'attach_user' => 'Attach User',
    'associate_user' => 'Associate User',
    'user_actions' => 'User Actions',
    'view' => 'View',
    'edit' => 'Edit',
    'detach' => 'Detach',
    'row_actions' => 'Actions',
    'delete_selected' => 'Delete Selected',
    'confirm_detach' => 'Are you sure you want to detach this user?',
    'confirm_delete' => 'Are you sure you want to delete the selected users?',
    'success_attached' => 'User successfully attached',
    'success_detached' => 'User successfully detached',
    'success_deleted' => 'Users successfully deleted',
    'toggle_layout' => 'Toggle Layout',
    'create' => 'Create User',
    'delete' => 'Delete User',
    'associate' => 'Associate User',
    'bulk_delete' => 'Delete Selected',
    'bulk_detach' => 'Detach Selected',
    'impersonate' => 'Impersona Utente',
    'stop_impersonating' => 'Termina Impersonificazione',
    'block' => 'Blocca',
    'unblock' => 'Sblocca',
    'send_reset_link' => 'Invia Link Reset Password',
    'verify_email' => 'Verifica Email',
  ),
  'fields' => 
  array (
    'name' => 
    array (
      'label' => 'Nome',
      'placeholder' => 'Inserisci il nome',
      'description' => 'name',
      'helper_text' => '',
    ),
    'email' => 
    array (
      'label' => 'Email',
      'placeholder' => 'Inserisci l\'email',
      'description' => 'email',
      'helper_text' => '',
    ),
    'created_at' => 
    array (
      'label' => 'Data Creazione',
    ),
    'updated_at' => 
    array (
      'label' => 'Ultima Modifica',
    ),
    'role' => 
    array (
      'label' => 'Ruolo',
    ),
    'active' => 'Active',
    'id' => 
    array (
      'label' => 'ID',
    ),
    'password' => 
    array (
      'label' => 'Password',
      'placeholder' => 'Inserisci la password',
      'description' => 'password',
      'helper_text' => '',
    ),
    'password_confirmation' => 
    array (
      'label' => 'Conferma Password',
      'placeholder' => 'Conferma la password',
    ),
    'email_verified_at' => 
    array (
      'label' => 'Email Verificata il',
    ),
    'current_password' => 
    array (
      'label' => 'Password Attuale',
      'placeholder' => 'Inserisci la password attuale',
    ),
    'roles' => 
    array (
      'label' => 'Ruoli',
    ),
    'permissions' => 
    array (
      'label' => 'Permessi',
    ),
    'status' => 
    array (
      'label' => 'Stato',
      'options' => 
      array (
        'active' => 'Attivo',
        'inactive' => 'Inattivo',
        'blocked' => 'Bloccato',
      ),
    ),
    'last_login' => 
    array (
      'label' => 'Ultimo Accesso',
    ),
    'avatar' => 
    array (
      'label' => 'Avatar',
    ),
    'language' => 
    array (
      'label' => 'Lingua',
    ),
    'timezone' => 
    array (
      'label' => 'Fuso Orario',
    ),
    'password_expires_at' => 
    array (
      'label' => 'Scadenza Password',
    ),
    'verified' => 
    array (
      'label' => 'Verificato',
    ),
    'unverified' => 
    array (
      'label' => 'Non Verificato',
    ),
    'applyFilters' => 
    array (
      'label' => 'applyFilters',
    ),
    'toggleColumns' => 
    array (
      'label' => 'toggleColumns',
    ),
    'reorderRecords' => 
    array (
      'label' => 'reorderRecords',
    ),
    'resetFilters' => 
    array (
      'label' => 'resetFilters',
    ),
    'openFilters' => 
    array (
      'label' => 'openFilters',
    ),
    'isActive' => 
    array (
      'label' => 'isActive',
    ),
    'deactivate' => 
    array (
      'label' => 'deactivate',
    ),
    'delete' => 
    array (
      'label' => 'delete',
    ),
    'edit' => 
    array (
      'label' => 'edit',
    ),
    'view' => 
    array (
      'label' => 'view',
    ),
    'create' => 
    array (
      'label' => 'create',
    ),
    'detach' => 
    array (
      'label' => 'detach',
    ),
    'attach' => 
    array (
      'label' => 'attach',
    ),
    'changePassword' => 
    array (
      'label' => 'changePassword',
    ),
  ),
  'filters' => 
  array (
    'active_users' => 'Active Users',
    'creation_date' => 'Creation Date',
    'date_from' => 'From',
    'date_to' => 'To',
    'verified' => 'Verified Users',
    'unverified' => 'Unverified Users',
  ),
  'messages' => 
  array (
    'no_records' => 'No users found',
    'loading' => 'Loading users...',
    'search' => 'Search users...',
    'credentials_incorrect' => 'The provided credentials are incorrect.',
    'created' => 'Utente creato con successo',
    'updated' => 'Utente aggiornato con successo',
    'deleted' => 'Utente eliminato con successo',
    'blocked' => 'Utente bloccato con successo',
    'unblocked' => 'Utente sbloccato con successo',
    'reset_link_sent' => 'Link per il reset della password inviato',
    'email_verified' => 'Email verificata con successo',
    'impersonating' => 'Stai impersonando l\'utente :name',
    // Added for LoginWidget
    'login_success' => 'Login successful',
    'validation_error' => 'Validation error',
    'login_error' => 'An error occurred during login. Please try again later.',
  ),
  'modals' => 
  array (
    'create' => 
    array (
      'heading' => 'Create User',
      'description' => 'Create a new user record',
      'actions' => 
      array (
        'submit' => 'Create',
        'cancel' => 'Cancel',
      ),
    ),
    'edit' => 
    array (
      'heading' => 'Edit User',
      'description' => 'Modify user information',
      'actions' => 
      array (
        'submit' => 'Save Changes',
        'cancel' => 'Cancel',
      ),
    ),
    'delete' => 
    array (
      'heading' => 'Delete User',
      'description' => 'Are you sure you want to delete this user?',
      'actions' => 
      array (
        'submit' => 'Delete',
        'cancel' => 'Cancel',
      ),
    ),
    'associate' => 
    array (
      'heading' => 'Associate User',
      'description' => 'Select a user to associate',
      'actions' => 
      array (
        'submit' => 'Associate',
        'cancel' => 'Cancel',
      ),
    ),
    'detach' => 
    array (
      'heading' => 'Detach User',
      'description' => 'Are you sure you want to detach this user?',
      'actions' => 
      array (
        'submit' => 'Detach',
        'cancel' => 'Cancel',
      ),
    ),
    'bulk_delete' => 
    array (
      'heading' => 'Delete Selected Users',
      'description' => 'Are you sure you want to delete the selected users?',
      'actions' => 
      array (
        'submit' => 'Delete Selected',
        'cancel' => 'Cancel',
      ),
    ),
    'bulk_detach' => 
    array (
      'heading' => 'Detach Selected Users',
      'description' => 'Are you sure you want to detach the selected users?',
      'actions' => 
      array (
        'submit' => 'Detach Selected',
        'cancel' => 'Cancel',
      ),
    ),
  ),
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
    'sort' => '26',
    'icon' => 'user-main',
  ),
  'validation' => 
  array (
    'email_unique' => 'Questa email è già in uso',
    'password_min' => 'La password deve essere di almeno :min caratteri',
    'password_confirmed' => 'Le password non coincidono',
    'current_password' => 'La password attuale non è corretta',
  ),
  'permissions' => 
  array (
    'view_users' => 'Visualizza utenti',
    'create_users' => 'Crea utenti',
    'edit_users' => 'Modifica utenti',
    'delete_users' => 'Elimina utenti',
    'impersonate_users' => 'Impersona utenti',
    'manage_roles' => 'Gestisci ruoli',
  ),
  'model' => 
  array (
    'label' => 'Utente',
  ),
);
