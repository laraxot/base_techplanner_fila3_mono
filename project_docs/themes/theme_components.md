# Componenti dei Temi

## Panoramica

Il sistema dei temi utilizza componenti Blade per garantire la coerenza dell'interfaccia utente attraverso diversi temi. Ogni tema deve implementare i componenti base per garantire la compatibilità con il sistema CMS.

## Tema Attivo

Il tema attivo è configurato in `laravel/config/local/techplanner/xra.php`:

```php
'pub_theme' => 'Sixteen',
```

Il namespace `pub_theme::` punta automaticamente al tema attivo.

## Componenti Obbligatori

### Navigation Components

Tutti i temi devono implementare i seguenti componenti di navigazione:

#### `components/blocks/navigation/simple.blade.php`

Componente di navigazione semplice utilizzato dai blocchi CMS.

**Posizione nei temi:**
- `Themes/Sixteen/resources/views/components/blocks/navigation/simple.blade.php` ✅
- `Themes/Two/resources/views/components/blocks/navigation/simple.blade.php` ✅
- `Themes/Zero/resources/views/components/blocks/navigation/simple.blade.php` ✅

**Interfaccia Standardizzata:**
```php
$data = [
    'title' => 'Titolo della navigazione',     // opzionale
    'brand' => 'Brand Name',                   // opzionale (priorità su title in Sixteen)
    'logo' => '/path/to/logo.png',             // opzionale (solo Sixteen)
    'menu_items' => [                          // opzionale
        [
            'label' => 'Menu Item',            // testo da visualizzare
            'title' => 'Alternative Label',    // fallback per label
            'url' => '/path',                  // link di destinazione
            'external' => false,               // link esterno (target="_blank")
            'active' => false,                 // stato attivo (evidenziato)
        ],
        // ... altri item
    ],
];
```

**Note sull'Interfaccia:**
- Tutti i temi ora usano la stessa struttura `$data`
- `brand` ha priorità su `title` nel tema Sixteen
- `logo` è supportato solo nel tema Sixteen
- Fallback automatici per menu vuoti o mancanti
- Supporto per traduzioni tramite `@lang('pub_theme::navigation.*')`

## Struttura dei Componenti per Tema

### Tema Sixteen (Attivo)
- Design moderno con Tailwind CSS
- Supporto per responsive design
- Menu mobile con hamburger button
- Supporto completo per logo e branding

### Tema Two
- Design pulito e minimalista
- Supporto per dark mode
- Navigazione orizzontale semplice
- Utilizzo di Tailwind CSS

### Tema Zero (Fallback)
- Design base con CSS inline
- Compatibilità massima
- Stili embedded per indipendenza
- Fallback per situazioni di emergenza

## Risoluzione dei Problemi

### Errore "view not found"

Se si riceve l'errore `view not found: pub_theme::components.blocks.navigation.simple`:

1. **Verifica tema attivo**: Controlla `laravel/config/local/techplanner/xra.php`
2. **Verifica esistenza file**: Assicurati che il componente esista nel tema attivo
3. **Verifica namespace**: Il namespace `pub_theme::` deve puntare al tema corretto
4. **Cache**: Pulisci la cache delle view con `php artisan view:clear`

### Aggiunta di Nuovi Componenti

Per aggiungere un nuovo componente:

1. **Crea il componente nel tema attivo**
2. **Replica nei altri temi** per garantire compatibilità
3. **Documenta** il componente in questo file
4. **Aggiorna** i test se necessario

## Best Practices

### Compatibilità tra Temi
- Utilizzare gli stessi nomi di variabili `$data`
- Implementare fallback per dati mancanti
- Testare con tutti i temi disponibili

### Accessibilità
- Utilizzare attributi ARIA appropriati
- Fornire alternative testuali
- Garantire navigazione da tastiera

### Performance
- Minimizzare l'uso di CSS inline (eccetto tema Zero)
- Utilizzare classi CSS riutilizzabili
- Ottimizzare le immagini

## Changelog

### 2024-01-XX - Standardizzazione Componente Navigation Simple
- **Problema**: Errore `view not found: pub_theme::components.blocks.navigation.simple`
- **Causa**: Inconsistenza nell'interfaccia tra i temi (Sixteen usava `$items`, altri usavano `$data['menu_items']`)
- **Soluzione**: 
  - Standardizzato tema Sixteen per usare `$data['menu_items']`
  - Migliorato supporto per branding e logo in Sixteen
  - Aggiunto supporto per traduzioni con `@lang()`
  - Aggiunta documentazione dell'interfaccia standardizzata
  - Implementati fallback consistenti per tutti i temi

## Collegamenti

- [Architettura del Progetto](./architecture.md)
- [Configurazione Temi](../laravel/config/local/techplanner/xra.php)
- [Modulo CMS](../laravel/Modules/Cms/)
- [Tema Sixteen](../laravel/Themes/Sixteen/)
- [Tema Two](../laravel/Themes/Two/)
- [Tema Zero](../laravel/Themes/Zero/)
