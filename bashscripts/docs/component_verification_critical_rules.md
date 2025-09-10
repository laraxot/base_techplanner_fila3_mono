# Regole Critiche per Verifica Componenti - PRIORITÀ ASSOLUTA

## ERRORE CRITICO DA NON RIPETERE MAI

**NON usare mai componenti Blade senza verificarne l'esistenza nella documentazione ufficiale!**

### Errore Commesso
```blade
{{-- ERRORE GRAVE: Componenti inesistenti --}}
<x-filament::layouts.card>
<x-filament::section>
<x-filament::input.wrapper>
<x-filament::input>
<x-filament::button>
```

**Risultato**: Internal Server Error - `Unable to locate a class or view for component [filament::layouts.card]`

## REGOLE CRITICHE - PRIORITÀ ASSOLUTA

### 1. REGOLA CRITICA - Verifica Componenti
**PRIMA di usare qualsiasi componente Blade:**

1. **Studiare documentazione ufficiale Filament**
2. **Verificare esistenza nel progetto**
3. **Testare in ambiente di sviluppo**

### 2. REGOLA - Componenti Filament Disponibili
✅ **Componenti che esistono**:
- `x-filament::card` - Card component
- `x-filament::button` - Button component
- `x-filament::badge` - Badge component
- `x-filament::icon` - Icon component
- `x-filament::loading-indicator` - Loading indicator
- `x-filament::alert` - Alert component

### 3. REGOLA - Componenti Filament NON Disponibili
❌ **NON USARE MAI**:
- `x-filament::layouts.card` - Non esiste
- `x-filament::section` - Non esiste
- `x-filament::input.wrapper` - Non esiste
- `x-filament::input` - Non esiste
- `x-filament::button` - Non esiste
- `x-filament::link` - Non esiste

### 4. REGOLA - Componenti Progetto Disponibili

#### Layout Components (x-layouts.*)
- `x-layouts.app`
- `x-layouts.guest` 
- `x-layouts.main`
- `x-layouts.marketing`
- `x-layouts.navigation`

#### UI Components (x-ui.*)
- `x-ui.button`
- `x-ui.checkbox`
- `x-ui.input`
- `x-ui.link`
- `x-ui.logo`
- `x-ui.text-link`
- `x-ui.badge`
- `x-ui.modal`

#### Standard Components (x-*)
- `x-button`
- `x-input`
- `x-checkbox`
- `x-input-label`
- `x-input-error`
- `x-primary-button`
- `x-secondary-button`
- `x-danger-button`

## Processo di Verifica OBBLIGATORIO

### 1. Verifica Componenti Esistenti
```bash
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
=======
=======
<<<<<<< HEAD
<<<<<<< HEAD
=======
<<<<<<< HEAD
<<<<<<< HEAD
>>>>>>> 7de7063d (.)
=======
=======

=======
=======
>>>>>>> ec52a6b4 (.)
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD

=======
<<<<<<< HEAD
=======
>>>>>>> f198176d (.)
<<<<<<< HEAD
=======
<<<<<<< HEAD
<<<<<<< HEAD
>>>>>>> ea169dcc (.)
<<<<<<< HEAD
=======
<<<<<<< HEAD

=======
<<<<<<< HEAD
>>>>>>> develop
=======
=======
>>>>>>> ea169dcc (.)
=======

=======
<<<<<<< HEAD
<<<<<<< HEAD
>>>>>>> ec52a6b4 (.)
=======
=======
=======
>>>>>>> 42ab2308 (.)
=======
=======
>>>>>>> 9de04485 (.)
<<<<<<< HEAD
>>>>>>> ea169dcc (.)
=======
<<<<<<< HEAD

=======
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> f52d0712 (.)
=======
>>>>>>> develop
>>>>>>> 71ff9e32 (.)
>>>>>>> ec52a6b4 (.)
>>>>>>> 85c5198c (.)

=======
=======
>>>>>>> 85c5198c (.)
<<<<<<< HEAD
>>>>>>> e9356a3a (.)
=======
>>>>>>> 42ab2308 (.)
=======
<<<<<<< HEAD
=======
>>>>>>> e9356a3a (.)
=======
>>>>>>> 42ab2308 (.)
<<<<<<< HEAD
>>>>>>> f52d0712 (.)
=======
>>>>>>> develop
>>>>>>> 71ff9e32 (.)
>>>>>>> ec52a6b4 (.)
=======
>>>>>>> 85c5198c (.)
>>>>>>> ea169dcc (.)
>>>>>>> 3c18aa7e (.)
>>>>>>> 9c02579 (.)
=======
>>>>>>> 574afe9e (.)
<<<<<<< HEAD
<<<<<<< HEAD
=======
<<<<<<< HEAD
=======
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> ec52a6b4 (.)
<<<<<<< HEAD
<<<<<<< HEAD
>>>>>>> 59901687 (.)
=======
>>>>>>> f198176d (.)
=======
<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> f52d0712 (.)
=======
>>>>>>> develop
>>>>>>> 71ff9e32 (.)
>>>>>>> ec52a6b4 (.)

=======

>>>>>>> 337c5266 (.)
>>>>>>> ea169dcc (.)
=======
>>>>>>> 59901687 (.)
>>>>>>> 85c5198c (.)
=======
>>>>>>> 9de04485 (.)
<<<<<<< HEAD
=======
>>>>>>> 59901687 (.)
>>>>>>> 85c5198c (.)
=======
>>>>>>> 59901687 (.)
=======
>>>>>>> f198176d (.)
>>>>>>> d20d0523 (.)
=======
>>>>>>> e1b46df35 (.)
>>>>>>> f71d08e230 (.)
<<<<<<< HEAD
>>>>>>> e9356a3a (.)
=======
>>>>>>> 42ab2308 (.)
=======
<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> 7de7063d (.)
=======
>>>>>>> e9356a3a (.)
=======
>>>>>>> 42ab2308 (.)
>>>>>>> f52d0712 (.)
=======
>>>>>>> e9356a3a (.)
=======
>>>>>>> 42ab2308 (.)
>>>>>>> develop
>>>>>>> 71ff9e32 (.)
>>>>>>> ec52a6b4 (.)
=======
>>>>>>> ea169dcc (.)
# Verifica componenti nel progetto
find resources/views/components -name "*.blade.php"

# Verifica componenti Filament
find vendor/filament -name "*.blade.php" | grep -E "(card|button|input)" | head -10
```

### 2. Documentazione Ufficiale
- **Filament Blade Components**: https://filamentphp.com/docs/3.x/support/blade-components/overview
- **Filament Forms**: https://filamentphp.com/docs/3.x/forms/fields/overview
- **Filament Actions**: https://filamentphp.com/docs/3.x/actions/overview

### 3. Test in Sviluppo
```bash
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
=======
=======
<<<<<<< HEAD
<<<<<<< HEAD
=======
<<<<<<< HEAD
<<<<<<< HEAD
>>>>>>> 7de7063d (.)
=======
=======

=======
=======
>>>>>>> ec52a6b4 (.)
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD

=======
<<<<<<< HEAD
=======
>>>>>>> f198176d (.)
<<<<<<< HEAD
=======
<<<<<<< HEAD
<<<<<<< HEAD
>>>>>>> ea169dcc (.)
<<<<<<< HEAD
=======
<<<<<<< HEAD

=======
<<<<<<< HEAD
>>>>>>> develop
=======
=======
>>>>>>> ea169dcc (.)
=======

=======
<<<<<<< HEAD
<<<<<<< HEAD
>>>>>>> ec52a6b4 (.)
=======
=======
=======
>>>>>>> 42ab2308 (.)
=======
=======
>>>>>>> 9de04485 (.)
<<<<<<< HEAD
>>>>>>> ea169dcc (.)
=======
<<<<<<< HEAD

=======
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> f52d0712 (.)
=======
>>>>>>> develop
>>>>>>> 71ff9e32 (.)
>>>>>>> ec52a6b4 (.)
>>>>>>> 85c5198c (.)

=======
=======
>>>>>>> 85c5198c (.)
<<<<<<< HEAD
>>>>>>> e9356a3a (.)
=======
>>>>>>> 42ab2308 (.)
=======
<<<<<<< HEAD
=======
>>>>>>> e9356a3a (.)
=======
>>>>>>> 42ab2308 (.)
<<<<<<< HEAD
>>>>>>> f52d0712 (.)
=======
>>>>>>> develop
>>>>>>> 71ff9e32 (.)
>>>>>>> ec52a6b4 (.)
=======
>>>>>>> 85c5198c (.)
>>>>>>> ea169dcc (.)
>>>>>>> 3c18aa7e (.)
>>>>>>> 9c02579 (.)
=======
>>>>>>> 574afe9e (.)
<<<<<<< HEAD
<<<<<<< HEAD
=======
<<<<<<< HEAD
=======
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> ec52a6b4 (.)
<<<<<<< HEAD
<<<<<<< HEAD
>>>>>>> 59901687 (.)
=======
>>>>>>> f198176d (.)
=======
<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> f52d0712 (.)
=======
>>>>>>> develop
>>>>>>> 71ff9e32 (.)
>>>>>>> ec52a6b4 (.)

=======

>>>>>>> 337c5266 (.)
>>>>>>> ea169dcc (.)
=======
>>>>>>> 59901687 (.)
>>>>>>> 85c5198c (.)
=======
>>>>>>> 9de04485 (.)
<<<<<<< HEAD
=======
>>>>>>> 59901687 (.)
>>>>>>> 85c5198c (.)
=======
>>>>>>> 59901687 (.)
=======
>>>>>>> f198176d (.)
>>>>>>> d20d0523 (.)
=======
>>>>>>> e1b46df35 (.)
>>>>>>> f71d08e230 (.)
<<<<<<< HEAD
>>>>>>> e9356a3a (.)
=======
>>>>>>> 42ab2308 (.)
=======
<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> 7de7063d (.)
=======
>>>>>>> e9356a3a (.)
=======
>>>>>>> 42ab2308 (.)
>>>>>>> f52d0712 (.)
=======
>>>>>>> e9356a3a (.)
=======
>>>>>>> 42ab2308 (.)
>>>>>>> develop
>>>>>>> 71ff9e32 (.)
>>>>>>> ec52a6b4 (.)
=======
>>>>>>> ea169dcc (.)
# Test componente
php artisan view:clear
php artisan config:clear
```

## Implementazione Corretta

### Login Form - Versione Corretta
```blade
<?php
declare(strict_types=1);
use function Laravel\Folio\{middleware, name};

middleware(['guest']);
name('login');
?>

<x-layouts.main>
    <div class="flex flex-col items-stretch justify-center w-screen min-h-screen py-10 sm:items-center">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            {{-- Logo e header --}}
            <div class="text-center mb-8">
                <a href="{{ url('/' . app()->getLocale()) }}" class="inline-block">
                    <x-ui.logo class="w-auto h-10 mx-auto text-gray-700 fill-current dark:text-gray-100" />
                </a>
            </div>

            {{-- Filament Widget per il login --}}
            <div class="px-10 py-8 sm:shadow-sm sm:bg-white dark:sm:bg-gray-950/50 dark:border-gray-200/10 sm:border sm:rounded-lg border-gray-200/60">
                @livewire(\Modules\User\Filament\Widget\Auth\Login::class)
            </div>
        </div>
    </div>
</x-layouts.main>
```

## Checklist per Implementazione

### Prima di Implementare
- [ ] Studiare documentazione ufficiale Filament
- [ ] Verificare componenti nel progetto
- [ ] Controllare esistenza componenti
- [ ] Testare in ambiente di sviluppo

### Durante l'Implementazione
- [ ] Usare solo componenti verificati
- [ ] Seguire convenzioni del progetto
- [ ] Testare funzionamento
- [ ] Verificare compatibilità

### Dopo l'Implementazione
- [ ] Testare in produzione
- [ ] Verificare errori
- [ ] Documentare modifiche
- [ ] Aggiornare regole

## Errori Comuni da Evitare

### 1. Usare Componenti Inesistenti
```blade
{{-- ERRATO --}}
<x-filament::layouts.card>
<x-filament::section>
<x-filament::input.wrapper>

{{-- CORRETTO --}}
<x-filament::card>
<x-layouts.main>
<x-ui.input>
```

### 2. Non Verificare Documentazione
```blade
{{-- ERRATO: Non verificare esistenza --}}
<x-filament::layouts.app>

{{-- CORRETTO: Verificare prima --}}
<x-layouts.app>
```

### 3. Non Testare in Sviluppo
```bash
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
=======
=======
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> ec52a6b4 (.)
=======
>>>>>>> ea169dcc (.)
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
=======
<<<<<<< HEAD
<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> f52d0712 (.)
=======
>>>>>>> develop
>>>>>>> 71ff9e32 (.)
>>>>>>> ec52a6b4 (.)
=======
>>>>>>> 85c5198c (.)
=======
>>>>>>> d20d0523 (.)
>>>>>>> f71d08e230 (.)
<<<<<<< HEAD
>>>>>>> e9356a3a (.)
=======
<<<<<<< HEAD
=======
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
>>>>>>> 7de7063d (.)
=======
>>>>>>> e9356a3a (.)
>>>>>>> f52d0712 (.)
=======
>>>>>>> e9356a3a (.)
>>>>>>> develop
>>>>>>> 71ff9e32 (.)
>>>>>>> ec52a6b4 (.)

# ERRATO: Non testare

=======
<<<<<<< HEAD
<<<<<<< HEAD
=======
=======
<<<<<<< HEAD
>>>>>>> ec52a6b4 (.)
<<<<<<< HEAD
=======
>>>>>>> f198176d (.)
<<<<<<< HEAD
=======
>>>>>>> 42ab2308 (.)
=======
>>>>>>> 85c5198c (.)
>>>>>>> ea169dcc (.)

# ERRATO: Non testare

=======
<<<<<<< HEAD
=======
<<<<<<< HEAD
=======
<<<<<<< HEAD
<<<<<<< HEAD
>>>>>>> f52d0712 (.)
=======
>>>>>>> develop
>>>>>>> 71ff9e32 (.)
>>>>>>> ec52a6b4 (.)
=======
=======
>>>>>>> 85c5198c (.)
=======
>>>>>>> 85c5198c (.)
<<<<<<< HEAD
>>>>>>> e9356a3a (.)
=======
>>>>>>> 42ab2308 (.)
=======
<<<<<<< HEAD
=======
>>>>>>> e9356a3a (.)
=======
>>>>>>> 42ab2308 (.)
<<<<<<< HEAD
>>>>>>> f52d0712 (.)
=======
>>>>>>> develop
>>>>>>> 71ff9e32 (.)
>>>>>>> ec52a6b4 (.)
=======
>>>>>>> 9de04485 (.)
<<<<<<< HEAD

# ERRATO: Non testare

=======
>>>>>>> 85c5198c (.)
>>>>>>> ea169dcc (.)
# ERRATO: Non testare
>>>>>>> 3c18aa7e (.)
=======
# ERRATO: Non testare
>>>>>>> 574afe9e (.)
<<<<<<< HEAD
<<<<<<< HEAD
=======
<<<<<<< HEAD
=======
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> ec52a6b4 (.)
<<<<<<< HEAD
<<<<<<< HEAD
>>>>>>> 59901687 (.)
=======
>>>>>>> f198176d (.)
=======
<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> f52d0712 (.)
=======
>>>>>>> develop
>>>>>>> 71ff9e32 (.)
>>>>>>> ec52a6b4 (.)

# ERRATO: Non testare

=======

# ERRATO: Non testare

>>>>>>> 337c5266 (.)
>>>>>>> ea169dcc (.)
=======
>>>>>>> 59901687 (.)
>>>>>>> 85c5198c (.)
=======
>>>>>>> 9de04485 (.)
<<<<<<< HEAD
=======
>>>>>>> 59901687 (.)
>>>>>>> 85c5198c (.)
=======
>>>>>>> 59901687 (.)
=======
>>>>>>> f198176d (.)
>>>>>>> d20d0523 (.)
=======
# ERRATO: Non testare
>>>>>>> e1b46df35 (.)
>>>>>>> f71d08e230 (.)
<<<<<<< HEAD
>>>>>>> e9356a3a (.)
=======
>>>>>>> 42ab2308 (.)
=======
<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> 7de7063d (.)
=======
>>>>>>> e9356a3a (.)
=======
>>>>>>> 42ab2308 (.)
>>>>>>> f52d0712 (.)
=======
>>>>>>> e9356a3a (.)
=======
>>>>>>> 42ab2308 (.)
>>>>>>> develop
>>>>>>> 71ff9e32 (.)
>>>>>>> ec52a6b4 (.)
=======
>>>>>>> ea169dcc (.)
# Usare componente senza test

# CORRETTO: Testare sempre
php artisan view:clear
php artisan config:clear
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
=======
=======
<<<<<<< HEAD
<<<<<<< HEAD
=======
<<<<<<< HEAD
<<<<<<< HEAD
>>>>>>> 7de7063d (.)
=======
=======

=======
=======
>>>>>>> ec52a6b4 (.)
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD

=======
<<<<<<< HEAD
=======
>>>>>>> f198176d (.)
<<<<<<< HEAD
=======
<<<<<<< HEAD
<<<<<<< HEAD
>>>>>>> ea169dcc (.)
<<<<<<< HEAD
=======
<<<<<<< HEAD

=======
<<<<<<< HEAD
>>>>>>> develop
=======
=======
>>>>>>> ea169dcc (.)
=======

=======
<<<<<<< HEAD
<<<<<<< HEAD
>>>>>>> ec52a6b4 (.)
=======
=======
=======
>>>>>>> 42ab2308 (.)
=======
=======
>>>>>>> 9de04485 (.)
<<<<<<< HEAD
>>>>>>> ea169dcc (.)
=======
<<<<<<< HEAD

=======
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> f52d0712 (.)
=======
>>>>>>> develop
>>>>>>> 71ff9e32 (.)
>>>>>>> ec52a6b4 (.)
>>>>>>> 85c5198c (.)

=======
=======
>>>>>>> 85c5198c (.)
<<<<<<< HEAD
>>>>>>> e9356a3a (.)
=======
>>>>>>> 42ab2308 (.)
=======
<<<<<<< HEAD
=======
>>>>>>> e9356a3a (.)
=======
>>>>>>> 42ab2308 (.)
<<<<<<< HEAD
>>>>>>> f52d0712 (.)
=======
>>>>>>> develop
>>>>>>> 71ff9e32 (.)
>>>>>>> ec52a6b4 (.)
=======
>>>>>>> 85c5198c (.)
>>>>>>> ea169dcc (.)
>>>>>>> 3c18aa7e (.)
>>>>>>> 9c02579 (.)
=======
>>>>>>> 574afe9e (.)
<<<<<<< HEAD
<<<<<<< HEAD
=======
<<<<<<< HEAD
=======
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> ec52a6b4 (.)
<<<<<<< HEAD
<<<<<<< HEAD
>>>>>>> 59901687 (.)
=======
>>>>>>> f198176d (.)
=======
<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> f52d0712 (.)
=======
>>>>>>> develop
>>>>>>> 71ff9e32 (.)
>>>>>>> ec52a6b4 (.)

=======

>>>>>>> 337c5266 (.)
>>>>>>> ea169dcc (.)
=======
>>>>>>> 59901687 (.)
>>>>>>> 85c5198c (.)
=======
>>>>>>> 9de04485 (.)
<<<<<<< HEAD
=======
>>>>>>> 59901687 (.)
>>>>>>> 85c5198c (.)
=======
>>>>>>> 59901687 (.)
=======
>>>>>>> f198176d (.)
>>>>>>> d20d0523 (.)
=======
>>>>>>> e1b46df35 (.)
>>>>>>> f71d08e230 (.)
<<<<<<< HEAD
>>>>>>> e9356a3a (.)
=======
>>>>>>> 42ab2308 (.)
=======
<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> 7de7063d (.)
=======
>>>>>>> e9356a3a (.)
=======
>>>>>>> 42ab2308 (.)
>>>>>>> f52d0712 (.)
=======
>>>>>>> e9356a3a (.)
=======
>>>>>>> 42ab2308 (.)
>>>>>>> develop
>>>>>>> 71ff9e32 (.)
>>>>>>> ec52a6b4 (.)
=======
>>>>>>> ea169dcc (.)
# Testare componente
```

## Regole da Memorizzare SEMPRE

### 1. REGOLA CRITICA - Verifica Componenti
**NON usare mai componenti Blade senza verificarne l'esistenza!**

### 2. REGOLA - Componenti Filament
- **Disponibili**: `x-filament::card`, `x-filament::button`, `x-filament::icon`
- **NON disponibili**: `x-filament::layouts.*`, `x-filament::input.*`

### 3. REGOLA - Componenti Progetto
- **Layout**: `x-layouts.*` (app, main, guest, etc.)
- **UI**: `x-ui.*` (button, input, logo, etc.)
- **Standard**: `x-*` (button, input, etc.)

### 4. REGOLA - Processo di Verifica
1. **Studiare**: Documentazione ufficiale
2. **Verificare**: Componenti nel progetto
3. **Testare**: In ambiente di sviluppo

## Conclusione

L'errore è stato causato da:
1. **Mancanza di verifica**: Non ho controllato l'esistenza dei componenti
2. **Uso di componenti inesistenti**: `x-filament::layouts.card` non esiste
3. **Mancanza di studio**: Non ho studiato la documentazione ufficiale

**Soluzione**: Verificare SEMPRE l'esistenza dei componenti prima di usarli.

---

*Regole aggiornate il: $(date)*
*Stato: Regole critiche definite*
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
=======
=======
<<<<<<< HEAD
<<<<<<< HEAD
*Priorità: CRITICA* 
=======
=======
=======
=======
=======
=======
>>>>>>> d20d0523 (.)
*Priorità: CRITICA* 
=======
*Priorità: CRITICA*
>>>>>>> 574afe9e (.)
=======
>>>>>>> ec52a6b4 (.)
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
=======
<<<<<<< HEAD
=======
>>>>>>> f198176d (.)
<<<<<<< HEAD
=======
<<<<<<< HEAD
*Priorità: CRITICA* 
>>>>>>> 3c18aa7e (.)
=======
>>>>>>> develop
*Priorità: CRITICA* 
=======
=======
=======
=======
=======
=======
>>>>>>> d20d0523 (.)
*Priorità: CRITICA* 
>>>>>>> ec52a6b4 (.)
=======
*Priorità: CRITICA*
>>>>>>> 574afe9e (.)
<<<<<<< HEAD
<<<<<<< HEAD
=======
=======
<<<<<<< HEAD
>>>>>>> ec52a6b4 (.)
>>>>>>> 59901687 (.)
=======
>>>>>>> f198176d (.)
=======
>>>>>>> 42ab2308 (.)
=======
<<<<<<< HEAD
=======
=======
>>>>>>> 85c5198c (.)
<<<<<<< HEAD
=======
>>>>>>> 9de04485 (.)
<<<<<<< HEAD
>>>>>>> ea169dcc (.)
=======
*Priorità: CRITICA* 
>>>>>>> 3c18aa7e (.)
=======
*Priorità: CRITICA*
>>>>>>> 574afe9e (.)
<<<<<<< HEAD
<<<<<<< HEAD
=======
<<<<<<< HEAD
<<<<<<< HEAD
>>>>>>> f52d0712 (.)
=======
>>>>>>> develop
>>>>>>> 71ff9e32 (.)
>>>>>>> ec52a6b4 (.)
=======
>>>>>>> 337c5266 (.)
>>>>>>> ea169dcc (.)
=======
>>>>>>> 59901687 (.)
>>>>>>> 85c5198c (.)
=======
>>>>>>> 9de04485 (.)
<<<<<<< HEAD
=======
>>>>>>> 59901687 (.)
>>>>>>> 85c5198c (.)
=======
>>>>>>> 59901687 (.)
=======
>>>>>>> f198176d (.)
>>>>>>> d20d0523 (.)
=======
*Priorità: CRITICA* 
>>>>>>> e1b46df35 (.)
>>>>>>> f71d08e230 (.)
<<<<<<< HEAD
>>>>>>> e9356a3a (.)
=======
>>>>>>> 42ab2308 (.)
=======
<<<<<<< HEAD
=======
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
=======
*Priorità: CRITICA* 
>>>>>>> 3c18aa7e (.)
=======
*Priorità: CRITICA*
>>>>>>> 574afe9e (.)
>>>>>>> 7de7063d (.)
=======
>>>>>>> e9356a3a (.)
=======
>>>>>>> 42ab2308 (.)
>>>>>>> f52d0712 (.)
=======
>>>>>>> e9356a3a (.)
=======
>>>>>>> 42ab2308 (.)
>>>>>>> develop
>>>>>>> 71ff9e32 (.)
>>>>>>> ec52a6b4 (.)
=======
>>>>>>> ea169dcc (.)
