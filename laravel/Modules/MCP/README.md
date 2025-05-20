# Modulo MCP (Model Context Protocol)

## Panoramica
Il modulo MCP è un sistema di controllo e validazione del contesto dei modelli del progetto. Aiuta a mantenere la coerenza tra i modelli e il loro contesto di utilizzo, implementando un protocollo di validazione per garantire che i modelli siano utilizzati correttamente in tutto il progetto.

## Caratteristiche Principali

### 1. Validazione del Contesto
- Verifica automatica dell'utilizzo corretto dei modelli
- Controllo delle relazioni tra modelli
- Validazione dei namespace
- Monitoraggio delle dipendenze tra modelli

### 2. Sistema di Contesto
- Cache del contesto in Redis
- Persistenza del contesto in database
- Versionamento del contesto
- Storico delle violazioni di contesto

### 3. Integrazione CI/CD
- Check automatici su pull request
- Report di violazioni di contesto
- Suggerimenti di correzione
- Blocco automatico su violazioni critiche

## Implementazione

### 1. Service Provider
```php
// /laravel/Modules/MCP/app/Providers/MCPServiceProvider.php
class MCPServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadContextRules();
        $this->registerCommands();
        $this->setupValidation();
    }

    protected function loadContextRules()
    {
        // Carica le regole di contesto da Redis o database
        $rules = $this->getContextRules();
        config(['mcp.context_rules' => $rules]);
    }
}
```

### 2. Comandi Artisan
```bash
# Verifica regole di contesto
php artisan mcp:check-context

# Aggiorna regole di contesto
php artisan mcp:update-context

# Mostra violazioni di contesto
php artisan mcp:context-violations

# Fix automatico del contesto
php artisan mcp:fix-context
```

### 3. Regole di Contesto Predefinite
```php
// /laravel/Modules/MCP/config/context_rules.php
return [
    'models' => [
        'must_extend' => 'XotBaseModel',
        'forbidden_methods' => ['save', 'delete'],
        'required_methods' => ['getContext'],
    ],
    'relationships' => [
        'must_use' => 'XotBaseRelationship',
        'forbidden_methods' => ['create', 'update'],
        'required_methods' => ['validateContext'],
    ],
    'context' => [
        'required_files' => ['context.php'],
        'forbidden_direct_access' => true,
    ],
];
```

### 4. Integrazione con IDE
- Plugin VSCode per validazione del contesto in tempo reale
- Snippets per convenzioni di contesto
- Auto-completamento basato su regole di contesto
- Quick fixes per violazioni di contesto

### 5. Dashboard di Monitoraggio
- Statistiche violazioni di contesto
- Trend di conformità del contesto
- Report periodici
- Suggerimenti di miglioramento

## Utilizzo

### 1. Verifica Manuale del Contesto
```php
use Modules\MCP\Services\ContextValidator;

$validator = app(ContextValidator::class);
$violations = $validator->checkModelContext($model);
```

### 2. Hook Pre-commit
```bash
#!/bin/bash
# .git/hooks/pre-commit

php artisan mcp:check-context
if [ $? -ne 0 ]; then
    echo "Violazioni di contesto MCP trovate. Commit bloccato."
    exit 1
fi
```

### 3. CI/CD Pipeline
```yaml
# .github/workflows/mcp-context-check.yml
name: MCP Context Check
on: [pull_request]
jobs:
  check:
    runs-on: ubuntu-latest
    steps:
      - uses: actions/checkout@v2
      - name: MCP Context Check
        run: php artisan mcp:check-context
```

## Best Practices

1. **Mantenimento Regole di Contesto**
   - Documentare ogni regola di contesto
   - Versionare le regole di contesto
   - Mantenere la retrocompatibilità
   - Aggiornare la documentazione

2. **Validazione del Contesto**
   - Eseguire check frequenti
   - Monitorare le violazioni di contesto
   - Analizzare i pattern comuni
   - Migliorare le regole di contesto

3. **Integrazione**
   - Usare gli hook git
   - Configurare CI/CD
   - Monitorare le performance
   - Aggiornare gli strumenti

## Metriche

1. **Performance**
   - Tempo di validazione del contesto
   - Utilizzo memoria
   - Cache hit rate
   - Tempo di risposta

2. **Qualità**
   - Tasso di violazioni di contesto
   - Pattern comuni
   - Trend di miglioramento
   - Copertura regole di contesto

## Contribuire

1. **Aggiungere Regole di Contesto**
   - Creare test
   - Documentare
   - Verificare performance
   - Aggiornare esempi

2. **Migliorare Validazione del Contesto**
   - Ottimizzare algoritmi
   - Aggiungere cache
   - Migliorare report
   - Estendere funzionalità 

## Regole per la signature dei comandi Artisan nei moduli

- La signature di ogni comando Artisan all'interno di un modulo deve iniziare con il nome del modulo in minuscolo, seguito da un solo `:` (due punti).
- Non usare mai riferimenti a nomi di progetto, brand o contesti specifici.
- Struttura: `[nome_modulo_minuscolo]:[azione-o-nome-comando]`
- Esempi validi:
  - `mcp:check-model`
  - `mcp:validate-batch`
  - `user:import`
  - `media:sync`
- Esempi NON validi:
  - `saluteora:mcp-server` (contiene nome progetto)
  - `mcp::server` (doppio due punti)
  - `MCP:Server` (maiuscole)
  - `mcp_server` (underscore) 
