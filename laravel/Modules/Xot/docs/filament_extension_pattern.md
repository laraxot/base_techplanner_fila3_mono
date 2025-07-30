# Pattern di Estensione Filament

## Regola Fondamentale

**NON estendere MAI direttamente le classi Filament. Estendere SEMPRE le classi base con prefisso `XotBase` dal modulo Xot.**

Questa è una regola architetturale critica che garantisce:
- Compatibilità con aggiornamenti Filament
- Funzionalità personalizzate centralizzate
- Consistenza del codice in tutto il progetto
- Manutenibilità a lungo termine

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

## Struttura Namespace

Mantenere sempre la stessa struttura di namespace rispetto a Filament, ma usando il namespace del modulo:

```php
// Namespace originale Filament
namespace Filament\Resources\Pages;

// Namespace corretto nel modulo
namespace Modules\SaluteOra\Filament\Resources\Pages;
```

## Metodi delle Classi Base

Le classi `XotBase*` spesso forniscono:
- Metodi astratti che devi implementare
- Metodi finali che non possono essere sovrascritti
- Metodi hook per personalizzare il comportamento

Prima di implementare o sovrascrivere un metodo, verificare sempre che:
1. Il metodo non sia dichiarato come `final` nella classe base
2. Il metodo sia destinato ad essere sovrascritto (non un metodo interno)
3. La funzionalità non sia già fornita dalla classe XotBase

## Esempio: Infolist vs getInfolistSchema

```php
// ❌ ERRATO: Sovrascrivere un metodo final
public function infolist(Infolist $infolist): Infolist
{
    // Questo causerà un errore
}

// ✅ CORRETTO: Implementare il metodo astratto
protected function getInfolistSchema(): array
{
    return [
        // Schema corretto
    ];
}
```

## Vantaggi del Pattern

1. **Aggiornamenti Sicuri**: Quando Filament viene aggiornato, è sufficiente adattare solo le classi XotBase
2. **Funzionalità Centralizzate**: Le classi XotBase forniscono funzionalità comuni personalizzate per il progetto
3. **Consistenza**: Tutti i componenti Filament seguono lo stesso pattern
4. **Manutenibilità**: Modifiche centralizzate nelle classi base
5. **Estensibilità**: Facile aggiunta di nuove funzionalità

## Documentazione Correlata

- [Errore Override Metodo Final](/docs/errors/filament_final_method_override.md)
- [Linee Guida Filament](/Modules/SaluteOra/docs/filament-resources.md)
- [Architettura Filament-Xot](/Modules/Xot/docs/filament/xot_filament_architecture.md)
