# Regole Layout Tema Sixteen

## REGOLA FONDAMENTALE - Layout Guest

**LEGGE ASSOLUTA**: Nel tema Sixteen usare SEMPRE `<x-layouts.guest>` per pagine auth/pubbliche.

### ✅ CORRETTO
```blade
<x-layouts.guest>
    <x-slot name="title">
        {{ __('Accedi') }}
    </x-slot>
    
    <!-- Contenuto della pagina -->
</x-layouts.guest>
```

### ❌ ERRATO
```blade
<x-layout>
    <!-- SBAGLIATO - Non esiste nel tema Sixteen -->
</x-layout>

<x-layouts.app>
    <!-- SBAGLIATO - Per pagine autenticate -->
</x-layouts.app>
```

## Motivazione

### Tema AGID-Centric
- Il tema Sixteen è **completamente AGID-compliant per default**
- `<x-layouts.guest>` include già:
  - Header istituzionale AGID
  - Breadcrumb navigation
  - Footer istituzionale
  - Skip links per accessibilità
  - Typography Titillium Web
  - Palette colori Bootstrap Italia

### Struttura Layout Sixteen
```
resources/views/layouts/
├── guest.blade.php    ✅ Per pagine pubbliche/auth
├── app.blade.php      ✅ Per pagine autenticate
├── base.blade.php     ✅ Layout base
└── navigation.blade.php ✅ Componente navigazione
```

## Componenti Disponibili

### Blocks System
```blade
<!-- Forms -->
<x-pub_theme::blocks.forms.login-card />
<x-pub_theme::blocks.forms.contact-form />

<!-- Navigation -->
<x-pub_theme::blocks.navigation.header-slim />
<x-pub_theme::blocks.navigation.header-main />
<x-pub_theme::blocks.navigation.breadcrumb />
<x-pub_theme::blocks.navigation.footer />

<!-- UI -->
<x-pub_theme::ui.logo />
<x-pub_theme::ui.card />
<x-pub_theme::ui.button />
```

## Checklist Pre-Implementazione

- [ ] Verificare che il layout sia `<x-layouts.guest>`
- [ ] Non usare `<x-layout>` generico
- [ ] Non aggiungere suffissi AGID (tutto è già AGID-compliant)
- [ ] Utilizzare componenti `pub_theme::blocks.*`
- [ ] Seguire naming conventions del tema Sixteen

## Errori Comuni

### ❌ Errore: Layout Generico
```blade
<!-- SBAGLIATO -->
<x-layout>
    <div class="min-h-screen">
        <!-- Contenuto -->
    </div>
</x-layout>
```

### ✅ Corretto: Layout Guest
```blade
<!-- GIUSTO -->
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

## Collegamenti

- [Sixteen Theme Naming Conventions](../../laravel/Themes/Sixteen/docs/sixteen-theme-naming-conventions.md)
- [Critical Rules](../../laravel/Themes/Sixteen/docs/critical-rules.md)
- [AGID Layout Usage Rules](../../laravel/Themes/Sixteen/docs/agid-layout-usage-rules.md)

## Ultimo aggiornamento
2025-01-06 