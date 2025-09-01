# Modulo User

## Introduzione

Il modulo User gestisce l'autenticazione, l'autorizzazione e la gestione degli utenti nel sistema. Fornisce funzionalità base per la registrazione, il login, la gestione dei ruoli e dei permessi.

## File Chiave
- [BaseUser.php](app/Models/BaseUser.php)
- [User.php](app/Models/User.php)
- [Doctor.php](../Patient/app/Models/Doctor.php)
- [DoctorResource.php](../Patient/app/Filament/Resources/DoctorResource.php)
- [RegisterAction.php](../Patient/app/Actions/RegisterAction.php)
- [RegistrationWidget.php](app/Filament/Widgets/RegistrationWidget.php)

## Funzionalità

### 1. Autenticazione
- Login/Logout
- Registrazione
- Password Reset
- Email Verification

### 2. Autorizzazione
- Ruoli e Permessi
- Policy
- Gates
- Middleware

### 3. Gestione Utenti
- CRUD Utenti
- Profili
- Impostazioni
- Notifiche

## Best Practices

### 1. Ereditarietà
- Estendere sempre `BaseUser` per i modelli utente
- Usare il trait `HasParent` per STI
- Non duplicare trait già presenti nelle classi base

### 2. Validation
- Usare le regole di validazione base
- Estendere le regole quando necessario
- Mantenere la validazione consistente

### 3. Error Handling
- Usare le eccezioni custom fornite
- Implementare logging appropriato
- Gestire gli errori in modo consistente

## Struttura
```
User/
├── app/
│   ├── Models/
│   │   ├── User.php
│   │   ├── OauthAccessToken.php
│   │   ├── OauthAuthCode.php
│   │   ├── OauthClient.php
│   │   ├── OauthPersonalAccessClient.php
│   │   └── OauthRefreshToken.php
│   ├── Providers/
│   │   ├── Traits/
│   │   │   ├── HasPassportConfiguration.php
│   │   │   └── HasSocialiteConfiguration.php
│   │   ├── UserServiceProvider.php
│   │   ├── EventServiceProvider.php
│   │   ├── RouteServiceProvider.php
│   │   └── Filament/
│   │       └── AdminPanelProvider.php
│   ├── Filament/
│   │   ├── Resources/
│   │   │   └── UserResource.php
│   │   ├── Widgets/
│   │   │   ├── Auth/
│   │   │   │   ├── LoginWidget.php
│   │   │   │   └── SocialLoginWidget.php
│   │   │   └── User/
│   │   │       ├── UserStatsWidget.php
│   │   │       └── UserActivityWidget.php
│   │   └── Pages/
│   │       └── Auth/
│   │           ├── LoginPage.php
│   │           └── RegisterPage.php
│   └── Http/
│       └── Controllers/
│           └── Auth/
├── config/
│   └── auth.php
├── database/
│   └── migrations/
└── resources/
    └── views/
        └── pages/
            └── auth/
```

## Documentazione Tecnica
- [Architettura](./architecture/README.md)
- [Best Practices](./best-practices/README.md)
- [Error Handling](./error-handling.md)
- [Validation](./validation.md)
- [Popolamento Database](./database-population.md)
- [Linee guida Actions](./actions.mdc)
- [Linee guida Activitylog](./activitylog.mdc)
- [Comandi Console](./console_commands/README.md)
- [ChangePasswordCommand](./console_commands/change-password-command.md)
- [Filosofia Comandi Console](./console_commands/console_commands_philosophy.md)

## Collegamenti Bidirezionali
- [Modulo Xot](../Xot/docs/README.md)
- [Modulo Patient](../Patient/docs/README.md)
- [Modulo Dental](../Dental/docs/README.md)
- [Linee guida Actions](./actions.mdc)
- [Linee guida Activitylog](./activitylog.mdc)

## Vedi Anche
- [Documentazione Principale](../../docs/INDEX.md)
- [Architettura Moduli](../../docs/architecture/modules-structure.md)
- [Convenzioni di Nomenclatura](../../docs/standards/file_naming_conventions.md)
- [Struttura del Progetto](../Xot/docs/architecture/struttura-progetto.md)

## Collegamenti Principali

### Documentazione Core
- [Architettura del Modulo](structure.md)
- [Configurazione Passport](passport.md)
- [Integrazione Socialite](socialite.txt)
- [Gestione Profili](user_profile_models.md)
- [Best Practices Filament](filament-best-practices.md)
- [Roadmap](roadmap.md)
- [Bottlenecks](bottlenecks.md)

### Integrazioni
- [Integrazione con Xot](../Xot/docs/README.md)
- [Integrazione con Lang](../Lang/docs/README.md)
- [Integrazione con Notify](../Notify/docs/README.md)

### Autenticazione
- [Login Personalizzato](custom_login.md)
- [Autenticazione a Due Fattori](two_factor.txt)
- [Single Sign-On](sso.txt)
- [Gestione Password](password.md)

### Autorizzazione
- [Permessi Spatie](spatie_permissions.txt)
- [Gestione Ruoli](repositories.md)
- [Team e Collaborazioni](teams.md)

## Collegamenti
- [Indice Documentazione](../../../docs/INDEX.md)
- [README Principale](../../../README.md)
- [API Reference](../docs/api.md)
- [Changelog](../docs/CHANGELOG.md) 

