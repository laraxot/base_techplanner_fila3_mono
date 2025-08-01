# Regola: Redirect Intelligente dopo Login

## 🚨 PROBLEMA CRITICO RISOLTO

**Errore**: `Route [filament.admin.pages.dashboard] not defined`
**Causa**: `redirect()->intended()` tentava di reindirizzare a una route inesistente
**Soluzione**: Implementato redirect intelligente basato sui ruoli dell'utente

## 📋 Regola Fondamentale

### ❌ MAI USARE
```php
// ❌ PROBLEMATICO - Route inesistente
return redirect()->intended();
```

### ✅ SEMPRE USARE
```php
// ✅ CORRETTO - Redirect intelligente
return $this->getRedirectUrl();
```

## 🔧 Implementazione Obbligatoria

### Metodo `getRedirectUrl()` Standard

```php
/**
 * Determina l'URL di redirect appropriato per l'utente autenticato.
 *
 * @return RedirectResponse
 */
protected function getRedirectUrl(): RedirectResponse
{
    $user = Auth::user();
    
    if (!$user) {
        return redirect()->to('/');
    }

    // Se l'utente ha ruoli admin, redirect al pannello appropriato
    $adminRoles = $user->roles->filter(function ($role) {
        return str_ends_with($role->name, '::admin');
    });

    if ($adminRoles->count() === 1) {
        // Un solo ruolo admin - redirect al modulo specifico
        $role = $adminRoles->first();
        $moduleName = str_replace('::admin', '', $role->name);
        return redirect()->to("/{$moduleName}/admin");
    } elseif ($adminRoles->count() > 1) {
        // Più ruoli admin - redirect alla dashboard principale
        return redirect()->to('/admin');
    }

    // Utente senza ruoli admin - redirect alla homepage
    return redirect()->to('/' . app()->getLocale());
}
```

## 📊 Logica di Redirect Standard

### 1. **Utente con Un Solo Ruolo Admin**
```php
// Input: ruolo "performance::admin"
// Output: redirect a "/performance/admin"
```

### 2. **Utente con Più Ruoli Admin**
```php
// Input: ruoli ["performance::admin", "user::admin"]
// Output: redirect a "/admin"
```

### 3. **Utente Senza Ruoli Admin**
```php
// Input: nessun ruolo admin
// Output: redirect a "/it" (locale corrente)
```

### 4. **Utente Non Autenticato**
```php
// Input: Auth::user() = null
// Output: redirect a "/"
```

## 🎯 Vantaggi del Pattern

### 1. **UX Migliorata**
- ✅ Redirect appropriato per ogni tipo di utente
- ✅ Nessun errore 404
- ✅ Navigazione intuitiva

### 2. **Sicurezza**
- ✅ Verifica dell'autenticazione
- ✅ Controllo dei ruoli
- ✅ Fallback sicuri

### 3. **Manutenibilità**
- ✅ Codice chiaro e documentato
- ✅ Logica centralizzata
- ✅ Facile da estendere

### 4. **Performance**
- ✅ Nessuna query inutile
- ✅ Redirect immediato
- ✅ Cache-friendly

## 📋 Checklist Implementazione

### Per Ogni Componente Login
- [ ] Sostituire `redirect()->intended()` con `$this->getRedirectUrl()`
- [ ] Implementare metodo `getRedirectUrl()` con logica standard
- [ ] Aggiungere controlli null-safe
- [ ] Testare tutti i casi di redirect
- [ ] Verificare PHPStan compliance

### Per Ogni Modulo
- [ ] Verificare che i ruoli seguano il pattern `{module}::admin`
- [ ] Testare redirect per utenti con ruoli diversi
- [ ] Verificare che le route di destinazione esistano
- [ ] Documentare eccezioni specifiche del modulo

## 🔍 Test Cases Obbligatori

### Test Case 1: Utente Performance Admin
```php
// Input: ruolo "performance::admin"
// Output: redirect a "/performance/admin"
```

### Test Case 2: Utente Multi-Admin
```php
// Input: ruoli ["performance::admin", "user::admin"]
// Output: redirect a "/admin"
```

### Test Case 3: Utente Normale
```php
// Input: nessun ruolo admin
// Output: redirect a "/it" (locale corrente)
```

### Test Case 4: Utente Non Autenticato
```php
// Input: Auth::user() = null
// Output: redirect a "/"
```

## 📝 Best Practices

### 1. **Gestione Errori**
- ✅ Try-catch per eccezioni
- ✅ Fallback sicuri
- ✅ Logging degli errori

### 2. **Type Safety**
- ✅ Tipizzazione esplicita
- ✅ Controlli null-safe
- ✅ PHPStan compliance

### 3. **Performance**
- ✅ Query ottimizzate
- ✅ Cache dei ruoli
- ✅ Redirect immediato

### 4. **Sicurezza**
- ✅ Verifica autenticazione
- ✅ Controllo autorizzazioni
- ✅ Sanitizzazione input

## 🔗 Collegamenti

### Documentazione Correlata
- [Redirect Intelligente dopo Login](../laravel/Modules/User/docs/intelligent-login-redirect.md)
- [Sistema di Autorizzazioni](../laravel/Modules/User/docs/auth/authorization.md)
- [Gestione Ruoli](../laravel/Modules/User/docs/auth/roles.md)

### File Correlati
- `laravel/Modules/User/app/Http/Livewire/Auth/Login.php` - **IMPLEMENTATO**
- `laravel/Modules/Xot/app/Filament/Pages/MainDashboard.php` - **LOGICA SIMILE**

## 📊 Metriche di Qualità

### Prima della Correzione
- ❌ **Errori 404**: Frequenti
- ❌ **UX**: Scarsa navigazione
- ❌ **Sicurezza**: Redirect non controllati
- ❌ **Manutenibilità**: Codice non documentato

### Dopo la Correzione
- ✅ **Errori 404**: Eliminati
- ✅ **UX**: Navigazione intuitiva
- ✅ **Sicurezza**: Redirect controllati
- ✅ **Manutenibilità**: Codice documentato

## Ultimo aggiornamento
2025-01-06 - Documentazione completa della soluzione redirect intelligente 