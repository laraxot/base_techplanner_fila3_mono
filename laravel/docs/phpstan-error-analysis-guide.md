# PHPStan Error Analysis & Resolution Guide

## Overview

Questa guida analizza sistematicamente gli errori PHPStan identificati nel progetto e fornisce soluzioni generiche per risolverli secondo le convenzioni Laraxot. Gli errori sono categorizzati per tipo e ogni categoria include causa, spiegazione tecnica e soluzione standardizzata.

## Tipologie di Errori Identificati

### 1. Template Type Covariance - Relazioni Eloquent BelongsTo

**Errore:** `Template type TDeclaringModel on class BelongsTo is not covariant`

**Moduli Coinvolti:** Employee (Attendance.php, Timbratura.php)

**Causa Tecnica:**
PHPStan rileva un problema di covarianza nei tipi generici delle relazioni Eloquent. Il tipo `$this` non è covariante con il tipo specifico del modello dichiarato nel PHPDoc.

**Problema nel Codice:**
```php
/**
 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<\Modules\User\Models\User, $this>
 */
public function user(): BelongsTo
{
    return $this->belongsTo(User::class);
}
```

**Soluzione Standardizzata:**
```php
/**
 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<\Modules\User\Models\User, \Modules\Employee\Models\Attendance>
 */
public function user(): BelongsTo
{
    return $this->belongsTo(User::class);
}
```

**Regola Generale:**
- Sostituire `$this` con il nome completo della classe corrente nei tipi generici
- Utilizzare sempre il FQCN (Fully Qualified Class Name) nei PHPDoc
- Mantenere coerenza tra dichiarazione del tipo di ritorno e PHPDoc

### 2. Classi Non Trovate in PHPDoc

**Errore:** `PHPDoc tag @property contains unknown class`

**Moduli Coinvolti:** Geo (Location.php, Place.php)

**Causa Tecnica:**
Riferimenti a classi inesistenti o non più disponibili nei PHPDoc delle proprietà del modello.

**Problema nel Codice:**
```php
/**
 * @property \Modules\Fixcity\Models\Profile|null $creator
 * @property \Modules\Fixcity\Models\Profile|null $updater
 */
```

**Soluzione Standardizzata:**
```php
/**
 * @property \Modules\User\Models\User|null $creator
 * @property \Modules\User\Models\User|null $updater
 */
```

**Regola Generale:**
- Verificare l'esistenza di tutte le classi referenziate nei PHPDoc
- Sostituire classi inesistenti con classi appropriate del progetto
- Utilizzare sempre namespace completi nei PHPDoc
- Documentare le sostituzioni nelle docs del modulo

### 3. Proprietà Non Esistenti nel Modello

**Errore:** `Property 'value' does not exist in model`

**Moduli Coinvolti:** Geo (Location.php)

**Causa Tecnica:**
Proprietà dichiarata in `$appends` ma non implementata come accessor nel modello.

**Problema nel Codice:**
```php
/** @var list<string> */
protected $appends = ['value'];

// Manca l'accessor getValueAttribute()
```

**Soluzione Standardizzata:**
```php
/** @var list<string> */
protected $appends = ['value'];

/**
 * Get the value attribute.
 *
 * @return string
 */
public function getValueAttribute(): string
{
    return $this->name ?? '';
}
```

**Regola Generale:**
- Ogni proprietà in `$appends` deve avere un accessor corrispondente
- Gli accessor devono essere tipizzati correttamente
- Documentare il comportamento degli accessor nei PHPDoc

### 4. Metodi Duplicati

**Errore:** `Cannot redeclare method`

**Moduli Coinvolti:** Geo (GoogleMapsService.php)

**Causa Tecnica:**
Dichiarazione multipla dello stesso metodo nella stessa classe.

**Problema nel Codice:**
```php
public function getElevation(float $latitude, float $longitude): array
{
    // Prima implementazione
}

// ... altre righe ...

public function getElevation(float $latitude, float $longitude): array
{
    // Seconda implementazione - ERRORE
}
```

**Soluzione Standardizzata:**
- Rimuovere le dichiarazioni duplicate
- Consolidare la logica in un unico metodo
- Se necessario, creare metodi con nomi diversi per funzionalità diverse

### 5. Proprietà Non Definite

**Errore:** `Access to an undefined property`

**Moduli Coinvolti:** Geo (GoogleMapsService.php)

**Causa Tecnica:**
Accesso a proprietà non dichiarate nella classe.

**Problema nel Codice:**
```php
$response = Http::get("{$this->baseUrl}/elevation/json", [
    'key' => $this->apiKey,
]);
// $baseUrl e $apiKey non sono dichiarate
```

**Soluzione Standardizzata:**
```php
class GoogleMapsService
{
    protected string $baseUrl;
    protected string $apiKey;

    public function __construct()
    {
        $this->baseUrl = config('services.google_maps.base_url', 'https://maps.googleapis.com/maps/api');
        $this->apiKey = config('services.google_maps.api_key');
    }
}
```

### 6. Errori di Cast

**Errore:** `Cannot cast mixed to int/string`

**Moduli Coinvolti:** Lang (SyncTranslationsAction.php)

**Causa Tecnica:**
Tentativo di cast di valori `mixed` senza validazione preventiva.

**Problema nel Codice:**
```php
$value = (int) $mixedValue; // Errore se $mixedValue è mixed
```

**Soluzione Standardizzata:**
```php
use Modules\Xot\Actions\Cast\SafeIntCastAction;
use Modules\Xot\Actions\Cast\SafeStringCastAction;

$value = SafeIntCastAction::cast($mixedValue, 0);
$stringValue = SafeStringCastAction::cast($mixedValue, '');
```

### 7. Metodi Non Trovati

**Errore:** `Call to an undefined method`

**Moduli Coinvolti:** TechPlanner (ListClients.php)

**Causa Tecnica:**
Chiamata a metodi non esistenti su oggetti Builder.

**Problema nel Codice:**
```php
$query->withDistance(); // Metodo non esistente su Builder
```

**Soluzione Standardizzata:**
- Verificare la documentazione del package/trait utilizzato
- Implementare il metodo mancante se necessario
- Utilizzare scope o macro per estendere Builder

### 8. Comparazioni Sempre Vere/False

**Errore:** `Strict comparison will always evaluate to true/false`

**Moduli Coinvolti:** Xot (SafeFloatCastAction.php), Geo (OptimizeRouteAction.php)

**Causa Tecnica:**
Comparazioni logicamente impossibili dovute a tipi incompatibili.

**Problema nel Codice:**
```php
if ($floatValue !== '') // Sempre true se $floatValue è float
if (is_numeric($arrayValue)) // Sempre false se $arrayValue è array
```

**Soluzione Standardizzata:**
- Rivedere la logica di controllo dei tipi
- Utilizzare controlli appropriati per ogni tipo di dato
- Evitare comparazioni tra tipi incompatibili

## Workflow di Risoluzione

### Fase 1: Analisi
1. Identificare la categoria dell'errore
2. Localizzare il file e la riga specifica
3. Comprendere il contesto del codice

### Fase 2: Documentazione
1. Aggiornare la documentazione del modulo specifico
2. Creare collegamenti bidirezionali con questa guida
3. Documentare la motivazione della correzione

### Fase 3: Implementazione
1. Applicare la soluzione standardizzata
2. Verificare la coerenza con le convenzioni Laraxot
3. Testare la correzione

### Fase 4: Validazione
1. Eseguire PHPStan per verificare la risoluzione
2. Controllare che non siano stati introdotti nuovi errori
3. Aggiornare la documentazione se necessario

## Best Practices

1. **Tipizzazione Rigorosa**: Utilizzare sempre tipi espliciti nei PHPDoc
2. **Namespace Completi**: Utilizzare FQCN in tutti i riferimenti di classe
3. **Validazione Preventiva**: Utilizzare le SafeCastAction per i cast
4. **Documentazione Aggiornata**: Mantenere PHPDoc sincronizzati con il codice
5. **Controlli di Esistenza**: Verificare l'esistenza di classi e metodi referenziati

## Collegamenti

- [PHPStan Cast Fixes Guide](./phpstan-cast-fixes-guide.md)
- [Modules/Employee/docs/xotbase_extension_rules.md](../Modules/Employee/docs/xotbase_extension_rules.md)
- [Modules/Geo/docs/phpstan_fixes.md](../Modules/Geo/docs/phpstan_fixes.md)
- [Modules/Xot/docs/](../Modules/Xot/docs/)

*Ultimo aggiornamento: Luglio 2025*
