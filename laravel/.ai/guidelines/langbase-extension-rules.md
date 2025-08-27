# LangBase Extension Rules - Multilingual Resources

## 🚨 Regola Fondamentale per Risorse Traducibili

**Per risorse con supporto multilingua, estendere SEMPRE le classi LangBase invece di XotBase.**

## 📋 Mappatura Classi LangBase

| Classe XotBase Originale | Classe LangBase da Usare | Per Cosa |
|--------------------------|--------------------------|----------|
| `XotBaseEditRecord` | `LangBaseEditRecord` | Pagine di modifica multilingua |
| `XotBaseCreateRecord` | `LangBaseCreateRecord` | Pagine di creazione multilingua |
| `XotBaseViewRecord` | `LangBaseViewRecord` | Pagine di visualizzazione multilingua |
| `XotBaseListRecords` | `LangBaseListRecords` | Pagine di elenco multilingua |

## ⚠️ Errori Critici da Evitare

### 1. ❌ Estensione Diretta XotBase per Risorse Traducibili
```php
// ❌ ERRORE: XotBase invece di LangBase per risorsa multilingua
use Modules\Xot\Filament\Resources\Pages\XotBaseEditRecord;

class EditPageContent extends XotBaseEditRecord
{
    use EditRecord\Concerns\Translatable; // ❌ Pattern errato
}
```

### 2. ❌ Duplicazione della Logica Translatable
```php
// ❌ ERRORE: Duplicazione concern Translatable
class EditPageContent extends XotBaseEditRecord
{
    use EditRecord\Concerns\Translatable; // ❌ Già presente in LangBaseEditRecord
    
    // Duplicazione inutile di funzionalità
}
```

## ✅ Pattern Corretti di Implementazione

### Edit Record Multilingua
```php
<?php

declare(strict_types=1);

namespace Modules\Cms\Filament\Resources\PageContentResource\Pages;

use Filament\Actions;
use Modules\Lang\Filament\Resources\Pages\LangBaseEditRecord;
use Modules\Cms\Filament\Resources\PageContentResource;

class EditPageContent extends LangBaseEditRecord // ✅ CORRETTO
{
    protected static string $resource = PageContentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
            Actions\LocaleSwitcher::make(), // ✅ Già incluso in LangBase
        ];
    }
}
```

### Create Record Multilingua
```php
<?php

declare(strict_types=1);

namespace Modules\Cms\Filament\Resources\PageResource\Pages;

use Modules\Lang\Filament\Resources\Pages\LangBaseCreateRecord;
use Modules\Cms\Filament\Resources\PageResource;

class CreatePage extends LangBaseCreateRecord // ✅ CORRETTO
{
    protected static string $resource = PageResource::class;
    
    // ✅ LangBaseCreateRecord già include Translatable concern
    // ✅ LangBaseCreateRecord già include LocaleSwitcher
}
```

## 🏗️ Architettura LangBase

### Gerarchia delle Classi
```
Filament\Resources\Pages\EditRecord
    ↓
Modules\Xot\Filament\Resources\Pages\XotBaseEditRecord
    ↓
Modules\Lang\Filament\Resources\Pages\LangBaseEditRecord
    ↓
Modules\Cms\Filament\Resources\PageContentResource\Pages\EditPageContent
```

### Componenti Inclusi in LangBase
- **Translatable Concern**: Gestione automatica delle traduzioni
- **LocaleSwitcher**: Switch della lingua nell'header
- **Configurazione Multilingua**: Setup preconfigurato per risorse traduciibili
- **Ereditarietà Completa**: Tutte le funzionalità di XotBase + multilingua

## 🔍 Come Identificare Risorse Traducibili

### 1. Modelli con Traduzioni
```php
// Modelli che usano HasTranslations o similar
class PageContent extends BaseModel
{
    use \Spatie\Translatable\HasTranslations;
    
    public array $translatable = ['title', 'content'];
}
```

### 2. Risorse con Campi Traducibili
```php
// Resource con campi che usano ->translatable()
class PageContentResource extends XotBaseResource
{
    public static function getFormSchema(): array
    {
        return [
            \Filament\Forms\Components\TextInput::make('title')->translatable(),
            \Filament\Forms\Components\RichEditor::make('content')->translatable(),
        ];
    }
}
```

### 3. Tabelle con Colonne Traducibili
```php
// Table con colonne traducibili
public static function getTableColumns(): array
{
    return [
        \Filament\Tables\Columns\TextColumn::make('title')->translatable(),
    ];
}
```

## 📝 Checklist Pre-Implementazione Multilingua

- [ ] ✅ Verificare se il modello usa traduzioni (HasTranslations)
- [ ] ✅ Verificare se la resource ha campi traducibili (->translatable())
- [ ] ✅ Estendere LangBase* invece di XotBase*
- [ ] ✅ Non duplicare Translatable concern (già in LangBase)
- [ ] ✅ Non duplicare LocaleSwitcher (già in LangBase)
- [ ] ✅ Verificare namespace corretto (Modules\Lang\Filament\*)
- [ ] ✅ Testare il cambio lingua nell'interfaccia
- [ ] ✅ Verificare il salvataggio delle traduzioni

## 🧠 Regole di Memoria

1. **Modello traduciibile** → **Usa LangBase**
2. **Campi ->translatable()** → **Usa LangBase**  
3. **LocaleSwitcher necessario** → **Usa LangBase**
4. **Sempre LangBase** per risorse multilingua

## 🔗 Documentazione Collegata

- [XotBase Extension Rules](../xotbase-extension-rules.md)
- [Translatable Models Guidelines](../../Modules/Lang/docs/translatable-models.md)
- [Multilingual Filament Resources](../../Modules/Lang/docs/filament-multilingual.md)

## 🎯 Best Practices

1. **Centralizzazione**: Tutta la logica multilingua in LangBase
2. **DRY**: Mai duplicare Translatable concern o LocaleSwitcher
3. **Coerenza**: Stesso pattern per tutte le risorse traduciibili
4. **Manutenibilità**: Modifiche globali tramite classi LangBase
5. **Testabilità**: Verificare tutte le lingue supportate

---

**⚠️ IMPORTANTE**: Per risorse con supporto multilingua, queste regole sono assolute. Violarle causerà duplicazione di codice e comportamenti inconsistenti.