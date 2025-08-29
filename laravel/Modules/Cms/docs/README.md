# Modulo Cms - Content Management System

## Panoramica
Il modulo Cms gestisce il sistema di gestione dei contenuti dell'applicazione, fornendo funzionalità per la gestione di menu, sezioni e contenuti dinamici.

## Struttura del Modulo

### Directory Principali
```
laravel/Modules/Cms/
├── app/
│   ├── Filament/
│   │   └── Resources/
│   │       ├── MenuResource.php
│   │       └── SectionResource.php
│   ├── Models/
│   └── Providers/
├── config/
├── database/
├── docs/
├── lang/
└── resources/
```

### Namespace
- **Principale**: `Modules\Cms`
- **Filament**: `Modules\Cms\Filament`
- **Models**: `Modules\Cms\Models`
- **Providers**: `Modules\Cms\Providers`

## Funzionalità Principali

### 1. Gestione Menu
- Creazione e gestione di menu dinamici
- Struttura gerarchica dei menu
- Supporto per localizzazione

### 2. Gestione Sezioni
- Creazione di sezioni di contenuto
- Layout flessibili e configurabili
- Integrazione con il sistema di temi

### 3. Content Management
- Editor di contenuti avanzato
- Gestione delle versioni
- Workflow di approvazione

## Architettura Filament

### Regole di Estensione
- **TUTTE** le risorse estendono `XotBaseResource`
- **TUTTE** le pagine estendono le classi XotBase appropriate
- **MAI** estendere direttamente le classi Filament

### Risorse Implementate
- `MenuResource`: Gestione menu dinamici
- `SectionResource`: Gestione sezioni di contenuto

## Stato Attuale e Problemi

### ✅ Corretto
- `MenuResource.php`: Estende correttamente `XotBaseResource`
- `SectionResource.php`: Estende correttamente `XotBaseResource`
- Pagine Section: Estendono correttamente le classi XotBase

### ❌ Da Correggere
- `CreateMenu.php`: Estende `CreateRecord` → Deve estendere `XotBaseCreateRecord`
- `EditMenu.php`: Estende `EditRecord` → Deve estendere `XotBaseEditRecord`

## Correzioni Necessarie

### Priorità Alta
1. **CreateMenu.php**: Correggere estensione classe
2. **EditMenu.php**: Correggere estensione classe
3. Verifica PHPStan livello 10
4. Test funzionali post-correzione

### Impatto
- Conformità alle regole architetturali XotBase
- Migliore manutenibilità del codice
- Consistenza con il resto del progetto

## Testing e Qualità

### PHPStan
```bash
# Verifica livello 10
./vendor/bin/phpstan analyse laravel/Modules/Cms/ --level=10
```

### Test Funzionali
```bash
# Test specifico per il modulo
php artisan test --testsuite=Cms

# Test di regressione
php artisan test --filter=Cms
```

## Documentazione Correlata

### Modulo Specifico
- [Filament Resources](filament-resources.md) - Risorse Filament e loro configurazione
- [Architettura](architecture.md) - Architettura del modulo e design patterns
- [API](api.md) - Endpoint API e documentazione

### Progetto Root
- [Regole XotBase Extension](../../.ai/guidelines/xotbase-extension-rules.md)
- [Architettura Filament](../../.ai/guidelines/FILAMENT.md)
- [Regole di Sviluppo Generali](../../docs/laraxot.md)

### Moduli Correlati
- [Modulo UI](../UI/docs/README.md) - Componenti di interfaccia
- [Modulo Xot](../Xot/docs/README.md) - Classi base e utilities
- [Modulo Theme](../Theme/docs/README.md) - Gestione temi

## Manutenzione e Aggiornamenti

### Checklist Aggiornamento
- [ ] Verifica conformità XotBase per nuove risorse
- [ ] Aggiornamento documentazione per modifiche
- [ ] Test funzionali post-modifiche
- [ ] Verifica PHPStan livello 10
- [ ] Aggiornamento collegamenti bidirezionali

### Note Importanti
- Mantenere sempre la conformità alle regole XotBase
- Documentare ogni modifica significativa
- Aggiornare i collegamenti bidirezionali
- Testare sempre le modifiche prima del commit

## Collegamenti Bidirezionali

### Documentazione Root
- [README](../../docs/README.md) - Documentazione principale del progetto
- [Laraxot](../../docs/laraxot.md) - Framework e convenzioni
- [Filament Best Practices](../../docs/filament-best-practices.md)

### Moduli Correlati
- [UI](../UI/docs/README.md) - Componenti di interfaccia
- [Xot](../Xot/docs/README.md) - Classi base e utilities
- [Theme](../Theme/docs/README.md) - Gestione temi

---

*Ultimo aggiornamento: Gennaio 2025*
*Stato: Correzioni necessarie per CreateMenu e EditMenu*
*Versione: 1.0*

