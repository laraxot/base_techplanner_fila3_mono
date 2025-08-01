# Memoria: Errore Layout Tema Sixteen (2025-01-06)

## Errore Critico Commesso
**Errore**: Ho usato `<x-layout>` invece di `<x-layouts.guest>` nel tema Sixteen.

**File**: `laravel/Themes/Sixteen/resources/views/pages/auth/login4.blade.php`

## Causa dell'Errore
- Non ho studiato la struttura del tema Sixteen prima di implementare
- Ho assunto che tutti i temi usino `<x-layout>` generico
- Non ho letto la documentazione specifica del tema Sixteen

## Soluzione Corretta

### Tema Sixteen è AGID-Centric
- **TUTTO** il tema Sixteen è già AGID-compliant per default
- `<x-layouts.guest>` include già header istituzionale, breadcrumb, footer
- **NON** serve aggiungere suffissi AGID ai nomi dei componenti

### Layout Corretto
```blade
<!-- ✅ CORRETTO -->
<x-layouts.guest>
    <x-slot name="title">
        {{ __('Accedi') }}
    </x-slot>
    
    <x-pub_theme::blocks.forms.login-card 
        title="{{ __('Accedi') }}"
        livewire-component="\Modules\User\Http\Livewire\Auth\Login"
    />
</x-layouts.guest>
```

### Layout SBAGLIATO
```blade
<!-- ❌ ERRATO -->
<x-layout>
    <div class="min-h-screen">
        <!-- Contenuto -->
    </div>
</x-layout>
```

## Lezioni Apprese

### 1. Studiare Prima di Implementare
- **SEMPRE** leggere la documentazione del tema specifico
- **SEMPRE** controllare i layout esistenti
- **SEMPRE** verificare le convenzioni di naming

### 2. Tema Sixteen Specifico
- Usare `<x-layouts.guest>` per pagine pubbliche/auth
- Usare `<x-layouts.app>` per pagine autenticate
- Tutti i componenti sono già AGID-compliant
- Non aggiungere suffissi AGID ai nomi

### 3. Componenti Disponibili
- `x-pub_theme::blocks.forms.*` per form
- `x-pub_theme::blocks.navigation.*` per navigazione
- `x-pub_theme::ui.*` per componenti UI

## Checklist Pre-Implementazione

Prima di creare qualsiasi pagina nel tema Sixteen:

- [ ] Leggere `laravel/Themes/Sixteen/docs/sixteen-theme-naming-conventions.md`
- [ ] Leggere `laravel/Themes/Sixteen/docs/critical-rules.md`
- [ ] Controllare layout esistenti in `resources/views/layouts/`
- [ ] Verificare componenti disponibili in `resources/views/components/`
- [ ] Non assumere convenzioni generiche
- [ ] Studiare la struttura specifica del tema

## File da Controllare Sempre

### Documentazione
- `laravel/Themes/Sixteen/docs/sixteen-theme-naming-conventions.md`
- `laravel/Themes/Sixteen/docs/critical-rules.md`
- `laravel/Themes/Sixteen/docs/agid-layout-usage-rules.md`

### Layout Esistenti
- `laravel/Themes/Sixteen/resources/views/layouts/guest.blade.php`
- `laravel/Themes/Sixteen/resources/views/layouts/app.blade.php`
- `laravel/Themes/Sixteen/resources/views/layouts/base.blade.php`

### Esempi di Implementazione
- `laravel/Themes/Sixteen/resources/views/pages/auth/login.blade.php`
- `laravel/Themes/Sixteen/resources/views/pages/auth/login1.blade.php`
- `laravel/Themes/Sixteen/resources/views/pages/auth/login2.blade.php`
- `laravel/Themes/Sixteen/resources/views/pages/auth/login3.blade.php`

## Regola Fondamentale
**NEL TEMA SIXTEEN USARE SEMPRE `<x-layouts.guest>` PER PAGINE AUTH/PUBBLICHE**

## Ultimo aggiornamento
2025-01-06 