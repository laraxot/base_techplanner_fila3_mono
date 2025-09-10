# Script di Verifica della Qualità del Codice

Questa documentazione descrive gli script utilizzati per verificare e migliorare la qualità del codice nel progetto.

## check_form_schema.php

### Descrizione
Script PHP che verifica se le classi che estendono `XotBaseResource` implementano correttamente il metodo `getFormSchema()`, essenziale per il corretto funzionamento del sistema di form.

### Posizione
```
bashscripts/check_form_schema.php
```

### Funzionalità
- Scansiona ricorsivamente i file PHP nella directory del progetto Laravel
- Identifica tutte le classi che estendono `XotBaseResource`
- Verifica la presenza del metodo `getFormSchema()`
- Genera un report delle classi che non implementano il metodo
- Crea un log di documentazione con i risultati

### Uso
```bash
php bashscripts/check_form_schema.php
```

### Output
Esempio di output:
=======
=======
Esempio di output:
<<<<<<< HEAD
=======
=======
<<<<<<< HEAD
=======
=======
<<<<<<< HEAD
>>>>>>> f52d0712 (.)
=======
>>>>>>> develop
>>>>>>> 71ff9e32 (.)
>>>>>>> ec52a6b4 (.)
```
XotBaseResource Classes Form Schema Check
====

❌ 3 classi senza getFormSchema:
- UserResource in Modules/User/Http/Resources/UserResource.php
- ProfileResource in Modules/Profile/Http/Resources/ProfileResource.php
- EventResource in Modules/Event/Http/Resources/EventResource.php
```

### Best Practice e Integrazione
- Utilizzare tipi PHP forti e annotazioni PHPDoc
- Integrare lo script nel workflow CI/CD (es. GitHub Actions, GitLab CI)
- Eseguire lo script prima di ogni commit importante e durante le review
- Preferire l'uso di Spatie Laravel Data per la validazione e la tipizzazione dei dati
- Utilizzare strumenti come PHPStan e PHP-CS-Fixer per garantire la qualità del codice

## Altri Script di Verifica della Qualità

### check_before_phpstan.sh
Esegue controlli preliminari prima dell'analisi con PHPStan.

### phpstan_docs_generator.sh
Genera la documentazione dei risultati di PHPStan.

## Raccomandazioni Generali
- Documentare sempre le regole di qualità e i criteri di accettazione
- Aggiornare la documentazione ogni volta che vengono introdotti nuovi controlli
- Integrare i controlli di qualità nel processo di sviluppo e deploy

## check_form_schema.php

### Descrizione
Script PHP che verifica se le classi che estendono `XotBaseResource` implementano correttamente il metodo `getFormSchema()`, essenziale per il corretto funzionamento del sistema di form.

### Posizione
```
bashscripts/check_form_schema.php
```

### Funzionalità
- Scansiona ricorsivamente i file PHP nella directory del progetto Laravel
- Identifica tutte le classi che estendono `XotBaseResource`
- Verifica la presenza del metodo `getFormSchema()`
- Genera un report delle classi che non implementano il metodo
- Crea un log di documentazione con i risultati

### Uso
```bash
php bashscripts/check_form_schema.php
```

### Output
Il comando genererà un output simile a:
```
XotBaseResource Classes Form Schema Check
====

❌ 3 classes missing getFormSchema method:

- UserResource in /var/www/html/base_techplanner_fila3/laravel/Modules/User/Http/Resources/UserResource.php
- ProfileResource in /var/www/html/base_techplanner_fila3/laravel/Modules/Profile/Http/Resources/ProfileResource.php
- EventResource in /var/www/html/base_techplanner_fila3/laravel/Modules/Event/Http/Resources/EventResource.php
```

### Risoluzione Conflitti Applicata
- Migliorato il codice con tipi PHP fortemente tipizzati
- Utilizzate le funzioni Safe per una maggiore sicurezza
- Aggiunta documentazione di tipo tramite annotazioni PHPDoc
- Implementati controlli più robusti con cast di tipo espliciti
- Aggiunto controllo per `SplFileInfo` per maggiore sicurezza

### Integrazione con il Workflow di Sviluppo
È consigliabile eseguire questo script:
- Prima di ogni commit importante
- Come parte del processo di CI/CD
- Durante le revisioni del codice

## Altri Script di Verifica della Qualità

### check_before_phpstan.sh
Esegue controlli preliminari prima dell'analisi con PHPStan.

# Script di Verifica della Qualità del Codice

Questa documentazione descrive gli script utilizzati per verificare e migliorare la qualità del codice nel progetto.

## check_form_schema.php

### Descrizione
Script PHP che verifica se le classi che estendono `XotBaseResource` implementano correttamente il metodo `getFormSchema()`, essenziale per il corretto funzionamento del sistema di form.

### Posizione
```
bashscripts/check_form_schema.php
```

### Funzionalità
- Scansiona ricorsivamente i file PHP nella directory del progetto Laravel
- Identifica tutte le classi che estendono `XotBaseResource`
- Verifica la presenza del metodo `getFormSchema()`
- Genera un report delle classi che non implementano il metodo
- Crea un log di documentazione con i risultati

### Uso
```bash
php bashscripts/check_form_schema.php
```

### Output
<<<<<<< HEAD
=======
Il comando genererà un output simile a:
=======
<<<<<<< HEAD
>>>>>>> f1e7ef1046 (.)
Il comando genererà un output simile a:
>>>>>>> 04d882f8f6 (.)
<<<<<<< HEAD
=======
=======
>>>>>>> ec52a6b4 (.)
```
XotBaseResource Classes Form Schema Check
====

❌ 3 classes missing getFormSchema method:

- UserResource in /var/www/html/base_techplanner_fila3/laravel/Modules/User/Http/Resources/UserResource.php
- ProfileResource in /var/www/html/base_techplanner_fila3/laravel/Modules/Profile/Http/Resources/ProfileResource.php
- EventResource in /var/www/html/base_techplanner_fila3/laravel/Modules/Event/Http/Resources/EventResource.php
```

### Risoluzione Conflitti Applicata
- Migliorato il codice con tipi PHP fortemente tipizzati
- Utilizzate le funzioni Safe per una maggiore sicurezza
- Aggiunta documentazione di tipo tramite annotazioni PHPDoc
- Implementati controlli più robusti con cast di tipo espliciti
- Aggiunto controllo per `SplFileInfo` per maggiore sicurezza

### Integrazione con il Workflow di Sviluppo
È consigliabile eseguire questo script:
- Prima di ogni commit importante
- Come parte del processo di CI/CD
- Durante le revisioni del codice

## Altri Script di Verifica della Qualità

### check_before_phpstan.sh
Esegue controlli preliminari prima dell'analisi con PHPStan.
<<<<<<< HEAD

=======
=======

=======
=======
=======
=======
=======
>>>>>>> 71ff9e32 (.)
=======
=======
=======
=======
=======
>>>>>>> d20d0523 (.)

=======
>>>>>>> 9c02579 (.)
=======
>>>>>>> 574afe9e (.)

=======
>>>>>>> 59901687 (.)
>>>>>>> 85c5198c (.)
=======
>>>>>>> 9de04485 (.)
=======
>>>>>>> 59901687 (.)
>>>>>>> 85c5198c (.)
=======
>>>>>>> 59901687 (.)
=======
>>>>>>> f198176d (.)
>>>>>>> d20d0523 (.)
>>>>>>> ec52a6b4 (.)
# Script di Verifica della Qualità del Codice

Questa documentazione descrive gli script utilizzati per verificare e migliorare la qualità del codice nel progetto.

## check_form_schema.php

### Descrizione
Script PHP che verifica se le classi che estendono `XotBaseResource` implementano correttamente il metodo `getFormSchema()`, essenziale per il corretto funzionamento del sistema di form.

### Posizione
```
bashscripts/check_form_schema.php
```

### Funzionalità
- Scansiona ricorsivamente i file PHP nella directory del progetto Laravel
- Identifica tutte le classi che estendono `XotBaseResource`
- Verifica la presenza del metodo `getFormSchema()`
- Genera un report delle classi che non implementano il metodo
- Crea un log di documentazione con i risultati
=======
<<<<<<< HEAD
=======
>>>>>>> 1831d11e78 (.)
=======
=======
>>>>>>> develop
Il comando genererà un output simile a:
>>>>>>> f52d0712 (.)
```
XotBaseResource Classes Form Schema Check
====

❌ 3 classes missing getFormSchema method:

- UserResource in /var/www/html/base_techplanner_fila3/laravel/Modules/User/Http/Resources/UserResource.php
- ProfileResource in /var/www/html/base_techplanner_fila3/laravel/Modules/Profile/Http/Resources/ProfileResource.php
- EventResource in /var/www/html/base_techplanner_fila3/laravel/Modules/Event/Http/Resources/EventResource.php
```

### Risoluzione Conflitti Applicata
- Migliorato il codice con tipi PHP fortemente tipizzati
- Utilizzate le funzioni Safe per una maggiore sicurezza
- Aggiunta documentazione di tipo tramite annotazioni PHPDoc
- Implementati controlli più robusti con cast di tipo espliciti
- Aggiunto controllo per `SplFileInfo` per maggiore sicurezza

### Integrazione con il Workflow di Sviluppo
È consigliabile eseguire questo script:
- Prima di ogni commit importante
- Come parte del processo di CI/CD
- Durante le revisioni del codice

## Altri Script di Verifica della Qualità

### check_before_phpstan.sh
Esegue controlli preliminari prima dell'analisi con PHPStan.
<<<<<<< HEAD
=======
<<<<<<< HEAD
=======
=======
=======
=======
>>>>>>> d20d0523 (.)

=======
>>>>>>> 9c02579 (.)
=======
>>>>>>> 574afe9e (.)

=======
>>>>>>> 59901687 (.)
>>>>>>> 85c5198c (.)
=======
>>>>>>> 9de04485 (.)
=======
>>>>>>> 59901687 (.)
>>>>>>> 85c5198c (.)
=======
>>>>>>> 59901687 (.)
=======
>>>>>>> f198176d (.)
>>>>>>> d20d0523 (.)
=======
=======
>>>>>>> 71ff9e32 (.)

=======
=======

=======
=======
=======
=======
>>>>>>> f52d0712 (.)
# Script di Verifica della Qualità del Codice

Questa documentazione descrive gli script utilizzati per verificare e migliorare la qualità del codice nel progetto.

## check_form_schema.php

### Descrizione
Script PHP che verifica se le classi che estendono `XotBaseResource` implementano correttamente il metodo `getFormSchema()`, essenziale per il corretto funzionamento del sistema di form.

### Posizione
```
bashscripts/check_form_schema.php
```

### Funzionalità
- Scansiona ricorsivamente i file PHP nella directory del progetto Laravel
- Identifica tutte le classi che estendono `XotBaseResource`
- Verifica la presenza del metodo `getFormSchema()`
- Genera un report delle classi che non implementano il metodo
- Crea un log di documentazione con i risultati
=======
<<<<<<< HEAD
>>>>>>> 1831d11e78 (.)
=======
>>>>>>> f52d0712 (.)
>>>>>>> ec52a6b4 (.)
Il comando genererà un output simile a:
```
XotBaseResource Classes Form Schema Check
====

❌ 3 classes missing getFormSchema method:

- UserResource in /var/www/html/base_techplanner_fila3/laravel/Modules/User/Http/Resources/UserResource.php
- ProfileResource in /var/www/html/base_techplanner_fila3/laravel/Modules/Profile/Http/Resources/ProfileResource.php
- EventResource in /var/www/html/base_techplanner_fila3/laravel/Modules/Event/Http/Resources/EventResource.php
```

### Risoluzione Conflitti Applicata
- Migliorato il codice con tipi PHP fortemente tipizzati
- Utilizzate le funzioni Safe per una maggiore sicurezza
- Aggiunta documentazione di tipo tramite annotazioni PHPDoc
- Implementati controlli più robusti con cast di tipo espliciti
- Aggiunto controllo per `SplFileInfo` per maggiore sicurezza

### Integrazione con il Workflow di Sviluppo
È consigliabile eseguire questo script:
- Prima di ogni commit importante
- Come parte del processo di CI/CD
- Durante le revisioni del codice

## Altri Script di Verifica della Qualità

### check_before_phpstan.sh
Esegue controlli preliminari prima dell'analisi con PHPStan.
<<<<<<< HEAD
=======
<<<<<<< HEAD
<<<<<<< HEAD
=======
<<<<<<< HEAD
<<<<<<< HEAD
=======
<<<<<<< HEAD
<<<<<<< HEAD
=======

>>>>>>> 3c18aa7e (.)
=======
>>>>>>> 9c02579 (.)
=======
>>>>>>> 574afe9e (.)
>>>>>>> 7de7063d (.)

=======
>>>>>>> ec52a6b4 (.)

=======
=======

=======

=======
<<<<<<< HEAD
=======
>>>>>>> f52d0712 (.)
>>>>>>> ec52a6b4 (.)
# Script di Verifica della Qualità del Codice

Questa documentazione descrive gli script utilizzati per verificare e migliorare la qualità del codice nel progetto.

## check_form_schema.php

### Descrizione
Script PHP che verifica se le classi che estendono `XotBaseResource` implementano correttamente il metodo `getFormSchema()`, essenziale per il corretto funzionamento del sistema di form.

### Posizione
```
bashscripts/check_form_schema.php
```

### Funzionalità
- Scansiona ricorsivamente i file PHP nella directory del progetto Laravel
- Identifica tutte le classi che estendono `XotBaseResource`
- Verifica la presenza del metodo `getFormSchema()`
- Genera un report delle classi che non implementano il metodo
- Crea un log di documentazione con i risultati

### Uso
```bash
php bashscripts/check_form_schema.php
```

### Output
Il comando genererà un output simile a:
```
XotBaseResource Classes Form Schema Check
====

❌ 3 classes missing getFormSchema method:

- UserResource in /var/www/html/base_techplanner_fila3/laravel/Modules/User/Http/Resources/UserResource.php
- ProfileResource in /var/www/html/base_techplanner_fila3/laravel/Modules/Profile/Http/Resources/ProfileResource.php
- EventResource in /var/www/html/base_techplanner_fila3/laravel/Modules/Event/Http/Resources/EventResource.php
```

### Risoluzione Conflitti Applicata
- Migliorato il codice con tipi PHP fortemente tipizzati
- Utilizzate le funzioni Safe per una maggiore sicurezza
- Aggiunta documentazione di tipo tramite annotazioni PHPDoc
- Implementati controlli più robusti con cast di tipo espliciti
- Aggiunto controllo per `SplFileInfo` per maggiore sicurezza

### Integrazione con il Workflow di Sviluppo
È consigliabile eseguire questo script:
- Prima di ogni commit importante
- Come parte del processo di CI/CD
- Durante le revisioni del codice

## Altri Script di Verifica della Qualità

### check_before_phpstan.sh
Esegue controlli preliminari prima dell'analisi con PHPStan.

=======
# Script di Verifica della Qualità del Codice

Questa documentazione descrive gli script utilizzati per verificare e migliorare la qualità del codice nel progetto.

## check_form_schema.php

### Descrizione
Script PHP che verifica se le classi che estendono `XotBaseResource` implementano correttamente il metodo `getFormSchema()`, essenziale per il corretto funzionamento del sistema di form.

### Posizione
```
bashscripts/check_form_schema.php
```

### Funzionalità
- Scansiona ricorsivamente i file PHP nella directory del progetto Laravel
- Identifica tutte le classi che estendono `XotBaseResource`
- Verifica la presenza del metodo `getFormSchema()`
- Genera un report delle classi che non implementano il metodo
- Crea un log di documentazione con i risultati

### Uso
```bash
php bashscripts/check_form_schema.php
```

### Output
Il comando genererà un output simile a:
```
XotBaseResource Classes Form Schema Check
====

❌ 3 classes missing getFormSchema method:

- UserResource in /var/www/html/base_techplanner_fila3/laravel/Modules/User/Http/Resources/UserResource.php
- ProfileResource in /var/www/html/base_techplanner_fila3/laravel/Modules/Profile/Http/Resources/ProfileResource.php
- EventResource in /var/www/html/base_techplanner_fila3/laravel/Modules/Event/Http/Resources/EventResource.php
```

### Risoluzione Conflitti Applicata
- Migliorato il codice con tipi PHP fortemente tipizzati
- Utilizzate le funzioni Safe per una maggiore sicurezza
- Aggiunta documentazione di tipo tramite annotazioni PHPDoc
- Implementati controlli più robusti con cast di tipo espliciti
- Aggiunto controllo per `SplFileInfo` per maggiore sicurezza

### Integrazione con il Workflow di Sviluppo
È consigliabile eseguire questo script:
- Prima di ogni commit importante
- Come parte del processo di CI/CD
- Durante le revisioni del codice

## Altri Script di Verifica della Qualità

### check_before_phpstan.sh
Esegue controlli preliminari prima dell'analisi con PHPStan.

=======
# Script di Verifica della Qualità del Codice

Questa documentazione descrive gli script utilizzati per verificare e migliorare la qualità del codice nel progetto.

## check_form_schema.php

### Descrizione
Script PHP che verifica se le classi che estendono `XotBaseResource` implementano correttamente il metodo `getFormSchema()`, essenziale per il corretto funzionamento del sistema di form.

### Posizione
```
bashscripts/check_form_schema.php
```

### Funzionalità
- Scansiona ricorsivamente i file PHP nella directory del progetto Laravel
- Identifica tutte le classi che estendono `XotBaseResource`
- Verifica la presenza del metodo `getFormSchema()`
- Genera un report delle classi che non implementano il metodo
- Crea un log di documentazione con i risultati

### Uso
```bash
php bashscripts/check_form_schema.php
```

### Output
Il comando genererà un output simile a:
```
XotBaseResource Classes Form Schema Check
====

❌ 3 classes missing getFormSchema method:

- UserResource in /var/www/html/base_techplanner_fila3/laravel/Modules/User/Http/Resources/UserResource.php
- ProfileResource in /var/www/html/base_techplanner_fila3/laravel/Modules/Profile/Http/Resources/ProfileResource.php
- EventResource in /var/www/html/base_techplanner_fila3/laravel/Modules/Event/Http/Resources/EventResource.php
```

### Risoluzione Conflitti Applicata
- Migliorato il codice con tipi PHP fortemente tipizzati
- Utilizzate le funzioni Safe per una maggiore sicurezza
- Aggiunta documentazione di tipo tramite annotazioni PHPDoc
- Implementati controlli più robusti con cast di tipo espliciti
- Aggiunto controllo per `SplFileInfo` per maggiore sicurezza

### Integrazione con il Workflow di Sviluppo
È consigliabile eseguire questo script:
- Prima di ogni commit importante
- Come parte del processo di CI/CD
- Durante le revisioni del codice

## Altri Script di Verifica della Qualità

### check_before_phpstan.sh
Esegue controlli preliminari prima dell'analisi con PHPStan.

<<<<<<< HEAD
=======

=======
<<<<<<< HEAD
>>>>>>> f000df5 (.)
=======
>>>>>>> develop

>>>>>>> 0c55086029 (.)
=======
=======

>>>>>>> f52d0712 (.)
>>>>>>> ec52a6b4 (.)
# Script di Verifica della Qualità del Codice

Questa documentazione descrive gli script utilizzati per verificare e migliorare la qualità del codice nel progetto.

## check_form_schema.php

### Descrizione
Script PHP che verifica se le classi che estendono `XotBaseResource` implementano correttamente il metodo `getFormSchema()`, essenziale per il corretto funzionamento del sistema di form.

### Posizione
```
bashscripts/check_form_schema.php
```

### Funzionalità
- Scansiona ricorsivamente i file PHP nella directory del progetto Laravel
- Identifica tutte le classi che estendono `XotBaseResource`
- Verifica la presenza del metodo `getFormSchema()`
- Genera un report delle classi che non implementano il metodo
- Crea un log di documentazione con i risultati

### Uso
```bash
php bashscripts/check_form_schema.php
```

### Output
Il comando genererà un output simile a:
```
XotBaseResource Classes Form Schema Check
====

❌ 3 classes missing getFormSchema method:

- UserResource in /var/www/html/base_techplanner_fila3/laravel/Modules/User/Http/Resources/UserResource.php
- ProfileResource in /var/www/html/base_techplanner_fila3/laravel/Modules/Profile/Http/Resources/ProfileResource.php
- EventResource in /var/www/html/base_techplanner_fila3/laravel/Modules/Event/Http/Resources/EventResource.php
```

### Risoluzione Conflitti Applicata
- Migliorato il codice con tipi PHP fortemente tipizzati
- Utilizzate le funzioni Safe per una maggiore sicurezza
- Aggiunta documentazione di tipo tramite annotazioni PHPDoc
- Implementati controlli più robusti con cast di tipo espliciti
- Aggiunto controllo per `SplFileInfo` per maggiore sicurezza

### Integrazione con il Workflow di Sviluppo
È consigliabile eseguire questo script:
- Prima di ogni commit importante
- Come parte del processo di CI/CD
- Durante le revisioni del codice

## Altri Script di Verifica della Qualità

### check_before_phpstan.sh
Esegue controlli preliminari prima dell'analisi con PHPStan.

<<<<<<< HEAD
=======
<<<<<<< HEAD
=======
# Script di Verifica della Qualità del Codice

Questa documentazione descrive gli script utilizzati per verificare e migliorare la qualità del codice nel progetto.

## check_form_schema.php

### Descrizione
Script PHP che verifica se le classi che estendono `XotBaseResource` implementano correttamente il metodo `getFormSchema()`, essenziale per il corretto funzionamento del sistema di form.

### Posizione
```
bashscripts/check_form_schema.php
```

### Funzionalità
- Scansiona ricorsivamente i file PHP nella directory del progetto Laravel
- Identifica tutte le classi che estendono `XotBaseResource`
- Verifica la presenza del metodo `getFormSchema()`
- Genera un report delle classi che non implementano il metodo
- Crea un log di documentazione con i risultati

### Uso
```bash
php bashscripts/check_form_schema.php
```

### Output
Il comando genererà un output simile a:
```
XotBaseResource Classes Form Schema Check
====

❌ 3 classes missing getFormSchema method:

- UserResource in /var/www/html/base_techplanner_fila3/laravel/Modules/User/Http/Resources/UserResource.php
- ProfileResource in /var/www/html/base_techplanner_fila3/laravel/Modules/Profile/Http/Resources/ProfileResource.php
- EventResource in /var/www/html/base_techplanner_fila3/laravel/Modules/Event/Http/Resources/EventResource.php
```

### Risoluzione Conflitti Applicata
- Migliorato il codice con tipi PHP fortemente tipizzati
- Utilizzate le funzioni Safe per una maggiore sicurezza
- Aggiunta documentazione di tipo tramite annotazioni PHPDoc
- Implementati controlli più robusti con cast di tipo espliciti
- Aggiunto controllo per `SplFileInfo` per maggiore sicurezza

### Integrazione con il Workflow di Sviluppo
È consigliabile eseguire questo script:
- Prima di ogni commit importante
- Come parte del processo di CI/CD
- Durante le revisioni del codice

## Altri Script di Verifica della Qualità

### check_before_phpstan.sh
Esegue controlli preliminari prima dell'analisi con PHPStan.

=======
# Script di Verifica della Qualità del Codice

Questa documentazione descrive gli script utilizzati per verificare e migliorare la qualità del codice nel progetto.

## check_form_schema.php

### Descrizione
Script PHP che verifica se le classi che estendono `XotBaseResource` implementano correttamente il metodo `getFormSchema()`, essenziale per il corretto funzionamento del sistema di form.

### Posizione
```
bashscripts/check_form_schema.php
```

### Funzionalità
- Scansiona ricorsivamente i file PHP nella directory del progetto Laravel
- Identifica tutte le classi che estendono `XotBaseResource`
- Verifica la presenza del metodo `getFormSchema()`
- Genera un report delle classi che non implementano il metodo
- Crea un log di documentazione con i risultati

### Uso
```bash
php bashscripts/check_form_schema.php
```

### Output
Il comando genererà un output simile a:
```
XotBaseResource Classes Form Schema Check
====

❌ 3 classes missing getFormSchema method:

- UserResource in /var/www/html/base_techplanner_fila3/laravel/Modules/User/Http/Resources/UserResource.php
- ProfileResource in /var/www/html/base_techplanner_fila3/laravel/Modules/Profile/Http/Resources/ProfileResource.php
- EventResource in /var/www/html/base_techplanner_fila3/laravel/Modules/Event/Http/Resources/EventResource.php
```

### Risoluzione Conflitti Applicata
- Migliorato il codice con tipi PHP fortemente tipizzati
- Utilizzate le funzioni Safe per una maggiore sicurezza
- Aggiunta documentazione di tipo tramite annotazioni PHPDoc
- Implementati controlli più robusti con cast di tipo espliciti
- Aggiunto controllo per `SplFileInfo` per maggiore sicurezza

### Integrazione con il Workflow di Sviluppo
È consigliabile eseguire questo script:
- Prima di ogni commit importante
- Come parte del processo di CI/CD
- Durante le revisioni del codice

## Altri Script di Verifica della Qualità

### check_before_phpstan.sh
Esegue controlli preliminari prima dell'analisi con PHPStan.

>>>>>>> f000df5 (.)
=======

>>>>>>> 0c55086029 (.)
# Script di Verifica della Qualità del Codice

Questa documentazione descrive gli script utilizzati per verificare e migliorare la qualità del codice nel progetto.

## check_form_schema.php

### Descrizione
Script PHP che verifica se le classi che estendono `XotBaseResource` implementano correttamente il metodo `getFormSchema()`, essenziale per il corretto funzionamento del sistema di form.

### Posizione
```
bashscripts/check_form_schema.php
```

### Funzionalità
- Scansiona ricorsivamente i file PHP nella directory del progetto Laravel
- Identifica tutte le classi che estendono `XotBaseResource`
- Verifica la presenza del metodo `getFormSchema()`
- Genera un report delle classi che non implementano il metodo
- Crea un log di documentazione con i risultati

### Uso
```bash
php bashscripts/check_form_schema.php
```

### Output
Il comando genererà un output simile a:
```
XotBaseResource Classes Form Schema Check
====

❌ 3 classes missing getFormSchema method:

- UserResource in /var/www/html/base_techplanner_fila3/laravel/Modules/User/Http/Resources/UserResource.php
- ProfileResource in /var/www/html/base_techplanner_fila3/laravel/Modules/Profile/Http/Resources/ProfileResource.php
- EventResource in /var/www/html/base_techplanner_fila3/laravel/Modules/Event/Http/Resources/EventResource.php
```

### Risoluzione Conflitti Applicata
- Migliorato il codice con tipi PHP fortemente tipizzati
- Utilizzate le funzioni Safe per una maggiore sicurezza
- Aggiunta documentazione di tipo tramite annotazioni PHPDoc
- Implementati controlli più robusti con cast di tipo espliciti
- Aggiunto controllo per `SplFileInfo` per maggiore sicurezza

### Integrazione con il Workflow di Sviluppo
È consigliabile eseguire questo script:
- Prima di ogni commit importante
- Come parte del processo di CI/CD
- Durante le revisioni del codice

## Altri Script di Verifica della Qualità

### check_before_phpstan.sh
Esegue controlli preliminari prima dell'analisi con PHPStan.

=======
>>>>>>> develop
>>>>>>> ec52a6b4 (.)
### phpstan_docs_generator.sh 
=======
=======
=======
<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> 0c55086029 (.)
=======
<<<<<<< HEAD
>>>>>>> f52d0712 (.)
=======
>>>>>>> develop
>>>>>>> 71ff9e32 (.)
>>>>>>> ec52a6b4 (.)
## Risorse Utili
- [PHPStan](https://phpstan.org/)
- [Spatie Laravel Data](https://spatie.be/docs/laravel-data/v4/introduction)
- [CI/CD Best Practices](https://docs.github.com/en/actions/guides/building-and-testing-php) 
<<<<<<< HEAD
=======

=======
<<<<<<< HEAD
>>>>>>> 1831d11e78 (.)
=======

>>>>>>> 0c55086029 (.)
=======
=======

<<<<<<< HEAD
>>>>>>> f52d0712 (.)
=======
>>>>>>> develop
>>>>>>> 71ff9e32 (.)
>>>>>>> ec52a6b4 (.)
=======
## PHPStan

Per mantenere alta la qualità del codice, utilizziamo PHPStan per l'analisi statica. 
<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> 04d882f8f6 (.)
=======
<<<<<<< HEAD
>>>>>>> f52d0712 (.)
=======
>>>>>>> develop
>>>>>>> 71ff9e32 (.)
>>>>>>> ec52a6b4 (.)
=======

### Uso
```bash
php bashscripts/check_form_schema.php
```

### Output
Il comando genererà un output simile a:
```
XotBaseResource Classes Form Schema Check
====

❌ 3 classes missing getFormSchema method:

- UserResource in /var/www/html/base_techplanner_fila3/laravel/Modules/User/Http/Resources/UserResource.php
- ProfileResource in /var/www/html/base_techplanner_fila3/laravel/Modules/Profile/Http/Resources/ProfileResource.php
- EventResource in /var/www/html/base_techplanner_fila3/laravel/Modules/Event/Http/Resources/EventResource.php
```

### Risoluzione Conflitti Applicata
- Migliorato il codice con tipi PHP fortemente tipizzati
- Utilizzate le funzioni Safe per una maggiore sicurezza
- Aggiunta documentazione di tipo tramite annotazioni PHPDoc
- Implementati controlli più robusti con cast di tipo espliciti
- Aggiunto controllo per `SplFileInfo` per maggiore sicurezza

### Integrazione con il Workflow di Sviluppo
È consigliabile eseguire questo script:
- Prima di ogni commit importante
- Come parte del processo di CI/CD
- Durante le revisioni del codice

## Altri Script di Verifica della Qualità

### check_before_phpstan.sh
Esegue controlli preliminari prima dell'analisi con PHPStan.
<<<<<<< HEAD
=======
<<<<<<< HEAD
=======
>>>>>>> ec52a6b4 (.)


=======
=======

<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> 59901687 (.)
>>>>>>> 85c5198c (.)
=======

>>>>>>> 9de04485 (.)
=======
=======

>>>>>>> 59901687 (.)
>>>>>>> 85c5198c (.)
=======
=======

>>>>>>> 59901687 (.)
=======

>>>>>>> f198176d (.)
>>>>>>> d20d0523 (.)
=======
>>>>>>> ec52a6b4 (.)
=======

=======
=======

=======
=======

=======

=======
<<<<<<< HEAD


=======
>>>>>>> develop


<<<<<<< HEAD
>>>>>>> f52d0712 (.)
=======
=======
=======

>>>>>>> 59901687 (.)
>>>>>>> 85c5198c (.)
=======

>>>>>>> 9de04485 (.)
=======
=======

>>>>>>> 59901687 (.)
>>>>>>> 85c5198c (.)
=======
=======

>>>>>>> 59901687 (.)
=======

>>>>>>> f198176d (.)
>>>>>>> d20d0523 (.)
>>>>>>> 71ff9e32 (.)
>>>>>>> ec52a6b4 (.)
# Script di Verifica della Qualità del Codice

Questa documentazione descrive gli script utilizzati per verificare e migliorare la qualità del codice nel progetto.

## check_form_schema.php

### Descrizione
Script PHP che verifica se le classi che estendono `XotBaseResource` implementano correttamente il metodo `getFormSchema()`, essenziale per il corretto funzionamento del sistema di form.

### Posizione
```
bashscripts/check_form_schema.php
```

### Funzionalità
- Scansiona ricorsivamente i file PHP nella directory del progetto Laravel
- Identifica tutte le classi che estendono `XotBaseResource`
- Verifica la presenza del metodo `getFormSchema()`
- Genera un report delle classi che non implementano il metodo
- Crea un log di documentazione con i risultati

### Uso
```bash
php bashscripts/check_form_schema.php
```

### Output
Il comando genererà un output simile a:
```
XotBaseResource Classes Form Schema Check
====

❌ 3 classes missing getFormSchema method:

- UserResource in /var/www/html/base_techplanner_fila3/laravel/Modules/User/Http/Resources/UserResource.php
- ProfileResource in /var/www/html/base_techplanner_fila3/laravel/Modules/Profile/Http/Resources/ProfileResource.php
- EventResource in /var/www/html/base_techplanner_fila3/laravel/Modules/Event/Http/Resources/EventResource.php
```

### Risoluzione Conflitti Applicata
- Migliorato il codice con tipi PHP fortemente tipizzati
- Utilizzate le funzioni Safe per una maggiore sicurezza
- Aggiunta documentazione di tipo tramite annotazioni PHPDoc
- Implementati controlli più robusti con cast di tipo espliciti
- Aggiunto controllo per `SplFileInfo` per maggiore sicurezza

### Integrazione con il Workflow di Sviluppo
È consigliabile eseguire questo script:
- Prima di ogni commit importante
- Come parte del processo di CI/CD
- Durante le revisioni del codice

## Altri Script di Verifica della Qualità

### check_before_phpstan.sh
Esegue controlli preliminari prima dell'analisi con PHPStan.

## Risorse Utili
- [PHPStan](https://phpstan.org/)
- [Spatie Laravel Data](https://spatie.be/docs/laravel-data/v4/introduction)
- [CI/CD Best Practices](https://docs.github.com/en/actions/guides/building-and-testing-php) 
<<<<<<< HEAD
=======
=======
=======
<<<<<<< HEAD
>>>>>>> f1e7ef1046 (.)
=======
>>>>>>> f71d08e230 (.)
=======
=======
=======
<<<<<<< HEAD
>>>>>>> f52d0712 (.)
=======
>>>>>>> develop
>>>>>>> 71ff9e32 (.)
>>>>>>> ec52a6b4 (.)
