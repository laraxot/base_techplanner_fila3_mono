# REGOLA CRITICA: Ereditarietà XotBase in Laraxot

## ⚠️ REGOLA FONDAMENTALE ASSOLUTA ⚠️

**MAI estendere classi Filament direttamente. SEMPRE usare le classi XotBase.**

## Mappatura Obbligatoria

### Widget
```php
// ❌ ERRATO - MAI fare questo
use Filament\Widgets\Widget;
class MyWidget extends Widget {}

// ✅ CORRETTO - SEMPRE fare questo
use Modules\Xot\Filament\Widgets\XotBaseWidget;
class MyWidget extends XotBaseWidget {}
```

### Resource Pages
```php
// ❌ ERRATO
use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Pages\EditRecord;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Pages\Page;

// ✅ CORRETTO
use Modules\Xot\Filament\Resources\Pages\XotBaseCreateRecord;
use Modules\Xot\Filament\Resources\Pages\XotBaseEditRecord;
use Modules\Xot\Filament\Resources\Pages\XotBaseListRecords;
use Modules\Xot\Filament\Resources\Pages\XotBasePage;
```

### Resources
```php
// ❌ ERRATO
use Filament\Resources\Resource;
class MyResource extends Resource {}

// ✅ CORRETTO
use Modules\Xot\Filament\Resources\XotBaseResource;
class MyResource extends XotBaseResource {}
```

## Regole Specifiche

### XotBaseResource
- **Chi estende XotBaseResource NON deve implementare getTableColumns()**
- **Le classi XotBase gestiscono automaticamente la configurazione**
- **Rispettano il vecchio percorso per compatibilità**

### XotBaseWidget
- **Fornisce metodi aggiuntivi per integrazione**
- **Gestisce automaticamente permessi e configurazioni**
- **Supporta il sistema di traduzioni Laraxot**

## Motivazione Architettonica

1. **Centralizzazione**: Tutte le personalizzazioni Laraxot in un punto
2. **Compatibilità**: Rispetto del vecchio percorso
3. **Estendibilità**: Funzionalità aggiuntive senza modificare Filament
4. **Manutenibilità**: Aggiornamenti Filament senza breaking changes
5. **Coerenza**: Comportamento uniforme in tutto il framework

## Checklist Verifica

- [ ] Nessuna classe estende direttamente Filament
- [ ] Tutti i widget estendono XotBaseWidget
- [ ] Tutte le pagine estendono XotBase{PageType}
- [ ] Tutte le risorse estendono XotBaseResource
- [ ] Nessun getTableColumns() in classi che estendono XotBaseResource

## Errori da Evitare

### Widget
```php
// ❌ CRITICO
class TodoWidget extends Widget // MAI!

// ✅ SEMPRE
class TodoWidget extends XotBaseWidget
```

### Resource
```php
// ❌ CRITICO  
class UserResource extends Resource // MAI!

// ✅ SEMPRE
class UserResource extends XotBaseResource
```

## Implementazione Immediata

Questa regola deve essere applicata:
1. **Immediatamente** a tutto il codice esistente
2. **Sempre** per nuovo codice
3. **Senza eccezioni** in nessun caso

## Collegamenti

- [XotBase Extension Rules](../../laravel/Modules/Employee/docs/xotbase_extension_rules.md)
- [Filament Widget Guidelines](../../laravel/Modules/Employee/docs/filament_widgets.md)
- [Laraxot Architecture](../../docs/laraxot_conventions.md)

---

**CRITICITÀ**: MASSIMA  
**APPLICAZIONE**: IMMEDIATA  
**ECCEZIONI**: NESSUNA  
**DATA**: 6 gennaio 2025

