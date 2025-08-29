# Componente Footer

## Descrizione
Il componente Footer è un elemento fondamentale dell'interfaccia utente che fornisce la navigazione secondaria e le informazioni di contatto del sito. Include il logo, menu di navigazione multipli, copyright e link ai social media.

## Problema Identificato (2025-01-06)
**ERRORE CRITICO**: Il componente footer presenta un errore di riferimento view che impedisce il corretto funzionamento:
- **View cercata**: `cms::components.footer` (nel FooterData.php)
- **View corretta**: `cms::components.footer.default` (percorso corretto)
- **Errore**: `The view [cms::components.footer] does not exist`

### Causa del Problema
Il file `Modules/Cms/app/Datas/FooterData.php` alla linea 26 definisce:
```php
public $view = 'cms::components.footer';
```

Questa view non esiste perché il namespace `cms::components.footer` punta a un file che non esiste. La struttura corretta è:
- `Modules/Cms/resources/views/components/footer/default.blade.php`
- Che corrisponde al namespace: `cms::components.footer.default`

### Soluzione Implementata
1. **Correggere il FooterData.php**: Cambiare la proprietà `$view` da `'cms::components.footer'` a `'cms::components.footer.default'`
2. **Verificare la struttura**: I file footer esistono nella cartella corretta
3. **Aggiornare la documentazione**: Riflettere la correzione

## Struttura del Componente

### File Template
- **Percorso**: `Modules/Cms/resources/views/components/footer/default.blade.php`
- **Namespace**: `cms::components.footer.default`
- **Tipo**: Componente Blade con parametri dinamici
- **Responsive**: Sì, si adatta a tutti i dispositivi

### Varianti Disponibili
- `default.blade.php`: Footer standard con logo e menu
- `empty.blade.php`: Footer vuoto per personalizzazioni
- `footer_with_logo.blade.php`: Footer esteso con logo prominente
- `social_media_icons.blade.php`: Footer con social media

### Parametri Accettati
- `background_color`: Colore di sfondo del footer
- `text_color`: Colore del testo
- `logo`: URL del logo da visualizzare
- `menu_items`: Array di elementi del menu
- `social_links`: Array di link ai social media
- `copyright_text`: Testo del copyright

## Utilizzo

### In Blade Templates
```blade
<x-cms::components.footer 
    :background-color="$footerData->background_color"
    :text-color="$footerData->text_color"
    :logo="$footerData->logo"
    :menu-items="$footerData->menu_items"
    :social-links="$footerData->social_links"
    :copyright-text="$footerData->copyright_text"
/>
```

### In Livewire Components
```php
public function render()
{
    return view('livewire.footer', [
        'footerData' => FooterData::from($this->footer)
    ]);
}
```

## Styling e Personalizzazione

### Classi CSS Principali
- `.cms-footer`: Container principale del footer
- `.cms-footer-logo`: Area del logo
- `.cms-footer-menu`: Menu di navigazione
- `.cms-footer-social`: Link ai social media
- `.cms-footer-copyright`: Area copyright

### Variabili CSS Personalizzabili
```css
:root {
    --cms-footer-bg: var(--footer-bg, #1f2937);
    --cms-footer-text: var(--footer-text, #f9fafb);
    --cms-footer-link: var(--footer-link, #d1d5db);
    --cms-footer-link-hover: var(--footer-link-hover, #ffffff);
}
```

## Responsive Design

### Breakpoint Mobile (< 768px)
- Logo centrato
- Menu a colonna singola
- Social link in riga
- Copyright centrato

### Breakpoint Tablet (768px - 1024px)
- Layout a 2 colonne
- Menu distribuito
- Social link in riga

### Breakpoint Desktop (> 1024px)
- Layout a 4 colonne
- Menu completo
- Social link distribuiti

## Accessibilità

### ARIA Labels
- `aria-label="Footer principale"`
- `aria-label="Menu di navigazione"`
- `aria-label="Link social media"`

### Navigazione Tastiera
- Tab order logico
- Focus visibile
- Skip links per screen reader

## Performance

### Ottimizzazioni Implementate
- Lazy loading per immagini
- CSS critico inline
- JavaScript non bloccante
- Cache delle view

### Metriche Target
- First Contentful Paint: < 1.5s
- Largest Contentful Paint: < 2.5s
- Cumulative Layout Shift: < 0.1

## Troubleshooting

### Problemi Comuni
1. **View non trovata**: Verificare nome file `default.blade.php`
2. **Parametri mancanti**: Controllare passaggio dati
3. **Styling errato**: Verificare CSS e variabili

### Debug
```php
// Verificare esistenza view
if (view()->exists('cms::components.footer')) {
    echo "View footer esiste";
} else {
    echo "View footer NON esiste";
}

// Verificare parametri
dd($footerData->toArray());
```

## Collegamenti Correlati
- [Troubleshooting](troubleshooting.md) - Problemi comuni e soluzioni
- [Componenti UI](../ui_components.md) - Panoramica componenti
- [Layout](../layouts.md) - Strutture layout disponibili

---
**Ultimo aggiornamento**: 2025-01-06
**Versione**: 2.0
**Stato**: ✅ Problema risolto - File rinominato correttamente

