# Componenti del Tema Sixteen

## Panoramica

I componenti del tema Sixteen sono progettati per implementare le **Linee Guida di Design per i Servizi Digitali della Pubblica Amministrazione** utilizzando **Tailwind CSS**. Ogni componente è ottimizzato per accessibilità, usabilità e conformità agli standard italiani.

## Layout Components

### App Layout
Layout principale per le applicazioni web della PA.

```blade
<x-pub_theme::layout.app>
<<<<<<< HEAD
=======
=======
<x-sixteen::layout.app>
>>>>>>> develop
    <x-slot name="header">
        <x-pub_theme::header.main>
            <x-slot name="logo">
                <x-pub_theme::logo />
            </x-slot>
            <x-slot name="navigation">
                <x-pub_theme::navigation.main />
            </x-slot>
        </x-pub_theme::header.main>
    </x-slot>
    
    <x-slot name="sidebar">
        <x-pub_theme::sidebar.main />
    </x-slot>
    
    <x-slot name="footer">
        <x-pub_theme::footer.main />
    </x-slot>
    
    <!-- Main content -->
    <main class="flex-1">
        {{ $slot }}
    </main>
</x-pub_theme::layout.app>
<<<<<<< HEAD
=======
=======
</x-sixteen::layout.app>
>>>>>>> develop
```

**Proprietà:**
- `sidebar-collapsed`: Controlla lo stato della sidebar
- `header-fixed`: Fissa l'header in cima
- `sidebar-fixed`: Fissa la sidebar

### Container Layout
Container responsive per contenuti centrati.

```blade
<x-pub_theme::layout.container size="lg">
<<<<<<< HEAD
=======
    <div class="prose prose-lg max-w-none">
        {{ $slot }}
    </div>
</x-pub_theme::layout.container>
=======
<x-sixteen::layout.container size="lg">
>>>>>>> develop
    <div class="prose prose-lg max-w-none">
        {{ $slot }}
    </div>
</x-pub_theme::layout.container>
```

**Sizes disponibili:**
- `sm`: max-width 640px
- `md`: max-width 768px
- `lg`: max-width 1024px
- `xl`: max-width 1280px
- `2xl`: max-width 1536px

## Form Components

### Input Field
Campo di input con validazione e accessibilità.

```blade
<x-pub_theme::form.input
<<<<<<< HEAD
=======
=======
<x-sixteen::form.input
>>>>>>> develop
    name="email"
    type="email"
    label="Indirizzo Email"
    placeholder="Inserisci la tua email"
    help="L'email verrà utilizzata per accedere al sistema"
    required
    :error="$errors->first('email')"
/>
```

**Proprietà:**
- `name`: Nome del campo (obbligatorio)
- `type`: Tipo di input (text, email, password, etc.)
- `label`: Etichetta del campo
- `placeholder`: Testo placeholder
- `help`: Testo di aiuto
- `required`: Campo obbligatorio
- `disabled`: Campo disabilitato
- `error`: Messaggio di errore

### Select Field
Campo select con opzioni dinamiche.

```blade
<x-pub_theme::form.select
<<<<<<< HEAD
=======
=======
<x-sixteen::form.select
>>>>>>> develop
    name="provincia"
    label="Provincia"
    :options="$province"
    placeholder="Seleziona una provincia"
    searchable
    :error="$errors->first('provincia')"
/>
```

**Proprietà:**
- `options`: Array di opzioni o Collection
- `searchable`: Abilita ricerca nelle opzioni
- `multiple`: Selezione multipla
- `max-items`: Numero massimo di elementi selezionabili

### Textarea Field
Campo di testo multi-riga.

```blade
<x-pub_theme::form.textarea
<<<<<<< HEAD
=======
=======
<x-sixteen::form.textarea
>>>>>>> develop
    name="descrizione"
    label="Descrizione"
    placeholder="Inserisci una descrizione dettagliata"
    rows="4"
    maxlength="500"
    :error="$errors->first('descrizione')"
/>
```

### Checkbox Field
Campo checkbox con label personalizzabile.

```blade
<x-pub_theme::form.checkbox
<<<<<<< HEAD
=======
=======
<x-sixteen::form.checkbox
>>>>>>> develop
    name="privacy"
    label="Accetto la privacy policy"
    required
    :error="$errors->first('privacy')"
/>
```

### Radio Group
Gruppo di radio button.

```blade
<x-pub_theme::form.radio-group
<<<<<<< HEAD
=======
=======
<x-sixteen::form.radio-group
>>>>>>> develop
    name="tipo_utente"
    label="Tipo di utente"
    :options="[
        'admin' => 'Amministratore',
        'user' => 'Utente',
        'guest' => 'Ospite'
    ]"
    :error="$errors->first('tipo_utente')"
/>
```

## Button Components

### Primary Button
Pulsante per azioni principali.

```blade
<x-pub_theme::button.primary
<<<<<<< HEAD
=======
=======
<x-sixteen::button.primary
>>>>>>> develop
    type="submit"
    :disabled="$isLoading"
    wire:loading.attr="disabled"
>
    <x-pub_theme::icon.spinner wire:loading />
<<<<<<< HEAD
=======
    Conferma Operazione
</x-pub_theme::button.primary>
=======
    <x-sixteen::icon.spinner wire:loading />
>>>>>>> develop
    Conferma Operazione
</x-pub_theme::button.primary>
```

**Varianti:**
- `primary`: Azione principale (blu)
- `secondary`: Azione secondaria (grigio)
- `success`: Azione positiva (verde)
- `warning`: Azione di avviso (giallo)
- `danger`: Azione pericolosa (rosso)
- `info`: Azione informativa (azzurro)

### Icon Button
Pulsante con icona.

```blade
<x-pub_theme::button.icon
<<<<<<< HEAD
=======
=======
<x-sixteen::button.icon
>>>>>>> develop
    variant="primary"
    icon="heroicon-o-plus"
    aria-label="Aggiungi elemento"
/>
```

### Button Group
Gruppo di pulsanti correlati.

```blade
<x-pub_theme::button.group>
    <x-pub_theme::button.secondary>
<<<<<<< HEAD
=======
=======
<x-sixteen::button.group>
    <x-sixteen::button.secondary>
>>>>>>> develop
        Annulla
    </x-pub_theme::button.secondary>
    <x-pub_theme::button.primary>
        Salva
    </x-pub_theme::button.primary>
</x-pub_theme::button.group>
```

## Alert Components

### Success Alert
Alert per operazioni completate con successo.

```blade
<x-pub_theme::alert.success>
<<<<<<< HEAD
=======
=======
<x-sixteen::alert.success>
>>>>>>> develop
    <x-slot name="icon">
        <x-pub_theme::icon.check-circle />
    </x-slot>
    Operazione completata con successo
</x-pub_theme::alert.success>
```

### Warning Alert
Alert per avvisi e informazioni importanti.

```blade
<x-pub_theme::alert.warning>
<<<<<<< HEAD
=======
=======
<x-sixteen::alert.warning>
>>>>>>> develop
    <x-slot name="icon">
        <x-pub_theme::icon.exclamation-triangle />
    </x-slot>
    Attenzione: alcuni dati potrebbero essere incompleti
</x-pub_theme::alert.warning>
```

### Error Alert
Alert per errori e problemi.

```blade
<x-pub_theme::alert.error>
<<<<<<< HEAD
=======
=======
<x-sixteen::alert.error>
>>>>>>> develop
    <x-slot name="icon">
        <x-pub_theme::icon.x-circle />
    </x-slot>
    Si è verificato un errore durante l'operazione
</x-pub_theme::alert.error>
```

### Info Alert
Alert per informazioni generali.

```blade
<x-pub_theme::alert.info>
<<<<<<< HEAD
=======
=======
<x-sixteen::alert.info>
>>>>>>> develop
    <x-slot name="icon">
        <x-pub_theme::icon.information-circle />
    </x-slot>
    Informazione importante per l'utente
</x-pub_theme::alert.info>
```

## Card Components

### Basic Card
Card semplice per contenuti.

```blade
<x-pub_theme::card>
<<<<<<< HEAD
=======
=======
<x-sixteen::card>
>>>>>>> develop
    <x-slot name="header">
        <h3 class="text-lg font-semibold">Titolo Card</h3>
    </x-slot>
    
    <div class="prose">
        Contenuto della card con formattazione tipografica.
    </div>
    
    <x-slot name="footer">
<<<<<<< HEAD
=======
        <x-sixteen::button.group>
            <x-sixteen::button.secondary>Annulla</x-sixteen::button.secondary>
            <x-sixteen::button.primary>Salva</x-sixteen::button.primary>
        </x-sixteen::button.group>
>>>>>>> develop
        <x-pub_theme::button.group>
            <x-pub_theme::button.secondary>Annulla</x-pub_theme::button.secondary>
            <x-pub_theme::button.primary>Salva</x-pub_theme::button.primary>
        </x-pub_theme::button.group>
<<<<<<< HEAD
=======
    </x-slot>
</x-pub_theme::card>
=======
>>>>>>> develop
    </x-slot>
</x-pub_theme::card>
```

### Interactive Card
Card con interazioni.

```blade
<x-pub_theme::card.interactive>
<<<<<<< HEAD
=======
    <x-slot name="header">
        <h3 class="text-lg font-semibold">Card Interattiva</h3>
        <x-pub_theme::button.icon
=======
<x-sixteen::card.interactive>
>>>>>>> develop
    <x-slot name="header">
        <h3 class="text-lg font-semibold">Card Interattiva</h3>
        <x-pub_theme::button.icon
            variant="ghost"
            icon="heroicon-o-ellipsis-vertical"
            size="sm"
        />
    </x-slot>
    
    Contenuto della card interattiva
</x-pub_theme::card.interactive>
<<<<<<< HEAD
=======
=======
</x-sixteen::card.interactive>
>>>>>>> develop
```

## Navigation Components

### Main Navigation
Navigazione principale dell'applicazione.

```blade
<x-pub_theme::navigation.main>
    <x-pub_theme::navigation.item
<<<<<<< HEAD
=======
=======
<x-sixteen::navigation.main>
    <x-sixteen::navigation.item
>>>>>>> develop
        href="/dashboard"
        icon="heroicon-o-home"
        :active="request()->is('dashboard*')"
    >
        Dashboard
    </x-pub_theme::navigation.item>
<<<<<<< HEAD
=======
    
    <x-pub_theme::navigation.item
=======
    </x-sixteen::navigation.item>
>>>>>>> develop
    
    <x-pub_theme::navigation.item
        href="/users"
        icon="heroicon-o-users"
        :active="request()->is('users*')"
    >
        Utenti
    </x-pub_theme::navigation.item>
</x-pub_theme::navigation.main>
<<<<<<< HEAD
=======
=======
    </x-sixteen::navigation.item>
</x-sixteen::navigation.main>
>>>>>>> develop
```

### Breadcrumb
Navigazione a breadcrumb.

```blade
<x-pub_theme::navigation.breadcrumb>
    <x-pub_theme::navigation.breadcrumb-item href="/">
<<<<<<< HEAD
=======
=======
<x-sixteen::navigation.breadcrumb>
    <x-sixteen::navigation.breadcrumb-item href="/">
>>>>>>> develop
        Home
    </x-pub_theme::navigation.breadcrumb-item>
    <x-pub_theme::navigation.breadcrumb-item href="/users">
        Utenti
    </x-pub_theme::navigation.breadcrumb-item>
    <x-pub_theme::navigation.breadcrumb-item>
        Dettagli Utente
    </x-pub_theme::navigation.breadcrumb-item>
</x-pub_theme::navigation.breadcrumb>
```

## Table Components

### Data Table
Tabella dati con ordinamento e paginazione.

```blade
<x-pub_theme::table.data>
<<<<<<< HEAD
=======
=======
<x-sixteen::table.data>
>>>>>>> develop
    <x-slot name="header">
        <x-pub_theme::table.header-cell sortable="name">
            Nome
        </x-pub_theme::table.header-cell>
        <x-pub_theme::table.header-cell sortable="email">
            Email
        </x-pub_theme::table.header-cell>
        <x-pub_theme::table.header-cell sortable="created_at">
            Data Creazione
        </x-pub_theme::table.header-cell>
        <x-pub_theme::table.header-cell>
            Azioni
        </x-pub_theme::table.header-cell>
    </x-slot>
    
    @foreach($users as $user)
        <x-pub_theme::table.row>
            <x-pub_theme::table.cell>
                {{ $user->name }}
            </x-pub_theme::table.cell>
            <x-pub_theme::table.cell>
                {{ $user->email }}
            </x-pub_theme::table.cell>
            <x-pub_theme::table.cell>
                {{ $user->created_at->format('d/m/Y') }}
            </x-pub_theme::table.cell>
            <x-pub_theme::table.cell>
                <x-pub_theme::button.icon
                    variant="ghost"
                    icon="heroicon-o-pencil"
                    size="sm"
                />
            </x-pub_theme::table.cell>
        </x-pub_theme::table.row>
<<<<<<< HEAD
=======
    @endforeach
</x-pub_theme::table.data>
=======
            </x-sixteen::table.cell>
        </x-sixteen::table.row>
>>>>>>> develop
    @endforeach
</x-pub_theme::table.data>
```

## Modal Components

### Basic Modal
Modal semplice per contenuti.

```blade
<x-pub_theme::modal
<<<<<<< HEAD
=======
=======
<x-sixteen::modal
>>>>>>> develop
    name="confirm-delete"
    title="Conferma Eliminazione"
    description="Sei sicuro di voler eliminare questo elemento? Questa azione è irreversibile."
>
    <x-slot name="footer">
        <x-pub_theme::button.group>
            <x-pub_theme::button.secondary wire:click="closeModal">
<<<<<<< HEAD
=======
=======
        <x-sixteen::button.group>
            <x-sixteen::button.secondary wire:click="closeModal">
>>>>>>> develop
                Annulla
            </x-pub_theme::button.secondary>
            <x-pub_theme::button.danger wire:click="delete">
                Elimina
            </x-pub_theme::button.danger>
        </x-pub_theme::button.group>
    </x-slot>
</x-pub_theme::modal>
```

### Form Modal
Modal con form integrato.

```blade
<x-pub_theme::modal.form
<<<<<<< HEAD
=======
=======
<x-sixteen::modal.form
>>>>>>> develop
    name="edit-user"
    title="Modifica Utente"
    wire:submit="save"
>
    <x-pub_theme::form.input
<<<<<<< HEAD
=======
=======
    <x-sixteen::form.input
>>>>>>> develop
        name="name"
        label="Nome"
        wire:model="form.name"
    />
    
    <x-pub_theme::form.input
<<<<<<< HEAD
=======
=======
    <x-sixteen::form.input
>>>>>>> develop
        name="email"
        type="email"
        label="Email"
        wire:model="form.email"
    />
    
    <x-slot name="footer">
        <x-pub_theme::button.group>
            <x-pub_theme::button.secondary wire:click="closeModal">
<<<<<<< HEAD
=======
=======
        <x-sixteen::button.group>
            <x-sixteen::button.secondary wire:click="closeModal">
>>>>>>> develop
                Annulla
            </x-pub_theme::button.secondary>
            <x-pub_theme::button.primary type="submit">
                Salva
            </x-pub_theme::button.primary>
        </x-pub_theme::button.group>
    </x-slot>
</x-pub_theme::modal.form>
```

## Icon Components

### Heroicons
Icone da Heroicons.

```blade
<x-pub_theme::icon.home />
<x-pub_theme::icon.user class="w-6 h-6" />
<x-pub_theme::icon.arrow-right class="text-blue-600" />
<<<<<<< HEAD
=======
=======
<x-sixteen::icon.home />
<x-sixteen::icon.user class="w-6 h-6" />
<x-sixteen::icon.arrow-right class="text-blue-600" />
>>>>>>> develop
```

### Custom Icons
Icone personalizzate del tema.

```blade
<x-pub_theme::icon.logo class="w-8 h-8" />
<x-pub_theme::icon.flag-italy class="w-4 h-4" />
<<<<<<< HEAD
=======
=======
<x-sixteen::icon.logo class="w-8 h-8" />
<x-sixteen::icon.flag-italy class="w-4 h-4" />
>>>>>>> develop
```

## Utility Components

### Loading Spinner
Indicatore di caricamento.

```blade
<x-pub_theme::loading.spinner />
<x-pub_theme::loading.spinner size="lg" />
<x-pub_theme::loading.spinner color="primary" />
<<<<<<< HEAD
=======
=======
<x-sixteen::loading.spinner />
<x-sixteen::loading.spinner size="lg" />
<x-sixteen::loading.spinner color="primary" />
>>>>>>> develop
```

### Empty State
Stato vuoto per liste o contenuti.

```blade
<x-pub_theme::empty-state
<<<<<<< HEAD
=======
=======
<x-sixteen::empty-state
>>>>>>> develop
    icon="heroicon-o-document"
    title="Nessun documento trovato"
    description="Non ci sono documenti da visualizzare al momento."
>
    <x-pub_theme::button.primary>
<<<<<<< HEAD
=======
        Crea Primo Documento
    </x-pub_theme::button.primary>
</x-pub_theme::empty-state>
=======
    <x-sixteen::button.primary>
>>>>>>> develop
        Crea Primo Documento
    </x-pub_theme::button.primary>
</x-pub_theme::empty-state>
```

### Badge
Badge per etichette e stati.

```blade
<<<<<<< HEAD
=======
<x-sixteen::badge.success>Attivo</x-sixteen::badge.success>
<x-sixteen::badge.warning>In Attesa</x-sixteen::badge.warning>
<x-sixteen::badge.error>Errore</x-sixteen::badge.error>
<x-sixteen::badge.info>Info</x-sixteen::badge.info>
>>>>>>> develop
<x-pub_theme::badge.success>Attivo</x-pub_theme::badge.success>
<x-pub_theme::badge.warning>In Attesa</x-pub_theme::badge.warning>
<x-pub_theme::badge.error>Errore</x-pub_theme::badge.error>
<x-pub_theme::badge.info>Info</x-pub_theme::badge.info>
<<<<<<< HEAD
=======
=======
>>>>>>> develop
```

## Customizzazione

### Override Componenti
Per personalizzare un componente, creare un file nella directory `resources/views/components/` del tema:

```blade
{{-- resources/views/components/sixteen/button/primary.blade.php --}}
<button {{ $attributes->merge([
    'type' => 'button',
    'class' => 'px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2'
]) }}>
    {{ $slot }}
</button>
```

### Variabili CSS
Definire variabili CSS personalizzate:

```css
:root {
    --sixteen-primary: #0066cc;
    --sixteen-secondary: #666666;
    --sixteen-success: #28a745;
    --sixteen-warning: #ffc107;
    --sixteen-danger: #dc3545;
}
```

## Accessibilità

Tutti i componenti sono progettati per essere accessibili:

- **ARIA labels** per screen reader
- **Focus management** per navigazione da tastiera
- **Contrasto colori** conforme a WCAG 2.1 AA
- **Struttura semantica** corretta
- **Testo alternativo** per icone e immagini

## Best Practices

1. **Utilizzare sempre le traduzioni** per testi visibili
2. **Mantenere coerenza** nell'uso dei componenti
3. **Testare su diversi dispositivi** e browser
4. **Verificare accessibilità** con screen reader
5. **Ottimizzare performance** con lazy loading quando necessario

---

**Versione**: 1.0.0  
**Ultimo aggiornamento**: Gennaio 2025  
**Compatibilità**: Laravel 10+, Filament 3.x, Tailwind CSS 3.x 