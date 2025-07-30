# Regole Architetturali Filament

## Regola Fondamentale

**NON estendere MAI direttamente le classi Filament. Estendere SEMPRE le classi base con prefisso `XotBase` dal modulo Xot.**

Questa è una regola architetturale critica che deve essere rispettata in tutto il progetto.

## Motivazione

1. **Compatibilità con Aggiornamenti**: Quando Filament viene aggiornato, è sufficiente adattare solo le classi XotBase
2. **Funzionalità Centralizzate**: Le classi XotBase forniscono funzionalità comuni personalizzate per il progetto
3. **Consistenza**: Tutti i componenti Filament seguono lo stesso pattern
4. **Manutenibilità**: Modifiche centralizzate nelle classi base
5. **Estensibilità**: Facile aggiunta di nuove funzionalità

## Mappatura delle Classi

| Classe Filament Originale | Classe Base da Utilizzare |
|---------------------------|---------------------------|
| `\Filament\Pages\Page` | `Modules\Xot\Filament\Pages\XotBasePage` |
| `\Filament\Pages\Dashboard` | `Modules\Xot\Filament\Pages\XotBaseDashboard` |
| `\Filament\Resources\Resource` | `Modules\Xot\Filament\Resources\XotBaseResource` |
| `\Filament\Resources\Pages\ListRecords` | `Modules\Xot\Filament\Resources\Pages\XotBaseListRecords` |
| `\Filament\Resources\Pages\CreateRecord` | `Modules\Xot\Filament\Resources\Pages\XotBaseCreateRecord` |
| `\Filament\Resources\Pages\EditRecord` | `Modules\Xot\Filament\Resources\Pages\XotBaseEditRecord` |
| `\Filament\Resources\Pages\ViewRecord` | `Modules\Xot\Filament\Resources\Pages\XotBaseViewRecord` |
| `\Filament\Widgets\Widget` | `Modules\Xot\Filament\Widgets\XotBaseWidget` |
| `\Filament\Resources\RelationManagers\RelationManager` | `Modules\Xot\Filament\Resources\RelationManagers\XotBaseRelationManager` |

## Esempi di Implementazione

### ❌ ERRATO - Estensione Diretta
```php
// MAI fare questo
class DoctorResource extends Resource
{
    // Questo viola la regola fondamentale
}
```

### ✅ CORRETTO - Estensione XotBase
```php
// SEMPRE fare questo
class DoctorResource extends XotBaseResource
{
    // Questo rispetta l'architettura del sistema
}
```

## Controlli Pre-Implementazione

Prima di implementare o sovrascrivere un metodo, verificare sempre:

1. Il metodo non sia dichiarato come `final` nella classe base
2. Il metodo sia destinato ad essere sovrascritto (non un metodo interno)
3. La funzionalità non sia già fornita dalla classe XotBase

## Documentazione Correlata

- [Pattern di Estensione Filament](/docs/patterns/filament-extension.md)
- [Architettura Filament-Xot](/Modules/Xot/docs/filament/xot_filament_architecture.md)
- [Pattern di Estensione Xot](/Modules/Xot/docs/filament_extension_pattern.md) 