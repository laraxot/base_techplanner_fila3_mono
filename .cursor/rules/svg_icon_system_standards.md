# Regola AI: Sistema Icone SVG Laraxot

## Regola Fondamentale
**OGNI modulo Laraxot DEVE avere almeno `icon.svg` nella cartella `resources/svg/` con standard Heroicon outline, tema dark ready e animazioni CSS.**

## Principi Obbligatori

### 1. Struttura Standardizzata
```
laravel/Modules/{ModuleName}/resources/svg/
├── icon.svg              # Icona principale del modulo (OBBLIGATORIA)
├── icon1.svg             # Prima variante (OPZIONALE)
├── icon2.svg             # Seconda variante (OPZIONALE)
├── icon3.svg             # Terza variante (OPZIONALE)
├── {functionality}.svg   # Icone per funzionalità specifiche
└── .gitkeep              # Mantiene la cartella nel repository
```

### 2. Standard di Design
- **Stile**: Heroicon outline (stroke, no fill)
- **Tema**: Dark ready con `currentColor`
- **Animazioni**: CSS transitions e hover effects
- **ViewBox**: `viewBox="0 0 24 24"` standard
- **Stroke**: `stroke-width="1.5"` consistente

### 3. Template Base Obbligatorio
```svg
<svg xmlns="http://www.w3.org/2000/svg" 
     fill="none" 
     viewBox="0 0 24 24" 
     stroke-width="1.5" 
     stroke="currentColor" 
     class="w-6 h-6 transition-all duration-200 hover:scale-110 hover:stroke-2">
    <!-- Path dell'icona -->
</svg>
```

## Moduli con Icone Implementate ✅

### Employee Module
- **Stato**: ✅ Complete e implementate
- **File**: `icon.svg`, `icon1.svg`, `icon2.svg`, `logo.svg`
- **Specifiche**: `employee-icon.svg`, `employee-icon1.svg`, `employee-icon2.svg`

### Xot Module
- **Stato**: ✅ Complete e implementate con aggiornamento 2025-01-06
- **File**: `icon.svg`, `logo.svg` (aggiornato con animazioni framework)
- **Funzionalità**: Cache, config, database, health, log, module, session, terminal
- **Animazioni**: Core pulse, module orbit, connection flow, framework glow

### User Module
- **Stato**: ✅ Complete e implementate con aggiornamento 2025-01-06
- **File**: `icon.svg`, `logo.svg` (aggiornato con animazioni utente)
- **Funzionalità**: User, permission, role, team, profile, social, token
- **Animazioni**: Breathe, gentle glow, connect pulse

### Media Module
- **Stato**: ✅ Aggiornato 2025-01-06
- **File**: `icon.svg`, `logo.svg` (aggiornato con animazioni camera)
- **Animazioni**: Focus adjust, aperture spin, flash blink, wave flow

### Notify Module
- **Stato**: ✅ Aggiornato 2025-01-06
- **File**: `icon.svg`, `logo.svg` (aggiornato con animazioni notifiche)
- **Animazioni**: Bell ring, notification wave, pulse alert, sound ripple

### Tenant Module
- **Stato**: ✅ Aggiornato 2025-01-06
- **File**: `icon.svg`, `logo.svg` (aggiornato con animazioni multi-tenant)
- **Animazioni**: Building glow, network pulse, connection flow, isolation shield

### Lang Module
- **Stato**: ✅ Aggiornato 2025-01-06
- **File**: `icon.svg`, `logo.svg` (aggiornato con animazioni localizzazione)
- **Animazioni**: Globe rotate, text flow, translate pulse, flag wave

### Job Module
- **Stato**: ✅ Aggiornato 2025-01-06
- **File**: `icon.svg`, `logo.svg` (aggiornato con animazioni code di lavoro)
- **Animazioni**: Queue process, worker activity, progress flow, status blink

## Moduli da Verificare e Implementare

### Priorità Alta
- **Tenant**: Verificare esistenza `icon.svg`
- **UI**: Verificare esistenza `icon.svg`
- **Notify**: Verificare esistenza `icon.svg`

### Priorità Media
- **Media**: Verificare esistenza `icon.svg`
- **Lang**: Verificare esistenza `icon.svg`
- **Job**: Verificare esistenza `icon.svg`

### Priorità Bassa
- **Geo**: Verificare esistenza `icon.svg`
- **Gdpr**: Verificare esistenza `icon.svg`
- **Activity**: Verificare esistenza `icon.svg`
- **Cms**: Verificare esistenza `icon.svg`
- **Chart**: Verificare esistenza `icon.svg`
- **TechPlanner**: Verificare esistenza `icon.svg`

## Checklist Implementazione Icone

### Prima di Creare Icone
- [ ] Verificare esistenza cartella `resources/svg/`
- [ ] Controllare se esiste già `icon.svg`
- [ ] Studiare design delle icone esistenti
- [ ] Pianificare varianti numerate se necessario

### Durante la Creazione
- [ ] Seguire template base obbligatorio
- [ ] Utilizzare stile Heroicon outline
- [ ] Implementare tema dark ready
- [ ] Aggiungere animazioni CSS
- [ ] Testare su diversi temi

### Dopo la Creazione
- [ ] Validare sintassi SVG
- [ ] Testare rendering in Filament
- [ ] Verificare animazioni e transizioni
- [ ] Aggiornare documentazione
- [ ] Testare su tema dark e light

## Utilizzo nelle Risorse Filament

### 1. Navigazione
```php
'navigation' => [
    'label' => 'Nome Modulo',
    'group' => 'Gruppo Modulo',
    'icon' => '{module-name}-icon', // Icona personalizzata
    'sort' => 50,
],
```

### 2. Risorse
```php
class ModuleResource extends XotBaseResource
{
    protected static ?string $navigationIcon = '{module-name}-icon';
    
    // ... resto della classe
}
```

### 3. Pagine
```php
class ListModule extends XotBaseListRecords
{
    protected static ?string $navigationIcon = '{module-name}-icon1';
    
    // ... resto della classe
}
```

## CSS per Animazioni

### 1. Transizioni Base
```css
.{module-name}-icon {
    transition: all 0.2s ease-in-out;
}

.{module-name}-icon:hover {
    transform: scale(1.1);
    stroke-width: 2;
}
```

### 2. Animazioni Avanzate
```css
.{module-name}-icon {
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.{module-name}-icon:hover {
    transform: scale(1.15) rotate(5deg);
    stroke-width: 2;
    filter: drop-shadow(0 4px 8px rgba(0, 0, 0, 0.3));
}
```

## Integrazione con XotBaseServiceProvider

### Registrazione Automatica
- **XotBaseServiceProvider**: Registra automaticamente tutte le icone SVG
- **BladeIconsFactory**: Gestisce il rendering delle icone
- **Prefisso Modulo**: Aggiunge automaticamente il prefisso del modulo

### Esempio di Utilizzo
```blade
<x-icon name="employee-icon" class="w-6 h-6" />
<x-icon name="user-main" class="w-8 h-8 text-blue-500" />
<x-icon name="xot-module" class="w-5 h-5" />
```

## Troubleshooting

### Problemi Comuni
1. **Icona Non Visualizzata**: Verificare registrazione in XotBaseServiceProvider
2. **Stile Non Applicato**: Controllare classi CSS e transizioni
3. **Animazioni Non Funzionanti**: Verificare supporto CSS e JavaScript
4. **Tema Non Compatibile**: Testare su diversi temi

### Soluzioni
1. **Cache**: Pulire cache Laravel e Filament
2. **Registrazione**: Verificare registrazione automatica icone
3. **CSS**: Controllare conflitti di stile
4. **JavaScript**: Verificare errori console

## Documentazione Obbligatoria

### File da Creare/Aggiornare
1. **Modulo**: `Modules/{ModuleName}/docs/svg_icon_standards.md`
2. **Root**: `docs/svg_icon_system_standards.md`
3. **README Modulo**: Aggiornare con sezione icone SVG
4. **README Root**: Aggiornare con sistema icone SVG

### Contenuto Documentazione
- Standard di design e template
- Esempi di implementazione
- Best practices e animazioni
- Troubleshooting e soluzioni
- Collegamenti bidirezionali

## Regole di Qualità

### 1. Design
- **Coerenza**: Stile uniforme tra tutti i moduli
- **Accessibilità**: Contrasto sufficiente per tema dark
- **Responsive**: Scalabilità per ogni dimensione
- **Performance**: Animazioni CSS ottimizzate

### 2. Implementazione
- **Struttura**: Organizzazione logica dei file
- **Naming**: Convenzioni consistenti
- **Versioning**: Varianti numerate progressive
- **Documentazione**: Aggiornamento continuo

### 3. Testing
- **Rendering**: Verifica su diversi temi
- **Animazioni**: Test transizioni e hover
- **Responsive**: Controllo su diversi dispositivi
- **Performance**: Ottimizzazione animazioni

## Collegamenti e Riferimenti

### Documentazione Interna
- [SVG Icon System Standards](../../docs/svg_icon_system_standards.md)
- [Employee SVG Standards](../laravel/Modules/Employee/docs/svg_icon_standards.md)
- [Xot Module Documentation](../laravel/Modules/Xot/docs/)
- [User Module Documentation](../laravel/Modules/User/docs/)

### Risorse Esterne
- [Heroicons](https://heroicons.com/) - Icone di riferimento
- [Blade Icons](https://github.com/blade-ui-kit/blade-icons) - Sistema Blade
- [SVG Best Practices](https://developer.mozilla.org/en-US/docs/Web/SVG) - Standard SVG

---

**CRITICAL**: Ogni modulo DEVE avere almeno `icon.svg` nella cartella `resources/svg/`. Le icone devono seguire lo stile Heroicon outline, essere pronte per il tema dark e includere animazioni CSS per hover e interazioni. Aggiornare SEMPRE la documentazione per nuove icone e standard.
