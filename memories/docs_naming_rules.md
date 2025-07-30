# Regole Critiche per Documentazione e Sviluppo

## Regola Fondamentale: Naming Convention Docs
**TUTTI i file e le cartelle nelle directory `docs` DEVONO essere in minuscolo, con l'unica eccezione di `README.md`**

### Esempi Corretti:
- ✅ `auth_best_practices.md`
- ✅ `user_module_structure.md`
- ✅ `filament_widgets_guide.md`
- ✅ `README.md` (unica eccezione)

### Esempi Errati:
- ❌ `Auth_Best_Practices.md`
- ❌ `UserModuleStructure.md`
- ❌ `FilamentWidgetsGuide.md`

### Comandi per Correzione:
```bash
# Trova file con maiuscole nelle cartelle docs
find . -path "*/docs/*" -name "*[A-Z]*" -type f

# Rinomina file con maiuscole
find . -path "*/docs/*" -name "*[A-Z]*" -type f -exec bash -c 'mv "$1" "$(echo "$1" | tr "[:upper:]" "[:lower:]")' _ {} \;

# Trova cartelle con maiuscole nelle cartelle docs
find . -path "*/docs/*" -name "*[A-Z]*" -type d

# Rinomina cartelle con maiuscole
find . -path "*/docs/*" -name "*[A-Z]*" -type d -exec bash -c 'mv "$1" "$(echo "$1" | tr "[:upper:]" "[:lower:]")' _ {} \;
```

## Regola Critica: Verifica Componenti Prima dell'Uso

### ⚠️ REGOLA OBBLIGATORIA - Mai Usare Componenti Senza Verifica
**PRIMA di usare qualsiasi componente, DEVI sempre verificare che esista e sia registrato correttamente**

### Checklist Verifica Componenti:
1. **Controllare esistenza file**: `resources/views/components/`
2. **Verificare registrazione**: Controllare namespace del tema (es. `pub_theme`)
3. **Testare in ambiente**: Mai assumere che un componente funzioni
4. **Consultare documentazione**: Verificare sintassi e parametri corretti

### Comandi di Verifica:
```bash
# Verifica esistenza file componente
find . -name "*.blade.php" -path "*/components/*" | grep -i "nome-componente"

# Verifica registrazione componente
grep -r "Blade::component" app/
grep -r "component(" config/

# Test componente in ambiente
php artisan view:clear
php artisan config:clear
```

### Esempi di Verifica:
```bash
# Verifica layout main
ls laravel/Themes/Sixteen/resources/views/components/layouts/main.blade.php

# Verifica componente logo
ls laravel/Themes/Sixteen/resources/views/components/ui/logo.blade.php

# Verifica componente text-link
ls laravel/Themes/Sixteen/resources/views/components/ui/text-link.blade.php
```

## Regola Critica: Namespace Corretto per Temi

### ⚠️ REGOLA CRITICA - Namespace Temi
**I temi Laravel sono registrati con namespace `pub_theme`, NON con il nome del tema**

### Namespace Corretti:
```blade
<!-- ✅ CORRETTO per temi -->
<x-pub_theme::layouts.main>
<x-pub_theme::ui.logo class="w-auto h-10" />
<x-pub_theme::ui.text-link href="/register">Register</x-pub_theme::ui.text-link>

<!-- ❌ ERRATO per temi -->
<x-sixteen::layouts.main>
<x-sixteen::ui.logo class="w-auto h-10" />
<x-sixteen::ui.text-link href="/register">Register</x-sixteen::ui.text-link>
```

### Verifica Registrazione Tema:
```php
// In ThemeServiceProvider.php
$this->loadViewsFrom(__DIR__ . '/../../resources/views', 'pub_theme');
```

## Regola Critica: Estensione Classi Filament

### ⚠️ REGOLA CRITICA - Mai Estendere Classi Filament Direttamente
**NON estendere MAI le classi Filament direttamente. Estendere SEMPRE le classi XotBase con lo stesso nome**

### Estensioni Corrette:
```php
// ✅ CORRETTO - Estendere XotBase
use Modules\Xot\Filament\Pages\XotBaseDashboard;

class Dashboard extends XotBaseDashboard
{
    // Implementazione
}

// ✅ CORRETTO - Estendere XotBase
use Modules\Xot\Providers\Filament\XotBasePanelProvider;

class AdminPanelProvider extends XotBasePanelProvider
{
    // Implementazione
}

// ✅ CORRETTO - Estendere XotBase
use Modules\Xot\Filament\Resources\XotBaseResource;

class EmployeeResource extends XotBaseResource
{
    // Implementazione
}
```

### Estensioni Errate:
```php
// ❌ ERRATO - Estendere Filament direttamente
use Filament\Pages\Dashboard;

class Dashboard extends Dashboard
{
    // Implementazione
}

// ❌ ERRATO - Estendere Filament direttamente
use Filament\Panel;

class AdminPanelProvider extends Panel
{
    // Implementazione
}

// ❌ ERRATO - Estendere Filament direttamente
use Filament\Resources\Resource;

class EmployeeResource extends Resource
{
    // Implementazione
}
```

### Struttura XotBase:
- **Pages**: `Modules\Xot\Filament\Pages\XotBaseDashboard`
- **Resources**: `Modules\Xot\Filament\Resources\XotBaseResource`
- **Providers**: `Modules\Xot\Providers\Filament\XotBasePanelProvider`
- **Widgets**: `Modules\Xot\Filament\Widgets\XotBaseWidget`

### Motivazione:
- **Consistenza**: Tutti i moduli estendono le stesse classi base
- **Funzionalità**: Le classi XotBase includono funzionalità aggiuntive
- **Manutenibilità**: Modifiche centralizzate nelle classi base
- **Integrazione**: Sistema unificato per tutti i moduli

## Regola Critica: Componenti Livewire Filament per Autenticazione

### Per Form Complessi (come Login) - Usare Componenti Livewire Filament
**Per form complessi come l'autenticazione, è MEGLIO usare i componenti Livewire Filament invece di Volt**

### Struttura Corretta:
```blade
<!-- ✅ CORRETTO per form complessi -->
@livewire(\Modules\User\Http\Livewire\Auth\Login::class)
```

### Componente Esistente:
- **File**: `laravel/Modules/User/app/Http/Livewire/Auth/Login.php`
- **Namespace**: `Modules\User\Http\Livewire\Auth`
- **Implementa**: `HasForms` e usa `InteractsWithForms`
- **View**: `user::livewire.auth.login`

### Quando Usare Componenti Livewire vs Volt:
- ✅ **Componenti Livewire Filament**: Form complessi (login, registrazione, profilo)
- ✅ **Volt**: Componenti semplici (bottoni, link, display)

### Regola di Separazione:
- **Frontoffice**: Usare `x-pub_theme::layouts.main` e componenti `x-pub_theme::ui.*`
- **Backoffice**: Usare componenti `x-filament::*`
- **Componenti Livewire Filament**: Possono essere usati in entrambi i contesti con `@livewire()`

### Esempio Corretto Login:
```blade
<?php
use function Laravel\Folio\{middleware, name};

middleware(['guest']);
name('login');
?>

<x-pub_theme::layouts.main>
    <x-slot name="title">
        {{ __('auth.login.title') }}
    </x-slot>

    <div class="flex flex-col items-center justify-center min-h-screen py-10">
        <div class="w-full max-w-md">
            <x-pub_theme::ui.logo class="w-auto h-10 text-gray-700 fill-current dark:text-gray-100 mx-auto mb-6" />
            
            <h2 class="mt-5 text-2xl font-extrabold leading-9 text-center text-gray-800 dark:text-gray-200">
                {{ __('auth.login.title') }}
            </h2>
        </div>

        <div class="mt-8 w-full max-w-md">
            <div class="px-10 py-8 bg-white dark:bg-gray-950/50 border border-gray-200/60 dark:border-gray-200/10 rounded-lg shadow-sm">
                @livewire(\Modules\User\Http\Livewire\Auth\Login::class)
            </div>
        </div>
    </div>
</x-pub_theme::layouts.main>
```

### Motivazione:
- **Componenti Livewire Filament**: Validazione integrata, gestione errori avanzata, componenti form robusti
- **Volt**: Più semplice per componenti base, meno overhead per funzionalità semplici
- **Separazione**: Frontoffice usa layout e componenti del tema, componenti Livewire Filament per logica complessa

## Regola Critica: Gestione Errori Componenti

### Quando un Componente Non Esiste:
1. **ERRORE GRAVE**: `Unable to locate a class or view for component`
2. **CAUSA**: Componente non registrato o percorso sbagliato
3. **SOLUZIONE**: Verificare esistenza e registrazione del componente
4. **PREVENZIONE**: Mai assumere che un componente esista

### Checklist Gestione Errori:
- [ ] Verificare esistenza file componente
- [ ] Controllare registrazione in ServiceProvider
- [ ] Verificare namespace e percorso
- [ ] Testare in ambiente di sviluppo
- [ ] Documentare componenti disponibili

---
*Regole critiche da rispettare sempre - Mai usare componenti senza verifica - Mai fidarsi delle assunzioni - Mai estendere classi Filament direttamente* 