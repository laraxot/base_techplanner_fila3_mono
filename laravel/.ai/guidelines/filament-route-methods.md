# Filament Route Methods - REGOLA ASSOLUTA

## ⚠️ REGOLA INVIOLABILE
**TUTTE LE PAGINE FILAMENT DEVONO AVERE IL METODO STATICO `route()` CORRETTAMENTE IMPLEMENTATO.**

## Problema Identificato

### ❌ ERRORE CRITICO: Metodo route() Mancante
```php
// ❌ ERRORE: XotBasePage senza metodo route()
class XotBasePage extends FilamentPage
{
    // MANCA: public static function route(string $path): PageRegistration
}

// Nel Resource:
public static function getPages(): array
{
    return [
        'preview' => Pages\PreviewNotificationTemplate::route('/preview'), // ❌ Method does not exist
    ];
}
```

**Errore PHP:** `BadMethodCallException: Method PreviewNotificationTemplate::route does not exist.`

## ✅ Soluzione Corretta

### 1. Implementazione del Metodo route() in XotBasePage
```php
// ✅ CORRETTO: XotBasePage con metodo route() completo
use Filament\Resources\Pages\PageRegistration;
use Filament\Panel;
use Illuminate\Support\Facades\Route;

abstract class XotBasePage extends FilamentPage
{
    /**
     * Create a route registration for this page.
     * 
     * @param string $path
     * @return PageRegistration
     */
    public static function route(string $path): PageRegistration
    {
        return new PageRegistration(
            page: static::class,
            route: fn (Panel $panel): \Illuminate\Routing\Route => Route::get($path, static::class)
                ->middleware(static::getRouteMiddleware($panel))
                ->withoutMiddleware(static::getWithoutRouteMiddleware($panel)),
        );
    }
}
```

### 2. Utilizzo Corretto nel Resource
```php
// ✅ CORRETTO: Registrazione pagina con route()
public static function getPages(): array
{
    return [
        ...parent::getPages(),
        'preview' => Pages\PreviewNotificationTemplate::route('/{record}/preview'),
    ];
}
```

### 3. Pagina Concrete che Estende XotBasePage
```php
// ✅ CORRETTO: Estensione XotBasePage
use Modules\Xot\Filament\Resources\Pages\XotBasePage;

class PreviewNotificationTemplate extends XotBasePage
{
    protected static string $resource = NotificationTemplateResource::class;
    protected static string $view = 'notify::preview-template';
    
    // Il metodo route() è ereditato da XotBasePage
}
```

## 📋 Import Richiesti per XotBasePage

```php
use Closure;
use Filament\Forms\Form;
use Filament\Panel;
use Illuminate\Support\Str;
use Webmozart\Assert\Assert;
use Illuminate\Support\Collection;
use Illuminate\Contracts\View\View;
use Filament\Forms\ComponentContainer;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\Component;
use Filament\Pages\Page as FilamentPage;
use Filament\Resources\Pages\PageRegistration; // ⚠️ CRITICAL
use Illuminate\Support\Facades\Route; // ⚠️ CRITICAL
use Modules\Xot\Filament\Traits\TransTrait;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Pages\Concerns\InteractsWithFormActions;
use Modules\Xot\Filament\Traits\NavigationLabelTrait;
```

## 🔍 Analisi dell'Errore

### Cosa è Successo
1. **XotBasePage** estendeva **FilamentPage** ma non implementava il metodo **route()**
2. **FilamentPage** di Filament HA il metodo **route()** che restituisce **PageRegistration**
3. **XotBasePage** SENZA route() → le pagine concrete non potevano usare **::route()**
4. **Errore**: `BadMethodCallException` quando si tenta di chiamare **ClassName::route()**

### Perché è Critico
- Il metodo **route()** è **statico** e deve essere disponibile sulla classe
- Filament lo usa per registrare dinamicamente le rotte
- Senza **route()**, le pagine custom non possono essere registrate in **getPages()**

## 🧠 Regole di Memoria

1. **XotBasePage** DEVE avere `public static function route(string $path): PageRegistration`
2. **PageRegistration** deve essere importato: `use Filament\Resources\Pages\PageRegistration;`
3. **Route facade** deve essere importato: `use Illuminate\Support\Facades\Route;`
4. **Panel** deve essere importato: `use Filament\Panel;`
5. Il metodo DEVE restituire `new PageRegistration(...)`

## ✅ Checklist Pre-Implementazione Pagine

- [ ] ✅ XotBasePage ha metodo route() che restituisce PageRegistration
- [ ] ✅ Tutti gli import necessari sono presenti in XotBasePage
- [ ] ✅ Le pagine concrete estendono XotBasePage (non FilamentPage direttamente)
- [ ] ✅ Le pagine sono registrate con `ClassName::route('/path')` in getPages()
- [ ] ✅ PHPStan non segnala errori sul metodo route()
- [ ] ✅ Testare la registrazione delle rotte con `php artisan route:list`

## 🔧 Verifica Rapida

```bash
# Verifica che le rotte siano registrate correttamente
php artisan route:list | grep PreviewNotificationTemplate

# Verifica che il metodo route() esista
php artisan tinker
>>> method_exists(\Modules\Notify\Filament\Resources\NotificationTemplateResource\Pages\PreviewNotificationTemplate::class, 'route')
# Dovrebbe restituire: true
```

## ⚠️ Errori Comuni da Evitare

### ❌ Metodo route() che restituisce stringa
```php
public static function route(string $path): string
{
    return static::class . '::' . $path; // ❌ SBAGLIATO
}
```

### ❌ Dimenticare gli import necessari
```php
// ❌ MANCANO IMPORT CRITICI
public static function route(string $path): PageRegistration // ❌ PageRegistration non importato
{
    return new PageRegistration( // ❌ Route facade non importato
        page: static::class,
        route: fn (Panel $panel) => Route::get($path, static::class) // ❌ Panel non importato
    );
}
```

### ❌ Estensione diretta di FilamentPage
```php
// ❌ VIETATO: Estensione diretta
class PreviewNotificationTemplate extends \Filament\Pages\Page
{
    // ERRORE: Non segue l'architettura XotBase
}
```

## 📚 Collegamenti alla Documentazione

- [XotBase Extension Rules](../xotbase-extension-rules.md)
- [Filament Architecture Best Practices](../architecture-patterns.md)
- [XotBase Patterns](../xot-base-patterns.md)

## 🚀 Deployment Checklist

Prima del deployment, verificare che:

1. [ ] Tutte le XotBasePage abbiano il metodo route() implementato
2. [ ] Tutti gli import necessari siano presenti
3. [ ] PHPStan non segnali errori sul metodo route()
4. [ ] Le rotte siano registrabili con `ClassName::route('/path')`
5. [ ] La documentazione sia aggiornata con questa regola

## 💡 Nota Importante

Questa regola si applica a TUTTE le pagine Filament che devono essere registrate in `getPages()`. Le pagine che non vengono registrate (ad esempio pagine standalone) non necessitano del metodo route().