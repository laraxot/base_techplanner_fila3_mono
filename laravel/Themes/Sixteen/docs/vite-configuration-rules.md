# Regole per la Configurazione Vite - Tema Sixteen

## 🚨 REGOLA FONDAMENTALE - Direttiva @vite

**SEMPRE usare il secondo parametro 'themes/Sixteen' nella direttiva @vite**

### ✅ Sintassi Corretta

```blade
@vite(['resources/css/app.css', 'resources/js/app.js'], 'themes/Sixteen')
```

### ❌ Sintassi da NON Usare

```blade
@vite(['resources/css/app.css', 'resources/js/app.js'])
```

## 📋 Motivazione Tecnica

Il secondo parametro `'themes/Sixteen'` è **obbligatorio** perché:

1. **Configurazione Vite Separata**: Il tema Sixteen ha il suo `vite.config.js` indipendente
2. **Build Directory Specifico**: Gli asset vengono compilati in `./resources/dist` del tema
3. **Manifest Separato**: Laravel deve sapere quale manifest utilizzare per risolvere gli asset
4. **Risoluzione Path**: Senza il secondo parametro, Laravel cerca nel manifest principale causando errori

## 🔧 Configurazione Vite del Tema

Dal file `vite.config.js` del tema:

```javascript
export default defineConfig({
    build: {
        outDir: './resources/dist',  // Directory specifica del tema
        emptyOutDir: false,
        manifest: 'manifest.json',   // Manifest separato
    },
    // ...
});
```

## 📁 File Corretti

✅ **CORRETTO** - `resources/views/components/layouts/guest.blade.php`:

```blade
@vite(['resources/css/app.css', 'resources/js/app.js'], 'themes/Sixteen')
```

## ❌ Errori Comuni da Evitare

**NON utilizzare mai** Vite senza il secondo parametro:

```blade
<!-- ❌ ERRATO - Manca il secondo parametro tema -->
@vite(['resources/css/app.css', 'resources/js/app.js'])
```

## 📋 Motivazione Tecnica

### Perché Serve il Secondo Parametro?

1. **Isolamento Tema**: Ogni tema ha i propri asset compilati separatamente
2. **Build Path Corretto**: Vite deve sapere dove cercare i file compilati del tema
3. **Manifest Specifico**: Ogni tema ha il proprio manifest.json per gli asset
4. **Evitare Conflitti**: Previene conflitti tra asset di temi diversi
5. **Hot Reload**: Funzionamento corretto del hot reload durante lo sviluppo

### Struttura Asset del Tema

Il tema Sixteen ha questa struttura per gli asset:

```
Themes/Sixteen/
├── resources/
│   ├── css/
│   │   └── app.css
│   └── js/
│       └── app.js
├── dist/                    # Asset compilati
│   ├── manifest.json
│   ├── assets/
│   │   ├── app-[hash].css
│   │   └── app-[hash].js
└── vite.config.js
```

## 🔧 Implementazione Corretta per Layout

### Layout Guest (Autenticazione)

```blade
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>{{ config('app.name', 'Laravel') }}</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    
    <!-- Scripts con tema specificato -->
    @vite(['resources/css/app.css', 'resources/js/app.js'], 'themes/Sixteen')
</head>
<body>
    <!-- Contenuto del layout -->
</body>
</html>
```

### Layout App (Applicazione)

```blade
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Meta tags -->
    
    <!-- Scripts con tema specificato -->
    @vite(['resources/css/app.css', 'resources/js/app.js'], 'themes/Sixteen')
</head>
<body>
    <!-- Contenuto del layout -->
</body>
</html>
```

### Layout Base (Separato CSS/JS)

```blade
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Meta tags -->
    
    <!-- CSS del tema -->
    @vite(['resources/css/app.css'], 'themes/Sixteen/dist')
</head>
<body>
    <!-- Contenuto del layout -->
    
    <!-- JS del tema -->
    @vite(['resources/js/app.js'], 'themes/Sixteen/dist')
</body>
</html>
```

## 🔍 File da Correggere

### Layout che Necessitano Correzione

I seguenti file hanno la configurazione Vite errata e devono essere corretti:

1. **`resources/views/layouts/guest.blade.php`** ❌
   - Attuale: `@vite(['resources/css/app.css', 'resources/js/app.js'])`
   - Corretto: `@vite(['resources/css/app.css', 'resources/js/app.js'], 'themes/Sixteen')`

2. **`resources/views/layouts/app.blade.php`** ❌
   - Attuale: `@vite(['resources/css/app.css', 'resources/js/app.js'])`
   - Corretto: `@vite(['resources/css/app.css', 'resources/js/app.js'], 'themes/Sixteen')`

3. **`resources/views/components/layouts/guest.blade.php`** ❌
   - Attuale: `@vite(['resources/css/app.css', 'resources/js/app.js'])`
   - Corretto: `@vite(['resources/css/app.css', 'resources/js/app.js'], 'themes/Sixteen')`

### Layout già Corretti

I seguenti file hanno già la configurazione corretta:

1. **`resources/views/layouts/base.blade.php`** ✅
   - Usa: `@vite(['resources/css/app.css'], 'themes/Sixteen/dist')`

2. **`resources/views/components/layouts/main.blade.php`** ✅
   - Usa: `@vite(['resources/css/app.css'], 'themes/Sixteen/dist')`

## 🚨 Errori Comuni e Soluzioni

### Errore: "Unable to locate file in Vite manifest"

**Causa**: Vite non trova il manifest del tema perché manca il secondo parametro

**Messaggio di errore**:
```
Unable to locate file in Vite manifest: resources/css/app.css
```

**Soluzione**:
1. Correggere la direttiva Vite aggiungendo il secondo parametro
2. Eseguire il build degli asset del tema:
   ```bash
   cd /var/www/html/_bases/base_techplanner_fila3_mono/laravel/Themes/Sixteen
   npm run build
   # oppure
   npm run copy
   ```

### Errore: Asset non caricati correttamente

**Causa**: Il tema non viene specificato e Vite cerca gli asset nella root

**Soluzione**: Specificare sempre il tema come secondo parametro

## 📚 Varianti di Configurazione

### Configurazione Unificata (Consigliata per sviluppo)

```blade
@vite(['resources/css/app.css', 'resources/js/app.js'], 'themes/Sixteen')
```

### Configurazione Separata (Consigliata per produzione)

```blade
<!-- Nel <head> -->
@vite(['resources/css/app.css'], 'themes/Sixteen/dist')

<!-- Prima della chiusura </body> -->
@vite(['resources/js/app.js'], 'themes/Sixteen/dist')
```

### Configurazione con Asset Aggiuntivi

```blade
@vite([
    'resources/css/app.css',
    'resources/css/theme.css',
    'resources/js/app.js',
    'resources/js/theme.js'
], 'themes/Sixteen')
```

## 🎯 Checklist Implementazione

Prima di utilizzare Vite in un layout del tema Sixteen:

- [ ] Specificare sempre il secondo parametro del tema
- [ ] Verificare che il path del tema sia corretto
- [ ] Testare che gli asset si carichino correttamente
- [ ] Controllare che non ci siano errori di manifest
- [ ] Eseguire il build degli asset se necessario

## 📖 Documentazione Correlata

- [assets.md](assets.md) - Gestione degli asset Vite
- [layout-usage-rules.md](layout-usage-rules.md) - Regole per l'uso dei layout
- [README.md](README.md) - Documentazione generale del tema

---

**Regola stabilita**: 31 Luglio 2025  
**Autorità**: Analisi dei layout esistenti del tema Sixteen  
**Stato**: REGOLA FONDAMENTALE  
**Priorità**: CRITICA

**Motivazione**: Il tema Sixteen richiede il secondo parametro di Vite per funzionare correttamente. Senza questo parametro, gli asset non vengono caricati e si verificano errori di manifest.
