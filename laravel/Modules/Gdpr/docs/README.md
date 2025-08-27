# GDPR Module Documentation

This document provides a comprehensive overview of the `Gdpr` module for Laraxot PTVX, which is designed to manage user consent and data processing treatments in compliance with GDPR regulations.

## Core Concepts

The module is built around three primary models:

- **Treatment**: Represents a specific purpose for data processing for which user consent is required (e.g., marketing communications, analytics).
- **Consent**: Records a user's agreement to a specific treatment.
- **Event**: Logs all GDPR-related actions, such as granting or revoking consent, creating a verifiable audit trail.

## Data Models

### 1. `Treatment`

The `Treatment` model defines the various data processing activities.

- **Table**: `treatments`
- **Key Attributes**:
  - `id` (UUID): Primary key.
  - `name` (string): A short, human-readable name for the treatment (e.g., `marketing-emails`).
  - `description` (string): A detailed explanation of what the data processing involves.
  - `required` (boolean): Whether this treatment is mandatory for using the service.
  - `active` (boolean): Toggles the treatment's availability.

### 2. `Consent`

The `Consent` model links a user (subject) to a specific treatment they have agreed to.

- **Table**: `consents`
- **Key Attributes**:
  - `id` (UUID): Primary key.
  - `subject_id` (string): The ID of the user who has given consent.
  - `treatment_id` (UUID): Foreign key linking to the `treatments` table.
- **Relationships**:
  - `treatment()`: A `BelongsTo` relationship to the `Treatment` model.

### 3. `Event`

The `Event` model provides a complete audit log of all consent-related activities.

- **Table**: `events`
- **Key Attributes**:
  - `id` (UUID): Primary key.
  - `action` (string): The type of event (e.g., `consent:given`, `consent:revoked`).
  - `consent_id` (UUID): Foreign key linking to the `consents` table.
  - `ip` (string, encrypted): The IP address from which the action was performed.
  - `payload` (string, encrypted): Additional data related to the event.
- **Relationships**:
  - `consent()`: A `BelongsTo` relationship to the `Consent` model.

## Core Functionality

The module's primary service, likely named `GdprService`, orchestrates the core logic:

- Checking if a user has consented to a specific treatment.
- Granting consent for a user and creating the corresponding `Consent` and `Event` records.
- Revoking consent and logging the action as an `Event`.
- Retrieving all active, required, or optional treatments.

```php
// Example: Checking consent
$hasConsented = Gdpr::hasConsent('marketing-emails', $user);

// Example: Granting consent
Gdpr::grantConsent('analytics', $user);
```

## Best Practices

- **Immutability**: Treat `Event` records as immutable. Never modify them after creation to preserve the integrity of the audit trail.
- **Security**: The `Event` model encrypts sensitive data like IP addresses and payloads. Ensure your application's `APP_KEY` is secure.
- **Clarity**: Use clear and unambiguous names and descriptions for `Treatment` records so that users understand what they are consenting to.
- **Modularity**: All business logic should be encapsulated within the module's services and actions, not in controllers or routes.

## Troubleshooting

- **Model Not Found**: Ensure all models (`Consent`, `Treatment`, `Event`) are correctly placed in the `laravel/Modules/Gdpr/app/Models/` directory and extend the module's `BaseModel`.
- **Encryption Errors**: If you encounter errors related to `Crypt`, verify that your `APP_KEY` is correctly set in your `.env` file.
- **Relationship Issues**: Double-check that foreign key constraints are correctly defined in your migrations and that relationships in the models are correctly specified.
